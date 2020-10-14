<?php require_once('views/include/headerClient.php'); ?>

<div class="center bg-white column">
    <?php foreach ($_SESSION as $key => $value): ?>
        <h1><?= $key ?>: <?= $value ?></h1>
    <?php endforeach ?>
</div>
