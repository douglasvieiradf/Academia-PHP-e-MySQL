<?php include "header.php" ?>
<?php
require("conexao.php");
$cod_matricula = $_GET['cod_matricula'];
$nome = $_GET['nome'];
$id_usuario = $_SESSION['id_usuario'];
$id_turma = $_GET['id_turma'];
$modalidade = $_GET['modalidade'];

function mostraData($data) {
    return date("d/m/Y", strtotime($data));
}
?>

<?php include "menu.php" ?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                            <h2 style="color:#666"><br/>&nbsp;&nbsp;Fichas do Aluno <?php echo $nome ?> 
                                <a class="btn btn-info" style="position: relative;right: -170px;" align="right" href="montaTreino.php?cod_matricula=<?php echo $cod_matricula; ?>&id_usuario=<?php echo $_SESSION['id_usuario'] ?>&nome=<?php echo $nome; ?>&id_turma=<?php echo $id_turma; ?>&modalidade=<?php echo $modalidade; ?>"><img src="images/aluno.png" style="margin-right:0px;" width="60" border="0" title="Inserir Nova Ficha e treinos"/></a>
                            </h2>

                            <table class="table table-striped table-hover table-condensed ">
                                <thead>
                                    <tr>
                                        <td style="font-size:22px; color:#000"><strong>Código</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Início</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Fim</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Observações</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Professor</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Ver Treino</strong></td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT f.*, fu.nome as nome_funcionario FROM ficha f
                                LEFT JOIN vb_professor p ON p.id_professor = f.id_professor
                                LEFT JOIN funcionario fu ON p.id_funcionario = fu.id_funcionario
				WHERE f.cod_matricula='$cod_matricula' order by id_ficha desc;
				";

                                    $resultado = mysqli_query($con, $sql);

                                    while ($dados = mysqli_fetch_assoc($resultado)) {
                                        ?>

                                        <tr align="center" >
                                            <td><?php echo $dados['id_ficha'] ?></td>
                                            <td><?php echo mostraData($dados['inicio_treino']); ?></td>
                                            <td><?php echo mostraData($dados['fim_treino']); ?></td>
                                            <td><?php echo $dados['observacoes']; ?></td>
                                            <td><?php echo $dados['nome_funcionario']; ?></td> 
                                            <td><a href="verTreino.php?id_ficha=<?php echo $dados['id_ficha']; ?>&cod_matricula=<?php echo $dados['cod_matricula']; ?>&nome=<?php echo $nome ?>&inicio_treino=<?php echo $dados['inicio_treino'] ?>&fim_treino=<?php echo $dados['fim_treino'] ?>&observacoes=<?php echo $dados['observacoes'] ?>">
                                                    <img src="images/fa.jpg" width="20" title="Treino Completo"/></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                            </table>

                            <p class="btn btn-primary" ><a class="btn-primary" href="javascript:history.back(-1)">Voltar</a>  </p>    

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php include "footer.php" ?>