<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?? 'DeskLite' ?></title>
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="/public/css/style.css">
    <!-- HTMX -->
    <script src="/public/js/htmx.min.js" defer></script>
    <!-- Alpine.js -->
    <script src="/public/js/alpine.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-900 antialiased min-h-screen">
    
    <div class="flex flex-col min-h-screen">
        <!-- Main Content -->
        <main class="flex-1 container mx-auto px-4 py-6">
            <?php show('content'); ?>
        </main>
    </div>

</body>
</html>
