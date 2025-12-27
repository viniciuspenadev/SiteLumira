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

$job_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$job_id) {
    header("Location: index.php");
    exit;
}

$job = $supabase->getJob($job_id);
$applications = $supabase->getApplications($job_id);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidatos - <?php echo $job['title']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../assets/css/mobile-admin.css">
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden font-sans">

    <!-- Mobile Header with Back -->
    <?php
    $custom_header_title = 'Candidatos';
    $custom_header_back_url = 'index.php';
    include '../components/responsive_header.php';
    ?>

    <!-- Global Nav (Desktop Sidebar) -->
    <?php include '../components/sidebar.php'; ?>

    <div class="flex-1 flex flex-col h-full overflow-hidden">

        <!-- Top Bar (Desktop Only) -->
        <header
            class="hidden lg:flex h-16 bg-white border-b border-gray-200 items-center justify-between px-8 shadow-sm z-10 shrink-0">
            <h1 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <a href="index.php" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                Candidatos: <span class="text-lumira-blue ml-1"><?php echo $job['title']; ?></span>
            </h1>
        </header>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-y-auto p-8 bg-gray-50/50">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if ($applications && count($applications) > 0): ?>
                    <?php foreach ($applications as $app): ?>
                        <div
                            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col hover:shadow-md transition-shadow group">

                            <!-- Header Card -->
                            <div class="flex items-start justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-lg">
                                        <?php echo strtoupper(substr($app['name'], 0, 1)); ?>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-800 leading-tight"><?php echo $app['name']; ?></h3>
                                        <p class="text-[10px] text-slate-400 font-medium">
                                            <?php echo date('d/m/Y \à\s H:i', strtotime($app['created_at'])); ?>
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="px-2 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold uppercase rounded border border-blue-100">
                                    <?php echo $app['status']; ?>
                                </span>
                            </div>

                            <!-- Contact Info -->
                            <div class="space-y-3 mb-6 bg-slate-50 p-4 rounded-xl border border-slate-100">
                                <a href="mailto:<?php echo $app['email']; ?>"
                                    class="flex items-center gap-2 text-xs text-slate-600 hover:text-blue-600 transition-colors">
                                    <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <span class="truncate"><?php echo $app['email']; ?></span>
                                </a>
                                <a href="https://wa.me/55<?php echo preg_replace('/[^0-9]/', '', $app['phone']); ?>"
                                    target="_blank"
                                    class="flex items-center gap-2 text-xs text-slate-600 hover:text-green-600 transition-colors">
                                    <i data-lucide="phone" class="w-3.5 h-3.5 text-slate-400"></i>
                                    <?php echo $app['phone']; ?>
                                </a>
                                <?php if (!empty($app['linkedin'])): ?>
                                    <a href="<?php echo $app['linkedin']; ?>" target="_blank"
                                        class="flex items-center gap-2 text-xs text-slate-600 hover:text-blue-700 transition-colors">
                                        <i data-lucide="linkedin" class="w-3.5 h-3.5 text-slate-400"></i>
                                        LinkedIn Perfil
                                    </a>
                                <?php endif; ?>
                            </div>

                            <div class="mt-auto">
                                <?php if (!empty($app['resume_url'])): ?>
                                    <a href="<?php echo $app['resume_url']; ?>" target="_blank"
                                        class="w-full py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl flex items-center justify-center gap-2 transition-all shadow-lg shadow-slate-900/10">
                                        <i data-lucide="file-text" class="w-3.5 h-3.5"></i> Ver Currículo
                                    </a>
                                <?php else: ?>
                                    <button disabled
                                        class="w-full py-2.5 bg-gray-50 text-gray-300 text-xs font-bold rounded-xl flex items-center justify-center gap-2 cursor-not-allowed border border-gray-100">
                                        <i data-lucide="file-x" class="w-3.5 h-3.5"></i> Sem Currículo
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full py-24 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i data-lucide="users" class="w-8 h-8 text-gray-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-600 mb-1">Nenhum candidato ainda</h3>
                        <p class="text-sm text-slate-400">Divulgue a vaga para começar a receber inscrições.</p>
                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <!-- Mobile Bottom Navigation -->
    <?php include '../components/mobile_nav.php'; ?>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>