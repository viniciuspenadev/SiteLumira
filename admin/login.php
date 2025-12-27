<?php
session_start();
// If already logged in via PHP session (which we will sync from cookie), redirect
if (isset($_COOKIE['sb_access_token'])) {
    header('Location: dashboard.php');
    exit;
}
$secrets = include '../includes/secrets.php';
$sbUrl = $secrets['SUPABASE_URL'];
$sbKey = $secrets['SUPABASE_KEY'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Lumirá</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-sm">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Acesso Restrito</h1>
            <p class="text-slate-500 text-sm">Painel de Atendimento</p>
        </div>

        <div id="error-msg" class="hidden bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-sm text-center"></div>

        <form id="login-form" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" id="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 outline-none transition"
                    placeholder="admin@lumira.com">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Senha</label>
                <input type="password" id="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 outline-none transition"
                    placeholder="••••••••">
            </div>
            <button type="submit" id="btn-submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-lg transition-colors flex justify-center">
                Entrar
            </button>
        </form>
        <div class="mt-4 text-center">
            <p class="text-xs text-slate-400">Protegido por Supabase Auth</p>
        </div>
    </div>

    <script>
        const supabaseUrl = '<?= $sbUrl ?>';
        const supabaseKey = '<?= $sbKey ?>';
        const sbClient = window.supabase.createClient(supabaseUrl, supabaseKey);

        document.getElementById('login-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const btn = document.getElementById('btn-submit');
            const errorDiv = document.getElementById('error-msg');

            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
            errorDiv.classList.add('hidden');

            const { data, error } = await sbClient.auth.signInWithPassword({
                email: email,
                password: password,
            });

            if (error) {
                errorDiv.innerText = "Erro: " + error.message;
                errorDiv.classList.remove('hidden');
                btn.disabled = false;
                btn.innerText = 'Entrar';
            } else {
                // Login successful. Save token to cookie securely.
                // Expires in 1 hour (3600s)
                document.cookie = `sb_access_token=${data.session.access_token}; path=/; max-age=3600; SameSite=Strict`;
                document.cookie = `sb_refresh_token=${data.session.refresh_token}; path=/; max-age=3600; SameSite=Strict`;

                window.location.href = 'dashboard.php';
            }
        });
    </script>
</body>

</html>