<?php require_once('views/include/header.php') ?>

<div class="bandeau center-y">
    <?= $client->nom ?> <?= $client->prenom ?>
</div>

<div class="bg-white column center-y">
    <?php for ($i = 0; $i <= 5; $i++): ?>
        <a href="<?= SCRIPT_NAME ?>/bank.php/client/compte/<?= $i ?>" class="compte space-around center-y">
            <div class="column">
                <div>Nom du compte</div>
                <div>Numéro compte</div>
            </div>

            <div>
                Nombre de transaction
            </div>

            <div>
                Argent
            </div>
        </a>
    <?php endfor ?>
</div>