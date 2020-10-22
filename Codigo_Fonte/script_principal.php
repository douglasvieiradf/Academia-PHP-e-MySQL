<?php include "header.php" ?>
<?php
require("conexao.php");
$id_professor = $_SESSION['id_professor'];
?>

<?php include "menu.php" ?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <p align="center">
                            <h1 style="color:#666">Suas turmas</h1></p><br/>
                            <div align="right"><br/>
                                <form method="get" action="script_principal.php" class="form-search form-inline">
                                    <label for="exampleInputName2" style="font-size:26px;">Buscar &nbsp;</label>
                                    <input class="form-control"
                                           style=" margin-right:20px ;padding: 10px; width: 30%; border:groove; font:Times New Roman, Times, serif; font-size:15px; "
                                           type="text" name="pesquisa" autofocus class="input-medium search-query"/>
                                </form>
                                <br/>
                            </div>
                            <table class="table table-striped table-hover table-condensed ">
                                <thead>
                                <tr>
                                    <td style="font-size:22px; color:#000"><strong>Cód.</strong></td>
                                    <td style="font-size:22px; color:#000"><strong>Modalidade</strong></td>
                                    <td style="font-size:22px; color:#000"><strong>Dias</strong></td>
                                    <td style="font-size:22px; color:#000"><strong>Horário</strong></td>
                                    <td style="font-size:22px; color:#000"><strong>Turma</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($_GET['pesquisa'])) {
                                    $pesquisa = $_GET['pesquisa'];
                                    $sql = "
                                        SELECT t.id_turma, m.nome as modalidade, d.dia, horario, u.login FROM vb_turma as t 
                                        LEFT JOIN vb_professor p ON t.id_professor = p.id_professor
                                                        LEFT JOIN funcionario f ON f.id_funcionario = p.id_funcionario
                                        LEFT JOIN vb_usuarios u ON u.id_usuario = f.id_usuario
                                        LEFT JOIN vb_modalidade m ON t.id_modalidade = m.id_modalidade
                                        LEFT JOIN vb_dias d ON d.id_dia = t.id_dia
                                        WHERE 
                                        (m.nome LIKE '%$pesquisa%'
                                        OR
                                        d.dia LIKE '%$pesquisa%'
                                        OR 
                                        horario LIKE '%$pesquisa%') and t.id_professor = '$id_professor' ;";
                                } else {
                                    $sql = "
                                        SELECT t.id_turma, m.nome as modalidade, d.dia, horario, u.login FROM vb_turma as t 
                                        LEFT JOIN vb_professor p ON t.id_professor = p.id_professor
                                                        LEFT JOIN funcionario f ON f.id_funcionario = p.id_funcionario
                                        LEFT JOIN vb_usuarios u ON u.id_usuario = f.id_usuario
                                        LEFT JOIN vb_modalidade m ON t.id_modalidade = m.id_modalidade
                                        LEFT JOIN vb_dias d ON d.id_dia = t.id_dia
                                                        WHERE t.id_professor = '$id_professor';";
                                }

                                $resultado = mysqli_query($con, $sql);

                                while ($dados = mysqli_fetch_assoc($resultado)) {
                                    ?>

                                    <tr align="center">
                                        <td><?php echo $dados['id_turma']; ?></td>
                                        <td class=""><?php echo $dados['modalidade']; ?></td>
                                        <td class=""><?php echo $dados['dia']; ?></td>
                                        <td class=""><?php echo $dados['horario']; ?></td>
                                        <td class=""><a
                                                    href="script_lista.php?id_turma=<?php echo $dados['id_turma']; ?>&modalidade=<?php echo $dados['modalidade']; ?>">
                                                <img src="images/search.png" width="20" title="Ver alunos"/></a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <br/><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "footer.php" ?>
