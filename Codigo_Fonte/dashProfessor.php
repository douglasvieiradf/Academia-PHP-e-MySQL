<?php include "header.php" ?>
<?php
require("conexao.php");
$_SESSION['id_professor'] ?: header("Location: /index.php");

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

$queryImc = "
SELECT
       CASE
           WHEN imc < 17 THEN 'Muito Abaixo do Peso'
           WHEN imc > 17 AND imc <18.49 THEN 'Abaixo do Peso'
           WHEN imc > 18.5 AND imc < 24.99 THEN 'Normal'
           WHEN imc > 25 AND imc < 29.99 THEN 'Acima do Peso'
           WHEN imc > 30 AND imc < 34.99 THEN 'Obesidade'
           WHEN imc > 35 AND imc < 39.99 THEN 'Obesidade II'
           WHEN imc > 40 THEN 'Obesidade III'
        ELSE
            'INVALIDO'
        END as peso,
       count(af.cod_matricula) as clientes
FROM avaliacao_funcional af
INNER JOIN vb_aluno va on af.cod_matricula = va.cod_matricula
group by CASE
           WHEN imc < 17 THEN 'Muito Abaixo do Peso'
           WHEN imc > 17 AND imc <18.49 THEN 'Abaixo do Peso'
           WHEN imc > 18.5 AND imc < 24.99 THEN 'Normal'
           WHEN imc > 25 AND imc < 29.99 THEN 'Acima do Peso'
           WHEN imc > 30 AND imc < 34.99 THEN 'Obesidade'
           WHEN imc > 35 AND imc < 39.99 THEN 'Obesidade II'
           WHEN imc > 40 THEN 'Obesidade III'
        ELSE
            'INVALIDO'
        END
";

$querySexo = "
SELECT
       sexo,
       CASE
        WHEN sexo = 'masculino' THEN SUM(IF(sexo='masculino',1,0))
        ELSE
          SUM(IF(sexo='feminino',1,0))
        END as quantidade
FROM vb_aluno
group by sexo
";

$modalidade = mysqli_query($con, $modalidade);
$queryImc = mysqli_query($con, $queryImc);
$querySexo = mysqli_query($con, $querySexo);

$arDados = array();
while ($row = mysqli_fetch_assoc($modalidade)) {
    $arDados[] = $row;
}

$arImc = array();
while ($row = mysqli_fetch_assoc($queryImc)) {
    $arImc[] = $row;
}

$arSexo = array();
while ($row = mysqli_fetch_assoc($querySexo)) {
    $arSexo[] = $row;
}


$arValor = 0;
foreach ($arDados as $dados) {
    $arValor += $dados['valor'] * 0.20;
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
                            <h1 style="color:#666">Painel Geral</h1>
                            <div class="row">
                                <h3>Lucro Mensal: R$ <label style="color: green">+<?= $arValor; ?></label></h3>
                                <div id="chartModalidades" class="col-md-12"></div>
                            </div>
                            <hr/>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 style="color:#666">Média de IMC dos Alunos</h3>
                                    <div id="chartdiv">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 style="color:#666">Inscritos: Masculino VS Feminino</h3>
                                    <div id="chartdiv2">
                                    </div>
                                </div>
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
    #chartdiv {
        width: 100%;
        height: 500px;
    }

    #chartdiv2 {
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

        var iconPath = "M53.5,476c0,14,6.833,21,20.5,21s20.5-7,20.5-21V287h21v189c0,14,6.834,21,20.5,21 c13.667,0,20.5-7,20.5-21V154h10v116c0,7.334,2.5,12.667,7.5,16s10.167,3.333,15.5,0s8-8.667,8-16V145c0-13.334-4.5-23.667-13.5-31 s-21.5-11-37.5-11h-82c-15.333,0-27.833,3.333-37.5,10s-14.5,17-14.5,31v133c0,6,2.667,10.333,8,13s10.5,2.667,15.5,0s7.5-7,7.5-13 V154h10V476 M61.5,42.5c0,11.667,4.167,21.667,12.5,30S92.333,85,104,85s21.667-4.167,30-12.5S146.5,54,146.5,42 c0-11.335-4.167-21.168-12.5-29.5C125.667,4.167,115.667,0,104,0S82.333,4.167,74,12.5S61.5,30.833,61.5,42.5z"


        var chart = am4core.create("chartdiv", am4charts.SlicedChart);
        chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

        chart.data = <?php echo json_encode($arImc) ?>;

        var series = chart.series.push(new am4charts.PictorialStackedSeries());
        series.dataFields.value = "clientes";
        series.dataFields.category = "peso";
        series.alignLabels = true;

        series.maskSprite.path = iconPath;
        series.ticks.template.locationX = 1;
        series.ticks.template.locationY = 0.5;

        series.labelsContainer.width = 200;

        chart.legend = new am4charts.Legend();
        chart.legend.position = "left";
        chart.legend.valign = "bottom";

    }); // end am4core.ready()


    am4core.ready(function () {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

        var chart = am4core.create("chartdiv2", am4charts.PieChart);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.data = <?php echo json_encode($arSexo) ?>;
        chart.radius = am4core.percent(70);
        chart.innerRadius = am4core.percent(40);
        chart.startAngle = 180;
        chart.endAngle = 360;

        var series = chart.series.push(new am4charts.PieSeries());
        series.dataFields.value = "quantidade";
        series.dataFields.category = "sexo";

        series.slices.template.cornerRadius = 10;
        series.slices.template.innerCornerRadius = 7;
        series.slices.template.draggable = true;
        series.slices.template.inert = true;
        series.alignLabels = false;

        series.hiddenState.properties.startAngle = 90;
        series.hiddenState.properties.endAngle = 90;

        chart.legend = new am4charts.Legend();

    }); // end am4core.ready()
</script>
