<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 — Kesalahan Server | DeskLite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="h-full flex items-center justify-center p-6 bg-slate-950">
    <div class="max-w-md w-full text-center space-y-6">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-400 mb-2">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <div class="space-y-2">
            <h1 class="text-6xl font-extrabold text-white tracking-tight">500</h1>
            <h2 class="text-xl font-semibold text-slate-200">Terjadi Kesalahan Server</h2>
            <p class="text-sm text-slate-400">Sistem mendeteksi kendala saat memproses permintaan Anda. Masalah ini telah dicatat ke log sistem.</p>
        </div>
        <div class="pt-4">
            <a href="<?= defined('APP_URL') ? APP_URL : '/' ?>" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-medium text-sm transition-all border border-slate-700">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>
