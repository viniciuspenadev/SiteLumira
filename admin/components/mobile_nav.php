<?php
// Get current page for active state
$current_uri = $_SERVER['REQUEST_URI'];
$is_dashboard = strpos($current_uri, 'dashboard') !== false;
$is_jobs = strpos($current_uri, 'jobs') !== false;

// Base path logic
$base_admin = '/admin/';
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false) {
    $base_admin = '/lumira/admin/';
}
?>

<!-- Mobile Bottom Navigation (Hidden on Desktop) -->
<nav class="mobile-bottom-nav md:hidden">
    <div class="mobile-bottom-nav-container safe-area-bottom">

        <!-- Dashboard/Chat -->
        <a href="<?php echo $base_admin; ?>dashboard"
            class="mobile-bottom-nav-item <?php echo $is_dashboard ? 'active' : ''; ?>">
            <svg class="mobile-bottom-nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <span>Chat</span>
        </a>

        <!-- Jobs/Vagas -->
        <a href="<?php echo $base_admin; ?>jobs/"
            class="mobile-bottom-nav-item <?php echo $is_jobs ? 'active' : ''; ?>">
            <svg class="mobile-bottom-nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
            </svg>
            <span>Vagas</span>
        </a>

        <!-- Logout -->
        <a href="<?php echo $base_admin; ?>logout" class="mobile-bottom-nav-item"
            onclick="return confirm('Deseja realmente sair?');">
            <svg class="mobile-bottom-nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            <span>Sair</span>
        </a>

    </div>
</nav>

<style>
    /* Ensure body has bottom padding to not be hidden by fixed nav */
    body {
        padding-bottom: 5rem;
        /* 4rem nav + 1rem spacing */
    }

    @media (min-width: 768px) {
        body {
            padding-bottom: 0;
            /* Remove on tablet/desktop */
        }
    }
</style>