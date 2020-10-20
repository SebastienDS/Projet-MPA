<?php require_once('views/include/headerClient.php') ?>

<div class="bandeau center-x center-y">
    <form action="" class="space-around w-70">
        <div>
            <label for="dateDebut">Date de début</label>
            <input type="date" id="dateDebut" name="dateDebut">
        </div>
        <div>
            <label for="dateFin">Date de fin</label>
            <input type="date" id="dateFin" name="dateFin">
        </div>

        <button type="submit" class="btn">Graphique</button>
    </form>
</div>

<div id="graphique" class="graphique">

</div>

<div class="footer-fixed flex-end center-y">

    <div class="DL-btns space-around">
        <form>
            <button class="btn">PDF</button>
        </form>
        <form>
            <button class="btn">XLS</button>
        </form>
        <form>
            <button class="btn">CSV</button>
        </form>
    </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': [ 'bar' ] });

    google.charts.setOnLoadCallback(() => {
        const data = new google.visualization.arrayToDataTable([
            ['Mois', 'Impayés CB', 'Impayés Visa', 'Impayés Mastercard'],
            ['Juin 2020', 250, 0, 0],
            ['Juillet 2020', 1250, 200, 0],
            ['Aout 2020', 0, 0, 0],
            ['Septembre 2020', 0, 0, 750]
        ]);

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