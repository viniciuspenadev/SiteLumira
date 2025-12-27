<?php
$FEATURES = [
    [
        'title' => 'Pedagogia Afetiva',
        'description' => 'Acreditamos que o vínculo emocional é a base para um aprendizado significativo e duradouro.',
        'icon' => 'heart',
    ],
    [
        'title' => 'Natureza Viva',
        'description' => 'Amplas áreas verdes onde as crianças exploram, descobrem e respeitam o meio ambiente.',
        'icon' => 'sprout',
    ],
    [
        'title' => 'Segurança Total',
        'description' => 'Ambiente monitorado e seguro, com controle de acesso rigoroso para a tranquilidade da sua família.',
        'icon' => 'shield-check',
    ],
    [
        'title' => 'Família na Escola',
        'description' => 'Uma comunidade acolhedora onde pais e educadores constroem juntos o caminho da educação.',
        'icon' => 'users',
    ],
];

$SCHOOL_ACTIVITIES = [
    [
        'id' => 'nutrition',
        'title' => 'Nutrição Consciente',
        'description' => 'Nossa cozinha é o coração da escola. Com cardápio elaborado por nutricionistas, ensinamos a importância dos alimentos reais.',
        'icon' => 'apple',
        'image' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=1200&auto=format&fit=crop',
        'color' => 'text-green-500',
        'benefits' => ['Cardápio sem açúcar', 'Introdução alimentar assistida', 'Oficinas culinárias'],
        'floatingCard' => ['title' => 'Hoje no Almoço', 'text' => 'Risoto de abóbora e franguinho 🥣']
    ],
    [
        'id' => 'garden',
        'title' => 'Horta Pedagógica',
        'description' => 'Acreditamos que sujar as mãos de terra é essencial. As crianças plantam, cuidam e colhem, entendendo os ciclos da natureza.',
        'icon' => 'sprout',
        'image' => 'https://images.unsplash.com/photo-1592419044706-39796d40f98c?q=80&w=1200&auto=format&fit=crop',
        'color' => 'text-lumira-orange',
        'benefits' => ['Educação ambiental', 'Responsabilidade e cuidado', 'Consumo do que se planta'],
        'floatingCard' => ['title' => 'Colheita da Semana', 'text' => 'Cenouras e Tomatinhos 🥕🍅']
    ],
    [
        'id' => 'english',
        'title' => 'Inglês Lúdico',
        'description' => 'O segundo idioma é introduzido naturalmente através de músicas, brincadeiras e contação de histórias, sem pressão.',
        'icon' => 'globe',
        'image' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=1200&auto=format&fit=crop',
        'color' => 'text-blue-500',
        'benefits' => ['Imersão diária', 'Storytelling', 'Músicas e Rimas'],
        'floatingCard' => ['title' => 'Palavra do Dia', 'text' => 'Butterfly (Borboleta) 🦋']
    ],
    [
        'id' => 'arts',
        'title' => 'Ateliê de Artes',
        'description' => 'Um espaço livre para criar, pintar e expressar sentimentos. Aqui a parede não é limite, é tela.',
        'icon' => 'palette',
        'image' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=1200&auto=format&fit=crop',
        'color' => 'text-purple-500',
        'benefits' => ['Exploração de texturas', 'Coordenação motora fina', 'Liberdade criativa'],
        'floatingCard' => ['title' => 'Exposição', 'text' => 'Pintura com os dedos 🎨']
    ]
];

$CLASSES = [
    [
        'title' => "Berçário",
        'age' => "4 meses a 2 anos",
        'description' => "Um ambiente de puro acolhimento e estímulos sensoriais seguros para os primeiros passos.",
        'image' => "assets/images/IMG_3428.jpg",
        'features' => ["Estímulo Sensorial", "Solário Privativo", "Nutrição Especializada"]
    ],
    [
        'title' => "Maternal",
        'age' => "2 a 4 anos",
        'description' => "A fase da descoberta, da autonomia e das primeiras amizades, com muita ludicidade.",
        'image' => "assets/images/IMG_7928.jpg",
        'features' => ["Artes & Pintura", "Iniciação Musical", "Horta Pedagógica"]
    ],
    [
        'title' => "Pré-Escola",
        'age' => "4 a 6 anos",
        'description' => "Preparação para o mundo letrado com projetos investigativos e tecnologia criativa.",
        'image' => "assets/images/IMG_1351.jpg",
        'features' => ["Letramento", "Robótica Kids", "Inglês Diário"]
    ]
];

