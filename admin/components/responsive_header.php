<?php
// Determine page title and back button
$page_title = 'Admin Lumirá';
$show_back = false;
$back_url = '';

if (isset($custom_header_title)) {
    $page_title = $custom_header_title;
}

if (isset($custom_header_back_url)) {
    $show_back = true;
    $back_url = $custom_header_back_url;
}
?>

<!-- Mobile Header (Hidden on Desktop) -->
<header class="mobile-header md:hidden safe-area-top">
    <div class="mobile-header-content">

        <?php if ($show_back): ?>
            <!-- Back Button -->
            <a href="<?php echo htmlspecialchars($back_url); ?>" class="mobile-header-back touch-target">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
        <?php else: ?>
            <!-- Logo/Brand -->
            <div class="flex items-center gap-2">
                <div
                    class="w-8 h-8 bg-gradient-to-br from-lumira-blue to-lumira-orange rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </div>
            </div>
        <?php endif; ?>

        <!-- Page Title -->
        <h1 class="mobile-header-title flex-1 text-center">
            <?php echo htmlspecialchars($page_title); ?>
        </h1>

        <!-- Right Action (placeholder for future notifications/menu) -->
        <div class="w-10"></div> <!-- Spacer for centering -->

    </div>
</header>