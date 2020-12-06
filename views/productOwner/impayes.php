<?php require_once('views/include/header.php');

$colSorted = $_GET['colSorted'];
$sortDirection = $_GET['sortDirection'];
$otherParams = (isset($_GET['searchingBy']) && isset($_GET['search'])) ? "searchingBy={$_GET['searchingBy']}&search={$_GET['search']}" : '';
?>

<div class="bandeau center-y flex-end">
    <form>
        <select name="searchingBy">
            <option value=""> Rechercher par </option>
            <option value="N_SIREN">Numero de SIREN</option>
            <option value="Raison_Sociale">Raison sociale</option>
            <option value="impayes">Impayés</option>
        </select>

        <input type="text" placeholder="Recherche" name="search">

        <button type="submit">Rechercher</button>
    </form>
</div>

<table class="caracteristiques">
    <tr>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/impayes?colSorted=N_SIREN&sortDirection=<?= ($colSorted !== 'N_SIREN') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Numéro de SIREN </a>
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/impayes?colSorted=Raison_Sociale&sortDirection=<?= ($colSorted !== 'Raison_Sociale') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Raison sociale </a>
        </th>
        <th>
            <a href="<?= SCRIPT_NAME ?>/bank.php/productOwner/impayes?colSorted=impayes&sortDirection=<?= ($colSorted !== 'impayes') ? 'ASC' : (($sortDirection === 'ASC') ? 'DESC' : 'ASC') ?>&<?= $otherParams ?>"> Impayés </a>
        </th>
    </tr>
    <?php foreach ($impayes as $impaye): ?>
        <tr class="bg-white">
            <td><?= $impaye->siren ?></td>
            <td><?= $impaye->raisonSociale ?></td>
            <td><?= $impaye->impayes ?></td>
        </tr>
    <?php endforeach; ?>
</table>



<div class="footer-fixed space-between center-y">
    <div></div>

    <div>
        <a class="arrow left" href="?page=<?= $page - 1 ?>"></a>
        <span class="p-15"><?= $page ?> / <?= $totalPages ?></span>
        <a class="arrow right" href="?page=<?= $page + 1 ?>"></a>
    </div>

    <div class="DL-btns space-around">
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/pdf/impayes?<?= http_build_query($_GET); ?>" method="POST">
            <button class="btn">PDF</button>
        </form>
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/xls/impayes?<?= http_build_query($_GET); ?>" method="POST">
            <button class="btn">XLS</button>
        </form>
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/csv/impayes?<?= http_build_query($_GET); ?>" method="POST">
            <button class="btn">CSV</button>
        </form>
    </div>
</div>