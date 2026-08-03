<?php
$meta_base_url = $base_url ?? '/';

if (!isset($base_url)) {
    $meta_host = $_SERVER['HTTP_HOST'] ?? '';

    if (strpos($meta_host, 'localhost') !== false || strpos($meta_host, '127.0.0.1') !== false) {
        $meta_base_url = '/lumira/';
    }
}

$style_version = file_exists(__DIR__ . '/../assets/css/style.css')
    ? filemtime(__DIR__ . '/../assets/css/style.css')
    : '1';
?>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>

<!-- Tailwind CSS (Compiled) -->
<link rel="stylesheet" href="<?php echo htmlspecialchars($meta_base_url, ENT_QUOTES, 'UTF-8'); ?>assets/css/style.css?v=<?php echo urlencode((string) $style_version); ?>">

<style>
    /* 
       Expertise Dev: Tipografia Fluida 
       Garante que os títulos escalem suavemente entre mobile e desktop 1366px+
    */
    .text-fluid-h1 {
        font-size: clamp(2.25rem, 5vw + 1rem, 4.5rem);
        line-height: 1.1;
    }

    .text-fluid-h2 {
        font-size: clamp(1.875rem, 4vw + 0.5rem, 3rem);
        line-height: 1.2;
    }

    /* Smooth scrolling for anchor links */
    html {
        scroll-behavior: smooth;
    }

    .fade-enter {
        opacity: 0;
    }

    .fade-enter-active {
        opacity: 1;
        transition: opacity 1000ms ease-in-out;
    }

    .fade-exit {
        opacity: 1;
    }

    .fade-exit-active {
        opacity: 0;
        transition: opacity 1000ms ease-in-out;
    }

    /* Additional Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 40px, 0);
        }

        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .blob-shape-1 {
        border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
    }

    .blob-shape-2 {
        border-radius: 53% 47% 52% 48% / 36% 41% 59% 64%;
    }
</style>