$GALLERY_ITEMS = [
    [
        'id' => '1',
        'src' => 'https://images.unsplash.com/photo-1503919545885-7f4941199547?q=80&w=800&auto=format&fit=crop',
        'category' => 'dia-a-dia',
        'caption' => 'Explorando o parque sensorial',
        'size' => 'large'
    ],
    [
        'id' => '2',
        'src' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=800&auto=format&fit=crop',
        'category' => 'dia-a-dia',
        'caption' => 'Aula de artes ao ar livre',
        'size' => 'normal'
    ],
    [
        'id' => '3',
        'src' => 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?q=80&w=800&auto=format&fit=crop',
        'category' => 'estrutura',
        'caption' => 'Nossa horta pedagógica',
        'size' => 'tall'
    ],
    [
        'id' => '4',
        'src' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=800&auto=format&fit=crop',
        'category' => 'dia-a-dia',
        'caption' => 'Hora da história e imaginação',
        'size' => 'wide'
    ],
    [
        'id' => '5',
        'src' => 'https://images.unsplash.com/photo-1560785496-7c97d3c27329?q=80&w=800&auto=format&fit=crop',
        'category' => 'eventos',
        'caption' => 'Festa da Família 2024',
        'size' => 'normal'
    ],
    [
        'id' => '6',
        'src' => 'https://images.unsplash.com/photo-1596464716127-f9a82763ef5c?q=80&w=800&auto=format&fit=crop',
        'category' => 'estrutura',
        'caption' => 'Biblioteca interativa',
        'size' => 'large'
    ],
    [
        'id' => '7',
        'src' => 'https://images.unsplash.com/photo-1519331379826-f95209603306?q=80&w=800&auto=format&fit=crop',
        'category' => 'dia-a-dia',
        'caption' => 'Brincadeira livre no pátio',
        'size' => 'normal'
    ]
];

$FAQS = [
    [
        'question' => "Como funciona o período de adaptação?",
        'answer' => "A adaptação é feita de forma gradual e respeitosa, onde a permanência da criança aumenta aos poucos. Os pais são bem-vindos para acompanhar nos primeiros dias, garantindo segurança emocional."
    ],
    [
        'question' => "Qual o horário de funcionamento?",
        'answer' => "Funcionamos das 07h00 às 19h00, com opções de período Regular (5h), Semi-integral (8h) e Integral (12h), para atender a rotina de cada família."
    ],
    [
        'question' => "Como é a alimentação na escola?",
        'answer' => "Nossa alimentação é 100% natural, preparada na escola e acompanhada por nutricionista. Não utilizamos açúcar ou ultraprocessados, priorizando frutas, verduras e integrais."
    ],
    [
        'question' => "A partir de qual idade vocês aceitam?",
        'answer' => "Aceitamos bebês a partir de 4 meses no nosso Berçário, com turmas segmentadas até a Pré-Escola (5 anos)."
    ]
];

$CAROUSEL_IMAGES = [
    [
        'url' => 'assets/images/hero_01.jpg',
        'alt' => 'Crianças brincando ao ar livre',
        'caption' => 'Aprender Brincando',
        'subcaption' => 'Um espaço seguro para a imaginação florescer.'
    ],
    [
        'url' => 'assets/images/IMG_1316.jpg',
        'alt' => 'Sala de aula moderna',
        'caption' => 'Educação do Futuro',
        'subcaption' => 'Tecnologia e afeto caminhando juntos.'
    ],
    [
        'url' => 'assets/images/IMG_1344.jpg',
        'alt' => 'Atividade em grupo',
        'caption' => 'Socioemocional',
        'subcaption' => 'Formando cidadãos conscientes e empáticos.'
    ]
];
?>