<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col h-screen bg-neutral-900 text-white">
    <?php require('header.php'); ?>
    <?= $content; ?>
    <?php require('footer.php'); ?>
</body>
</html>