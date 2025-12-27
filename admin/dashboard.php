<?php
$secrets = include '../includes/secrets.php';
require_once '../includes/supabase_helper.php';

// Check for Supabase Token
if (!isset($_COOKIE['sb_access_token'])) {
    header('Location: login.php');
    exit;
}

$accessToken = $_COOKIE['sb_access_token'];

// Initialize with the PROJECT ANON KEY first (for the apikey header)
$supabase = new SupabaseHelper($secrets['SUPABASE_URL'], $secrets['SUPABASE_KEY']);
// Then set the USER TOKEN for RLS authorization
$supabase->setToken($accessToken);

// Get all conversations for sidebar
$conversations = $supabase->getConversations() ?? [];

// Get selected conversation details
$selectedId = $_GET['chat_id'] ?? ($conversations[0]['id'] ?? null);
$messages = [];
$currentConv = null;

if ($selectedId) {
    // Find info in loaded conversations or fetch specific?
    // Let's filter from the array to save API calls, or just find it.
    foreach ($conversations as $c) {
        if ($c['id'] == $selectedId) {
            $currentConv = $c;
            break;
        }
    }

    // Fetch Messages
    if ($currentConv) {
        $messages = $supabase->getMessages($selectedId) ?? [];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Lumirá - Atendimento</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden">

    <!-- Global Nav -->
    <?php include 'components/sidebar.php'; ?>

    <!-- SIDEBAR: Conversation List -->
    <div class="w-80 bg-white border-r border-gray-200 flex flex-col h-full">
        <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h2 class="font-bold text-lg text-slate-800">Conversas</h2>
            <div class="flex gap-2">
                <a href="?refresh=1" class="text-slate-400 hover:text-orange-500 p-1" title="Atualizar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 2v6h-6"></path>
                        <path d="M3 12a9 9 0 0 1 15-6.7L21 8"></path>
                        <path d="M3 22v-6h6"></path>
                        <path d="M21 12a9 9 0 0 1-15 6.7L3 16"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="overflow-y-auto flex-1">
            <?php if (empty($conversations)): ?>
                <div class="p-4 text-center text-slate-400 text-sm mt-10">Nenhuma conversa encontrada.</div>
            <?php endif; ?>

            <?php foreach ($conversations as $conv): ?>
                <?php
                $active = ($conv['id'] == $selectedId) ? 'bg-orange-50 border-r-4 border-orange-500' : 'hover:bg-gray-50';
                $time = date('H:i', strtotime($conv['last_message_at']));
                $name = $conv['visitor_name'] ?? 'Visitante #' . substr($conv['id'], 0, 4);
                $summary = $conv['ai_summary'] ? substr($conv['ai_summary'], 0, 50) . '...' : 'Iniciando conversa...';
                ?>
                <a href="?chat_id=<?= $conv['id'] ?>"
                    class="block p-4 border-b border-gray-100 transition-colors <?= $active ?>">
                    <div class="flex justify-between items-baseline mb-1">
                        <span
                            class="font-semibold text-slate-800 text-sm truncate w-32"><?= htmlspecialchars($name) ?></span>
                        <span class="text-[10px] text-slate-400 font-medium"><?= $time ?></span>
                    </div>
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                        <?= htmlspecialchars($summary) ?>
                    </p>
                    <?php if ($conv['visitor_contact']): ?>
                        <div
                            class="mt-2 text-[10px] bg-green-100 text-green-700 inline-block px-1.5 py-0.5 rounded border border-green-200">
                            📞 Contato Capturado
                        </div>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- MAIN AREA -->
    <?php if ($currentConv): ?>
        <div class="flex-1 flex flex-col h-full relative">

            <!-- Chat Header -->
            <div class="h-16 border-b border-gray-200 bg-white flex items-center justify-between px-6 shadow-sm z-10">
                <div class="flex items-center gap-3 relative z-10">
                    <div
                        class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold border border-orange-200">
                        <?= strtoupper(substr($currentConv['visitor_name'] ?? 'V', 0, 1)) ?>
                    </div>
                    <div>
                        <h1 class="font-bold text-slate-800 leading-tight">
                            <?= htmlspecialchars($currentConv['visitor_name'] ?? 'Visitante Desconhecido') ?>
                        </h1>
                        <p class="text-xs text-slate-500">
                            ID: <?= substr($currentConv['id'], 0, 8) ?> •
                            <span class="text-green-600 font-medium">Status: Ativo</span>
                        </p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <!-- Delete Button -->
                    <a href="delete_conversation.php?id=<?= $currentConv['id'] ?>"
                        onclick="return confirm('ATENÇÃO: Tem certeza que deseja excluir esta conversa permanentemente?');"
                        class="bg-white hover:bg-red-50 text-red-500 border border-red-200 px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 shadow-sm transition-all hover:shadow-md hover:border-red-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>
                        Excluir
                    </a>

                    <?php if ($currentConv['visitor_contact']):
                        // Clean phone for whatsapp link
                        $phone = preg_replace('/[^0-9]/', '', $currentConv['visitor_contact']);
                        ?>
                        <a href="https://wa.me/55<?= $phone ?>" target="_blank"
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 shadow-sm transition-all hover:shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                            Chamar no WhatsApp
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex flex-1 overflow-hidden">
                <!-- Chat Messages -->
                <div class="flex-1 p-6 overflow-y-auto space-y-4 bg-slate-50 relative">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-5 pointer-events-none"
                        style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 20px 20px;">
                    </div>

                    <?php foreach ($messages as $msg):
                        $isUser = $msg['role'] === 'user';
                        ?>
                        <div class="flex <?= $isUser ? 'justify-start' : 'justify-end' ?>">
                            <!-- User Msg (Left) / AI Msg (Right) - Inverting standard for admin view actually allows seeing 'Customer' on Left usually in CRMs, but standard chat is Right(Me). 
                                  Let's keep: User = Left (Customer), AI = Right (Us/Bot) -->
                            <div class="max-w-xl <?= $isUser ? 'order-1' : 'order-2' ?>">
                                <div class="px-4 py-3 rounded-2xl text-sm shadow-sm border relative z-10
                                    <?= $isUser
                                        ? 'bg-white text-slate-700 rounded-tl-none border-slate-200'
                                        : 'bg-orange-100 text-slate-800 rounded-tr-none border-orange-200'
                                        ?>">
                                    <?= nl2br(htmlspecialchars($msg['content'])) ?>
                                </div>
                                <span
                                    class="text-[10px] text-slate-400 mt-1 block <?= $isUser ? 'text-left ml-1' : 'text-right mr-1' ?>">
                                    <?= $isUser ? 'Cliente' : 'Lumirá IA' ?> • <?= date('H:i', strtotime($msg['created_at'])) ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- RIGHT SIDEBAR: AI Summary Dashboard -->
                <div class="w-80 bg-white border-l border-gray-200 p-6 shadow-xl z-20 overflow-y-auto">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Raio-X do Lead (IA)</h3>

                    <div class="space-y-6">
                        <!-- AI Summary Card -->
                        <div
                            class="bg-gradient-to-br from-indigo-50 to-blue-50 p-4 rounded-xl border border-indigo-100 shadow-sm relative overflow-hidden group">
                            <div class="absolute top-0 right-0 p-2 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z" />
                                    <path
                                        d="M12 6a1 1 0 0 0-1 1v5a1 1 0 0 0 .29.71l3.5 3.5a1 1 0 0 0 1.42-1.42L13 11.59V7a1 1 0 0 0-1-1z" />
                                </svg>
                            </div>
                            <h4 class="text-indigo-900 font-bold text-sm mb-2 flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                Resumo Inteligente
                            </h4>
                            <p class="text-sm text-indigo-800 leading-relaxed">
                                <?= $currentConv['ai_summary'] ? nl2br(htmlspecialchars($currentConv['ai_summary'])) : 'Aguardando análise da IA...' ?>
                            </p>
                        </div>

                        <!-- Contact Details -->
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Nome Identificado</label>
                            <div
                                class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-slate-700 font-medium">
                                <?= $currentConv['visitor_name'] ?? '-' ?>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Contato / WhatsApp</label>
                            <div
                                class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-slate-700 font-medium flex justify-between items-center group cursor-pointer hover:border-orange-300 transition-colors">
                                <?= $currentConv['visitor_contact'] ?? '-' ?>
                                <?php if ($currentConv['visitor_contact']): ?>
                                    <svg class="text-slate-400 group-hover:text-orange-500" xmlns="http://www.w3.org/2000/svg"
                                        width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Tags / Status (Mocked for visual) -->
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-2">Interesse Provável</label>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="px-2 py-1 bg-slate-100 text-slate-600 text-xs rounded-full border border-slate-200">Educação
                                    Infantil</span>
                                <span
                                    class="px-2 py-1 bg-slate-100 text-slate-600 text-xs rounded-full border border-slate-200">Matrícula
                                    2025</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    <?php else: ?>
        <!-- Empty State -->
        <div class="flex-1 flex flex-col items-center justify-center p-10 bg-gray-50 text-slate-400">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="opacity-50">
                    <line x1="21" y1="15" x2="21" y2="15"></line>
                    <line x1="21" y1="9" x2="21" y2="9"></line>
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold mb-2">Selecione uma conversa</h2>
            <p>Escolha um contato na lista ao lado para ver o histórico e detalhes.</p>
        </div>
    <?php endif; ?>

    <!-- Auto Token Refresh -->
    <?php include 'components/auto_refresh.php'; ?>

    <!-- Init Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>

</html>