<?php
$categories = [
    ['id' => 'todos', 'label' => 'Todos'],
    ['id' => 'dia-a-dia', 'label' => 'Dia a Dia'],
    ['id' => 'estrutura', 'label' => 'Estrutura'],
    ['id' => 'eventos', 'label' => 'Eventos'],
];
?>
<section id="gallery" class="py-20 bg-white relative">
    <div class="container mx-auto px-4 md:px-8">

        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
            <div>
                <span class="flex items-center gap-2 text-lumira-blue font-bold uppercase tracking-wider text-sm mb-2">
                    <i data-lucide="camera" class="w-4 h-4"></i> Galeria Lumirá
                </span>
                <h2 class="text-3xl font-bold text-lumira-dark">
                    Momentos Especiais
                </h2>
            </div>

            <!-- Minimal Filters -->
            <div class="flex flex-wrap gap-2" id="gallery-filters">
                <?php foreach ($categories as $cat): ?>
                    <button
                        class="filter-btn px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 <?php echo $cat['id'] === 'todos' ? 'bg-lumira-light text-lumira-blue active' : 'bg-transparent text-slate-400 hover:text-lumira-blue'; ?>"
                        data-filter="<?php echo $cat['id']; ?>">
                        <?php echo $cat['label']; ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Horizontal Scroll Strip (Soft & Fitted) -->
        <div class="relative -mx-4 md:mx-0">
            <div class="flex gap-4 overflow-x-auto pb-8 px-4 md:px-0 scrollbar-hide snap-x snap-mandatory"
                id="gallery-grid">
                <?php foreach ($GALLERY_ITEMS as $item):
                    $catLabel = 'Todos';
                    foreach ($categories as $c) {
                        if ($c['id'] === $item['category'])
                            $catLabel = $c['label'];
                    }
                    ?>
                    <div class="gallery-item snap-center shrink-0 w-[280px] h-[350px] md:w-[320px] md:h-[400px] relative group rounded-[2rem] overflow-hidden cursor-pointer shadow-sm hover:shadow-lg transition-all duration-300"
                        data-category="<?php echo $item['category']; ?>" data-src="<?php echo $item['src']; ?>"
                        data-caption="<?php echo $item['caption']; ?>">
                        <img src="<?php echo $item['src']; ?>" alt="<?php echo $item['caption']; ?>"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />

                        <!-- Gradient Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-lumira-dark/80 via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300">
                        </div>

                        <!-- Content -->
                        <div
                            class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            <p class="text-white font-bold text-lg leading-tight mb-1">
                                <?php echo $item['caption']; ?>
                            </p>
                            <span class="text-white/70 text-xs font-medium uppercase tracking-wider">
                                <?php echo $catLabel; ?>
                            </span>
                        </div>

                        <!-- Hover Icon -->
                        <div
                            class="absolute top-4 right-4 bg-white/20 backdrop-blur-md p-2 rounded-full text-white opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-75 group-hover:scale-100">
                            <i data-lucide="maximize-2" class="w-4.5 h-4.5"></i>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- End Spacer -->
                <div class="w-4 shrink-0 md:hidden"></div>
            </div>

            <!-- Scroll Hint (Mobile) -->
            <div class="absolute bottom-0 right-4 text-xs text-slate-300 md:hidden font-medium animate-pulse">
                Deslize para ver mais →
            </div>
        </div>

    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox-modal"
        class="fixed inset-0 z-[70] bg-black/95 backdrop-blur-sm flex items-center justify-center p-4 md:p-12 animate-fade-in hidden opacity-0 transition-opacity duration-300">

        <button id="lightbox-close"
            class="absolute top-6 right-6 p-3 bg-white/10 hover:bg-white/20 rounded-full text-white transition-colors z-50">
            <i data-lucide="x" class="w-7 h-7"></i>
        </button>

        <button id="lightbox-prev"
            class="absolute left-4 top-1/2 -translate-y-1/2 p-4 text-white/50 hover:text-white transition-colors z-50 hidden md:block">
            <i data-lucide="chevron-left" class="w-10 h-10"></i>
        </button>

        <div class="relative max-w-5xl w-full h-full flex flex-col items-center justify-center pointer-events-none">
            <img id="lightbox-image" src="" alt=""
                class="max-h-[85vh] max-w-full rounded-2xl shadow-2xl object-contain pointer-events-auto" />
            <div class="mt-4 text-center">
                <p id="lightbox-caption" class="text-white text-xl font-bold"></p>
            </div>
        </div>

        <button id="lightbox-next"
            class="absolute right-4 top-1/2 -translate-y-1/2 p-4 text-white/50 hover:text-white transition-colors z-50 hidden md:block">
            <i data-lucide="chevron-right" class="w-10 h-10"></i>
        </button>
    </div>
</section>