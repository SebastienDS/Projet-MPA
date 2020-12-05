<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <?php foreach ($style ?? [] as $css): ?>
        <link rel="stylesheet" href="<?= SCRIPT_NAME ?>/public/css/<?= $css ?>.css">
    <?php endforeach; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?= $content ?>
</body>
</html>