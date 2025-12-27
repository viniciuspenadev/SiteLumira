<section id="about" class="py-20 md:py-28 bg-lumira-light overflow-hidden">
    <div class="container mx-auto px-4 md:px-8">

        <!-- Intro -->
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 mb-20">

            <!-- Interactive Video Container -->
            <div class="w-full lg:w-1/2 relative group" id="video-container">

                <!-- Floating Icons -->
                <div class="absolute -top-6 -left-6 z-20 animate-bounce duration-[3000ms]">
                    <div
                        class="w-12 h-12 bg-white rounded-2xl shadow-lg flex items-center justify-center text-lumira-orange transform -rotate-12">
                        <i data-lucide="book-open" class="w-6 h-6"></i>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 z-20 animate-bounce duration-[4000ms] delay-700">
                    <div
                        class="w-12 h-12 bg-white rounded-2xl shadow-lg flex items-center justify-center text-lumira-blue transform rotate-12">
                        <i data-lucide="palette" class="w-6 h-6"></i>
                    </div>
                </div>
                <div class="absolute top-1/2 -right-8 z-20 animate-bounce duration-[3500ms] delay-500">
                    <div
                        class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-green-500">
                        <i data-lucide="star" class="w-5 h-5"></i>
                    </div>
                </div>

                <div
                    class="relative rounded-[2.5rem] overflow-hidden shadow-2xl aspect-video bg-gray-900 border-8 border-white transform transition-transform duration-500 hover:scale-[1.02]">

                    <!-- Simulated Video Content (Playing State) -->
                    <div id="video-playing"
                        class="absolute inset-0 transition-opacity duration-700 opacity-0 pointer-events-none">
                        <img src="assets/images/hero_01.jpg" class="w-full h-full object-cover opacity-60"
                            alt="Video Background" />
                        <div class="absolute inset-0 flex items-center justify-center">
                            <p class="text-white font-bold animate-pulse">Vídeo Reproduzindo...</p>
                        </div>
                    </div>

                    <!-- Cover Image & Interaction Layer (Visible when not playing) -->
                    <div id="video-cover" class="absolute inset-0 transition-all duration-500 opacity-100">
                        <img src="assets/images/hero_01.jpg" alt="Crianças aprendendo"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-lumira-dark/30 backdrop-blur-[1px] group-hover:backdrop-blur-0 transition-all duration-500">
                        </div>

                        <!-- Play Button -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button id="play-video-btn"
                                class="w-20 h-20 bg-white/20 backdrop-blur-md border border-white/50 rounded-full flex items-center justify-center text-white hover:bg-lumira-orange hover:border-lumira-orange hover:scale-110 transition-all duration-300 group/btn shadow-xl">
                                <i data-lucide="play" class="ml-1 fill-current w-8 h-8"></i>
                                <span
                                    class="absolute inset-0 rounded-full animate-ping bg-white/30 opacity-75 group-hover/btn:hidden"></span>
                            </button>
                        </div>

                        <!-- Interactive Hotspots -->
                        <div class="absolute top-1/4 left-1/4 animate-bounce duration-[3000ms]">
                            <div
                                class="bg-white/90 backdrop-blur text-lumira-dark px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center gap-1 cursor-pointer hover:bg-lumira-blue hover:text-white transition-colors">
                                <i data-lucide="mouse-pointer-2" class="w-3 h-3"></i> Tour Virtual
                            </div>
                        </div>

                        <div class="absolute bottom-1/3 right-1/4 animate-bounce duration-[4000ms] delay-700">
                            <div
                                class="bg-white/90 backdrop-blur text-lumira-dark px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center gap-1 cursor-pointer hover:bg-lumira-blue hover:text-white transition-colors">
                                <i data-lucide="mouse-pointer-2" class="w-3 h-3"></i> Depoimentos
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Decorative blob -->
                <div class="absolute -z-10 -right-10 -bottom-10 w-40 h-40 bg-lumira-orange/20 rounded-full blur-2xl">
                </div>
                <div class="absolute -z-10 -left-10 top-10 w-40 h-40 bg-lumira-blue/20 rounded-full blur-2xl"></div>
            </div>

            <div class="w-full lg:w-1/2">
                <h4 class="text-lumira-orange font-bold uppercase tracking-wider mb-2 flex items-center gap-2">
                    <span class="w-8 h-0.5 bg-lumira-orange"></span>
                    Nossa Essência
                </h4>
                <h2 class="text-3xl md:text-5xl font-bold text-lumira-dark mb-6 leading-tight">
                    Um lugar onde cada descoberta é celebrada.
                </h2>
                <p class="text-slate-600 text-lg leading-relaxed mb-6">
                    No <strong class="text-lumira-blue">Colégio Lumirá</strong>, acreditamos que a educação infantil é a
                    fase mais importante da vida. Nossa missão é proporcionar um ambiente seguro, estimulante e
                    acolhedor, onde as crianças possam desenvolver todo o seu potencial intelectual, emocional e social.
                </p>
                <p class="text-slate-600 text-lg leading-relaxed mb-8">
                    Combinamos metodologias ativas com o carinho que seu filho merece, preparando-o não apenas para a
                    escola, mas para a vida.
                </p>

                <a href="#methodology"
                    class="inline-flex items-center text-lumira-blue font-bold hover:text-lumira-orange transition-colors group">
                    Conheça nossa Metodologia
                    <span class="ml-2 transform group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>
        </div>

    </div>
</section>