<?php
$title = "Project jrwnnnn_ // BOOT";
require_once "./public/components/head.php";
?>
<body>
    <?php include "./public/partials/status_bar.php"; ?>
    <main class="flex flex-col space-y-8">
        <div class="space-y-5">
            <pre class="overflow-hidden font-mono font-bold whitespace-pre md:text-lg text-[.6rem]">
<?php include "./public/assets/ascii/jerwin.txt"; ?>
            </pre>
            <p>Hello! I'm a computer science student here in the Philippines, and I've been coding since the ripe old age of (wait for it) 14. My first language? HTML, the basic building blocks of the internet  (think blinking text and questionable color schemes). Now I'm tackling Java and Python, because frankly, web development is about as exciting as watching paint dry. When I'm not meticulously crafting lines of code, you can find me strategically demolishing virtual enemies, listening to good music, trying to convince my pet dog to take over the world (spoiler alert, he's not very interested) or perfecting the art of the ceiling stare. The crazy part? I manage to ace my classes while being this gloriously lazy. Don't worry though, I'm not here to brag (okay, maybe a little). </p>
            <div class="space-y-2 hover_container">
                <h3 class="text-lg font-bold tracking-widest">> LATEST_TRANSMISSION</h3>
                <p class="font-mono text-sm break-all">
                    <span class="px-1 mr-2 text-xs font-bold text-black bg-green-500">ENCRYPTED</span>
                    <span id="latest_transmission" class="text-green-500 opacity-80 cursor-pointer">░█░█░▄▀▄░█░█░░░░░█▀▀░█▀▄░█▀▄░█▀█░█▀▄░░▀█░█/█░░▀█░░░░░█▀▀░█▀▄░█▀▄░█░█░█▀▄░░░▀░░▀░░░░▀░▀▀▀░▀▀▀░▀░▀░▀░▀░▀▀▀░▀░▀</span>
                    <script>
                        const e=document.getElementById('latest_transmission'),c='░█▓▒▀▄▌▐',l=e.innerText.length;
                        setInterval(()=>e.innerText=[...Array(l)].map(()=>c[Math.floor(Math.random()*c.length)]).join(''),100);
                    </script>
                </p>
                <p class="font-mono text-xs font-bold">[ DATE RECIEVED: 2026-01-27 ]</p>
            </div>
        </div>
        <hr class="border-green-500">
        <div class="space-y-5">
            <h3 class="text-xl font-bold tracking-widest">> MAIN_MENU</h3>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <a href="projects" class="block cursor-pointer generic_button group">
                    <span class="mr-2 group-hover:animate-ping">></span> [ DIR ] PROJECTS
                </a>
                <a href="/jrwnnnn-me/blogs" class="block cursor-pointer generic_button group">
                    <span class="mr-2 group-hover:animate-ping">></span> [ LOG ] BLOGS
                </a>
            </div>
        </div>
        <div class="gap-6 space-y-6 columns-1 lg:columns-2">
            <div class="break-inside-avoid generic_container py-6!">
                <div class="@container w-full overflow-hidden">
                    <pre class="font-mono leading-none whitespace-pre text-[.85cqw] md:text-[.9cqw]">
<?php include "./public/assets/ascii/vyse.txt"; ?>
                    </pre>
                </div>
            </div>
        </div>
    </main>
    <?php include "public/partials/footer.php"; ?>
</body>
</html>