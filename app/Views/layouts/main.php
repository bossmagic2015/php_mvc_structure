<?php

use App\Core\View;

$BASE = '/php_base_structure';
?>

<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'My App' ?></title>

    <!-- Main CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $BASE ?>/assets/css/main.css">

    <script>
        window.APP_BASE = <?= json_encode(rtrim($BASE, '/')) ?>;
    </script>

    <!-- Page CSS -->
    <?php View::stack('styles'); ?>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container"><a class="navbar-brand" href="/">MyApp</a></div>
    </nav>

    <main class="container py-4">
        <?= $content ?>
    </main>

    <!-- Main JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?= $BASE ?>/assets/js/main.js"></script>

    <!-- Page JS -->
    <?php View::stack('scripts'); ?>
</body>

</html>