<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(get_class($e)) ?>: <?= htmlspecialchars($e->getMessage()) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        code, pre { font-family: 'Fira Code', monospace; }
    </style>
</head>
<body class="min-h-full bg-slate-950 p-6 md:p-10 text-slate-200">
    <div class="max-w-6xl mx-auto space-y-6">
        <!-- Header Banner -->
        <div class="p-6 rounded-2xl bg-rose-500/10 border border-rose-500/20 space-y-3">
            <div class="flex items-center gap-3">
                <span class="px-2.5 py-1 rounded-md text-xs font-semibold uppercase tracking-wider bg-rose-500 text-white">
                    <?= htmlspecialchars(get_class($e)) ?>
                </span>
                <span class="text-xs text-rose-300/80 font-mono">Code: <?= $e->getCode() ?></span>
                <span class="ml-auto text-xs px-2 py-0.5 rounded bg-slate-800 text-slate-400 border border-slate-700">DeskLite Dev Mode</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-white tracking-tight">
                <?= htmlspecialchars($e->getMessage() ?: '(No message provided)') ?>
            </h1>
            <div class="flex items-center gap-2 text-sm text-slate-400 font-mono break-all pt-1">
                <svg class="w-4 h-4 text-rose-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span><?= htmlspecialchars($e->getFile()) ?></span>
                <span class="text-rose-400 font-bold">:<?= $e->getLine() ?></span>
            </div>
        </div>

        <!-- Stack Trace Section -->
        <div class="space-y-3">
            <h2 class="text-lg font-semibold text-slate-200 flex items-center gap-2">
                <span>Stack Trace</span>
                <span class="text-xs text-slate-500 font-normal">(Most recent call first)</span>
            </h2>
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 overflow-x-auto shadow-xl">
                <pre class="text-xs leading-relaxed text-slate-300"><?= htmlspecialchars($e->getTraceAsString()) ?></pre>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="flex items-center justify-between text-xs text-slate-500 pt-4 border-t border-slate-900">
            <div>DeskLite Custom MVC &bull; PHP <?= PHP_VERSION ?></div>
            <div>Log written to <code>storage/logs/error.log</code></div>
        </div>
    </div>
</body>
</html>
