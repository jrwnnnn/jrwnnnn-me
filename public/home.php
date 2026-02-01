<?php
$title = "Project jrwnnnn_ // BOOT";
require_once "./public/components/head.php";

$languages = json_decode(file_get_contents(
        "https://raw.githubusercontent.com/jrwnnnn/jrwnnnn-me/refs/heads/data/languages.json",
    ),
    true,
);

$stack = [];
foreach ($languages as $repo) {
    foreach ($repo as $language => $bytes) {
        $stack[$language] = ($stack[$language] ?? 0) + $bytes;
    }
}
$total = array_sum($stack);
foreach ($stack as $language => $bytes) {
    $stack[$language] = round(($bytes / $total) * 100);
}
arsort($stack);


?>
<body>
    <?php include "./public/partials/status_bar.php"; ?>
    <main class="flex flex-col space-y-8">
        <div class="space-y-5">
            <pre class="overflow-hidden font-mono font-bold whitespace-pre md:text-lg text-[.6rem]">
<?php include "./public/assets/ascii/jerwin.txt"; ?>
            </pre>
            <p>Hello! I'm a computer science student here in the Philippines, and I've been coding since the ripe old age of (wait for it) 14. My first language? HTML, the basic building blocks of the internet  (think blinking text and questionable color schemes). Now I'm tackling Java and Python, because frankly, web development is about as exciting as watching paint dry. When I'm not meticulously crafting lines of code, you can find me strategically demolishing virtual enemies, listening to good music, trying to convince my pet dog to take over the world (spoiler alert, he's not very interested) or perfecting the art of the ceiling stare. The crazy part? I manage to ace my classes while being this gloriously lazy. Don't worry though, I'm not here to brag (okay, maybe a little). </p>
            <div class="space-y-2 hover_container" onclick="location.href='blog?=latest'">
                <h3 class="text-lg font-bold tracking-widest">> LATEST_TRANSMISSION</h3>
                <p class="font-mono text-sm break-all">
                    <span class="px-1 mr-2 text-xs font-bold text-black bg-green-500">ENCRYPTED</span>
                    <span id="latest_transmission" class="text-green-500 opacity-80 cursor-pointer line-clamp-2">░█░█░▄▀▄░█░█░░░░░█▀▀░█▀▄░█▀▄░█▀█░█▀▄░░▀█░█/█░░▀█░░░░░█▀▀░█▀▄░█▀▄░█░█░█▀▄░░░▀░░▀░░░░▀░▀▀▀░▀▀▀░▀░▀░▀░▀░▀▀▀░▀░▀</span>
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
                <div class="block cursor-pointer generic_button group" onclick="location.href='projects'">
                    <span class="mr-2 group-hover:animate-ping">></span> [ DIR ] PROJECTS
                </div>
                <div class="block cursor-pointer generic_button group" onclick="location.href='blog'">
                    <span class="mr-2 group-hover:animate-ping">></span> [ LOG ] BLOGS
                </div>
            </div>
        </div>
        <div class="gap-6 space-y-6 columns-1 lg:columns-2">
            <div class="space-y-5 break-inside-avoid generic_container">
                <div class="@container w-full overflow-hidden">
                    <pre class="font-mono leading-none whitespace-pre text-[.85cqw] glitch md:text-[.9cqw]">
<?php echo file_get_contents("https://pastebin.com/raw/2w7sZxex"); ?>
                    </pre>
                </div>
            </div>
            <div class="break-inside-avoid generic_container p-10!">
                <p class="text-lg font-bold tracking-widest">> STACK</p>
                <canvas id="stackradar"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                const ctx = document.getElementById('stackradar');
                new Chart(ctx, {
                    type: 'radar',
                    data: {
                    labels: [<?php echo '"' .
                        implode('","', array_keys($stack)) .
                        '"'; ?>],
                    datasets: [{
                        data: [<?php echo implode(
                            ",",
                            array_values($stack),
                        ); ?>],
                        backgroundColor: 'rgba(0, 201, 80, 0.2)',
                        borderColor: '#00C950',
                        borderWidth: 2,
                        pointBackgroundColor: '#00C950',
                        pointBorderColor: '#00C950',
                    }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            r: {
                                angleLines: {
                                    color: '#00C95050'
                                },
                                grid: {
                                    color: '#00C95030' 
                                },
                                pointLabels: {
                                    color: '#00C950',
                                    font: {
                                    family: "monospace",
                                    size: 12,
                                    weight: 'bold',
                                    }
                                },
                                ticks: {
                                    display: false,
                                    backdropColor: 'transparent'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        }
                    }
                });
                </script>
            </div>
        </div>
    </main>
    <?php include "public/partials/footer.php"; ?>
</body>
</html>