<?php if ($_SESSION['auth'] === 'admin') {
    require_once('views/include/headerAdmin.php');
} else if ($_SESSION['auth'] === 'client') {
    require_once('views/include/headerClient.php');
} ?>

<div class="center-x center-y bg-white column">
    <?php foreach ($_SESSION as $key => $value): ?>
        <h1><?= $key ?>: <?= $value ?></h1>
    <?php endforeach ?>
</div>
