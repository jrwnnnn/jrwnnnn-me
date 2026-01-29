<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
$base = $protocol . "://" . $_SERVER["HTTP_HOST"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= $base ?>">
    <title><?= $title ?? 'Project jrwnnnn_'; ?></title>
    <link href="./public/css/output.css" rel="stylesheet">
</head>
