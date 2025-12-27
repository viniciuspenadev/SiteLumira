<?php
header('Content-Type: application/json');

// Security: CORs & Origin Check
$allowed_origins = [
    'http://localhost',
    'http://127.0.0.1',
    'https://colegiolumira.com.br',
    'https://www.colegiolumira.com.br',
    'https://lumira.aiconverse.com.br'
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? $_SERVER['HTTP_REFERER'] ?? '';
$origin_parsed = parse_url($origin, PHP_URL_SCHEME) . '://' . parse_url($origin, PHP_URL_HOST);

// If running locally, we might need to adjust port matching or just be lenient on localhost
if (strpos($origin, 'localhost') !== false || strpos($origin, '127.0.0.1') !== false) {
    header("Access-Control-Allow-Origin: *");
} elseif (in_array($origin_parsed, $allowed_origins)) {
    header("Access-Control-Allow-Origin: $origin_parsed");
} else {
    // Optional: Block strict in production
    // http_response_code(403);
    // exit(json_encode(['success' => false, 'error' => 'Forbidden Origin']));
}

header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Enable detailed error reporting for logging
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Load Dependencies
$secrets = include '../includes/secrets.php';
require_once '../includes/supabase_helper.php';

$apiKey = $secrets['GEMINI_API_KEY'] ?? null;
$model = $secrets['GEMINI_MODEL'] ?? 'gemini-flash-latest';
$sbUrl = $secrets['SUPABASE_URL'] ?? null;
$sbKey = $secrets['SUPABASE_KEY'] ?? null;

// Initialize Supabase
$supabase = new SupabaseHelper($sbUrl, $sbKey);

// Helper function for JSON response
function sendResponse($success, $data = [], $error = null)
{
    echo json_encode(['success' => $success, 'response' => $data, 'error' => $error]);
    exit;
}

// 1. Validate Request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, null, 'Method Not Allowed');
}

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';
$conversationId = $input['conversation_id'] ?? null;
$inputHistory = $input['history'] ?? []; // Fallback if DB fetch fails or is empty

if (empty($userMessage)) {
    sendResponse(false, null, 'Empty message');
}

if (!$apiKey || !$sbUrl) {
    sendResponse(false, "Desculpe, sistema em manutenção.", 'Missing Config');
}

// 2. Manage Conversation Session
if (!$conversationId) {
    // New Conversation
    $newConv = $supabase->createConversation();
    if ($newConv && isset($newConv[0]['id'])) {
        $conversationId = $newConv[0]['id'];
    } else {
        error_log("Failed to create conversation in Supabase");
    }
}

// 3. Save User Message to DB
if ($conversationId) {
    $supabase->addMessage($conversationId, 'user', $userMessage);
}

// 4. Build Context (History)
// We try to fetch the last 10 messages from DB to maintain context.
$contents = [];
$dbMessages = [];

if ($conversationId) {
    // Fetch recent messages provided by SupabaseHelper
    // We need to implement a limit logic in helper or just take the last ones.
    // Assuming getMessages returns all, we slice the last 10.
    $allMessages = $supabase->getMessages($conversationId);
    if ($allMessages) {
        $dbMessages = array_slice($allMessages, -10); // Keep last 10 interactions
    }
}

if (!empty($dbMessages)) {
    foreach ($dbMessages as $msg) {
        // Map DB role to Gemini role
        $role = ($msg['role'] === 'user') ? 'user' : 'model';
        // Skip the current message we just saved to avoid duplication if we fetched it?
        // Supabase `addMessage` adds it. `getMessages` fetches it. 
        // So `dbMessages` INCLUDES the current `$userMessage`.
        // Gemini API expects the inputs.
        // If the very last message in `dbMessages` is identical to `$userMessage` (and is user), we can use it.
        // But to be safe and strictly ordered:

        $contents[] = [
            'role' => $role,
            'parts' => [['text' => $msg['content']]]
        ];
    }
} else {
    // Fallback to Frontend History if DB is empty (e.g. first msg or logic error)
    // Note: Frontend history includes the Welcome message (model).
    foreach ($inputHistory as $msg) {
        if (isset($msg['role']) && isset($msg['parts'][0]['text'])) {
            $contents[] = [
                'role' => $msg['role'] === 'user' ? 'user' : 'model',
                'parts' => [['text' => $msg['parts'][0]['text']]]
            ];
        }
    }
    // Add current user message if not in history yet
    $contents[] = [
        'role' => 'user',
        'parts' => [['text' => $userMessage]]
    ];
}

