<?php
$title = "Project jrwnnnn_ // 404";
require_once "./public/components/head.php";
?>
<body>
    <?php include "./public/partials/status_bar.php"; ?>
    <main class="flex flex-col justify-between">
        <div class="space-y-5">
            <h1 class="text-5xl font-bold tracking-widest text-green-500 animate-pulse glitch">> 404_ERROR</h1>
            <div class="space-y-5 font-mono text-sm text-green-500/80">
                <p class="font-bold md:max-w-2/3">> <span class="text-red-500">FATAL EXCEPTION:</span> The requested frequency is receiving static. The page you are looking for might have been moved, deleted, or never existed in this timeline.</p>
            </div>
        </div>
        <p class="self-end font-mono text-sm opacity-30"> &copy; <?= date("Y",) ?> jrwnnnn_</p>
    </main>
    <script src="./public/js/glitchFX.js"></script>
</body>
</html>