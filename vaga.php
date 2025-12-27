<?php
include 'includes/constants.php';
include 'data/jobs.php';

// Get Job ID from URL
$job_id = isset($_GET['id']) ? $_GET['id'] : null;
$current_job = null;

// Find Job
foreach ($JOBS as $job) {
    if ($job['id'] === $job_id) {
        $current_job = $job;
        break;
    }
}

// Redirect if not found
if (!$current_job) {
    header("Location: trabalhe-conosco.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- SEO -->
    <title>Vaga: <?php echo $current_job['title']; ?> - Colégio Lumirá</title>
    <meta name="description" content="<?php echo $current_job['summary']; ?>" />

    <!-- Common Assets -->
    <?php include 'includes/meta.php'; ?>
</head>

<body class="bg-gray-50 text-slate-700 antialiased selection:bg-lumira-orange selection:text-white">

    <?php include 'includes/header.php'; ?>

    <div class="min-h-screen bg-white">

        <!-- Hero Area -->
        <div class="bg-lumira-dark text-white pt-32 pb-20 md:pt-48 md:pb-32 relative overflow-hidden">
            <!-- Decorative -->
            <div class="absolute inset-0 opacity-20"
                style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-lumira-blue/30 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2">
            </div>

            <div class="container mx-auto px-4 md:px-8 relative z-10">
                <a href="trabalhe-conosco.php"
                    class="inline-flex items-center gap-2 text-white/60 hover:text-white mb-8 transition-colors text-sm font-bold uppercase tracking-wider">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Voltar para Vagas
                </a>

                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span
                                class="bg-white/10 backdrop-blur-md px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider text-lumira-orange border border-white/10">
                                <?php echo $current_job['department']; ?>
                            </span>
                            <span
                                class="text-white/60 text-xs font-medium bg-lumira-dark px-2 py-1 rounded border border-white/10">
                                Publicado em <?php echo date('d/m/Y', strtotime($current_job['posted_at'])); ?>
                            </span>
                        </div>
                        <h1 class="text-3xl md:text-5xl font-bold mb-6 max-w-3xl"><?php echo $current_job['title']; ?>
                        </h1>

                        <div class="flex flex-wrap gap-4 md:gap-8 text-sm font-medium text-white/80">
                            <span class="flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-4 h-4 text-lumira-orange"></i>
                                <?php echo $current_job['location']; ?>
                            </span>
                            <span class="flex items-center gap-2">
                                <i data-lucide="briefcase" class="w-4 h-4 text-lumira-orange"></i>
                                <?php echo $current_job['type']; ?>
                            </span>
                            <span class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-4 h-4 text-lumira-orange"></i>
                                <?php echo $current_job['workload']; ?>
                            </span>
                        </div>
                    </div>

                    <a href="#application-form-section"
                        class="px-8 py-4 bg-lumira-orange hover:bg-orange-500 text-white font-bold rounded-xl shadow-lg hover:shadow-orange-500/20 transition-all transform hover:-translate-y-1 inline-flex items-center gap-2 whitespace-nowrap">
                        Candidatar-se Agora <i data-lucide="arrow-down" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 md:px-8 -mt-10 relative z-20 pb-20">
            <div class="flex flex-col lg:flex-row gap-12">

                <!-- Left: Job Details -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100">

                        <div class="mb-10">
                            <h2 class="text-xl font-bold text-lumira-dark mb-4 flex items-center gap-2">
                                <i data-lucide="info" class="w-5 h-5 text-lumira-blue"></i> Sobre a Vaga
                            </h2>
                            <p class="text-slate-600 leading-relaxed text-lg">
                                <?php echo $current_job['description']; ?>
                            </p>
                        </div>

                        <div class="mb-10">
                            <h2 class="text-xl font-bold text-lumira-dark mb-4 flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-lumira-blue"></i> Requisitos
                            </h2>
                            <ul class="space-y-3">
                                <?php foreach ($current_job['requirements'] as $req): ?>
                                    <li class="flex items-start gap-3 text-slate-600">
                                        <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-lumira-blue shrink-0"></div>
                                        <?php echo $req; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-lumira-dark mb-4 flex items-center gap-2">
                                <i data-lucide="gift" class="w-5 h-5 text-lumira-blue"></i> Benefícios
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <?php foreach ($current_job['benefits'] as $benefit): ?>
                                    <div
                                        class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg text-slate-600 text-sm font-medium border border-gray-100">
                                        <i data-lucide="star" class="w-4 h-4 text-lumira-orange"></i>
                                        <?php echo $benefit; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right: Application Form -->
                <div class="w-full lg:w-1/3" id="application-form-section">
                    <!-- Success Message (Hidden by default) -->
                    <div id="application-success"
                        class="hidden bg-white rounded-3xl p-8 shadow-xl border border-green-100 text-center animate-fade-in-up">
                        <div
                            class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i data-lucide="check" class="w-10 h-10"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-lumira-dark mb-2">Candidatura Enviada!</h3>
                        <p class="text-slate-500 text-sm mb-6">
                            Recebemos seus dados para a vaga de <strong><?php echo $current_job['title']; ?></strong>.
                            Boa sorte!
                        </p>
                        <a href="trabalhe-conosco.php" class="text-lumira-blue font-bold text-sm hover:underline">Ver
                            outras vagas</a>
                    </div>


                    <div id="application-card"
                        class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 sticky top-24">
                        <h3 class="text-2xl font-bold text-lumira-dark mb-6">Quero me candidatar</h3>

                        <form id="application-form" class="space-y-4">
                            <input type="hidden" name="job_id" value="<?php echo $current_job['id']; ?>">

                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Nome
                                    Completo</label>
                                <input type="text" required
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all text-sm"
                                    placeholder="Seu nome" />
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Email</label>
                                <input type="email" required
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all text-sm"
                                    placeholder="seu@email.com" />
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Telefone
                                    / WhatsApp</label>
                                <input type="tel" required
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all text-sm"
                                    placeholder="(11) 99999-9999" />
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">LinkedIn
                                    (Opcional)</label>
                                <input type="url"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all text-sm"
                                    placeholder="URL do perfil" />
                            </div>

                            <div class="pt-2">
                                <label
                                    class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Currículo</label>
                                <div
                                    class="relative border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:bg-gray-50 transition-colors cursor-pointer group">
                                    <input type="file" required accept=".pdf"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                                    <i data-lucide="file-up"
                                        class="w-6 h-6 text-slate-400 mx-auto mb-1 group-hover:text-lumira-blue transition-colors"></i>
                                    <p class="text-xs text-slate-500 font-medium">Anexar PDF (max 5MB)</p>
                                </div>
                            </div>

                            <div class="pt-4 flex items-start gap-3">
                                <div class="flex items-center h-5">
                                    <input id="privacy-consent-job" type="checkbox" required
                                        class="w-4 h-4 border border-gray-300 rounded focus:ring-3 focus:ring-lumira-blue/30 bg-gray-50 text-lumira-blue" />
                                </div>
                                <label for="privacy-consent-job" class="text-xs text-slate-500">
                                    Concordo com a <a href="politica-de-privacidade.php" target="_blank"
                                        class="text-lumira-blue font-bold hover:underline">Pol. Privacidade</a>.
                                </label>
                            </div>

                            <button type="submit"
                                class="w-full py-4 bg-lumira-blue hover:bg-blue-600 text-white font-bold rounded-xl shadow-lg hover:shadow-blue-500/20 transition-all flex items-center justify-center gap-2 mt-4">
                                <i data-lucide="send" class="w-4 h-4"></i> Enviar Inscrição
                            </button>

                            <p class="text-xs text-center text-slate-400 mt-2">
                                Ao enviar, você concorda com nossa política de privacidade.
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        document.getElementById('application-form').addEventListener('submit', function (e) {
            e.preventDefault();
            // Simulating submission
            document.getElementById('application-card').classList.add('hidden');
            document.getElementById('application-success').classList.remove('hidden');
            // Check if element is in view, if not scroll to it
            document.getElementById('application-form-section').scrollIntoView({ behavior: 'smooth' });
        });
    </script>
    <?php include 'includes/footer.php'; ?>
</body>

</html>