<?php
// Function to check if cookies are accepted
$cookiesAccepted = isset($_COOKIE['cookies_accepted']) ? $_COOKIE['cookies_accepted'] : false;
?>

<div id="cookie-banner"
    class="<?php echo $cookiesAccepted ? 'hidden' : ''; ?> fixed bottom-0 left-0 right-0 bg-white shadow-[0_-4px_20px_rgba(0,0,0,0.1)] z-50 p-6 transform transition-transform duration-500 ease-in-out translate-y-full has-cookie-check">
    <div class="container mx-auto max-w-6xl">
        <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">

            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-lumira-orange/10 p-2 rounded-lg">
                        <i data-lucide="cookie" class="w-6 h-6 text-lumira-orange"></i>
                    </div>
                    <h3 class="font-bold text-lumira-dark text-lg">Respeitamos sua Privacidade</h3>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Utilizamos cookies para personalizar sua experiência e analisar nosso tráfego.
                    Ao clicar em "Aceitar Todos", você concorda com nossa
                    <a href="politica-de-privacidade.php" class="text-lumira-blue font-bold hover:underline">Política de
                        Privacidade</a>.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                <button id="btn-reject-cookies"
                    class="px-6 py-3 rounded-xl border-2 border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-colors">
                    Rejeitar
                </button>
                <button id="btn-accept-cookies"
                    class="px-8 py-3 rounded-xl bg-lumira-blue text-white font-bold hover:bg-lumira-dark shadow-lg hover:shadow-xl transition-all">
                    Aceitar Todos
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const banner = document.getElementById('cookie-banner');

        // Check if banner should show (slight delay for better UX)
        if (!banner.classList.contains('hidden')) {
            setTimeout(() => {
                banner.classList.remove('translate-y-full');
            }, 1000);
        }

        // Accept Action
        document.getElementById('btn-accept-cookies').addEventListener('click', () => {
            setCookie('cookies_accepted', 'true', 365);
            hideBanner();
        });

        // Reject Action (still sets a cookie to remember choice, but indicates rejection)
        document.getElementById('btn-reject-cookies').addEventListener('click', () => {
            setCookie('cookies_accepted', 'false', 365);
            hideBanner();
        });

        function hideBanner() {
            banner.classList.add('translate-y-full');
            setTimeout(() => {
                banner.classList.add('hidden');
            }, 500);
        }

        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }
    });
</script>