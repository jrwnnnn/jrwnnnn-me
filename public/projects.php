<?php
$title = "Project jrwnnnn_ // PROJECTS";
require_once "./public/components/head.php";

$repos = json_decode(
    file_get_contents(
        "https://raw.githubusercontent.com/jrwnnnn/jrwnnnn-me/refs/heads/data/repositories.json",
    ),
    true,
);
$participation = json_decode(
    file_get_contents(
        "https://raw.githubusercontent.com/jrwnnnn/jrwnnnn-me/refs/heads/data/participation.json",
    ),
    true,
);

usort($repos, function ($a, $b) {
    return strtotime($b["pushed_at"]) - strtotime($a["pushed_at"]);
});
?>

<body>
    <?php include "./public/partials/status_bar.php"; ?>
    <main class="flex flex-col space-y-8">
        <div class="flex justify-between items-end">
            <div>
                <p class="text-xl font-bold tracking-widest">> PROJECT_DATABASE</p>
                <p class="mt-1 text-sm opacity-70">Found <?= count(
                    $repos,
                ) ?> records in local storage. Total size: <?= array_sum(
     array_column($repos, "size"),
 ) ?>k</p>
            </div>
            <a href="/" class="hidden text-sm md:block group">
                <span class="inline-block group-hover:-translate-x-1"><</span> [ RETURN ]
            </a>
        </div>
        <hr class="bg-green-500">
        <div class="flex flex-wrap gap-2">
            <?php foreach ($repos as $repo):

                $width =
                    (60 + floor(min($repo["size"] ?? 0, 100000) / 2500)) / 4;
                $statusClass = $repo["archived"]
                    ? "border-green-500 bg-green-900/5 opacity-50 hover:opacity-100"
                    : "border-green-500 bg-green-900/10 hover:bg-green-500 hover:text-black";
                ?>
                <a href="<?= htmlspecialchars(
                    $repo["html_url"],
                ) ?>" target="_blank" style="--w: <?= $width ?>rem" class="<?= $statusClass ?> w-full md:w-(--w) border p-4 flex flex-col space-y-2 justify-between">
                    <div class="flex justify-between font-mono opacity-60 text-[.7rem]">
                        <div>0x<?= substr(md5($repo["name"]), 0, 4) ?></div>
                        <div><?= $repo["size"] ?? 0 ?>k</div>
                    </div>
                    <p class="flex items-center text-lg font-bold uppercase truncate">
                        <?= htmlspecialchars($repo["name"]) ?>
                        <svg class="inline-block ml-1 w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </p>
                    <p class="text-xs opacity-70 line-clamp-2"><?= htmlspecialchars(
                        $repo["description"] ?? "No description available",
                    ) ?></p>
                    <svg viewBox="0 0 102 25" class="w-full h-8 opacity-60 hover:opacity-100" preserveAspectRatio="none">
                        <?php
                        $stats =
                            $participation[$repo["name"]]["all"] ??
                            array_fill(0, 52, 0);
                        $max = max($stats) ?: 1;
                        $points = implode(
                            " ",
                            array_map(
                                fn($i, $v) => $i * 2 .
                                    "," .
                                    (25 - ($v / $max) * 25),
                                array_keys($stats),
                                $stats,
                            ),
                        );
                        ?>
                        <polyline points="<?= $points ?>" fill="none" stroke="currentColor" stroke-width="1.5" vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex justify-between items-end mt-2">
                        <div class="flex gap-2 items-center text-xs tracking-wider uppercase">
                            <div class="py-0.5 px-2 border"><?= $repo[
                                "language"
                            ] ?? "RAW" ?></div>
                            <div class="py-0.5 px-2 border"><?= $repo[
                                "license"
                            ]["spdx_id"] ?? "N/A" ?></div>
                        </div>
                        <div class="w-2 h-2 rounded-full <?= $repo["archived"]
                            ? "bg-red-900"
                            : "bg-green-500 animate-pulse" ?>"></div>
                    </div>
                </a>
            <?php
            endforeach; ?>
        </div>
    </main>
    <?php include "./public/partials/footer.php"; ?>
</body>
</html>
