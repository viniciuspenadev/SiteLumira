<section id="contact" class="py-20 md:py-28 bg-lumira-blue/5 relative overflow-hidden">
    <!-- Decorative Circles -->
    <div
        class="absolute top-0 right-0 w-96 h-96 bg-lumira-blue/10 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2 pointer-events-none">
    </div>

    <div class="container mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start">

            <!-- Contact Info -->
            <div>
                <h2 class="text-3xl md:text-5xl font-bold text-lumira-dark mb-6">
                    Venha nos conhecer
                </h2>
                <p class="text-slate-600 text-lg mb-10">
                    Estamos ansiosos para receber sua família. Agende uma visita para conhecer nossa estrutura e
                    proposta pedagógica.
                </p>

                <div class="space-y-8">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-white rounded-full shadow-sm text-lumira-blue shrink-0">
                            <i data-lucide="map-pin" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lumira-dark text-lg">Endereço</h4>
                            <p class="text-slate-600">R. Eng. Alexandre Machado, 208<br />Vila Augusta, Guarulhos - SP
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-white rounded-full shadow-sm text-lumira-blue shrink-0">
                            <i data-lucide="phone" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lumira-dark text-lg">Telefone & WhatsApp</h4>
                            <p class="text-slate-600">(11) 93492-1031</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-white rounded-full shadow-sm text-lumira-blue shrink-0">
                            <i data-lucide="mail" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lumira-dark text-lg">Email</h4>
                            <p class="text-slate-600">contato@colegiolumira.com.br</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-white rounded-full shadow-sm text-lumira-blue shrink-0">
                            <i data-lucide="clock" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-lumira-dark text-lg">Horário de Atendimento</h4>
                            <p class="text-slate-600">Segunda a Sexta: 07h30 às 18h30</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white p-8 md:p-10 rounded-[2rem] shadow-xl relative z-10">
                <!-- Success Message (Hidden by default) -->
                <div id="contact-success"
                    class="h-full flex flex-col items-center justify-center text-center py-20 animate-fade-in-up hidden">
                    <div
                        class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mb-6">
                        <i data-lucide="send" class="w-10 h-10"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-lumira-dark mb-2">Mensagem Enviada!</h3>
                    <p class="text-slate-500">Obrigado pelo contato. Retornaremos em breve.</p>
                </div>

                <form id="contact-form" class="space-y-6">
                    <h3 class="text-2xl font-bold text-lumira-dark mb-2">Fale Conosco</h3>

                    <div>
                        <label htmlFor="name" class="block text-sm font-semibold text-slate-700 mb-2">Nome
                            Completo</label>
                        <input type="text" id="name" required
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-transparent focus:border-lumira-blue/50 focus:bg-white focus:outline-none transition-all"
                            placeholder="Seu nome" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label htmlFor="email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                            <input type="email" id="email" required
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-transparent focus:border-lumira-blue/50 focus:bg-white focus:outline-none transition-all"
                                placeholder="seu@email.com" />
                        </div>
                        <div>
                            <label htmlFor="phone"
                                class="block text-sm font-semibold text-slate-700 mb-2">Telefone</label>
                            <input type="tel" id="phone" required
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-transparent focus:border-lumira-blue/50 focus:bg-white focus:outline-none transition-all"
                                placeholder="(11) 93492-1031" />
                        </div>
                    </div>

                    <div>
                        <label htmlFor="message"
                            class="block text-sm font-semibold text-slate-700 mb-2">Mensagem</label>
                        <textarea id="message" rows="4" required
                            class="w-full px-4 py-3 rounded-xl bg-gray-50 border-2 border-transparent focus:border-lumira-blue/50 focus:bg-white focus:outline-none transition-all resize-none"
                            placeholder="Gostaria de agendar uma visita para..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-lumira-dark text-white rounded-xl font-bold text-lg hover:bg-lumira-blue transition-colors shadow-lg hover:shadow-xl">
                        Enviar Mensagem
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>