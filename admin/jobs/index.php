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

// Handle Actions
if (isset($_GET['delete_id'])) {
    $supabase->deleteJob($_GET['delete_id']);
    header("Location: index.php");
    exit;
}
if (isset($_GET['archive_id'])) {
    $supabase->updateJob($_GET['archive_id'], ['active' => false]);
    header("Location: index.php");
    exit;
}
if (isset($_GET['close_id'])) {
    $supabase->updateJob($_GET['close_id'], ['status' => 'closed', 'active' => true]);
    header("Location: index.php");
    exit;
}
if (isset($_GET['open_id'])) {
    $supabase->updateJob($_GET['open_id'], ['status' => 'open', 'active' => true]);
    header("Location: index.php");
    exit;
}

$jobs = [];
$error_msg = null;
try {
    $jobs = $supabase->getJobs(false);
    if (!is_array($jobs)) {
        // If API returns null/false
        $error_msg = "Retorno inválido da API. Verifique as chaves.";
        $jobs = []; // Ensure array
    }
} catch (Exception $e) {
    $error_msg = "Erro de Conexão: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Vagas - Admin Lumirá</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden font-sans">

    <!-- Global Nav -->
    <?php include '../components/sidebar.php'; ?>

    <div class="flex-1 flex flex-col h-full overflow-hidden">

        <!-- Top Bar -->
        <header
            class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10 shrink-0">
            <div>
                <h1 class="text-xl font-bold text-slate-800">Gerenciar Vagas</h1>
                <p class="text-xs text-slate-500">Módulo de Recrutamento</p>
            </div>
            <a href="manage.php"
                class="bg-lumira-blue hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition-colors shadow-lg shadow-blue-500/20">
                <i data-lucide="plus" class="w-4 h-4"></i> Nova Vaga
            </a>
        </header>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-y-auto p-8 bg-gray-50/50">

            <?php if ($error_msg): ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                    <p class="font-bold">Erro!</p>
                    <p><?php echo htmlspecialchars($error_msg); ?></p>
                </div>
            <?php endif; ?>

            <!-- Key Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Active -->
                <div
                    class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Vagas Ativas</p>
                        <h3 class="text-3xl font-bold text-slate-800">
                            <?php echo count(array_filter($jobs ?? [], fn($j) => $j['active'])); ?>
                        </h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-500">
                        <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                    </div>
                </div>

                <!-- Total Candidates (Mock for now, would need count query) -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between opacity-50"
                    title="Em breve">
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Candidatos Total</p>
                        <h3 class="text-3xl font-bold text-slate-800">-</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-500">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                </div>

                <!-- Action -->
                <a href="../../trabalhe-conosco/index.php" target="_blank"
                    class="bg-gradient-to-br from-slate-800 to-slate-900 p-6 rounded-2xl border border-slate-700 shadow-lg flex items-center justify-between group cursor-pointer hover:shadow-xl transition-all">
                    <div>
                        <p
                            class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1 group-hover:text-white transition-colors">
                            Visualizar Site</p>
                        <h3 class="text-lg font-bold text-white mb-1">Ver página pública</h3>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-white/20 transition-all">
                        <i data-lucide="external-link" class="w-5 h-5"></i>
                    </div>
                </a>
            </div>

            <!-- Job List -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-bold text-slate-800">Listagem de Vagas</h2>
                    <div class="text-xs text-slate-400">Ordenado por criação</div>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 text-slate-400 text-[10px] uppercase tracking-wider font-bold">
                            <th class="pl-6 py-4">Cargo / Info</th>
                            <th class="px-4 py-4">Departamento</th>
                            <th class="px-4 py-4">Status</th>
                            <th class="px-4 py-4">Publicado em</th>
                            <th class="pr-6 py-4 text-right">Gerenciar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php if ($jobs && count($jobs) > 0): ?>
                            <?php foreach ($jobs as $job): ?>
                                <tr class="hover:bg-blue-50/50 transition-colors group">
                                    <td class="pl-6 py-4">
                                        <div class="font-bold text-slate-800 text-sm"><?php echo $job['title']; ?></div>
                                        <div class="text-xs text-slate-400 mt-0.5 flex items-center gap-1">
                                            <i data-lucide="briefcase" class="w-3 h-3"></i> <?php echo $job['type']; ?>
                                            <span class="mx-1">•</span>
                                            <i data-lucide="map-pin" class="w-3 h-3"></i> <?php echo $job['location']; ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span
                                            class="inline-flex px-2 py-1 rounded border border-gray-100 bg-gray-50 text-xs font-medium text-slate-500">
                                            <?php echo $job['department']; ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <?php if (!$job['active']): ?>
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> ARQUIVADA
                                            </span>
                                        <?php elseif (($job['status'] ?? 'open') === 'closed'): ?>
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-orange-50 text-orange-600 border border-orange-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span> ENCERRADA
                                            </span>
                                        <?php else: ?>
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-50 text-green-600 border border-green-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> ABERTA
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-4 text-xs text-slate-500 font-medium">
                                        <?php echo date('d/m/Y', strtotime($job['created_at'])); ?>
                                    </td>
                                    <td class="pr-6 py-4">
                                        <div class="flex items-center justify-end gap-1">
                                            <!-- Candidates -->
                                            <a href="applications.php?id=<?php echo $job['id']; ?>"
                                                class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors border border-transparent hover:border-indigo-100"
                                                title="Ver Candidatos">
                                                <i data-lucide="users" class="w-4 h-4"></i>
                                            </a>

                                            <div class="w-px h-4 bg-gray-200 mx-1"></div>

                                            <!-- Status / Archive Actions -->
                                            <?php if (!$job['active']): ?>
                                                <!-- Archived -> Publish -->
                                                <a href="index.php?open_id=<?php echo $job['id']; ?>"
                                                    class="p-1.5 text-green-500 hover:bg-green-50 rounded-lg transition-colors"
                                                    title="Reativar / Publicar">
                                                    <i data-lucide="upload-cloud" class="w-4 h-4"></i>
                                                </a>
                                            <?php else: ?>
                                                <!-- Active Actions -->
                                                <?php if (($job['status'] ?? 'open') === 'open'): ?>
                                                    <!-- Open -> Close -->
                                                    <a href="index.php?close_id=<?php echo $job['id']; ?>"
                                                        class="p-1.5 text-orange-500 hover:bg-orange-50 rounded-lg transition-colors"
                                                        title="Encerrar Vaga">
                                                        <i data-lucide="lock" class="w-4 h-4"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <!-- Closed -> Reopen -->
                                                    <a href="index.php?open_id=<?php echo $job['id']; ?>"
                                                        class="p-1.5 text-green-500 hover:bg-green-50 rounded-lg transition-colors"
                                                        title="Reabrir Vaga">
                                                        <i data-lucide="unlock" class="w-4 h-4"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <!-- Archive -->
                                                <a href="index.php?archive_id=<?php echo $job['id']; ?>"
                                                    class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-50 rounded-lg transition-colors"
                                                    title="Arquivar (Ocultar)">
                                                    <i data-lucide="archive" class="w-4 h-4"></i>
                                                </a>
                                            <?php endif; ?>

                                            <!-- Edit -->
                                            <a href="manage.php?id=<?php echo $job['id']; ?>"
                                                class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors"
                                                title="Editar">
                                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                                            </a>

                                            <!-- Delete -->
                                            <a href="index.php?delete_id=<?php echo $job['id']; ?>"
                                                class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                                onclick="return confirm('Tem certeza que deseja excluir esta vaga?')"
                                                title="Excluir">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="py-12 text-center text-slate-400">
                                    <div
                                        class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="briefcase" class="w-8 h-8 opacity-20"></i>
                                    </div>
                                    <h3 class="font-bold text-slate-600">Nenhuma vaga cadastrada</h3>
                                    <p class="text-sm mt-1">Clique em "Nova Vaga" para começar.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>