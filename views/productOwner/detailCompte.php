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
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/?colSorted=N_SIREN&sortDirection=<?= ($colSorted !== 'N_SIREN') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Numéro de SIREN </a>
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/?colSorted=Raison_Sociale&sortDirection=<?= ($colSorted !== 'Raison_Sociale') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Raison sociale </a>
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/?colSorted=datetr&sortDirection=<?= ($colSorted !== 'datetr') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Date traitement </a>
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/?colSorted=nombreTransactions&sortDirection=<?= ($colSorted !== 'nombreTransactions') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Nombre de transactions </a>
        </th>
        <th>
            Devise
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/?colSorted=moyenPay&sortDirection=<?= ($colSorted !== 'moyenPay') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Moyen de paiement </a>
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/?colSorted=montantTotal&sortDirection=<?= ($colSorted !== 'montantTotal') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Montant total </a>
        </th>
        <th>
            Sens + ou -
        </th>
    </tr>
    <?php foreach ($transactions as $transaction): ?>
        <tr class="clickableRow <?= $transaction->montantTotal >= 0 ? 'montantPositif' : 'montantNegatif' ?>" siren="<?= $transaction->siren ?>" date="<?= $transaction->date ?>">
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

    <div class="max-height column space-around center-y">
        <div>
            <?= $displayedResults ?> résultat<?= $displayedResults > 1 ? 's' : '' ?> affiché<?= $displayedResults > 1 ? 's' : '' ?> / <?= $resultsTotal ?>
        </div>

        <div>
            <a class="arrow left" href="?page=<?= $page - 1 ?>"></a>
            <span class="p-15"><?= $page ?> / <?= $totalPages ?></span>
            <a class="arrow right" href="?page=<?= $page + 1 ?>"></a>
        </div>
    </div>

    <div class="DL-btns space-around">
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/pdf/compte/<?= $numeroCompte ?>?<?= http_build_query($_GET); ?>" method="POST">
            <button class="btn">PDF</button>
        </form>
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/xls/compte/<?= $numeroCompte ?>?<?= http_build_query($_GET); ?>" method="POST">
            <button class="btn">XLS</button>
        </form>
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/csv/compte/<?= $numeroCompte ?>?<?= http_build_query($_GET); ?>" method="POST">
            <button class="btn">CSV</button>
        </form>
    </div>
</div>

<script>
    const rows = document.querySelectorAll('.clickableRow');

    rows.forEach(row => {
        row.addEventListener('click', () => {
            window.location = `<?= SCRIPT_NAME ?>/bank.php/productOwner/client/<?= $idClient ?>/compte/<?= $numeroCompte ?>/transaction/${row.getAttribute('siren')}/${row.getAttribute('date')}`;
        })
        row.style.cursor = 'pointer';
    })
</script>
