<?php include "header.php" ?>
<?php
require("conexao.php");
$id_turma = $_GET['id_turma'];
$modalidade = $_GET['modalidade'];
//$id_usuario = $_SESSION['id_usuario'];
//$nome = $_GET['nome'];
?>

<?php include "menu.php" ?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="color:#666"><br/>&nbsp;&nbsp;Alunos da turma <?php echo $modalidade ?>
                                <a style="position: relative;right: -170px;" align="right" href="novaMatricula.php?id_turma=<?php echo $id_turma; ?>"><img src="images/newaluno.png" style="margin-right:30px;" width="45" border="0" title="Inserir Novo Aluno"/></a>
                            </h2>
                            <div align="right"><br/><br/>
                                <form method="get" action="script_lista.php" class="form-search form-inline">
                                    <label for="exampleInputName2" style="font-size:26px;">Buscar &nbsp;</label>
                                    <input class="form-control" style=" margin-right:20px ;padding: 10px; width: 30%; border:groove; font:Times New Roman, Times, serif; font-size:15px; " type="text" name="pesquisa" autofocus class="input-medium search-query"/>
                                </form><br/><br/>
                            </div>
                            <table class="table table-striped table-hover table-condensed ">
                                <thead>
                                    <tr>
                                        <td style="font-size:22px; color:#000"><strong>Código</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Matrícula</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Nome aluno</strong></td>
                                        <td colspan="6" style="font-size:22px; color:#000"><strong>Opções</strong></td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($_GET['pesquisa'])) {
                                        $pesquisa = $_GET['pesquisa'];
                                        $sql = "SELECT m.id_matricula, m.cod_matricula, a.nome FROM vb_matricula m
				LEFT JOIN vb_aluno a ON m.cod_matricula = a.cod_matricula
				WHERE 
                                (m.id_turma='$id_turma';
                                and 
                                m.id_matricula LIKE '%$pesquisa%'
                                OR
                                m.cod_matricula LIKE '%$pesquisa%'
                                OR
                                a.nome LIKE '%$pesquisa%')
                                WHERE m.id_turma='$id_turma';";
                                } else {
                                        $sql = "SELECT m.id_matricula, m.cod_matricula, a.nome FROM vb_matricula m
				LEFT JOIN vb_aluno a ON m.cod_matricula = a.cod_matricula
				WHERE m.id_turma='$id_turma';";}

                                        $resultado = mysqli_query($con, $sql);

                                        while ($dados = mysqli_fetch_assoc($resultado)) {
                                            ?>

                                            <tr align="center" >
                                                <td><?php echo $dados['id_matricula'] ?></td>
                                                <td><?php echo $dados['cod_matricula']; ?></td>
                                                <td><?php echo $dados['nome']; ?></td>
                                                <td><a href="script_edita.php?id_matricula = <?php echo $dados['id_matricula'];
                                        ?>&cod_matricula=<?php echo $dados['cod_matricula']; ?>&id_turma=<?php echo $_GET['id_turma']; ?>&modalidade=<?php echo $modalidade; ?>">
                                    <img src="images/edit.png" width="20" title="Editar Aluno"/></a>
                                    </td>
                                    <td><a href="script_delete.php?id_matricula=<?php echo $dados['id_matricula']; ?>&cod_matricula=<?php echo $dados['cod_matricula']; ?>&id_turma=<?php echo $id_turma; ?>&modalidade=<?php echo $modalidade; ?>" onClick=" return confirm('Deseja realmente excluir aluno?');">
                                            <img src="images/delete.png" width="20" title="Excluir Aluno"/></a>
                                    </td>
                                    <td><a href="script_trancar.php?id_matricula=<?php echo $dados['id_matricula']; ?>&cod_matricula=<?php echo $dados['cod_matricula']; ?>&id_turma=<?php echo $id_turma; ?>&modalidade=<?php echo $modalidade; ?>" onClick="return confirm('Deseja realmente trancar matrícula?');">
                                            <img src="images/lock.png" width="20" title="Trancar matrícula"/></a>
                                    </td>
                                    <td><a href="avaliacaoFuncional.php?cod_matricula=<?php echo $dados['cod_matricula']; ?>&nome=<?php echo $dados['nome']; ?>&id_turma=<?php echo $_GET['id_turma']; ?>&modalidade=<?php echo $_GET['modalidade']; ?>">
                                            <img src="images/heart.png" width="20" title="Avaliação Funcional"/></a>
                                    </td>
                                    <td><a href="gerenciaAvaliacao.php?cod_matricula=<?php echo $dados['cod_matricula']; ?>&nome=<?php echo $dados['nome']; ?>">
                                            <img src="images/list.png" width="20" title="Gerenciar Avaliações"/></a>
                                    </td>

                                    <td><a href="listaTreino.php?cod_matricula=<?php echo $dados['cod_matricula']; ?>&id_usuario=<?php echo $_SESSION['id_usuario'] ?>&nome=<?php echo $dados['nome']; ?>&id_turma=<?php echo $id_turma; ?>&modalidade=<?php echo $modalidade; ?>">
                                            <img src="images/fa.jpg" width="20" title="Ver Treinos"/></a>
                                    </td><td><a href="montaTreino.php?cod_matricula=<?php echo $dados['cod_matricula']; ?>&id_usuario=<?php echo $_SESSION['id_usuario'] ?>&nome=<?php echo $dados['nome']; ?>&id_turma=<?php echo $id_turma; ?>&modalidade=<?php echo $modalidade; ?>">
                                            <img src="images/aluno.png" width="20" title="Montar Treino"/></a>
                                    </td>
                                    </tr>
                                <?php } ?>
                            </table>

                            <p class="btn btn-primary" ><a class="btn-primary" href="javascript:history.back(-1)">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php include "footer.php" ?>
