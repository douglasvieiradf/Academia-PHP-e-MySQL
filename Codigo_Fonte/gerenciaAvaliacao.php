<?php include "header.php" ?>
<?php
require("conexao.php");
$id_professor = $_SESSION['id_professor'];
$cod_matricula = $_GET['cod_matricula'];

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
                            <p align="center"><h1 style="color:#666">Últimas Avaliações</h1></p><br/>
                            <table class="table table-striped table-hover table-condensed ">
                                <thead>
                                    <tr>
                                        <td style="font-size:16px; color:#000"><strong>Data da Avaliação</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Peso</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Altura</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Peito</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Cintura</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Quadril</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Braço Esquerdo</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Braço Direito</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Coxa Esquerda</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Coxa Direita</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Panturrilha Esquerda</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Panturrilha Direita</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>IMC</strong></td>
                                        <td style="font-size:16px; color:#000"><strong>Deletar</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select id_avaliacao,data_avaliacao,peso, altura, peito, cintura, quadril, "
                                            . "bracoEsquerdo, bracoDireito, coxaEsquerda, coxaDireita , panturrilhaEsquerda, "
                                            . "panturrilhaDireita, imc from avaliacao_funcional where cod_matricula = "
                                            . "$cod_matricula order by data_avaliacao desc;";
                                    $resultado = mysqli_query($con, $sql);

                                    while ($dados = mysqli_fetch_assoc($resultado)) {
                                        ?>

                                        <tr align="center" >
                                            <td><?php echo mostraData($dados['data_avaliacao']); ?></td>
                                            <td><?php echo $dados['peso']; ?> kg</td>
                                            <td><?php echo $dados['altura']; ?>m</td>
                                            <td><?php echo $dados['peito']; ?>cm</td>
                                            <td><?php echo $dados['cintura']; ?>cm</td>
                                            <td><?php echo $dados['quadril']; ?>cm</td>
                                            <td><?php echo $dados['bracoEsquerdo']; ?>cm</td>
                                            <td><?php echo $dados['bracoDireito']; ?>cm</td>
                                            <td><?php echo $dados['coxaEsquerda']; ?>cm</td>
                                            <td><?php echo $dados['coxaDireita']; ?>cm</td>
                                            <td><?php echo $dados['panturrilhaEsquerda']; ?>cm</td>
                                            <td><?php echo $dados['panturrilhaDireita']; ?>cm</td>
                                            <td><strong><?php echo $dados['imc']; ?></strong></td>
                                            <td><a href="deleteAvaliacao.php?cod_matricula=<?php echo $_GET['cod_matricula']; ?>&id_avaliacao=<?php echo $dados['id_avaliacao']; ?>" onClick=" return confirm('Deseja realmente excluir esta avaliação?');">
                                                    <img src="images/delete.png" width="20" title="Excluir Avaliação"/></a></td>
                                        </tr>
<?php } ?>
                            </table>
          <p class="btn btn-primary" ><a class="btn-primary" href="javascript:history.back(-1)">Voltar</a>  </p>    
                  <br/><br/>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php include "footer.php" ?>