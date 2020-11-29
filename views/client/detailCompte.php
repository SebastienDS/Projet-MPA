<?php require_once('views/include/header.php') ?>

<div class="bandeau center-y flex-end">
    <form>
        <select name="searchingBy">
            <option value=""> Rechercher par </option>
            <option value="NSIREN">Numero de SIREN</option>
            <option value="Raison_Sociale">Raison sociale</option>
            <option value="datetr">Date de traitement</option>
            <option value="nombreTransactions">Nombre de transactions</option>
            <option value="moyenPay">Moyen de paiement</option>
            <option value="montantTotal">Montant total</option>
        </select>

        <input type="text" placeholder="Recherche" name="search">

        <button type="submit">Rechercher</button>
    </form>
</div>

<table class="caracteristiques">
    <tr>
        <th>
            Numéro de SIREN
        </th>
        <th>
            Raison sociale
        </th>
        <th>
            Date traitement
        </th>
        <th>
            Nombre de transactions
        </th>
        <th>
            Devise
        </th>
        <th>
            Moyen de paiement
        </th>
        <th>
            Montant total
        </th>
        <th>
            Sens + ou -
        </th>
    </tr>
    <?php foreach ($transactions as $transaction): ?>
        <tr class="<?= $transaction->montantTotal >= 0 ? 'montantPositif' : 'montantNegatif' ?>">
            <td><?= $transaction->siren ?></td>
            <td><?= $transaction->raisonSociale ?></td>
            <td><?= $transaction->date ?></td>
            <td><?= $transaction->nombreTransactions ?></td>
            <td><?= $transaction->Euro ?></td>
            <td><?= $transaction->moyenPay ?></td>
            <td><?= $transaction->montantTotal ?></td>
            <td><?= $transaction->montantTotal >= 0 ? '+' : '-' ?></td>
        </tr>
    <?php endforeach; ?>
</table>



<div class="footer-fixed space-between center-y">
    <div class="total">
        <?= $compteInfos->solde ?>
    </div>

    <div class="DL-btns space-around">
        <form action="<?= SCRIPT_NAME ?>/bank.php/client/download/pdf/compte/<?= $numeroCompte ?>" method="POST">
            <button class="btn">PDF</button>
        </form>
        <form action="<?= SCRIPT_NAME ?>/bank.php/client/download/xls/compte/<?= $numeroCompte ?>" method="POST">
            <button class="btn">XLS</button>
        </form>
        <form action="<?= SCRIPT_NAME ?>/bank.php/client/download/csv/compte/<?= $numeroCompte ?>" method="POST">
            <button class="btn">CSV</button>
        </form>
    </div>
</div>



