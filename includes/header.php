<?php
// Determine if we are on the home page
$current_page = basename($_SERVER['PHP_SELF']);
$is_home = ($current_page == 'index.php' || $current_page == '');
$link_prefix = $is_home ? '' : 'index.php';

$navItems = [
    [
        'label' => 'Início',
        'href' => $link_prefix . '#home'
    ],
    [
        'label' => 'A Escola',
        'href' => $link_prefix . '#about',
        'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=600&auto=format&fit=crop',
        'description' => 'Conheça nossa essência e metodologia.',
        'children' => [
            ['label' => 'Nossa Essência', 'href' => $link_prefix . '#about', 'description' => 'Quem somos e no que acreditamos', 'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=600&auto=format&fit=crop'],
            ['label' => 'Metodologia', 'href' => $link_prefix . '#methodology', 'description' => 'Pedagogia afetiva e inovação', 'image' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop'],
            ['label' => 'Vivência Escolar', 'href' => $link_prefix . '#school-life', 'description' => 'Horta, Nutrição e Bilinguismo', 'image' => 'https://images.unsplash.com/photo-1592419044706-39796d40f98c?q=80&w=600&auto=format&fit=crop'],
            ['label' => 'Equipe', 'href' => $link_prefix . '#contact', 'description' => 'Educadores apaixonados', 'image' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=600&auto=format&fit=crop']
        ]
    ],
    [
        'label' => 'Turmas',
        'href' => $link_prefix . '#classes',
        'image' => 'assets/images/IMG_3428.jpg',
        'description' => 'Ciclos de aprendizado para cada fase.',
        'children' => [
            ['label' => 'Berçário', 'href' => $link_prefix . '#classes', 'description' => '4 meses a 2 anos', 'image' => 'assets/images/IMG_3428.jpg'],
            ['label' => 'Maternal', 'href' => $link_prefix . '#classes', 'description' => '2 a 4 anos', 'image' => 'assets/images/IMG_7928.jpg'],
            ['label' => 'Pré-Escola', 'href' => $link_prefix . '#classes', 'description' => '4 a 6 anos', 'image' => 'assets/images/IMG_1351.jpg']
        ]
    ],
    /*
    [
        'label' => 'Galeria',
        'href' => $link_prefix . '#gallery',
        'image' => 'https://images.unsplash.com/photo-1596464716127-f9a82763ef5c?q=80&w=600&auto=format&fit=crop',
        'description' => 'Dia a dia no Lumirá'
    ],
    */
];
?>

<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent py-4">
    <div class="container mx-auto px-4 md:px-8 relative">
        <div class="flex items-center justify-between">
            <a href="<?php echo $link_prefix; ?>index.php"
                class="flex-shrink-0 transition-transform hover:scale-105 relative z-50">
                <?php $className = "h-16 md:h-20";
                include 'includes/logo.php'; ?>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-1">
                <?php foreach ($navItems as $item): ?>
                    <div class="relative group px-4 py-3 nav-item-group">
                        <a href="<?php echo $item['href']; ?>"
                            class="relative z-10 font-bold text-sm tracking-wide transition-colors duration-300 flex items-center gap-1 text-lumira-dark md:text-white md:mix-blend-overlay group-hover:opacity-100 header-link"
                            style="text-shadow: 0 2px 4px rgba(0,0,0,0.1)">
                            <?php echo $item['label']; ?>
                            <?php if (isset($item['children'])): ?>
                                <i data-lucide="chevron-down"
                                    class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180"></i>
                            <?php endif; ?>
                        </a>

                        <?php if (isset($item['children'])): ?>
                            <!-- Mega Menu -->
                            <div
                                class="absolute top-full left-1/2 -translate-x-1/2 pt-6 transition-all duration-300 origin-top w-[600px] opacity-0 scale-95 -translate-y-2 invisible group-hover:opacity-100 group-hover:scale-100 group-hover:translate-y-0 group-hover:visible">
                                <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-gray-100 flex p-2">
                                    <!-- Left Side -->
                                    <div class="w-1/2 p-4 flex flex-col gap-2">
                                        <?php foreach ($item['children'] as $child): ?>
                                            <a href="<?php echo $child['href']; ?>"
                                                class="group/link p-4 rounded-xl hover:bg-lumira-light/50 transition-all flex items-center justify-between"
                                                data-image="<?php echo $child['image']; ?>"
                                                data-description="<?php echo $child['description']; ?>">
                                                <div>
                                                    <div
                                                        class="font-bold text-lumira-dark group-hover/link:text-lumira-blue transition-colors">
                                                        <?php echo $child['label']; ?>
                                                    </div>
                                                    <div class="text-xs text-slate-400 mt-1 font-medium">
                                                        <?php echo $child['description']; ?>
                                                    </div>
                                                </div>
                                                <i data-lucide="chevron-right"
                                                    class="w-4 h-4 text-lumira-orange opacity-0 -translate-x-2 group-hover/link:opacity-100 group-hover/link:translate-x-0 transition-all"></i>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- Right Side -->
                                    <div class="w-1/2 relative rounded-2xl overflow-hidden bg-gray-100 m-2">
                                        <div class="absolute inset-0 transition-all duration-500">
                                            <img src="<?php echo $item['image']; ?>" alt="Preview"
                                                class="w-full h-full object-cover animate-fade-in mega-menu-image">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-lumira-dark/80 to-transparent opacity-80">
                                            </div>
                                            <div class="absolute bottom-6 left-6 right-6">
                                                <span
                                                    class="text-white/80 text-xs font-bold uppercase tracking-wider mb-2 block">Explorar</span>
                                                <p class="text-white font-medium text-lg leading-tight mega-menu-text">
                                                    <?php echo $item['description']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Arrow -->
                                <div
                                    class="absolute top-4 left-1/2 -translate-x-1/2 w-4 h-4 bg-white transform rotate-45 border-l border-t border-gray-100">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <a href="agendar.php"
                    class="ml-4 px-6 py-2.5 bg-lumira-orange text-white rounded-full font-bold text-sm shadow-md hover:shadow-lg hover:bg-orange-500 transition-all transform hover:-translate-y-0.5 relative z-10">
                    Agendar Visita
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button class="md:hidden p-2 relative z-50 text-white" aria-label="Menu" id="mobile-menu-btn">
                <i data-lucide="menu" id="icon-menu" class="w-7 h-7"></i>
                <i data-lucide="x" id="icon-close" class="w-7 h-7 text-lumira-dark hidden"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Nav Overlay -->
    <div
        class="fixed inset-0 bg-white/95 backdrop-blur-xl z-40 md:hidden transition-all duration-500 flex flex-col px-8 pt-24 space-y-2 overflow-y-auto mobile-menu-overlay opacity-0 pointer-events-none">
        <?php foreach ($navItems as $item): ?>
            <div
                class="border-b border-gray-100 last:border-0 pb-4 mb-4 mobile-item transition-all duration-500 -translate-x-10 opacity-0">
                <a href="<?php echo $item['href']; ?>"
                    class="mobile-menu-link text-2xl font-bold text-lumira-dark flex items-center gap-3 mb-2">
                    <?php echo $item['label']; ?>
                </a>
                <?php if (isset($item['children'])): ?>
                    <div class="pl-4 mt-2 space-y-3 border-l-2 border-lumira-light ml-1">
                        <?php foreach ($item['children'] as $child): ?>
                            <a href="<?php echo $child['href']; ?>"
                                class="mobile-menu-link block text-lg text-slate-500 font-medium hover:text-lumira-orange">
                                <?php echo $child['label']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <a href="agendar.php"
            class="w-full py-4 bg-lumira-orange text-white rounded-xl font-bold text-xl shadow-lg mt-4 text-center block">
            Agendar Visita
        </a>
    </div>
</header>