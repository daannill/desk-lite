<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?? 'DeskLite — Modern Helpdesk' ?></title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="<?= APP_URL ?>/css/style.css">
    
    <!-- HTMX -->
    <script src="<?= APP_URL ?>/js/htmx.min.js" defer></script>
    <!-- Alpine.js -->
    <script src="<?= APP_URL ?>/js/alpine.min.js" defer></script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 antialiased min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white" x-data="{ mobileMenuOpen: false }">
    
    <!-- Navigation Bar -->
    <header class="sticky top-0 z-40 bg-slate-900/80 backdrop-blur-md border-b border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 gap-4">
                
                <!-- Brand & Logo -->
                <div class="flex items-center gap-8">
                    <a href="/" class="flex items-center gap-2.5 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-cyan-400 p-0.5 shadow-lg shadow-indigo-500/20 group-hover:scale-105 transition-transform duration-200">
                            <div class="w-full h-full bg-slate-900 rounded-[10px] flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold tracking-tight text-white group-hover:text-indigo-400 transition-colors">Desk<span class="text-indigo-400">Lite</span></span>
                            <span class="text-[10px] font-semibold text-slate-400 -mt-1 tracking-wider uppercase">Workspace v1.0</span>
                        </div>
                    </a>

                    <!-- Nav Links (Desktop) -->
                    <nav class="hidden md:flex items-center gap-1">
                        <a href="/" class="px-3 py-2 rounded-lg text-sm font-medium bg-slate-800/90 text-white shadow-sm border border-slate-700/50">
                            Dashboard
                        </a>
                        <a href="#tickets" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-all">
                            Tiket Helpdesk
                        </a>
                        <a href="#activity" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-all">
                            Aktivitas
                        </a>
                        <a href="#analytics" class="px-3 py-2 rounded-lg text-sm font-medium text-slate-400 hover:text-slate-200 hover:bg-slate-800/50 transition-all">
                            Laporan
                        </a>
                    </nav>
                </div>

                <!-- Global Search & Actions -->
                <div class="flex items-center gap-3">
                    <!-- Quick Search Input -->
                    <div class="hidden lg:flex items-center relative w-64">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" placeholder="Cari tiket, tugas..." class="w-full bg-slate-800/80 border border-slate-700/60 rounded-xl pl-9 pr-4 py-1.5 text-xs text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                        <kbd class="hidden xl:inline-block absolute right-2.5 px-1.5 py-0.5 text-[10px] font-medium text-slate-400 bg-slate-700/60 rounded border border-slate-600/50">⌘K</kbd>
                    </div>

                    <!-- Status Pill -->
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-medium">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span>Sistem Normal</span>
                    </div>

                    <!-- User Profile Dropdown Simulation -->
                    <div class="flex items-center gap-2 pl-2 border-l border-slate-800" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 rounded-xl p-1 hover:bg-slate-800 transition-colors focus:outline-none">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center text-xs font-bold text-white shadow-md">
                                AD
                            </div>
                            <div class="hidden sm:flex flex-col text-left">
                                <span class="text-xs font-semibold text-slate-200 leading-tight">Alex Developer</span>
                                <span class="text-[10px] text-slate-400">Lead Admin</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden border-b border-slate-800 bg-slate-900 px-4 pt-2 pb-4 space-y-2">
            <a href="/" class="block px-3 py-2 rounded-lg text-base font-medium bg-indigo-600 text-white">Dashboard</a>
            <a href="#tickets" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-300 hover:bg-slate-800">Tiket Helpdesk</a>
            <a href="#activity" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-300 hover:bg-slate-800">Aktivitas</a>
            <a href="#analytics" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-300 hover:bg-slate-800">Laporan</a>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php show('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-slate-800/80 py-6 text-xs text-slate-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-300">DeskLite</span>
                <span>&copy; <?= date('Y') ?> DeskLite Workspace. All rights reserved.</span>
            </div>
            <div class="flex items-center gap-4 text-slate-400">
                <a href="#" class="hover:text-slate-300 transition-colors">Dokumentasi</a>
                <span>&bull;</span>
                <a href="#" class="hover:text-slate-300 transition-colors">Status Layanan</a>
                <span>&bull;</span>
                <span class="text-slate-400">PHP 8.2 Custom MVC</span>
            </div>
        </div>
    </footer>

</body>
</html>
