<?php
// Auth Check (Cookie-based to match login.php)
if (!isset($_COOKIE['sb_access_token'])) {
    header('Location: ../login.php');
    exit;
}

$secrets = include '../../includes/secrets.php';
include '../../includes/supabase_helper.php';

$supabase = new SupabaseHelper($secrets['SUPABASE_URL'], $secrets['SUPABASE_KEY']);
// Use User Token for elevated privileges (RLS)
$supabase->setToken($_COOKIE['sb_access_token']);

$id = isset($_GET['id']) ? $_GET['id'] : null;
$job = null;
$error = null;

if ($id) {
    // Edit Mode
    $job = $supabase->getJob($id);
    if (!$job) {
        header("Location: index.php");
        exit;
    }
} else {
    // Create Mode (Set defaults)
    $job = [
        'title' => '',
        'department' => '',
        'location' => 'Vila Augusta, Guarulhos',
        'type' => 'CLT',
        'workload' => '',
        'description' => '',
        'requirements' => [],
        'benefits' => [],
        'active' => true
    ];
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic Sanitization
    $data = [
        'title' => $_POST['title'],
        'department' => $_POST['department'],
        'location' => $_POST['location'],
        'type' => $_POST['type'],
        'workload' => $_POST['workload'],
        'description' => trim($_POST['description']),
        'status' => $_POST['status'] ?? 'open',
        // Handle Arrays (textarea lines to json)
        'requirements' => array_filter(array_map('trim', explode("\n", $_POST['requirements']))),
        'benefits' => array_filter(array_map('trim', explode("\n", $_POST['benefits']))),
        'active' => isset($_POST['active']) ? true : false
    ];

    if ($id) {
        $supabase->updateJob($id, $data);
    } else {
        $supabase->createJob($data);
    }

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? 'Editar' : 'Nova'; ?> Vaga - Admin Lumirá</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden font-sans">

    <!-- Global Nav -->
    <?php include '../components/sidebar.php'; ?>

    <script>
        const TEMPLATES = {
            'professor': {
                title: 'Professora de Educação Infantil',
                department: 'Pedagógico',
                type: 'CLT',
                location: 'Vila Augusta, Guarulhos',
                workload: '44h semanais',
                description: 'Responsável por planejar e executar atividades pedagógicas alinhadas à BNCC e nossa pedagogia afetiva. Acompanhar o desenvolvimento integral das crianças.',
                requirements: ['Licenciatura em Pedagogia', 'Experiência em sala de aula', 'Conhecimento na BNCC', 'Perfil acolhedor'],
                benefits: ['Vale Transporte', 'Cesta Básica', 'Plano de Saúde', 'Bolsa de Estudos']
            },
            'auxiliar': {
                title: 'Auxiliar de Limpeza',
                department: 'Operacional',
                type: 'CLT',
                location: 'Vila Augusta, Guarulhos',
                workload: '44h semanais',
                description: 'Responsável pela higienização e organização dos espaços escolares, garantindo um ambiente limpo e saudável.',
                requirements: ['Ensino Fundamental completo', 'Organização', 'Proatividade'],
                benefits: ['Vale Transporte', 'Cesta Básica', 'Alimentação no Local']
            },
            'estagio': {
                title: 'Estágio em Pedagogia',
                department: 'Pedagógico',
                type: 'Estágio',
                location: 'Vila Augusta, Guarulhos',
                workload: '30h semanais',
                description: 'Auxiliar a professora regente nas atividades diárias e cuidado com as crianças.',
                requirements: ['Cursando Pedagogia', 'Gostar de crianças', 'Residir em Guarulhos'],
                benefits: ['Bolsa Auxílio', 'Vale Transporte', 'Seguro de Vida']
            }
        };

        function loadTemplate(key) {
            if (!confirm('Isso substituirá os dados atuais. Continuar?')) return;
            const t = TEMPLATES[key];
            document.querySelector('[name="title"]').value = t.title;

            // Handle inputs/selects
            const dept = document.querySelector('[name="department"]');
            dept.value = t.department;

            document.querySelector('[name="type"]').value = t.type;
            document.querySelector('[name="location"]').value = t.location;
            document.querySelector('[name="workload"]').value = t.workload;
            document.querySelector('[name="description"]').value = t.description;

            // Set dynamic lists
            setList('requirements', t.requirements);
            setList('benefits', t.benefits);
        }

        // Dynamic List Logic
        function setList(id, items) {
            const container = document.getElementById(id + '-list');
            container.innerHTML = '';
            items.forEach(item => addListItem(id, item));
            updateHidden(id);
        }

        function addListItem(id, value = '') {
            const container = document.getElementById(id + '-list');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 mb-2 animate-fade-in-up';
            div.innerHTML = `
                <div class="bg-slate-100 p-2 rounded-lg cursor-move text-slate-400 hover:text-slate-600">
                    <i data-lucide="grip-vertical" class="w-4 h-4"></i>
                </div>
                <input type="text" value="${value}" 
                    class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm"
                    placeholder="Digite um item..." oninput="updateHidden('${id}')">
                <button type="button" onclick="this.parentElement.remove(); updateHidden('${id}')" 
                    class="p-2 text-red-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            `;
            container.appendChild(div);
            lucide.createIcons();
            updateHidden(id);
            // Focus new input if empty
            if (!value) div.querySelector('input').focus();
        }

        function updateHidden(id) {
            const container = document.getElementById(id + '-list');
            const inputs = container.querySelectorAll('input');
            const values = Array.from(inputs).map(i => i.value).filter(v => v.trim() !== '');
            document.getElementById(id + '-hidden').value = values.join('\n');
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Initialize lists from hidden values (PHP)
            const reqVal = document.getElementById('requirements-hidden').value;
            const benVal = document.getElementById('benefits-hidden').value;

            if (reqVal) setList('requirements', reqVal.split('\n'));
            else addListItem('requirements'); // Start with one

            if (benVal) setList('benefits', benVal.split('\n'));
            else addListItem('benefits'); // Start with one
        });
    </script>

    <div class="flex-1 flex flex-col h-full overflow-hidden">

        <!-- Top Bar -->
        <header
            class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10 shrink-0">
            <h1 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <a href="index.php" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <?php echo $id ? 'Editar Vaga' : 'Nova Vaga'; ?>
            </h1>

            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider mr-2">Modelos Rápidos:</span>
                <button onclick="loadTemplate('professor')"
                    class="px-3 py-1.5 text-xs font-bold text-lumira-blue bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors border border-blue-100">
                    Professor
                </button>
                <button onclick="loadTemplate('auxiliar')"
                    class="px-3 py-1.5 text-xs font-bold text-lumira-blue bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors border border-blue-100">
                    Auxiliar
                </button>
                <button onclick="loadTemplate('estagio')"
                    class="px-3 py-1.5 text-xs font-bold text-lumira-blue bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors border border-blue-100">
                    Estágio
                </button>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8 bg-gray-50/50">

            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                    <form method="POST" class="p-8 space-y-8">

                        <!-- Header Form -->
                        <div class="flex items-center justify-between">
                            <h2 class="font-bold text-lg text-slate-700">Informações Principais</h2>

                            <!-- Controls: Status & Visibility -->
                            <div class="flex items-center gap-6">

                                <!-- Status Selector -->
                                <div>
                                    <div class="relative">
                                        <select name="status"
                                            class="pl-3 pr-8 py-1.5 rounded-lg border border-gray-200 text-xs font-bold uppercase tracking-wider focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none appearance-none bg-white 
                                            <?php echo ($job['status'] ?? 'open') === 'open' ? 'text-green-600 bg-green-50 border-green-200' : 'text-slate-500 bg-gray-50'; ?>">
                                            <option value="open" <?php echo ($job['status'] ?? 'open') === 'open' ? 'selected' : ''; ?>>Aberta</option>
                                            <option value="closed" <?php echo ($job['status'] ?? 'open') === 'closed' ? 'selected' : ''; ?>>Encerrada</option>
                                        </select>
                                        <i data-lucide="chevron-down"
                                            class="w-3 h-3 absolute right-2 top-2.5 pointer-events-none <?php echo ($job['status'] ?? 'open') === 'open' ? 'text-green-400' : 'text-slate-400'; ?>"></i>
                                    </div>
                                </div>

                                <!-- Visibility Toggle -->
                                <label class="relative inline-flex items-center cursor-pointer group">
                                    <input type="checkbox" name="active" value="1" class="sr-only peer" <?php echo $job['active'] ? 'checked' : ''; ?>>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-lumira-blue">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-500 group-hover:text-gray-700">
                                        <?php echo $job['active'] ? 'Publicada' : 'Arquivada (Oculta)'; ?>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Título
                                    da Vaga</label>
                                <input type="text" name="title" value="<?php echo htmlspecialchars($job['title']); ?>"
                                    required
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm font-medium">
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Departamento</label>

                                <div class="relative">
                                    <select name="department"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm appearance-none bg-white">
                                        <option value="Pedagógico" <?php echo $job['department'] == 'Pedagógico' ? 'selected' : ''; ?>>Pedagógico</option>
                                        <option value="Administrativo" <?php echo $job['department'] == 'Administrativo' ? 'selected' : ''; ?>>Administrativo</option>
                                        <option value="Operacional" <?php echo $job['department'] == 'Operacional' ? 'selected' : ''; ?>>Operacional</option>
                                        <option value="Coordenação" <?php echo $job['department'] == 'Coordenação' ? 'selected' : ''; ?>>Coordenação</option>
                                        <option value="Marketing" <?php echo $job['department'] == 'Marketing' ? 'selected' : ''; ?>>Marketing</option>
                                        <option value="Financeiro" <?php echo $job['department'] == 'Financeiro' ? 'selected' : ''; ?>>Financeiro</option>
                                    </select>
                                    <i data-lucide="chevron-down"
                                        class="w-4 h-4 text-slate-400 absolute right-3 top-3 pointer-events-none"></i>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Tipo
                                    de Contrato</label>
                                <div class="relative">
                                    <select name="type"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm appearance-none bg-white">
                                        <option value="CLT" <?php echo $job['type'] == 'CLT' ? 'selected' : ''; ?>>CLT
                                        </option>
                                        <option value="PJ" <?php echo $job['type'] == 'PJ' ? 'selected' : ''; ?>>PJ
                                        </option>
                                        <option value="Estágio" <?php echo $job['type'] == 'Estágio' ? 'selected' : ''; ?>>
                                            Estágio</option>
                                        <option value="Temporário" <?php echo $job['type'] == 'Temporário' ? 'selected' : ''; ?>>Temporário</option>
                                        <option value="Voluntário" <?php echo $job['type'] == 'Voluntário' ? 'selected' : ''; ?>>Voluntário</option>
                                    </select>
                                    <i data-lucide="chevron-down"
                                        class="w-4 h-4 text-slate-400 absolute right-3 top-3 pointer-events-none"></i>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Localização</label>
                                <input type="text" name="location"
                                    value="<?php echo htmlspecialchars($job['location'] ?: 'Vila Augusta, Guarulhos'); ?>"
                                    required
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm">
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Carga
                                    Horária</label>
                                <input type="text" name="workload"
                                    value="<?php echo htmlspecialchars($job['workload']); ?>"
                                    placeholder="Ex: 44h semanais" required
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Descrição
                                    Detalhada</label>
                                <textarea name="description" rows="5" required
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm leading-relaxed"><?php echo htmlspecialchars($job['description']); ?></textarea>
                            </div>

                            <!-- Dynamic List Requirements -->
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 flex justify-between items-center">
                                    Requisitos
                                    <button type="button" onclick="addListItem('requirements')"
                                        class="text-xs text-lumira-blue hover:underline flex items-center gap-1">
                                        <i data-lucide="plus" class="w-3 h-3"></i> Adicionar
                                    </button>
                                </label>
                                <div id="requirements-list" class="space-y-2"></div>
                                <textarea name="requirements" id="requirements-hidden" class="hidden"><?php
                                if (is_array($job['requirements'])) {
                                    echo implode("\n", $job['requirements']);
                                }
                                ?></textarea>
                            </div>

                            <!-- Dynamic List Benefits -->
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 flex justify-between items-center">
                                    Benefícios
                                    <button type="button" onclick="addListItem('benefits')"
                                        class="text-xs text-lumira-blue hover:underline flex items-center gap-1">
                                        <i data-lucide="plus" class="w-3 h-3"></i> Adicionar
                                    </button>
                                </label>
                                <div id="benefits-list" class="space-y-2"></div>
                                <textarea name="benefits" id="benefits-hidden" class="hidden"><?php
                                if (is_array($job['benefits'])) {
                                    echo implode("\n", $job['benefits']);
                                }
                                ?></textarea>
                            </div>

                        </div>

                        <div class="pt-6 border-t border-gray-100 flex justify-end gap-4">
                            <a href="index.php"
                                class="px-6 py-2.5 rounded-xl text-slate-500 hover:bg-slate-100 font-bold transition-all text-sm">Cancelar</a>
                            <button type="submit"
                                class="px-8 py-2.5 rounded-xl bg-lumira-blue hover:bg-blue-600 text-white font-bold shadow-lg hover:shadow-blue-500/30 transition-all text-sm flex items-center gap-2">
                                <i data-lucide="save" class="w-4 h-4"></i> Salvar Vaga
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>