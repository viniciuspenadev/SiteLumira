<section id="methodology" class="py-20 bg-white relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div
        class="absolute top-0 left-0 w-64 h-64 bg-lumira-light rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 opacity-60">
    </div>
    <div
        class="absolute bottom-0 right-0 w-96 h-96 bg-lumira-orange/5 rounded-full blur-3xl translate-x-1/3 translate-y-1/3">
    </div>

    <div class="container mx-auto px-4 md:px-8 relative z-10">
        <div class="flex flex-col md:flex-row gap-12 items-start">

            <!-- Header Section -->
            <div class="w-full md:w-1/3 sticky top-24">
                <span
                    class="text-lumira-orange font-bold uppercase tracking-wider text-sm flex items-center gap-2 mb-3">
                    <span class="w-8 h-0.5 bg-lumira-orange"></span>
                    Nossos Pilares
                </span>
                <h2 class="text-3xl md:text-5xl font-bold text-lumira-dark mb-6 leading-tight">
                    Aprendizado que vai além da sala de aula.
                </h2>
                <p class="text-slate-600 text-lg leading-relaxed mb-8">
                    No Lumirá, entendemos que a criança aprende com o corpo, com a emoção e com a interação. Nossa
                    proposta pedagógica integra a natureza, a tecnologia e o afeto.
                </p>
                <div class="hidden md:block p-6 bg-lumira-light/50 rounded-2xl border border-lumira-blue/10">
                    <p class="italic text-lumira-dark font-medium">
                        "A criança é feita de cem. A criança tem cem linguagens, cem mãos, cem pensamentos, cem modos de
                        pensar, de jogar e de falar."
                    </p>
                    <p class="text-right text-sm text-slate-500 mt-2">— Loris Malaguzzi</p>
                </div>
            </div>

            <!-- Grid of Features -->
            <div class="w-full md:w-2/3 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <?php foreach ($FEATURES as $idx => $feature):
                    $isEven = $idx % 2 === 0;
                    ?>
                    <div
                        class="group p-8 rounded-[2rem] transition-all duration-500 hover:-translate-y-2 border border-gray-100 shadow-sm hover:shadow-xl <?php echo $isEven ? 'bg-white md:translate-y-8' : 'bg-white'; ?>">
                        <div
                            class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transition-colors duration-300 <?php echo $isEven ? 'bg-lumira-light text-lumira-blue group-hover:bg-lumira-blue group-hover:text-white' : 'bg-orange-50 text-lumira-orange group-hover:bg-lumira-orange group-hover:text-white'; ?>">
                            <i data-lucide="<?php echo $feature['icon']; ?>" class="w-8 h-8" stroke-width="1.5"></i>
                        </div>

                        <h3 class="text-2xl font-bold text-lumira-dark mb-3 group-hover:text-lumira-blue transition-colors">
                            <?php echo $feature['title']; ?>
                        </h3>

                        <p class="text-slate-500 leading-relaxed group-hover:text-slate-600">
                            <?php echo $feature['description']; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>