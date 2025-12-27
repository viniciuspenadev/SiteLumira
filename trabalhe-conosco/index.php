<?php
include '../includes/constants.php';
$secrets = include '../includes/secrets.php';
include '../includes/supabase_helper.php';

$supabase = new SupabaseHelper($secrets['SUPABASE_URL'], $secrets['SUPABASE_KEY']);
// Fetch active jobs
$jobs = $supabase->getJobs(true);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- SEO -->
    <title>Trabalhe Conosco - Colégio Lumirá (Vagas Abertas)</title>
    <meta name="description"
        content="Confira as vagas abertas no Colégio Lumirá e venha transformar a educação conosco." />

    <!-- Common Assets -->
    <?php include '../includes/meta.php'; ?>
</head>

<body class="bg-gray-50 text-slate-700 antialiased selection:bg-lumira-orange selection:text-white">

    <?php include '../includes/header.php'; ?>

    <div class="min-h-screen bg-white">

        <!-- Hero Banner Small -->
        <div class="bg-lumira-dark text-white pt-32 pb-12 md:pt-48 md:pb-20 relative overflow-hidden">
            <!-- Decorative -->
            <div class="absolute inset-0 opacity-20"
                style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
            <div
                class="absolute bottom-0 right-0 w-64 h-64 bg-lumira-blue rounded-full blur-[80px] opacity-40 translate-y-1/2 translate-x-1/3">
            </div>

            <div class="container mx-auto px-4 md:px-8 relative z-10 text-center">
                <a href="../index.php"
                    class="inline-flex items-center gap-2 text-white/70 hover:text-white mb-6 transition-colors text-sm font-bold uppercase tracking-wider">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Voltar para Início
                </a>
                <h1 class="text-3xl md:text-5xl font-bold mb-4">Trabalhe Conosco</h1>
                <p class="text-lg text-white/80 max-w-2xl mx-auto">
                    Você ama educar? Venha fazer parte da nossa história e ajudar a construir o futuro no Colégio
                    Lumirá.
                </p>
            </div>
        </div>

        <div class="container mx-auto px-4 md:px-8 py-12 md:py-20">

            <!-- Intro Text -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-lumira-dark mb-4">Oportunidades Abertas</h2>
                <p class="text-slate-600 text-lg">
                    Estamos sempre em busca de talentos que compartilham do nosso propósito. Confira abaixo as posições
                    disponíveis para integrar nosso time.
                </p>
            </div>

            <!-- Jobs Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                <?php if ($jobs && count($jobs) > 0): ?>
                    <?php foreach ($jobs as $job): ?>
                        <a href="vaga.php?id=<?php echo $job['id']; ?>" class="group">
                            <div
                                class="bg-white rounded-3xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 h-full flex flex-col hover:-translate-y-1">

                                <div class="flex items-start justify-between mb-6">
                                    <div class="flex items-center gap-2">
                                        <!-- Status Badge -->
                                        <?php if (($job['status'] ?? 'open') === 'open'): ?>
                                            <div
                                                class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold uppercase tracking-wider rounded-full flex items-center gap-1.5 shadow-sm border border-green-200">
                                                <span class="relative flex h-2 w-2">
                                                    <span
                                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                                </span>
                                                Aberta
                                            </div>
                                        <?php else: ?>
                                            <div
                                                class="px-3 py-1 bg-gray-100 text-slate-500 text-xs font-bold uppercase tracking-wider rounded-full flex items-center gap-1.5 border border-gray-200">
                                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                                Encerrada
                                            </div>
                                        <?php endif; ?>

                                        <!-- Department Badge -->
                                        <div
                                            class="px-3 py-1 bg-lumira-light/30 text-lumira-dark text-xs font-bold uppercase tracking-wider rounded-full border border-gray-100">
                                            <?php echo htmlspecialchars($job['department']); ?>
                                        </div>
                                    </div>

                                    <span class="text-slate-400 text-xs font-medium flex items-center gap-1">
                                        <i data-lucide="clock" class="w-3 h-3"></i>
                                        <?php echo date('d/m/Y', strtotime($job['created_at'])); ?>
                                    </span>
                                </div>

                                <h3
                                    class="text-xl font-bold text-lumira-dark mb-3 group-hover:text-lumira-blue transition-colors">
                                    <?php echo htmlspecialchars($job['title']); ?>
                                </h3>

                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span
                                        class="inline-flex items-center gap-1 text-xs font-medium text-slate-500 bg-gray-50 px-2 py-1 rounded-md">
                                        <i data-lucide="map-pin" class="w-3 h-3"></i>
                                        <?php echo htmlspecialchars($job['location']); ?>
                                    </span>
                                    <span
                                        class="inline-flex items-center gap-1 text-xs font-medium text-slate-500 bg-gray-50 px-2 py-1 rounded-md">
                                        <i data-lucide="briefcase" class="w-3 h-3"></i>
                                        <?php echo htmlspecialchars($job['type']); ?>
                                    </span>
                                </div>

                                <p class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                    <?php echo htmlspecialchars($job['description']); ?>
                                </p>

                                <div
                                    class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between text-sm font-bold text-lumira-blue">
                                    Ver Detalhes
                                    <i data-lucide="arrow-right"
                                        class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-gray-100 shadow-sm">
                        <i data-lucide="briefcase" class="w-16 h-16 text-slate-300 mx-auto mb-4 opacity-50"></i>
                        <h3 class="text-xl font-bold text-slate-600">Nenhuma vaga aberta no momento</h3>
                        <p class="text-slate-400 mt-2">Mas fique de olho, novas oportunidades surgem sempre!</p>
                    </div>
                <?php endif; ?>

                <!-- General Application Card -->
                <div
                    class="bg-lumira-blue rounded-3xl p-8 shadow-xl text-white flex flex-col justify-between overflow-hidden relative">
                    <div
                        class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full blur-[40px] translate-x-1/2 -translate-y-1/2">
                    </div>

                    <div>
                        <div
                            class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-6 backdrop-blur-sm">
                            <i data-lucide="mail-plus" class="w-6 h-6 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Banco de Talentos</h3>
                        <p class="text-white/80 text-sm mb-6 leading-relaxed">
                            Não encontrou a vaga ideal? Envie seu currículo para nosso banco de talentos. Estamos sempre
                            crescendo!
                        </p>
                    </div>

                    <a href="mailto:rh@colegiolumira.com.br"
                        class="inline-flex items-center gap-2 text-sm font-bold hover:text-white/80 transition-colors">
                        Enviar Currículo
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <div class="mt-20 text-center">
                <p class="text-slate-500 text-sm">
                    Dúvidas sobre o processo? Entre em contato pelo email <a href="mailto:rh@colegiolumira.com.br"
                        class="text-lumira-blue font-bold hover:underline">rh@colegiolumira.com.br</a>
                </p>
            </div>

        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>