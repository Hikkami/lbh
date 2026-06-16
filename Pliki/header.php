<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $metaDescription ?? 'Międzynarodowe Stowarzyszenie Ciągarskie w Polsce - The Wire Association International, Poland Chapter. Działamy na rzecz rozwoju polskiego przemysłu.'; ?>">
    <meta name="keywords" content="WAI, WAI Poland Chapter, Stowarzyszenie Ciągarskie, przemysł metalowy, ciągarstwo, drut, kable, Wire Association International">
    <meta name="author" content="WAI Poland Chapter">
    <meta name="robots" content="<?php echo $metaRobots ?? 'index, follow'; ?>">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $pageTitle ?? 'WAI Poland Chapter - Międzynarodowe Stowarzyszenie Ciągarskie w Polsce'; ?>">
    <meta property="og:description" content="Platforma wymiany wiedzy i doświadczeń dla specjalistów z branży metalowej, ciągarskiej i kablowej. Dołącz do nas!">
    <meta property="og:image" content="logo.png">
    <meta property="og:url" content="https://wai-poland.org">
    
    <title><?php echo $pageTitle ?? 'WAI Poland Chapter - Międzynarodowe Stowarzyszenie Ciągarskie w Polsce'; ?></title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f3f4f6; 
            color: #1f2937; 
            scroll-behavior: smooth; 
        }
        /* Style poprawiające widoczność formatowania z edytora bogatego tekstu */
        .rich-text ul { list-style-type: disc !important; padding-left: 1.5rem !important; margin-bottom: 1rem !important; }
        .rich-text ol { list-style-type: decimal !important; padding-left: 1.5rem !important; margin-bottom: 1rem !important; }
        .rich-text p { margin-bottom: 1rem !important; }
        .rich-text h1, .rich-text h2, .rich-text h3 { font-weight: bold !important; margin-bottom: 0.5rem !important; margin-top: 1rem !important; }
        .rich-text h1 { font-size: 1.5rem !important; }
        .rich-text h2 { font-size: 1.25rem !important; }
        .rich-text h3 { font-size: 1.1rem !important; }
        .rich-text a { color: #2563eb !important; text-decoration: underline !important; }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col relative">
        <header class="bg-white shadow-sm sticky top-0 z-40">
            <div class="bg-blue-800 text-white py-1">
                <div class="max-w-7xl mx-auto px-4 flex justify-end text-sm space-x-6">
                    <a href="mailto:wai.poland@gmail.com" class="hover:text-blue-200 transition"><i class="fas fa-envelope mr-2"></i> wai.poland@gmail.com</a>
                    <span class="hidden sm:inline"><i class="fas fa-globe mr-2"></i> wai-poland.org</span>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <a href="index.php" class="flex items-center space-x-3">
                    <img src="logo.png" alt="WAI Poland Chapter Logo" class="h-12 md:h-16 w-auto object-contain" />
                </a>

                <div class="md:hidden">
                    <button id="mobile-menu-btn" aria-label="Otwórz menu" class="text-gray-600 hover:text-blue-600 focus:outline-none p-2">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>

                <?php
                $activePage = basename($_SERVER['PHP_SELF']);
                function navClass($page, $activePage) {
                    $base = "px-4 py-2 font-medium transition-colors border-b-2 ";
                    if ($activePage === $page) {
                        return $base . "border-blue-600 text-blue-700";
                    }
                    return $base . "border-transparent text-gray-600 hover:text-blue-600 hover:border-blue-300";
                }
                ?>

                <nav class="hidden md:flex space-x-2" aria-label="Główna nawigacja">
                    <a href="index.php" class="<?php echo navClass('index.php', $activePage); ?>">Aktualności</a>
                    <a href="o-nas.php" class="<?php echo navClass('o-nas.php', $activePage); ?>">O nas & Zarząd</a>
                    <a href="statut.php" class="<?php echo navClass('statut.php', $activePage); ?>">Statut</a>
                    <a href="galeria.php" class="<?php echo navClass('galeria.php', $activePage); ?>">Galeria</a>
                    <a href="dolacz.php" class="<?php echo navClass('dolacz.php', $activePage); ?>">Dołącz do nas</a>
                </nav>
            </div>
            
            <div id="mobile-menu" class="hidden md:hidden bg-gray-50 border-t border-gray-200 absolute w-full shadow-lg">
                <nav class="flex flex-col px-4 py-2">
                    <a href="index.php" class="py-3 border-b text-gray-700 hover:text-blue-600">Aktualności</a>
                    <a href="o-nas.php" class="py-3 border-b text-gray-700 hover:text-blue-600">O nas & Zarząd</a>
                    <a href="statut.php" class="py-3 border-b text-gray-700 hover:text-blue-600">Statut</a>
                    <a href="galeria.php" class="py-3 border-b text-gray-700 hover:text-blue-600">Galeria</a>
                    <a href="dolacz.php" class="py-3 border-b text-gray-700 hover:text-blue-600">Dołącz do nas</a>
                </nav>
            </div>
        </header>

        <main class="flex-grow max-w-7xl w-full mx-auto px-4 py-8 relative z-0">