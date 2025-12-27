<div id="lumira-chat-widget" class="fixed bottom-6 right-6 z-50 flex flex-col items-end font-sans">

    <!-- Engagement Badge -->
    <div id="chat-badge" class="mb-4 mr-2 relative animate-bounce-slow cursor-pointer" onclick="toggleChat()">
        <div
            class="bg-white/90 backdrop-blur-md text-slate-800 text-sm font-medium py-2 px-4 rounded-full shadow-lg border border-white/50 relative z-10 flex items-center gap-2">
            <span>Dúvidas sobre matrícula? 👋</span>
            <button onclick="event.stopPropagation(); closeBadge();"
                class="text-slate-400 hover:text-slate-600 rounded-full p-0.5 hover:bg-slate-100/50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <!-- Tail -->
        <div
            class="absolute -bottom-1.5 right-6 w-3 h-3 bg-white/90 backdrop-blur-md rotate-45 border-r border-b border-white/50 z-0">
        </div>
    </div>

    <!-- Chat Window (Glassmorphism) -->
    <div id="chat-window"
        class="hidden flex-col w-[360px] h-[550px] bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl overflow-hidden transition-all duration-300 transform origin-bottom-right mb-4 border border-white/40 ring-1 ring-black/5">
        <!-- Header -->
        <div
            class="bg-gradient-to-br from-lumira-orange/90 to-orange-500/90 backdrop-blur-sm p-5 flex items-center justify-between text-white shadow-lg relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -top-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl pointer-events-none">
            </div>

            <div class="flex items-center gap-3 relative z-10">
                <div class="relative">
                    <div
                        class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center overflow-hidden border-2 border-white/40 shadow-inner">
                        <img src="assets/images/logo_icon.png"
                            onerror="this.src='https://ui-avatars.com/api/?name=L&background=random'" alt="IA"
                            class="w-full h-full object-cover">
                    </div>
                    <span
                        class="absolute bottom-0.5 right-0.5 w-3.5 h-3.5 bg-green-400 border-[3px] border-orange-500 rounded-full shadow-sm"></span>
                </div>
                <div>
                    <h3 class="font-bold text-lg leading-tight tracking-wide">Lumirá <span
                            class="font-normal opacity-90">Assistente</span></h3>
                    <p
                        class="text-[11px] text-orange-50 bg-white/20 px-2 py-0.5 rounded-full inline-block mt-0.5 backdrop-blur-sm">
                        ⚡ Responde na hora</p>
                </div>
            </div>
            <button onclick="toggleChat()"
                class="text-white/90 hover:text-white hover:bg-white/20 transition-all focus:outline-none rounded-full p-2 relative z-10">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div id="chat-messages" class="flex-1 overflow-y-auto p-5 space-y-5 scroll-smooth custom-scrollbar">
            <!-- Welcome Message (Bot) -->
            <div class="flex items-start gap-3">
                <div
                    class="w-9 h-9 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0 text-lumira-orange text-xs font-bold border border-orange-200 shadow-sm">
                    L
                </div>
                <div class="flex flex-col gap-1 w-full max-w-[85%]">
                    <div
                        class="bg-white/60 backdrop-blur-sm p-4 rounded-2xl rounded-tl-none shadow-sm text-[15px] pt-3 text-slate-700 border border-white/50">
                        <p>Olá! Bem-vindo ao Colégio Lumirá. ☀️</p>
                        <p class="mt-2">Sou a assistente virtual da escola. Como posso ajudar você hoje?</p>
                    </div>
                    <span class="text-[10px] text-slate-400 font-medium ml-2">Agora</span>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white/60 backdrop-blur-md border-t border-white/50">
            <form id="chat-form" onsubmit="handleSendMessage(event)"
                class="relative flex items-end gap-2 bg-white rounded-3xl p-1.5 shadow-inner border border-slate-200 focus-within:ring-2 focus-within:ring-lumira-orange/30 focus-within:border-lumira-orange/50 transition-all">
                <textarea id="chat-input" rows="1" placeholder="Digite sua mensagem..."
                    class="w-full py-3 px-4 bg-transparent rounded-2xl text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none resize-none max-h-24 scrollbar-hide border-0"
                    onkeydown="if(event.key === 'Enter' && !event.shiftKey) { event.preventDefault(); this.form.dispatchEvent(new Event('submit', {cancelable: true, bubbles: true})); }"></textarea>
                <button type="submit"
                    class="p-3 rounded-full bg-gradient-to-r from-lumira-orange to-orange-500 text-white hover:shadow-lg hover:scale-105 active:scale-95 transition-all shadow-md disabled:opacity-50 disabled:cursor-not-allowed flex-shrink-0 mb-0.5 mr-0.5"
                    id="send-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </form>
            <div class="text-center mt-3 flex items-center justify-center gap-1.5 opacity-60">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
                        fill="#F59E0B" stroke="#F59E0B" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <p class="text-[10px] text-slate-500 font-medium tracking-wide">Powered by Gemini AI</p>
            </div>
        </div>
    </div>

    <!-- Floating Button (FAB) -->
    <button id="chat-fab" onclick="toggleChat()"
        class="group flex items-center justify-center w-16 h-16 bg-gradient-to-br from-lumira-orange to-orange-600 text-white rounded-full shadow-[0_8px_30px_rgb(249,115,22,0.4)] hover:shadow-[0_8px_40px_rgb(249,115,22,0.6)] hover:scale-110 transition-all duration-300 focus:outline-none z-50 ring-4 ring-white/30 backdrop-blur-sm">
        <!-- Icon Closed -->
        <svg id="icon-closed" class="absolute transition-all duration-300 transform scale-100 group-hover:rotate-12"
            xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
        <!-- Icon Open -->
        <svg id="icon-open" class="absolute transition-all duration-300 transform scale-0 opacity-0 rotate-90"
            xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
