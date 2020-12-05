<?php require_once('views/include/header.php') ?>

<div class="bandeau flex-end center-y">

</div>

<div class="bg-white column center-y minHeight">
    <div class="center-x center-y p-15">
        <a href="<?= SCRIPT_NAME ?>/bank.php/admin/updateProfil/<?= $idClient ?>/ajoutCompte" class="btn">Ajouter un compte</a>
    </div>

    <?php foreach ($comptes as $compte): ?>
        <div class="compte space-around center-y">
            <div class="column">
                <div> Nom du compte : <?= $compte->nom ?> </div>
                <div> Numéro compte : <?= $compte->id ?> </div>
            </div>

            <div> Nombre de transaction : <?= $compte->nombreTransactions ?> </div>

            <div class="total"> Solde : <?= $compte->solde ?> </div>

            <a href="<?= SCRIPT_NAME ?>/bank.php/admin/updateProfil/<?= $idClient ?>/deleteCompte/<?= $compte->id ?>">
                <img src="<?= SCRIPT_NAME ?>/public/img/trash.png" alt="delete button" height="50">
            </a>
        </div>
    <?php endforeach; ?>
</div>