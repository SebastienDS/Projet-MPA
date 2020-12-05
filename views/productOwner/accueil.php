<?php require_once('views/include/header.php') ?>

<div class="bandeau flex-end center-y">
    <form>
        <input type="text" placeholder="Recherche" name="search">
        <button type="submit">Rechercher</button>
    </form>
</div>

<div class="bg-white">
    <?php foreach ($comptes as $compte): ?>
        <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $compte->id ?>">
            <div class="space-between compteItem center-y">
                <div>
                    <?= $compte->nom ?> <?= $compte->prenom ?>
                </div>

                <i class="fa fa-eye" style="font-size: 3rem"></i>
            </div>
        </a>
    <?php endforeach ?>
</div>