</div>

<style>
    /* Custom Scrollbar for Chat */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
    }

    /* Animations */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes bounce-slow {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .animate-bounce-slow {
        animation: bounce-slow 3s infinite ease-in-out;
    }

    .message-enter {
        animation: slideInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .typing-dot {
        animation: typing 1.4s infinite ease-in-out both;
    }

    .typing-dot:nth-child(1) {
        animation-delay: -0.32s;
    }

    .typing-dot:nth-child(2) {
        animation-delay: -0.16s;
    }

    @keyframes typing {

        0%,
        80%,
        100% {
            transform: scale(0);
        }

        40% {
            transform: scale(1);
        }
    }

    #chat-window.open {
        display: flex;
        animation: slideInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    #chat-fab.open #icon-closed {
        transform: scale(0) rotate(-90deg);
        opacity: 0;
    }

    #chat-fab.open #icon-open {
        transform: scale(1) rotate(0);
        opacity: 1;
    }

    #chat-fab.open {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        box-shadow: 0 8px 30px rgba(239, 68, 68, 0.4);
    }
</style>

<script>
    let isChatOpen = false;
    let conversationId = null;
    let threadHistory = [
        { role: 'model', parts: [{ text: "Olá! Bem-vindo ao Colégio Lumirá. ☀️ Sou a assistente virtual da escola. Como posso ajudar você hoje?" }] }
    ];

    function toggleChat() {
        const window = document.getElementById('chat-window');
        const fab = document.getElementById('chat-fab');
        const badge = document.getElementById('chat-badge');

        isChatOpen = !isChatOpen;

        if (isChatOpen) {
            window.classList.remove('hidden');
            window.classList.add('open');
            fab.classList.add('open');
            if (badge) badge.style.display = 'none'; // Hide badge when open
            setTimeout(() => document.getElementById('chat-input').focus(), 300);
        } else {
            window.classList.remove('open');
            window.classList.add('hidden');
            fab.classList.remove('open');
        }
    }

    function closeBadge() {
        const badge = document.getElementById('chat-badge');
        if (badge) badge.remove();
    }

    // Unified function to add message to UI
    function addMessageToUI(text, sender, animate = false) {
        const container = document.getElementById('chat-messages');
        const isUser = sender === 'user';
        const time = new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
        const msgId = 'msg-' + Date.now() + Math.random().toString(36).substr(2, 9); // Context unique ID

        const html = `
            <div class="flex items-end gap-3 ${isUser ? 'flex-row-reverse' : ''} message-enter">
                ${!isUser ? `
                <div class="w-9 h-9 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0 text-lumira-orange text-xs font-bold border border-orange-200 shadow-sm">
                    L
                </div>` : ''}
                
                <div class="flex flex-col gap-1 max-w-[85%] ${isUser ? 'items-end' : ''}">
                    <div id="${msgId}" class="px-5 py-3 rounded-2xl shadow-sm text-[15px] border 
                        ${isUser
                ? 'bg-gradient-to-br from-lumira-orange to-orange-500 text-white rounded-tr-none border-transparent shadow-orange-500/20'
                : 'bg-white/80 backdrop-blur-sm text-slate-700 rounded-tl-none border-white/60'}">
                        ${!animate ? formatText(text) : ''}
                    </div>
                    <span class="text-[10px] text-slate-400 font-medium ${isUser ? 'mr-1' : 'ml-2'} opacity-80">${time}</span>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        scrollToBottom();

        if (animate && !isUser) {
            typeWriter(text, document.getElementById(msgId));
        }
    }

    // wrapper for compatibility with existing calls if I missed any, but better update them.
    // Let's stick to using addMessage as the main function name but internal logic updated? 
    // No, I renamed it in the previous step (initChat call). Let's define the alias or change usages.

    // Changing usages in handleSendMessage:

    async function handleSendMessage(e) {
        e.preventDefault();
        const input = document.getElementById('chat-input');
        const message = input.value.trim();
        if (!message) return;

        // UI Update
        addMessageToUI(message, 'user');
        input.value = '';
        input.style.height = 'auto';

        // Update History & Save
        // We push optimistic user message? Or wait until success? 
        // Better to push immediately for UX, but if failed we might have issues.
        // Let's stick to previous logic: Push to history AFTER success? 
        // No, `handleSendMessage` logic before was: 1. `addMessage` (UI) 2. Fetch 3. `threadHistory.push`.
        // We should add to threadHistory temporarily or just save after success.

        const typingId = showTypingIndicator();

        try {
            const response = await fetch('api/chat_handler.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    message: message,
                    history: threadHistory,
                    conversation_id: conversationId
                })
            });

            const data = await response.json();
            removeMessage(typingId);

            if (data.success) {
                if (data.conversation_id) conversationId = data.conversation_id;

                addMessageToUI(data.response, 'model', true);

                // Update History
                threadHistory.push({ role: 'user', parts: [{ text: message }] });
                threadHistory.push({ role: 'model', parts: [{ text: data.response }] });
            } else {
                addMessageToUI("Desculpe, tive um problema técnico. Tente novamente mais tarde.", 'model');
                console.error('Chat Error:', data.error);
            }

        } catch (error) {
            removeMessage(typingId);
            addMessageToUI("Erro de conexão. Verifique sua internet.", 'model');
            console.error('Fetch Error:', error);
        }
    }

    function typeWriter(text, element) {
        let i = 0;
        const speed = 15; // Faster type speed for modern feel
        element.innerHTML = ''; // Ensure empty

        function type() {
            if (i < text.length) {
                // Check for newlines
                if (text.charAt(i) === '\n') {
                    element.innerHTML += '<br>';
                } else {
                    element.innerHTML += text.charAt(i);
                }

                i++;
                scrollToBottom();
                setTimeout(type, speed + (Math.random() * 10)); // Add slight randomness
            } else {
                // Formatting after typing is done (bold, etc)
                element.innerHTML = formatText(text);
                scrollToBottom();
            }
        }
        type();
    }

    function showTypingIndicator() {
        const container = document.getElementById('chat-messages');
        const id = 'typing-' + Date.now();

        const html = `
            <div id="${id}" class="flex items-end gap-3 message-enter">
                <div class="w-9 h-9 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0 text-lumira-orange text-xs font-bold border border-orange-200">
                    L
                </div>
                <div class="bg-white/60 backdrop-blur-sm px-4 py-3 rounded-2xl rounded-tl-none shadow-sm border border-white/50">
                    <div class="flex gap-1.5">
                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full typing-dot"></div>
                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full typing-dot"></div>
                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full typing-dot"></div>
                    </div>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        scrollToBottom();
        return id;
    }

    function removeMessage(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }

    function scrollToBottom() {
        const container = document.getElementById('chat-messages');
        container.scrollTop = container.scrollHeight;
    }

    function formatText(text) {
        return text
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\n/g, '<br>');
    }

    // Auto resize textarea
    document.getElementById('chat-input').addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
</script>