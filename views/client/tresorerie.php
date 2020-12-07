<?php require_once('views/include/header.php') ?>

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
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': [ 'corechart' ] });

    google.charts.setOnLoadCallback(() => {
        const data = new google.visualization.arrayToDataTable(<?= json_encode($tresorerie) ?>);

        const options = {
            title: 'Soldes',
            hAxis: {title: 'Dates',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };

        const chart = new google.visualization.AreaChart(document.getElementById('graphique'));
        chart.draw(data, options);

    });
</script>