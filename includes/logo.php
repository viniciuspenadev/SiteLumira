<?php
// Default props
$className = $className ?? "h-12";
?>
<div class="relative <?php echo $className; ?> select-none logo-container">
    <!-- White Logo (Visible on Transparent Header) -->
    <img src="assets/images/logo_white.png" alt="Colégio Lumirá"
        class="logo-white relative z-10 h-full w-auto object-contain transition-opacity duration-300" />

    <!-- Original Logo (Visible on White Header) -->
    <img src="assets/images/logo_original.png" alt="Colégio Lumirá"
        class="logo-original absolute top-0 left-0 z-20 h-full w-auto object-contain transition-opacity duration-300 opacity-0" />
</div>