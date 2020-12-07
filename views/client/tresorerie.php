<?php require_once('views/include/header.php') ?>

<div class="bandeau center-x center-y">

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