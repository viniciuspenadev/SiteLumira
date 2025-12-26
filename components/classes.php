<section id="classes" class="py-20 bg-white relative">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-16">
            <span class="text-lumira-orange font-bold uppercase tracking-wider text-sm">Ciclos de Aprendizado</span>
            <h2 class="text-3xl md:text-5xl font-bold text-lumira-dark mt-2 mb-6">Nossas Turmas</h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg">
                Turmas reduzidas e divididas por faixa etária para garantir atenção individualizada e estímulos
                adequados.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($CLASSES as $cls): ?>
                <div
                    class="group relative bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col overflow-hidden hover:-translate-y-2">
                    <div class="h-48 overflow-hidden relative">
                        <img src="<?php echo $cls['image']; ?>" alt="<?php echo $cls['title']; ?>"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-lumira-dark/80 to-transparent opacity-60"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <div
                                class="bg-white/20 backdrop-blur-md border border-white/30 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-1">
                                <?php echo $cls['age']; ?>
                            </div>
                            <h3 class="text-2xl font-bold text-white"><?php echo $cls['title']; ?></h3>
                        </div>
                    </div>

                    <div class="p-8 flex-1 flex flex-col">
                        <p class="text-slate-600 mb-6 leading-relaxed">
                            <?php echo $cls['description']; ?>
                        </p>

                        <ul class="space-y-3 mt-auto">
                            <?php foreach ($cls['features'] as $feat): ?>
                                <li class="flex items-center gap-3 text-sm font-medium text-lumira-dark/80">
                                    <div
                                        class="w-6 h-6 rounded-full bg-lumira-light flex items-center justify-center text-lumira-blue shrink-0">
                                        <i data-lucide="check" class="w-3.5 h-3.5" stroke-width="3"></i>
                                    </div>
                                    <?php echo $feat; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div
                        class="h-1.5 w-full bg-gradient-to-r from-lumira-blue to-lumira-orange transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>