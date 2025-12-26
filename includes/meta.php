<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Nunito', 'sans-serif'],
                },
                colors: {
                    lumira: {
                        blue: '#5C8D9D', // Muted Teal from Logo
                        orange: '#F59E3F', // Warm Orange from Logo
                        dark: '#35525E',
                        light: '#EBF4F7',
                    }
                }
            }
        }
    }
</script>

<style>
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
</style>