<?php
// Load data
include 'includes/constants.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <!-- SEO -->
  <title>Colégio Lumirá - Berçário e Educação Infantil na Vila Augusta, Guarulhos</title>
  <meta name="description"
    content="O Colégio Lumirá é referência em Educação Infantil em Guarulhos, na Vila Augusta. Proposta pedagógica afetiva, bilíngue e inovadora. Agende sua visita!" />
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.colegiolumira.com/" />
  <meta property="og:title" content="Colégio Lumirá - Berçário e Educação Infantil na Vila Augusta, Guarulhos" />
  <meta property="og:description" content="O Colégio Lumirá é referência em Educação Infantil em Guarulhos, na Vila Augusta. Proposta pedagógica afetiva, bilíngue e inovadora. Agende sua visita!" />
  <meta property="og:image" content="https://www.colegiolumira.com/assets/logo_og.png" />

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image" />
  <meta property="twitter:url" content="https://www.colegiolumira.com/" />
  <meta property="twitter:title" content="Colégio Lumirá - Berçário e Educação Infantil na Vila Augusta, Guarulhos" />
  <meta property="twitter:description" content="O Colégio Lumirá é referência em Educação Infantil em Guarulhos, na Vila Augusta. Proposta pedagógica afetiva, bilíngue e inovadora. Agende sua visita!" />
  <meta property="twitter:image" content="https://www.colegiolumira.com/assets/logo_og.png" />

  <!-- Schema.org JSON-LD -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "School",
      "name": "Colégio Lumirá",
      "image": "https://images.unsplash.com/photo-1503676260728-1c00da094a0b",
      "description": "Escola de Educação Infantil e Berçário na Vila Augusta, Guarulhos, com pedagogia afetiva e inovadora.",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "R. Eng. Alexandre Machado, 208 - Vila Augusta",
        "addressLocality": "Guarulhos",
        "addressRegion": "SP",
        "postalCode": "07040-040",
        "addressCountry": "BR"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": -23.4705,
        "longitude": -46.5418
      },
      "url": "https://www.colegiolumira.com",
      "telephone": "+5511934921031",
      "priceRange": "$$$",
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday"
          ],
          "opens": "07:00",
          "closes": "19:00"
        }
      ]
    }
    </script>

  <!-- Common Assets -->
  <?php include 'includes/meta.php'; ?>
</head>

<body class="bg-gray-50 text-slate-700 antialiased selection:bg-lumira-orange selection:text-white">

  <?php
  // Header
  include 'includes/header.php';
  ?>

  <main>
    <?php
    // Load components in order
    include 'components/marketing_modal.php';
    include 'components/hero.php';
    include 'components/about.php';
    include 'components/methodology.php';
    include 'components/school_life.php';
    include 'components/classes.php';
    // include 'components/gallery.php';
    include 'components/faq.php';
    include 'components/contact.php';
    ?>
  </main>

  <?php include 'components/cookie_consent.php'; ?>
  <?php include 'includes/footer.php'; ?>
  <?php include 'components/chat_widget.php'; ?>
</body>

</html>