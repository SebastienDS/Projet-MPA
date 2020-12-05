<?php require_once('views/include/headerPOClientView.php') ?>

<div class="bandeau center-x center-y">
    <form class="space-around w-70">
        <div class="center-y">
            <label for="dateDebut">Date de début</label>
            <input type="date" id="dateDebut" name="dateDebut" value="<?= $dateDebut ?>">
        </div>
        <div class="center-y">
            <label for="dateFin">Date de fin</label>
            <input type="date" id="dateFin" name="dateFin" value="<?= $dateFin ?>">
        </div>

        <button type="submit" class="btn">Graphique</button>
    </form>
</div>


<div id="graphique" class="graphique body">

</div>

<div class="footer-fixed flex-end center-y">

    <div class="DL-btns space-around">
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/pdf/impayes" method="POST">
            <button class="btn">PDF</button>
        </form>
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/xls/impayes" method="POST">
            <button class="btn">XLS</button>
        </form>
        <form action="<?= SCRIPT_NAME ?>/bank.php/download/csv/impayes" method="POST">
            <button class="btn">CSV</button>
        </form>
    </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': [ 'bar' ] });

    google.charts.setOnLoadCallback(() => {
        const data = new google.visualization.arrayToDataTable(<?= json_encode($impayes) ?>);

        const options = {
            title: 'Impayés',
            subtitle: 'Montant en euro',
            isStacked: true,
            series: {
                0: { color: '#ff0000' },
                1: { color: '#6aa84f' },
                2: { color: '#0000ff' }
            }
        };

        const chart = new google.charts.Bar(document.getElementById('graphique'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    });
</script>