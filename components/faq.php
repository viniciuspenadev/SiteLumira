<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 md:px-8 max-w-4xl">
        <div class="text-center mb-12">
            <span
                class="flex items-center justify-center gap-2 text-lumira-blue font-bold uppercase tracking-wider text-sm mb-3">
                <i data-lucide="help-circle" class="w-4 h-4"></i> Dúvidas Comuns
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-lumira-dark">Perguntas Frequentes</h2>
        </div>

        <div class="space-y-4" id="faq-container">
            <?php foreach ($FAQS as $index => $faq): ?>
                <div
                    class="faq-item bg-white rounded-2xl border border-transparent shadow-sm hover:border-gray-200 transition-all duration-300">
                    <button
                        class="w-full px-6 py-5 flex items-center justify-between text-left focus:outline-none faq-toggle"
                        aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                        <span class="font-bold text-lg transition-colors text-slate-700 faq-question">
                            <?php echo $faq['question']; ?>
                        </span>
                        <i data-lucide="chevron-down"
                            class="text-lumira-orange transition-transform duration-300 w-6 h-6 faq-icon"></i>
                    </button>
                    <div class="faq-answer overflow-hidden transition-all duration-300 ease-in-out max-h-0 opacity-0">
                        <div class="px-6 pb-6 text-slate-600 leading-relaxed border-t border-gray-100 pt-4">
                            <?php echo $faq['answer']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-10">
            <p class="text-slate-500">Ainda tem dúvidas?</p>
            <a href="#contact" class="text-lumira-orange font-bold hover:underline">Fale com nossa coordenação</a>
        </div>
    </div>
</section>