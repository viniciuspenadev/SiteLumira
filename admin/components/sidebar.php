<?php
// Determine active page for highlighting
$current_uri = $_SERVER['REQUEST_URI'];
$is_chat = strpos($current_uri, 'dashboard.php') !== false;
$is_jobs = strpos($current_uri, 'admin/jobs') !== false;
?>
<!-- Main Navigation Rail -->
<div class="w-20 bg-lumira-dark flex flex-col items-center py-6 shrink-0 z-50">
    <!-- Logo Icon -->
    <div class="mb-8">
        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
            </svg>
        </div>
    </div>

    <!-- Nav Items -->
    <div class="flex-1 w-full space-y-4 px-2">

        <!-- Chat / CRM -->
        <a href="/lumira/admin/dashboard.php"
            class="group flex flex-col items-center justify-center p-3 rounded-xl transition-all <?php echo $is_chat ? 'bg-lumira-blue text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?>"
            title="Atendimento (Chat)">
            <i data-lucide="message-square" class="w-6 h-6 mb-1"></i>
            <span class="text-[10px] font-medium">Chat</span>
        </a>

        <!-- Jobs / Vagas -->
        <a href="/lumira/admin/jobs/index.php"
            class="group flex flex-col items-center justify-center p-3 rounded-xl transition-all <?php echo $is_jobs ? 'bg-lumira-blue text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?>"
            title="Gerenciar Vagas">
            <i data-lucide="briefcase" class="w-6 h-6 mb-1"></i>
            <span class="text-[10px] font-medium">Vagas</span>
        </a>

    </div>

    <!-- Bottom Actions -->
    <div class="mt-auto px-2 w-full space-y-4">
        <a href="/lumira/admin/logout.php"
            class="group flex flex-col items-center justify-center p-3 rounded-xl text-slate-400 hover:bg-red-500/10 hover:text-red-400 transition-all"
            title="Sair">
            <i data-lucide="log-out" class="w-6 h-6"></i>
        </a>
    </div>
</div>

<!-- Add these styles if not present in parent -->
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    lumira: {
                        dark: '#1e293b',
                        blue: '#3b82f6',
                        orange: '#f97316',
                    }
                }
            }
        }
    }
</script>