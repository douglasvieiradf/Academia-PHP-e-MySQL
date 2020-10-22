<?php include "header.php" ?>
<?php
require("conexao.php");
$id_turma = $_GET['id_turma'];
$modalidade = $_GET['modalidade'];
?>

<?php include "menu.php" ?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">


                            <p align="center"><h2 style="color:#666"><br/>&nbsp;&nbsp;Alunos da turma <?php echo $modalidade ?> </h2></p>
                            <table class="table table-striped table-hover table-condensed ">
                                <thead>
                                    <tr>
                                        <td style="font-size:22px; color:#000"><strong>Código</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Matrícula</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Nome aluno</strong></td>
                                        <td colspan="5" style="font-size:22px; color:#000"><strong>Opções</strong></td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT m.id_matricula, m.cod_matricula, a.nome FROM vb_matricula m
				LEFT JOIN vb_aluno a ON m.cod_matricula = a.cod_matricula
				WHERE m.id_turma='$id_turma';
				";

                                    $resultado = mysqli_query($con, $sql);

                                    while ($dados = mysqli_fetch_assoc($resultado)) {
                                        ?>

                                        <tr align="center" >
                                            <td><?php echo $dados['id_matricula'] ?></td>
                                            <td><?php echo $dados['cod_matricula']; ?></td>
                                            <td><?php echo $dados['nome']; ?></td>
                                            <td><a href="" >
                                                    <img src="images/personal.png" width="20" title="Ver Dados"/></a>
                                            </td>
                                            <td><a href="" >
                                                    <img src="images/edit.png" width="20" title="Editar Aluno"/></a>
                                            </td>
                                            <td><a href="" >
                                                    <img src="images/delete.png" width="20" title="Excluir Aluno"/></a>
                                            </td>
                                            <td><a href="script_trancar.php?id_matricula=<?php echo $dados['id_matricula']; ?>&cod_matricula=<?php echo $dados['cod_matricula']; ?>&id_turma=<?php echo $id_turma; ?>&modalidade=<?php echo $modalidade; ?>" onClick="return confirm('Deseja realmente trancar matrícula?');">
                                                    <img src="images/lock.png" width="20" title="Trancar matrícula"/></a>
                                            </td>
                                            <td><a href="avaliacaoFuncional.php" >
                                                    <img src="images/list.png" width="20" title="Avaliação Funcional"/></a>
                                            </td>
                                        </tr>

                                    <?php } ?>
                            </table>

                        <a href="javascript:history.back(-1)"><img src="images/back.png" width="40" border="0" title="Voltar"/></a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php include "footer.php" ?>