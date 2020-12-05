<?php require_once('views/include/headerPOClientView.php') ?>

<div class="bandeau center-y">
    <?= $client->nom ?> <?= $client->prenom ?>
</div>

<div class="bg-white column center-y minHeight">
    <?php foreach ($comptes as $compte): ?>
        <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $compte->id ?>" class="compte space-around center-y">
            <div class="column">
                <div> Nom du compte : <?= $compte->nom ?> </div>
                <div> Numéro compte : <?= $compte->id ?> </div>
            </div>

            <div> Nombre de transaction : <?= $compte->nombreTransactions ?> </div>

            <div class="total"> Solde : <?= $compte->solde ?> </div>
        </a>
    <?php endforeach; ?>
</div>