// 5. Prepare System Prompt (Refined)
$systemPrompt = <<<EOT
Você é a atendente virtual do Colégio Lumirá.
**Seu Objetivo:** Agendar visitas e captar novos alunos (Leads).

**Regras de Comportamento:**
1. **Assuma que é um NOVO CLIENTE:** Não pergunte se o filho já estuda na escola, a menos que a pessoa diga algo como "preciso falar com a professora" ou "boleto atrasado".
2. **Respostas Curtas:** Use no máximo 2 ou 3 frases curtas. Mensagem estilo WhatsApp.
3. **Conversa:** Seja acolhedora. Pergunte o nome da criança e a idade para direcionar (Berçário ou Pré-escola).
4. **Extração:** Se identificar Nome ou Telefone, continue agindo naturalmente.

**Não use:**
- Listas com tópicos ou bullet points.
- Texto quebrado no meio.
- Pedidos de desculpas excessivos.

**Exemplo de Fluxo:**
- Usuário: "Oi, queria saber preço."
- Você: "Olá! Temos condições especiais. Para qual idade seria a vaga? 😊"
- Usuário: "Para meu filho de 3 anos."
- Você: "Ah, que fase gostosa! Seria para o Maternal. Qual o seu nome e WhatsApp para eu te passar a proposta detalhada?"
EOT;

// 5a. Inject System Prompt into Context
// The reference project puts the prompt inside the text. 
// We will prepend it as a strict "developer/user" instruction to ensure the model behaves content-aware.
array_unshift($contents, [
    'role' => 'user',
    'parts' => [['text' => "System Instruction:\n" . $systemPrompt]]
]);

// 6. Call Gemini API
// Using v1beta for compatibility with 'gemini-flash-latest'
$url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

$payload = [
    'contents' => $contents,
    // 'systemInstruction' removed to avoid 400 errors on some versions
    'generationConfig' => [
        'temperature' => 0.7,
        'maxOutputTokens' => 300,
        'stopSequences' => []
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
// SSL Verification: False on Localhost, True on Production
$isLocal = ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, !$isLocal);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    error_log("Gemini Error ({$httpCode}): " . $response);

    if ($httpCode === 429) {
        sendResponse(false, null, "Muitas pessoas falando comigo! 😅 Tente de novo em 30 segundos.");
    }

    sendResponse(false, null, "Erro no Gemini: $httpCode");
}

$decoded = json_decode($response, true);
$aiReply = $decoded['candidates'][0]['content']['parts'][0]['text'] ?? "Desculpe, não entendi.";

// 7. Save AI Reply to DB
if ($conversationId) {
    $supabase->addMessage($conversationId, 'model', $aiReply);

    // --- AI INTELLIGENCE LAYER (Background Analysis) ---
    // We ignore errors here so user doesn't see "API Error" if just the analysis fails.
    try {
        $analysisPrompt = <<<EOT
Analise a conversa:
Última msg Usuário: "$userMessage"
Última msg IA: "$aiReply"

Extraia em JSON:
{
  "name": "Nome do visitante ou null",
  "contact": "Telefone/Email ou null",
  "summary": "Resumo atualizado da intenção (ex: Mãe de aluno, Agendamento)"
}
EOT;

        $analysisPayload = [
            'contents' => [['role' => 'user', 'parts' => [['text' => $analysisPrompt]]]],
            'generationConfig' => ['responseMimeType' => 'application/json']
        ];

        $ch2 = curl_init($url);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_POST, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($analysisPayload));
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, !$isLocal);

        $analysisRaw = curl_exec($ch2);
        curl_close($ch2);

        $analysisData = json_decode(json_decode($analysisRaw, true)['candidates'][0]['content']['parts'][0]['text'] ?? '{}', true);

        if (!empty($analysisData)) {
            $visitorName = $analysisData['name'] ?? null;
            $visitorContact = $analysisData['contact'] ?? null;
            $summary = $analysisData['summary'] ?? null;

            $supabase->updateVisitorInfo($conversationId, $visitorName, $visitorContact);
            if ($summary) {
                $supabase->updateSummary($conversationId, $summary);
            }
        }
    } catch (Exception $e) {
        error_log("Analytics Error: " . $e->getMessage());
        // Do not stop execution
    }
}

// 8. Respond to User
echo json_encode([
    'success' => true,
    'response' => $aiReply,
    'conversation_id' => $conversationId
]);
?>