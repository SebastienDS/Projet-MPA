<?php require_once('views/include/headerPOClientView.php');

$colSorted = $_GET['colSorted'];
$sortDirection = $_GET['sortDirection'];
$otherParams = (isset($_GET['searchingBy']) && isset($_GET['search'])) ? "searchingBy={$_GET['searchingBy']}&search={$_GET['search']}" : '';
$_GET['idClient'] = $idClient;
?>

<div class="bandeau center-y flex-end">
    <form>
        <select name="searchingBy">
            <option value=""> Rechercher par </option>
            <option value="N_SIREN">Numero de SIREN</option>
            <option value="Raison_Sociale">Raison sociale</option>
            <option value="datetr">Date de traitement</option>
            <option value="moyenPay">Moyen de paiement</option>
            <option value="montant">Montant</option>
        </select>

        <input type="text" placeholder="Recherche" name="search">

        <button type="submit">Rechercher</button>
    </form>
</div>

<table class="caracteristiques">
    <tr>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/transaction/<?= $siren ?>/<?= $date ?>/?colSorted=N_SIREN&sortDirection=<?= ($colSorted !== 'N_SIREN') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Numéro de SIREN </a>
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/transaction/<?= $siren ?>/<?= $date ?>/?colSorted=Raison_Sociale&sortDirection=<?= ($colSorted !== 'Raison_Sociale') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Raison sociale </a>
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/transaction/<?= $siren ?>/<?= $date ?>/?colSorted=datetr&sortDirection=<?= ($colSorted !== 'datetr') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Date traitement </a>
        </th>
        <th>
            Devise
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/transaction/<?= $siren ?>/<?= $date ?>/?colSorted=moyenPay&sortDirection=<?= ($colSorted !== 'moyenPay') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Moyen de paiement </a>
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/transaction/<?= $siren ?>/<?= $date ?>/?colSorted=montant&sortDirection=<?= ($colSorted !== 'montant') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Montant </a>
        </th>
        <th>
            Sens + ou -
        </th>
    </tr>
    <?php foreach ($transactions as $transaction): ?>
        <tr class="<?= $transaction->montant >= 0 ? 'montantPositif' : 'montantNegatif' ?>" siren="<?= $transaction->siren ?>" date="<?= $transaction->datetr ?>">
            <td><?= $transaction->siren ?></td>
            <td><?= $transaction->raisonSociale ?></td>
            <td><?= $transaction->datetr ?></td>
            <td><?= $transaction->Euro ?></td>
            <td><?= $transaction->moyenPay ?></td>
            <td><?= $transaction->montant ?></td>
            <td><?= $transaction->montant >= 0 ? '+' : '-' ?></td>
        </tr>
    <?php endforeach; ?>
</table>



<div class="footer-fixed space-between center-y">
    <div class="total">
        <?= $compteInfos->solde ?>
    </div>

    <form class="center-y">
        <button type='submit' class="arrow left" name="page" value="-"></button>
        <span class="p-15">1 / 42</span>
        <button type='submit' class="arrow right" name="page" value="+"></button>
    </form>

    <div class="DL-btns space-around">
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/pdf/compte/<?= $numeroCompte ?>/transaction/<?= $siren ?>/<?= $date ?>?<?= http_build_query($_GET); ?>" method="POST">
            <button class="btn">PDF</button>
        </form>
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/xls/compte/<?= $numeroCompte ?>/transaction/<?= $siren ?>/<?= $date ?>?<?= http_build_query($_GET); ?>" method="POST">
            <button class="btn">XLS</button>
        </form>
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/csv/compte/<?= $numeroCompte ?>/transaction/<?= $siren ?>/<?= $date ?>?<?= http_build_query($_GET); ?>" method="POST">
            <button class="btn">CSV</button>
        </form>
    </div>
</div>