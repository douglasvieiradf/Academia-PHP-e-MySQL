<?php include "header.php" ?>
<?php
require("conexao.php");
$_SESSION['tipo_usuario'] == 'administrador' ?: header("Location: /index.php");

function mostraData($data)
{
    return date("d/m/Y", strtotime($data));
}

$modalidade = "
SELECT
    count(cod_matricula) as inscritos,
    md.nome as modalidade,
    sum(md.valor_mensal) as valor
FROM vb_aluno al
         INNER JOIN vb_modalidade md ON al.id_turma = md.id_modalidade
WHERE md.id_modalidade in(1,2,3,4,5,6,7,8,9,10,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27)
group by  md.nome
";


$cidade = "
SELECT
        count(al.cod_matricula) as matriculado,
        vc.cidade
FROM vb_aluno al
INNER JOIN vb_cidade vc on al.id_cidade = vc.id_cidade
group by cidade
";

$modalidade = mysqli_query($con, $modalidade);
$cidade = mysqli_query($con, $cidade);

$arDados = array();
while ($row = mysqli_fetch_assoc($modalidade)) {
    $arDados[] = $row;
}

$arCidade = array();
while ($row = mysqli_fetch_assoc($cidade)) {
    $arCidade[] = $row;
}
$arValor = 0;
foreach ($arDados as $dados) {
    $arValor += $dados['valor'];
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
                            <h1 style="color:#666">Painel Administrativo</h1>
                            <div class="row">
                                <h3>Lucro Mensal: R$ <label style="color: green">+<?= $arValor; ?></label></h3>
                                <div id="chartModalidades" class="col-md-12"></div>
                            </div>
                            <hr/>
                            <div class="row">
                                <h3 style="color:#666">Clientes por cidade</h3>
                                <div id="chartdiv" class="col-md-12"></div>
                            </div>
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

</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
    am4core.ready(function () {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
        var chart = am4core.create("chartModalidades", am4charts.XYChart);

// Add data
        chart.data = <?php echo json_encode($arDados) ?>;

// Create axes

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "modalidade";
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
        series.dataFields.valueY = "inscritos";
        series.dataFields.categoryX = "modalidade";
        series.name = "inscritos";
        series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        series.columns.template.fillOpacity = .8;

        var columnTemplate = series.columns.template;
        columnTemplate.strokeWidth = 2;
        columnTemplate.strokeOpacity = 1;

    }); // end am4core.ready()

    am4core.ready(function () {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

        var chart = am4core.create("chartdiv", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.data =  <?php echo json_encode($arCidade) ?>;

        chart.innerRadius = am4core.percent(40);
        chart.depth = 120;

        chart.legend = new am4charts.Legend();

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "matriculado";
        series.dataFields.depthValue = "matriculado";
        series.dataFields.category = "cidade";
        series.slices.template.cornerRadius = 5;
        series.colors.step = 3;

    }); // end am4core.ready()
</script>
