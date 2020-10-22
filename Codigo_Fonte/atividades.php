<?php include "header.php" ?>
<?php
require('conexao.php');

$sqlTotal = "SELECT * FROM vb_modalidade;";
$qrTotal = mysqli_query($con, $sqlTotal) or die(mysqli_error());
$numTotal = mysqli_num_rows($qrTotal);

//a pagina atual
if (isset($_GET['pagina']) AND $_GET['pagina'] != '') {
    $pagina = $_GET['pagina'];
} else {
    $pagina = 1;
}

//A quantidade de valor a ser exibida
$qtdPaginas = 30;

//Total de Registro na tabela
$totalPagina = ceil($numTotal / $qtdPaginas);

//Calcula a pagina de qual valor será exibido
$inicio = ($qtdPaginas * $pagina) - $qtdPaginas;

$exibir = 3;
$anterior = (($pagina - 1) == 0) ? 1 : $pagina - 1;
$posterior = (($pagina + 1) >= $exibir) ? $exibir : $pagina + 1;
?>

<?php include "menu.php" ?>

<!--------------Content--------------->
<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                            <div id="lista">

                                <br/><br/><p><h1 align="left" style="font-size:65px;color: #d41319"><b>&nbsp;&nbsp;&nbsp;Lista de Atividades</b></h1></p><br/><br/>
                            </div>

                            <div align="right">
                                <form method="get" action="atividades.php" class="form-search form-inline">
                                    <label for="exampleInputName2" style="font-size:26px;">Buscar &nbsp;</label>
                                    <input class="form-control" style=" margin-right:20px ;padding: 10px; width: 30%; border:groove; font:Times New Roman, Times, serif; font-size:15px; " type="text" name="pesquisa" autofocus class="input-medium search-query"/>
                                </form><br/><br/>
                            </div><br/>

                            <table class="table table-striped table-hover table-condensed ">
                                <thead>
                                    <tr>
                                        <td style="font-size:22px; color:#000"><strong>Cód.</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Modalidade</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Dias</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Horário</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Professor</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Mensalidade</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['pesquisa'])) {
                                        $pesquisa = $_GET['pesquisa'];

                                        $sql = "SELECT id_turma, m.nome as modalidade, dia, horario, f.nome as professor, m.valor_mensal as mensalidade 
                                        FROM vb_turma t
                                        LEFT JOIN vb_modalidade m ON t.id_modalidade = m.id_modalidade
                                        LEFT JOIN vb_professor p ON p.id_professor = t.id_professor
                                        LEFT JOIN funcionario f ON f.id_funcionario = p.id_funcionario
                                        LEFT JOIN vb_dias d ON d.id_dia = t.id_dia
				  	WHERE 
				  	id_turma LIKE '%$pesquisa%'
				  	OR
				  	m.nome LIKE '%$pesquisa%'
				  	OR
				  	dia LIKE '%$pesquisa%'
				  	OR
				  	horario LIKE '%$pesquisa%'
				  	OR 
				  	f.nome LIKE '%$pesquisa%'
				  	OR
				  	m.valor_mensal LIKE '%$pesquisa%'
					LIMIT $inicio, $qtdPaginas
					;";
                                    } else {
                                        $sql = "SELECT id_turma, m.nome as modalidade, dia, horario, f.nome as professor, m.valor_mensal as mensalidade 
                                        FROM vb_turma t
                                        LEFT JOIN vb_modalidade m ON t.id_modalidade = m.id_modalidade
                                        LEFT JOIN vb_professor p ON p.id_professor = t.id_professor
                                        LEFT JOIN funcionario f ON f.id_funcionario = p.id_funcionario
                                        LEFT JOIN vb_dias d ON d.id_dia = t.id_dia
					LIMIT $inicio, $qtdPaginas
					;";
                                    }
                                    $resultado = mysqli_query($con, $sql);

                                    while ($dados = mysqli_fetch_assoc($resultado)) {
                                        ?>

                                        <tr align="center" >
                                            <td><?php echo $dados['id_turma']; ?></td>
                                            <td class=""><?php echo $dados['modalidade']; ?></td>
                                            <td class=""><?php echo $dados['dia']; ?></td>
                                            <td class=""><?php echo $dados['horario']; ?></td>
                                            <td class=""><?php echo $dados['professor']; ?></td>
                                            <td class=""><?php echo "R$" . $dados['mensalidade']; ?></td>
                                        </tr>
                                    <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div align="center">

            <?php
            echo '<a class=linked href="?pagina=1">primeira</a> | ';
            echo "<a class=linked href=\"?pagina=$anterior\">anterior</a> | ";
            ?>

            <?php
            for ($i = $pagina - $exibir; $i <= $pagina - 1; $i++) {
                if ($i > 0)
                    echo '<a class=linked href="?pagina=' . $i . '"> ' . $i . ' </a>';
            }

            echo '<a class=linked href="?pagina=' . $pagina . '"><strong>' . $pagina . '</strong></a>';

            for ($i = $pagina + 1; $i < $pagina + $exibir; $i++) {
                if ($i <= $exibir)
                    echo '<a class=linked href="?pagina=' . $i . '"> ' . $i . ' </a>';
            }
            ?>
            <?php
            echo " | <a class=linked href=\"?pagina=$posterior\">próxima</a> | ";
            echo "  <a class=linked href=\"?pagina=$exibir\">última</a>";
            ?>

        </div>


        <div class=""><!--------------Essa e a div da fundo branco parte 2--------------->
            <br/><h1 align="center" style="color: #000"><b>SUA SAÚDE É O NOSSO FOCO! </b></h1>
            <p class="texto">A academia Fitness oferece aos seus clientes uma academia diferente de todas as outras. Porque em suas
                unidades pelo DF você encontra equipamentos de última geração, professores qualificados e modalidades 
                para todos os gostos e idades. Tudo isso, por preço acessíveis. O melhor lugar para você praticar saúde
                em família é aqui. <br/><br/>
                <a class="link" href="faleConosco.php">TIRE AQUI SUAS DÚVIDAS</a> <p><br/>

        </div>
    </div>
</section>

<?php include "footer.php" ?>

