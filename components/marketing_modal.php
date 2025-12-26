<div id="marketing-modal"
    class="fixed inset-0 z-[60] flex items-center justify-center px-4 transition-all duration-500 bg-black/0 backdrop-blur-none opacity-0 invisible pointer-events-none">
    <!-- Click outside to close -->
    <div class="absolute inset-0" id="marketing-modal-bg"></div>

    <!-- Modal Content -->
    <div id="marketing-modal-content"
        class="bg-white w-full max-w-4xl rounded-[2.5rem] shadow-2xl overflow-hidden relative flex flex-col md:flex-row transform transition-all duration-700 scale-95 translate-y-10 opacity-0">

        <!-- Close Button -->
        <button id="marketing-modal-close"
            class="absolute top-4 right-4 z-20 p-2 bg-white/80 backdrop-blur rounded-full text-slate-500 hover:text-lumira-orange hover:bg-white transition-all shadow-sm">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>

        <!-- Image Section -->
        <div class="w-full md:w-2/5 relative h-64 md:h-auto overflow-hidden group">
            <img src="assets/images/mkt.JPG" alt="Criança feliz no Colégio Lumirá"
                class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-110" />
            <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-lumira-dark/60 to-transparent"></div>

            <div class="absolute bottom-6 left-6 text-white md:hidden">
                <span
                    class="bg-lumira-orange px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2 inline-block">Novas
                    Turmas</span>
                <h3 class="text-2xl font-bold">O Futuro Começa Aqui</h3>
            </div>
        </div>

        <!-- Content Section -->
        <div class="w-full md:w-3/5 p-8 md:p-12 flex flex-col justify-center relative bg-white">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-lumira-orange/10 rounded-bl-[100%] -z-1"></div>

            <div class="hidden md:block">
                <div class="flex items-center gap-2 mb-4">
                    <span
                        class="flex items-center gap-1 bg-lumira-light text-lumira-blue px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                        <i data-lucide="sparkles" class="w-3 h-3"></i> Matrículas Abertas
                    </span>
                    <span class="text-slate-400 text-sm font-medium">Vagas Limitadas</span>
                </div>

                <h2 class="text-4xl lg:text-5xl font-bold text-lumira-dark mb-4 leading-tight">
                    Garanta o futuro do seu filho em <span class="text-lumira-orange">2026</span>
                </h2>
            </div>

            <div class="md:hidden mt-2">
                <h2 class="text-2xl font-bold text-lumira-dark mb-2">
                    Matrículas 2026 Abertas
                </h2>
            </div>

            <p class="text-slate-600 text-lg mb-8 leading-relaxed">
                Agende uma visita pedagógica e descubra como nossa metodologia afetiva transforma o aprendizado.
                <br class="hidden md:block" /> Condições especiais para matrículas antecipadas até
                <strong>30/11</strong>.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="agendar.php" id="marketing-modal-cta"
                    class="flex-1 px-8 py-4 bg-lumira-orange text-white rounded-xl font-bold text-lg text-center hover:bg-orange-500 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1 flex items-center justify-center gap-2 group">
                    Quero Agendar Visita <i data-lucide="arrow-right"
                        class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <button id="marketing-modal-dismiss"
                    class="px-8 py-4 bg-gray-50 text-slate-600 rounded-xl font-bold text-lg hover:bg-gray-100 transition-colors">
                    Agora não
                </button>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex items-center gap-2 text-slate-400 text-sm">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                <span>Atendimento: Seg a Sex, das 07h30 às 18h30</span>
            </div>
        </div>
    </div>
</div>