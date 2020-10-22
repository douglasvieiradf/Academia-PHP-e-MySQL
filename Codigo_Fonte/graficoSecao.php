<?php include "header.php" ?>
<?php
require("conexao.php");
$_SESSION['tipo_usuario'] == 'aluno' ?: header("Location: /index.php");
$id_exercicio = $_GET['id_exercicio'];

function mostraData($data)
{
    return date("d/m/Y", strtotime($data));
}

/*$modalidade = "
SELECT
    count(cod_matricula) as inscritos,
    md.nome as modalidade,
    sum(md.valor_mensal) as valor
FROM vb_aluno al
         INNER JOIN vb_modalidade md ON al.id_turma = md.id_modalidade
WHERE md.id_modalidade in(1,2,3,4,5,6,7,8,9,10,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27)
group by  md.nome
";*/

$modalidade = "
SELECT
    dt_secao as data,
    qtd_serie as series,
    repeticao as repeticao,
    carga as carga
    FROM secao
    WHERE id_exercicio = $id_exercicio
    ORDER BY data ASC
";



$modalidade = mysqli_query($con, $modalidade);

$arDados = array();
while ($row = mysqli_fetch_assoc($modalidade)) {
    
    $row['fator'] = ($row['series']*$row['repeticao'])*$row['carga'];
    echo $row['fator'];
    $arDados[] = $row;
}

include "menu.php"
?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 style="color:#666">Desempenho</h1>
                            <div class="row">
                                <div id="chartModalidades" class="col-md-12"></div>
                            </div>
                            <div class="row">
                                <div id="chartCal" class="col-md-12"></div>
                            </div>
                            <div class="row">
                                <div id="chartdiv" class="col-md-12"></div>
                            </div>
                            <hr/>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php include "footer.php" ?>

<!-- Styles -->
<style>
    #chartModalidades {
        width: 100%;
        height: 200px;
    }

    #chartdiv {
        width: 100%;
        height: 500px;
    }

    #chartCal {
  width: 100%;
  height: 300px;
}

</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
   /* am4core.ready(function () {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
        var chart = am4core.create("chartModalidades", am4charts.XYChart);

// Add data
        chart.data = <?php echo json_encode($arDados) ?>;

// Create axes

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "data";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 100;

        categoryAxis.renderer.labels.template.adapter.add("dy", function (dy, target) {
            if (target.dataItem && target.dataItem.index & 2 == 2) {
                return dy + 25;
            }
            return dy;
        });

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "series";
        series.dataFields.categoryX = "data";
        series.name = "data";
        series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        series.columns.template.fillOpacity = .8;

        var columnTemplate = series.columns.template;
        columnTemplate.strokeWidth = 2;
        columnTemplate.strokeOpacity = 1;

    }); // end am4core.ready()*/



    am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartCal", am4charts.XYChart);
chart.paddingRight = 20;


chart.data = <?php echo json_encode($arDados) ?>;

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.grid.template.location = 0;
dateAxis.renderer.axisFills.template.disabled = true;
dateAxis.renderer.ticks.template.disabled = true;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.tooltip.disabled = true;
valueAxis.renderer.minWidth = 35;
valueAxis.renderer.axisFills.template.disabled = true;
valueAxis.renderer.ticks.template.disabled = true;

var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.dateX = "data";
series.dataFields.valueY = "fator";
series.strokeWidth = 2;
series.tooltipText = "fator: {valueY}, dia: {dateX}";

// set stroke property field
series.propertyFields.stroke = "color";

chart.cursor = new am4charts.XYCursor();

var scrollbarX = new am4core.Scrollbar();
chart.scrollbarX = scrollbarX;

dateAxis.start = 0.0;
dateAxis.keepSelection = true;


}); // end am4core.ready()





    am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end



var chart = am4core.create('chartdiv', am4charts.XYChart)
chart.colors.step = 2;

chart.legend = new am4charts.Legend()
chart.legend.position = 'bottom'
chart.legend.paddingBottom = 20
chart.legend.labels.template.maxWidth = 95

var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
xAxis.dataFields.category = 'data'
xAxis.renderer.cellStartLocation = 0.1
xAxis.renderer.cellEndLocation = 0.9
xAxis.renderer.grid.template.location = 0;

var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
yAxis.min = 0;

function createSeries(value, name) {
    var series = chart.series.push(new am4charts.ColumnSeries())
    series.dataFields.valueY = value
    series.dataFields.categoryX = 'data'
    series.name = name
    series.columns.template.tooltipText = name+": [bold]{valueY}[/]";
        series.columns.template.fillOpacity = .8;

    series.events.on("hidden", arrangeColumns);
    series.events.on("shown", arrangeColumns);

    var bullet = series.bullets.push(new am4charts.LabelBullet())
    bullet.interactionsEnabled = false
    bullet.dy = 30;
    bullet.label.text = '{valueY}'
    bullet.label.fill = am4core.color('#ffffff')

    return series;
}

chart.data = <?php echo json_encode($arDados) ?>;


createSeries('series', 'Séries');
createSeries('repeticao', 'Repetições');
createSeries('carga', 'Carga');

function arrangeColumns() {

    var series = chart.series.getIndex(0);

    var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
    if (series.dataItems.length > 1) {
        var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
        var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
        var delta = ((x1 - x0) / chart.series.length) * w;
        if (am4core.isNumber(delta)) {
            var middle = chart.series.length / 2;

            var newIndex = 0;
            chart.series.each(function(series) {
                if (!series.isHidden && !series.isHiding) {
                    series.dummyData = newIndex;
                    newIndex++;
                }
                else {
                    series.dummyData = chart.series.indexOf(series);
                }
            })
            var visibleCount = newIndex;
            var newMiddle = visibleCount / 2;

            chart.series.each(function(series) {
                var trueIndex = chart.series.indexOf(series);
                var newIndex = series.dummyData;

                var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
            })
        }
    }
}

}); // end am4core.ready()
</script>

</script>
