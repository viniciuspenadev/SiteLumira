<section id="home" class="relative h-screen min-h-[600px] w-full overflow-hidden bg-gray-900">
    <!-- Slides -->
    <?php foreach ($CAROUSEL_IMAGES as $index => $image): ?>
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out hero-slide <?php echo $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0'; ?>"
            data-index="<?php echo $index; ?>">
            <!-- Image -->
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[10000ms] ease-linear transform hero-bg-image <?php echo $index === 0 ? 'scale-100' : 'scale-110'; ?>"
                style="background-image: url('<?php echo $image['url']; ?>');">
            </div>
            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-r from-lumira-dark/80 via-lumira-dark/40 to-transparent"></div>
        </div>
    <?php endforeach; ?>

    <!-- Content -->
    <div class="absolute inset-0 z-20 flex items-center">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-3xl text-white">
                <span
                    class="inline-block px-4 py-1 mb-4 border border-white/30 rounded-full text-sm font-semibold tracking-wider uppercase bg-white/10 backdrop-blur-sm animate-fade-in-up">
                    Matrículas Abertas 2026
                </span>

                <?php foreach ($CAROUSEL_IMAGES as $index => $image): ?>
                    <div class="hero-text <?php echo $index === 0 ? 'block' : 'hidden'; ?>"
                        data-index="<?php echo $index; ?>">
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight drop-shadow-lg">
                            <?php echo $image['caption']; ?>
                        </h1>
                        <p class="text-lg md:text-2xl mb-8 font-light text-gray-100 max-w-lg drop-shadow-md">
                            <?php echo $image['subcaption']; ?>
                        </p>
                    </div>
                <?php endforeach; ?>

                <div class="flex gap-4">
                    <a href="#contact"
                        class="px-8 py-4 bg-lumira-orange hover:bg-orange-500 text-white rounded-full font-bold text-lg transition-all transform hover:scale-105 shadow-lg flex items-center gap-2">
                        Conheça a Escola <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                    <a href="#about"
                        class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white rounded-full font-bold text-lg transition-all hidden md:flex items-center">
                        Saiba Mais
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <button id="hero-prev"
        class="absolute left-4 top-1/2 -translate-y-1/2 z-30 p-4 rounded-full bg-white/10 hover:bg-white/30 backdrop-blur-md text-white transition-all hidden md:block hover:scale-110">
        <i data-lucide="chevron-left" class="w-7 h-7"></i>
    </button>
    <button id="hero-next"
        class="absolute right-4 top-1/2 -translate-y-1/2 z-30 p-4 rounded-full bg-white/10 hover:bg-white/30 backdrop-blur-md text-white transition-all hidden md:block hover:scale-110">
        <i data-lucide="chevron-right" class="w-7 h-7"></i>
    </button>

    <!-- Indicators -->
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-30 flex gap-3">
        <?php foreach ($CAROUSEL_IMAGES as $index => $image): ?>
            <button data-index="<?php echo $index; ?>"
                class="hero-indicator h-1.5 rounded-full transition-all duration-500 <?php echo $index === 0 ? 'bg-lumira-orange w-12' : 'bg-white/40 w-4 hover:bg-white'; ?>">
            </button>
        <?php endforeach; ?>
    </div>
</section>