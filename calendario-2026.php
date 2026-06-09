<?php
include 'includes/constants.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Calendário Letivo 2026 - Colégio Lumirá</title>
    <meta name="description" content="Calendário letivo do ano de 2026 do Colégio Lumirá.">
    <?php include 'includes/meta.php'; ?>
    <style>
        :root {
            --lumira-blue: #5C8D9D;
            --lumira-orange: #F59E3F;
            --lumira-dark: #35525E;
        }

        /* Web Layout */
        .month-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            border: 1px solid #f1f5f9;
        }

        .month-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .text-lumira-blue {
            color: var(--lumira-blue);
        }

        .bg-lumira-blue {
            background-color: var(--lumira-blue);
        }

        .text-lumira-orange {
            color: var(--lumira-orange);
        }

        .bg-lumira-orange {
            background-color: var(--lumira-orange);
        }

        .header-gradient {
            background: linear-gradient(135deg, var(--lumira-blue) 0%, var(--lumira-dark) 100%);
        }

        .event-item {
            position: relative;
            padding-left: 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.4rem;
        }

        .event-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.5rem;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: var(--lumira-orange);
            -webkit-print-color-adjust: exact;
        }

        .event-date {
            font-weight: 700;
            color: var(--lumira-dark);
            min-width: 48px;
            flex-shrink: 0;
            display: inline-block;
        }

        .event-desc {
            flex: 1;
        }

        .download-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 100;
            background-color: var(--lumira-orange);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 9999px;
            font-weight: 700;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            border: none;
        }

        .download-btn:hover {
            transform: scale(1.05) translateY(-2px);
            background-color: #e68d2f;
        }

        /* Print Specifics - Ultra Compact & Clean */
        @media print {
            @page {
                margin: 0;
                /* Removes browser headers/footers (date, URL) */
                size: A4 portrait;
            }

            body {
                background-color: white !important;
                padding: 1.5cm !important;
                /* Internal margin for printer clearance */
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                font-size: 10pt !important;
            }

            .no-print {
                display: none !important;
            }

            .container {
                max-width: none !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            header {
                padding-top: 0 !important;
                padding-bottom: 1rem !important;
                margin-bottom: 1.5rem !important;
                border-radius: 1rem !important;
            }

            header h1 {
                font-size: 24pt !important;
            }

            header p {
                font-size: 11pt !important;
            }

            header img {
                height: 60px !important;
            }

            .grid {
                display: grid !important;
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 0.75rem !important;
            }

            .month-card {
                padding: 0.75rem !important;
                border-radius: 0.75rem !important;
                border: 1px solid #e2e8f0 !important;
                box-shadow: none !important;
                height: auto !important;
                break-inside: avoid !important;
            }

            .month-card h2 {
                font-size: 14pt !important;
                margin-bottom: 0.5rem !important;
            }

            .month-card span {
                font-size: 8pt !important;
                padding: 0.2rem 0.5rem !important;
            }

            .event-item {
                margin-bottom: 0.25rem !important;
            }

            .event-item::before {
                top: 0.4rem !important;
                width: 6px !important;
                height: 6px !important;
            }

            .event-date {
                font-size: 9pt !important;
                min-width: 44px !important;
            }

            .month-card .space-y-3>*+* {
                margin-top: 0.25rem !important;
            }

            .mt-12 {
                margin-top: 1.5rem !important;
                padding: 1rem !important;
                border-radius: 1rem !important;
            }

            .mt-12 i {
                width: 1.5rem !important;
                height: 1.5rem !important;
            }

            .mt-12 h3 {
                font-size: 12pt !important;
            }

            .mt-12 p {
                font-size: 10pt !important;
            }
        }
    </style>
</head>

<body class="bg-slate-50 font-sans text-slate-800 antialiased">

    <!-- FAB Download Button -->
    <button onclick="window.print()" class="download-btn group no-print">
        <i data-lucide="download" class="w-5 h-5 transition-transform group-hover:translate-y-0.5"></i>
        <span>Baixar PDF</span>
    </button>

    <!-- Header Section -->
    <header class="header-gradient text-white py-12 mb-12 shadow-lg">
        <div class="container mx-auto px-4 text-center">
            <div class="mb-6 flex justify-center">
                <img src="assets/images/logo_white.png" alt="Colégio Lumirá" class="h-24 w-auto drop-shadow-md">
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-2 tracking-tight">Calendário Letivo 2026</h1>
            <p class="text-white/80 text-lg">Organização e planejamento para um ano de muito aprendizado</p>
        </div>
    </header>

    <main class="container mx-auto px-4 pb-20">

        <!-- Mesh Gradient Background Decoration (Hidden on print) -->
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none opacity-20 no-print">
            <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-lumira-blue rounded-full blur-[100px]"></div>
            <div class="absolute top-[60%] -right-[10%] w-[35%] h-[35%] bg-lumira-orange rounded-full blur-[100px]">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-6 lg:gap-8">

            <!-- Janeiro -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Janeiro</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">05
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">01 a 13</span> <span class="event-desc">Período de
                            férias</span></div>
                    <div class="event-item"><span class="event-date">14 a 16</span> <span
                            class="event-desc">Planejamento e treinamento</span></div>
                    <div class="event-item"><span class="event-date">19</span> <span class="event-desc">Início das aulas
                            do Integral</span></div>
                    <div class="event-item"><span class="event-date">26</span> <span class="event-desc">Início das aulas
                            ½ período</span></div>
                </div>
            </div>

            <!-- Fevereiro -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Fevereiro</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">17
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">13</span> <span class="event-desc">Folia do Lumirá
                            (Traje: Fantasia)</span></div>
                    <div class="event-item"><span class="event-date">16 a 18</span> <span class="event-desc">Recesso
                            Carnaval</span></div>
                </div>
            </div>

            <!-- Março -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Março</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">22
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">08</span> <span class="event-desc">Dia
                            Internacional da Mulher</span></div>
                    <div class="event-item"><span class="event-date">20</span> <span class="event-desc">Início
                            Outono</span></div>
                    <div class="event-item"><span class="event-date">23</span> <span class="event-desc">Comemoração dia
                            da água</span></div>
                    <div class="event-item"><span class="event-date">27</span> <span class="event-desc">Dia do Circo
                            (Traje palhaço)</span></div>
                </div>
            </div>

            <!-- Abril -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Abril</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">19
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">02</span> <span class="event-desc">Festa de
                            Páscoa</span></div>
                    <div class="event-item"><span class="event-date">03</span> <span class="event-desc">Feriado
                            (Sexta-feira Santa)</span></div>
                    <div class="event-item"><span class="event-date">19</span> <span class="event-desc">Dia do
                            Indígena</span></div>
                    <div class="event-item"><span class="event-date">20</span> <span class="event-desc">Recesso do
                            feriado</span></div>
                    <div class="event-item"><span class="event-date">21</span> <span class="event-desc">Feriado
                            Tiradentes</span></div>
                    <div class="event-item"><span class="event-date">22</span> <span class="event-desc">Início do 2º
                            Bimestre</span></div>
                    <div class="event-item"><span class="event-date">30</span> <span class="event-desc">Dia do Trabalho
                            (atividade lúdica)</span></div>
                </div>
            </div>

            <!-- Maio -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Maio</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">20
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">01</span> <span class="event-desc">Feriado (Dia do
                            Trabalho)</span></div>
                </div>
            </div>

            <!-- Junho -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Junho</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">20
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">04</span> <span class="event-desc">Feriado (Corpus
                            Christi)</span></div>
                    <div class="event-item"><span class="event-date">08</span> <span class="event-desc">Comemoração do
                            dia do meio ambiente (Não haverá aula)</span></div>
                    <div class="event-item"><span class="event-date">21</span> <span class="event-desc">Início do
                            Inverno</span></div>
                </div>
            </div>

            <!-- Julho -->
            <div class="month-card bg-slate-50 border-dashed border-lumira-blue/30">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Julho</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">03
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">06 a 10</span> <span class="event-desc">Recesso
                            (Escola fechada)</span></div>
                    <div class="event-item"><span class="event-date">13 a 31</span> <span class="event-desc">Curso de
                            férias (08h às 17h)</span></div>
                </div>
            </div>

            <!-- Agosto -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Agosto</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">21
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">03</span> <span class="event-desc">Volta às aulas -
                            Início 3º Bimestre</span></div>
                    <div class="event-item"><span class="event-date">21</span> <span class="event-desc">Comemoração do
                            Folclore</span></div>
                    <div class="event-item"><span class="event-date">24</span> <span class="event-desc">Comemoração do
                            Dia do Soldado</span></div>
                </div>
            </div>

            <!-- Setembro -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Setembro</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">22
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">04</span> <span class="event-desc">Dia da
                            Independência</span></div>
                    <div class="event-item"><span class="event-date">07</span> <span class="event-desc">Feriado Dia da
                            Independência (Não haverá aula)</span></div>
                    <div class="event-item"><span class="event-date">12</span> <span class="event-desc">Festa Família
                            (Sábado)</span></div>
                    <div class="event-item"><span class="event-date">21</span> <span class="event-desc">Comemoração do
                            Dia da Árvore</span></div>
                    <div class="event-item"><span class="event-date">22</span> <span class="event-desc">Início da
                            Primavera</span></div>
                </div>
            </div>

            <!-- Outubro -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Outubro</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">20
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">07</span> <span class="event-desc">Início do 4º
                            Bimestre</span></div>
                    <div class="event-item"><span class="event-date">05 a 09</span> <span class="event-desc">Semana da
                            Criança</span></div>
                    <div class="event-item"><span class="event-date">12</span> <span class="event-desc">Feriado Dia das
                            Crianças (Não haverá aula)</span></div>
                    <div class="event-item"><span class="event-date">13</span> <span class="event-desc">Antecipação Dia
                            dos Professores (Não haverá aula)</span></div>
                    <div class="event-item"><span class="event-date">30</span> <span class="event-desc">Festa Floresta
                            Encantada</span></div>
                </div>
            </div>

            <!-- Novembro -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Novembro</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">20
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">02</span> <span class="event-desc">Feriado
                            Finados</span></div>
                    <div class="event-item"><span class="event-date">15</span> <span class="event-desc">Feriado
                            Proclamação da República</span></div>
                    <div class="event-item"><span class="event-date">20</span> <span class="event-desc">Feriado
                            Consciência Negra</span></div>
                </div>
            </div>

            <!-- Dezembro -->
            <div class="month-card">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-lumira-blue">Dezembro</h2>
                    <span class="bg-lumira-blue/10 text-lumira-blue px-3 py-1 rounded-full text-sm font-semibold">12
                        dias letivos</span>
                </div>
                <div class="space-y-3 text-slate-600">
                    <div class="event-item"><span class="event-date">07</span> <span class="event-desc">Recesso
                            (Segunda-feira) (Não haverá aula)</span></div>
                    <div class="event-item"><span class="event-date">08</span> <span class="event-desc">Feriado
                            Guarulhos (Não haverá aula)</span></div>
                    <div class="event-item"><span class="event-date">19</span> <span
                            class="event-desc">Confraternização, Natal e Formatura</span></div>
                    <div class="event-item"><span class="event-date">21</span> <span class="event-desc">Início do
                            Recesso (Férias)</span></div>
                </div>
            </div>

        </div>

        <!-- Extra Note -->
        <div
            class="mt-12 p-8 bg-white rounded-3xl border-2 border-lumira-orange/20 shadow-xl overflow-hidden relative break-inside-avoid">
            <div class="absolute top-0 right-0 w-32 h-32 bg-lumira-orange/10 rounded-bl-full -mr-8 -mt-8 no-print">
            </div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="bg-lumira-orange p-3 rounded-2xl text-white shadow-lg">
                    <i data-lucide="info" class="w-8 h-8"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-800">Observação importante</h3>
                    <p class="text-slate-600"> A <b>Festa Julina Arraiá Lumirá (Externa)</b> terá a data informada
                        posteriormente.</p>
                </div>
            </div>
        </div>

    </main>

    <script>
        lucide.createIcons();

        window.onbeforeprint = function () {
            document.title = "Calendario_Letivo_2026_Colegio_Lumira";
        };
        window.onafterprint = function () {
            document.title = "Calendário Letivo 2026 - Colégio Lumirá";
        };
    </script>
</body>

</html>