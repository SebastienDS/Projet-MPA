<?php require_once('views/include/header.php') ?>

<div class="center-x center-y bg-white column">
    <?php foreach ($_SESSION as $key => $value): ?>
        <h1><?= $key ?>: <?= $value ?></h1>
    <?php endforeach ?>
</div>
