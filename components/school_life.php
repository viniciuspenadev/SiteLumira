<section id="school-life" class="py-20 md:py-28 bg-orange-50/40 relative overflow-hidden">
    <!-- Decorative -->
    <div class="absolute top-1/2 left-0 w-64 h-64 bg-white rounded-full blur-3xl -translate-y-1/2 -translate-x-1/2">
    </div>
    <div
        class="absolute bottom-0 right-0 w-96 h-96 bg-lumira-light rounded-full blur-3xl translate-y-1/3 translate-x-1/3">
    </div>

    <div class="container mx-auto px-4 md:px-8 relative z-10">

        <!-- Header -->
        <div class="text-center mb-12">
            <span class="text-lumira-orange font-bold uppercase tracking-wider text-sm">Nosso Dia a Dia</span>
            <h2 class="text-3xl md:text-5xl font-bold text-lumira-dark mt-2 mb-6">Muito mais que sala de aula</h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg">
                Proporcionamos experiências ricas que desenvolvem a criança integralmente, da alimentação à
                criatividade.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-16">

            <!-- Navigation Tabs (Left Side) -->
            <div
                class="w-full lg:w-1/3 flex flex-row lg:flex-col gap-4 overflow-x-auto lg:overflow-visible pb-4 lg:pb-0 scrollbar-hide">
                <?php foreach ($SCHOOL_ACTIVITIES as $index => $activity):
                    $isActive = $index === 0;
                    ?>
                    <button
                        class="activity-tab flex items-center gap-4 p-4 rounded-2xl transition-all duration-300 text-left min-w-[240px] border-2 cursor-pointer <?php echo $isActive ? 'bg-white border-lumira-orange/20 shadow-lg scale-100 lg:scale-105 z-10' : 'bg-white/50 border-transparent hover:bg-white hover:border-gray-200 text-slate-500'; ?>"
                        data-id="<?php echo $activity['id']; ?>">
                        <div
                            class="activity-icon-wrapper w-12 h-12 rounded-full flex items-center justify-center shrink-0 transition-colors <?php echo $isActive ? 'bg-lumira-light text-lumira-blue' : 'bg-gray-200 text-gray-400'; ?>">
                            <i data-lucide="<?php echo $activity['icon']; ?>" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4
                                class="activity-title font-bold text-lg <?php echo $isActive ? 'text-lumira-dark' : 'text-slate-500'; ?>">
                                <?php echo $activity['title']; ?>
                            </h4>
                        </div>
                        <!-- Arrow only for active -->
                        <i data-lucide="arrow-right"
                            class="activity-arrow ml-auto text-lumira-orange hidden lg:block w-5 h-5 <?php echo $isActive ? '' : 'hidden'; ?>"></i>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Content Area (Right Side) -->
            <div class="w-full lg:w-2/3 relative min-h-[500px]">
                <?php foreach ($SCHOOL_ACTIVITIES as $index => $activity):
                    $isActive = $index === 0;
                    ?>
                    <div class="activity-content flex flex-col md:flex-row gap-10 items-center animate-fade-in absolute inset-0 transition-opacity duration-500 <?php echo $isActive ? 'opacity-100 relative z-10 pointer-events-auto' : 'opacity-0 absolute z-0 pointer-events-none hidden'; ?>"
                        id="activity-<?php echo $activity['id']; ?>">

                        <!-- Text -->
                        <div class="w-full md:w-1/2 order-2 md:order-1">
                            <span
                                class="flex items-center gap-2 font-bold uppercase tracking-wider text-sm mb-3 <?php echo $activity['color']; ?>">
                                <i data-lucide="<?php echo $activity['icon']; ?>" class="w-4 h-4"></i>
                                <?php echo $activity['title']; ?>
                            </span>
                            <h3 class="text-3xl font-bold text-lumira-dark mb-4 leading-tight">
                                <?php echo $activity['description']; ?>
                            </h3>

                            <ul class="space-y-4 mb-8">
                                <?php foreach ($activity['benefits'] as $benefit): ?>
                                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                                        <i data-lucide="check-circle-2"
                                            class="w-5 h-5 shrink-0 <?php echo str_replace('text-', 'text-opacity-80 text-', $activity['color']); ?>"></i>
                                        <?php echo $benefit; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Image -->
                        <div class="w-full md:w-1/2 relative order-1 md:order-2 h-[400px]">
                            <div
                                class="relative h-full w-full rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-white group">
                                <img src="<?php echo $activity['image']; ?>" alt="<?php echo $activity['title']; ?>"
                                    class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110" />

                                <!-- Floating Card -->
                                <div
                                    class="absolute bottom-6 left-6 bg-white/95 backdrop-blur-md p-4 rounded-xl shadow-lg max-w-[220px] animate-fade-in-up">
                                    <p class="text-xs text-slate-500 uppercase font-bold mb-1">
                                        <?php echo $activity['floatingCard']['title']; ?></p>
                                    <p class="text-lumira-dark font-bold text-sm">
                                        <?php echo $activity['floatingCard']['text']; ?></p>
                                </div>
                            </div>

                            <!-- Decorative -->
                            <div
                                class="absolute -z-10 -top-6 -right-6 w-32 h-32 rounded-full opacity-20 blur-2xl <?php echo str_replace('text-', 'bg-', $activity['color']); ?>">
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>