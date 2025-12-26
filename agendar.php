<?php
include 'includes/constants.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- SEO -->
    <title>Agendar Visita - Colégio Lumirá | Vila Augusta, Guarulhos</title>
    <meta name="description"
        content="Venha conhecer o Colégio Lumirá na Vila Augusta, Guarulhos. Estrutura completa, segurança e afeto. Agende sua visita pedagógica agora!" />

    <!-- Common Assets -->
    <?php include 'includes/meta.php'; ?>
</head>

<body class="bg-gray-50 text-slate-700 antialiased selection:bg-lumira-orange selection:text-white">

    <?php
    include 'includes/header.php';
    ?>

    <div class="min-h-screen bg-white">

        <!-- Hero Banner Small -->
        <div class="bg-lumira-dark text-white pt-32 pb-12 md:pt-48 md:pb-20 relative overflow-hidden">
            <!-- Decorative -->
            <div class="absolute inset-0 opacity-20"
                style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
            <div
                class="absolute bottom-0 right-0 w-64 h-64 bg-lumira-orange rounded-full blur-[80px] opacity-40 translate-y-1/2 translate-x-1/3">
            </div>

            <div class="container mx-auto px-4 md:px-8 relative z-10 text-center">
                <a href="index.php"
                    class="inline-flex items-center gap-2 text-white/70 hover:text-white mb-6 transition-colors text-sm font-bold uppercase tracking-wider">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Voltar para Início
                </a>
                <h1 class="text-3xl md:text-5xl font-bold mb-4">Agende sua Visita</h1>
                <p class="text-lg text-white/80 max-w-2xl mx-auto">
                    Venha sentir a energia do Lumirá de perto, aqui na Vila Augusta. Conheça nossa estrutura, converse
                    com a coordenação e tire todas as suas dúvidas.
                </p>
            </div>
        </div>

        <div class="container mx-auto px-4 md:px-8 py-12 md:py-16">

            <!-- Success Message (Hidden by default) -->
            <div id="schedule-success"
                class="hidden min-h-[50vh] flex flex-col items-center justify-center text-center animate-fade-in-up">
                <div
                    class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="check-circle-2" class="w-12 h-12"></i>
                </div>
                <h2 class="text-3xl font-bold text-lumira-dark mb-4">Solicitação Recebida!</h2>
                <p class="text-slate-600 text-lg mb-8 max-w-lg mx-auto">
                    Que alegria saber do seu interesse! Nossa equipe pedagógica entrará em contato via WhatsApp em até
                    24 horas para confirmar o melhor horário para sua família.
                </p>
                <a href="index.php"
                    class="inline-flex items-center gap-2 text-lumira-blue font-bold hover:text-lumira-orange transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i> Voltar para o site
                </a>
            </div>

            <!-- Main Content -->
            <div id="schedule-content" class="flex flex-col lg:flex-row gap-12 lg:gap-20">

                <!-- Left Column: Value Prop -->
                <div class="w-full lg:w-2/5">
                    <h3 class="text-2xl font-bold text-lumira-dark mb-6">Por que nos visitar?</h3>

                    <div class="space-y-8">
                        <div class="flex gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-orange-50 text-lumira-orange flex items-center justify-center shrink-0">
                                <i data-lucide="heart" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lumira-dark text-lg mb-1">Pedagogia do Afeto</h4>
                                <p class="text-slate-600 text-sm leading-relaxed">
                                    Entenda como acolhemos cada emoção e transformamos o aprendizado em algo prazeroso.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-blue-50 text-lumira-blue flex items-center justify-center shrink-0">
                                <i data-lucide="shield-check" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lumira-dark text-lg mb-1">Segurança Total</h4>
                                <p class="text-slate-600 text-sm leading-relaxed">
                                    Conheça nossos protocolos de segurança, monitoramento e controle de acesso.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center shrink-0">
                                <i data-lucide="sparkles" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lumira-dark text-lg mb-1">Espaços Encantadores</h4>
                                <p class="text-slate-600 text-sm leading-relaxed">
                                    Visite o solário, a horta, o ateliê e as salas preparadas para estimular a
                                    autonomia.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 p-6 bg-gray-50 rounded-3xl border border-gray-100">
                        <h4 class="font-bold text-lumira-dark mb-2 flex items-center gap-2">
                            <i data-lucide="clock" class="w-4.5 h-4.5 text-lumira-orange"></i> Melhores Horários
                        </h4>
                        <p class="text-slate-500 text-sm mb-4">
                            Recomendamos visitar durante as atividades pedagógicas para ver a escola em ação.
                        </p>
                        <ul class="text-sm text-slate-600 space-y-1">
                            <li>• Manhã: 08h30 às 10h30</li>
                            <li>• Tarde: 13h30 às 16h00</li>
                        </ul>
                    </div>
                </div>

                <!-- Right Column: Form -->
                <div class="w-full lg:w-3/5">
                    <div
                        class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 p-6 md:p-10 relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-lumira-blue/5 rounded-bl-[100%] pointer-events-none">
                        </div>

                        <form id="schedule-form" class="space-y-6 relative z-10">

                            <!-- Parent Info -->
                            <div>
                                <h4 class="text-sm font-bold text-lumira-orange uppercase tracking-wider mb-4">Dados do
                                    Responsável</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Nome
                                            Completo</label>
                                        <input type="text" required
                                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all"
                                            placeholder="Seu nome" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Telefone /
                                            WhatsApp</label>
                                        <input type="tel" required
                                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all"
                                            placeholder="(11) 93492-1031" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                                        <input type="email" required
                                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all"
                                            placeholder="seu@email.com" />
                                    </div>
                                </div>
                            </div>

                            <!-- Child Info -->
                            <div class="pt-4 border-t border-gray-100">
                                <h4 class="text-sm font-bold text-lumira-orange uppercase tracking-wider mb-4">Sobre a
                                    Criança</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Nome da
                                            Criança</label>
                                        <input type="text" required
                                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Data de
                                            Nascimento</label>
                                        <div class="relative">
                                            <input type="date" required
                                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all text-slate-600" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Visit Preferences -->
                            <div class="pt-4 border-t border-gray-100">
                                <h4 class="text-sm font-bold text-lumira-orange uppercase tracking-wider mb-4">Interesse
                                    e Disponibilidade</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Período de
                                            Interesse</label>
                                        <select
                                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all text-slate-600">
                                            <option>Regular (Manhã)</option>
                                            <option>Regular (Tarde)</option>
                                            <option>Semi-Integral</option>
                                            <option>Integral</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Previsão de
                                            Matrícula</label>
                                        <select
                                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all text-slate-600">
                                            <option>Imediata</option>
                                            <option>Próximo Semestre</option>
                                            <option>Ano que vem (2026)</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Observações ou
                                            Dúvidas Específicas</label>
                                        <textarea rows="3"
                                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-lumira-blue focus:ring-2 focus:ring-lumira-blue/20 outline-none transition-all resize-none"
                                            placeholder="Ex: Tem alergia alimentar, dúvidas sobre adaptação..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full py-4 bg-lumira-orange hover:bg-orange-500 text-white font-bold rounded-xl text-lg shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                                <i data-lucide="calendar" class="w-5 h-5"></i> Solicitar Agendamento
                            </button>

                            <p class="text-xs text-center text-slate-400 mt-4">
                                Ao enviar, você concorda em receber o contato da nossa equipe escolar. Seus dados estão
                                seguros.
                            </p>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('schedule-form').addEventListener('submit', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
            // Simulating loading/transition
            this.closest('#schedule-content').classList.add('hidden');
            document.getElementById('schedule-success').classList.remove('hidden');
        });
    </script>

    <?php include 'includes/footer.php'; ?>