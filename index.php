<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project jrwnnnn_ // TRANSMISSION</title>    
    <link href="public/css/output.css" rel="stylesheet">

</head>
<body>
    <?php include "public/partials/status_bar.php"; ?>
    <main class="flex flex-col justify-center items-center">
        <div class="space-y-5">
            <p id="transmission" class="text-xl cursor-pointer text-green-400 opacity-80">░█░█░▄▀▄░█░█░░░░░█▀▀░█▀▄░█▀▄░█▀█░█▀▄░░▀█░█/█░░▀█░░░░░█▀▀░█▀▄░█▀▄░█░█░█▀▄░░░▀░░▀░░░░▀░▀▀▀░▀▀▀░▀░▀░▀░▀░▀▀▀░▀░▀</p>
            <script>
                const e=document.getElementById('transmission'),c='░█▓▒▀▄▌▐',l=e.innerText.length;
                setInterval(()=>e.innerText=[...Array(l)].map(()=>c[Math.floor(Math.random()*c.length)]).join(''),100);
            </script>
            <div class="font-mono">
                <p class="text-green-700 animate-pulse">> Initializing handshake protocol...</p>
                <p class="text-green-600 animate-pulse delay-75">> Verifying security clearance...</p>
                <p class="text-green-500">> CONNECTION_SUCCESSFUL</p>
            </div>
        </div>
    </main>
    <?php include "public/partials/footer.php"; ?>
</body>
</html>