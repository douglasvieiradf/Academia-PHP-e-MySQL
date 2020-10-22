<?php include "header.php" ?>
<?php
require("conexao.php");
$nome = $_GET['nome'];
$cod_matricula = $_GET['cod_matricula'];
$id_usuario = $_SESSION['id_usuario'];
$id_turma = $_GET['id_turma'];
$modalidade = $_GET['modalidade'];
if (isset($_GET['id_ficha']) and $_GET['id_ficha'] != '') {
    $id_ficha = $_GET['id_ficha'];
    $action = "insereFicha.php?tipo=edita&id_ficha=" . $_GET['id_ficha'];
    $sql_ficha = "SELECT * FROM ficha WHERE  id_ficha = '$id_ficha'";
    $resultficha = mysqli_query($con, $sql_ficha);
    $dados_ficha = mysqli_fetch_assoc($resultficha);
    //print_r($dados_ficha);
} else {
    $action = "insereFicha.php?tipo=insere";
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
                            <h1 style="color:#666"><br/>Montar Treino</h1><br/>
                        </div>
                        <form method="post" action="<?php echo $action; ?>" >
                            <input type="hidden" name="cod_matricula" value="<?php echo $_GET['cod_matricula']; ?>"  />
                            <input type="hidden" name="id_turma" value="<?php echo $_GET['id_turma']; ?>"  />
                            <input type="hidden" name="modalidade" value="<?php echo $_GET['modalidade']; ?>"  />

                            <div class="col-md-1">
                                &nbsp;
                            </div>

                            <div class="col-md-10">

                                <div class="panel panel-primary">
                                    <div class="panel-heading"><b>Ficha do Aluno</b></div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="form-group text-left">
                                                    <br/>
                                                    <label for="nome">
                                                        Nome completo 
                                                    </label>
                                                    <input type="text" readonly class="form-control" id="nome" name="nome" required value="<?php echo $nome ?>"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group text-left">
                                                    <label for="inicioTreino">
                                                        Iniciar treino em:
                                                    </label>
                                                    <input type="date" class="form-control" id="inicio_treino" name="inicio_treino" required value="<?php
                                                    if (isset($dados_ficha)) {
                                                        echo $dados_ficha['inicio_treino'];
                                                    }
                                                    ?>"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group text-left">
                                                    <label for="fimTreino">
                                                        Executar treino até:
                                                    </label>
                                                    <input type="date" class="form-control" id="fim_treino" name="fim_treino" required value="<?php
                                                    if (isset($dados_ficha)) {
                                                        echo $dados_ficha['fim_treino'];
                                                    }
                                                    ?>"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="form-group text-left">
                                                    <br/>
                                                    <label for="observacoes">
                                                        Observações
                                                    </label>
                                                    <textarea placeholder=""  name="observacoes" type="text" class="form-control" id="observacoes" rows=5" /><?php
                                                    if (isset($dados_ficha)) {
                                                        echo $dados_ficha['observacoes'];
                                                    }
                                                    ?></textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group text-right">

                                                <input class="btn btn-primary" type="submit" name="enviar" id="enviar" value="Salvar">
                                            </div>
                                        </div>



                                    </div>

                                </div>

                            </div>
                        </form>
                        <div class="col-md-1">
                            &nbsp;
                        </div>

                        <div class="col-md-12">
                            <br/>&nbsp;
                        </div>
                        <div class="col-md-1">
                            &nbsp;
                        </div>
                        <?php if (isset($_GET['id_ficha']) and $_GET['id_ficha'] != '') { ?>

                            <form action="insereTreino.php" method="post" >
                                <div class="col-md-10">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading"><b>Inserir Exercício</b></div>
                                        <input type="hidden" name="id_ficha" value="<?php echo $_GET['id_ficha']; ?>" />
                                        <input type="hidden" name="nome" value="<?php echo $nome ?>" />
                                        <input type="hidden" name="cod_matricula" value="<?php echo $_GET['cod_matricula']; ?>"  />
                                        <input type="hidden" name="id_ficha" value="<?php echo $_GET['id_ficha']; ?>"  />
                                        <input type="hidden" name="id_turma" class="form-control" id="id_turma"  value="<?php echo $id_turma; ?>" />
                                        <input type="hidden" name="modalidade" class="form-control" id="modalidade"  value="<?php echo $modalidade; ?>" />
                                        <div class="panel-body">

                                            <div class="col-md-5">
                                                <div class="form-group text-left">
                                                    <br/>
                                                    <div class="loading" style="display: inline-block;float: right;position: relative; bottom: -30px;left: 25px;"></div>
                                                    <label for="tipoExercicio">
                                                        Tipo de Exercício
                                                    </label>

                                                    <?php
                                                    $sql_exercicio = "select distinct tipoExercicio from exercicio;";
                                                    $result_exercicio = mysqli_query($con, $sql_exercicio);
                                                    ?>

                                                    <select class="form-control" id="tipoExercicio" name="tipoExercicio" required onchange="return carregaExercicios(this.value);" >
                                                        <option> Selecione </option>                                                   
                                                        <?php
                                                        while ($dados_exercicio = mysqli_fetch_assoc($result_exercicio)) {
                                                            ?>
                                                            <option value="<?php echo $dados_exercicio['tipoExercicio']; ?>"     

                                                                    >
                                                                        <?php echo $dados_exercicio ['tipoExercicio']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-md-7">
                                                <div class="form-group text-left">
                                                    <br/>
                                                    <label for="exercicio">
                                                        Exercício
                                                    </label>
                                                    <div class="cexercicio">
                                                        <select class="form-control" name="exercicio">
                                                            <option> Selecione o tipo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group text-left">
                                                    <br/>
                                                    <label for="serie">
                                                        Série
                                                    </label>
                                                    <input type="number" class="form-control" id="serie" name="serie" required value=""/>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group text-left">
                                                    <br/>
                                                    <label for="repeticao">
                                                        Repetições
                                                    </label>
                                                    <input type="number" class="form-control" id="repeticao" name="repeticao" required value=""/>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group text-left">
                                                    <br/>
                                                    <label for="carga">
                                                        Carga
                                                    </label>
                                                    <input class="form-control" id="carga" name="carga" required value=""/>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <br/>
                                                <div class="form-group text-left">

                                                    <button type="submit" class="btn btn-primary" style="margin-top: 22px !important;" title="Adicionar novo"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add Novo</button>



                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </form>

                            <div class="col-md-1">
                                &nbsp;
                            </div>


                            <div class="col-md-12">
                                <br/>&nbsp;
                            </div>
                            <div class="col-md-1">
                                &nbsp;
                            </div>
                            <div class="col-md-10">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><b>Treino</b></div>
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <table class="table table-striped table-hover table-condensed ">
                                                <thead>
                                                    <tr>
                                                        <td style="font-size:18px; color:#000"><strong>Exercício</strong></td>
                                                        <td style="font-size:18px; color:#000"><strong>Tipo</strong></td>
                                                        <td style="font-size:18px; color:#000"><strong>Séries</strong></td>
                                                        <td style="font-size:18px; color:#000"><strong>Repetições</strong></td>
                                                        <td style="font-size:18px; color:#000"><strong>Carga</strong></td>
                                                        <td style="font-size:18px; color:#000"><strong>Excluir</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_treino = "SELECT id_treino, id_ficha, e.exercicio, e.tipoExercicio, serie, repeticao, carga FROM treino t
                                        LEFT JOIN exercicio e ON e.id_exercicio = t.id_exercicio
                                        WHERE id_ficha =  '$id_ficha' ORDER BY e.tipoExercicio;";

                                                    $result_treino = mysqli_query($con, $sql_treino);
                                                    //$dadosTreino = mysqli_fetch_assoc($result_treino);
                                                    ?>
                                                    <?php
                                                    while ($dadosTreino = mysqli_fetch_array($result_treino)) {
                                                        ?>
                                                        <tr>
                                                            <td ><?php echo $dadosTreino['exercicio'] ?></td>
                                                            <td ><?php echo $dadosTreino['tipoExercicio'] ?></td>
                                                            <td ><?php echo $dadosTreino['serie'] ?></td>
                                                            <td ><?php echo $dadosTreino['repeticao'] ?></td>
                                                            <td ><?php echo $dadosTreino['carga'] ?> kg</td>
                                                            <td><a href="deleteExercicio.php?cod_matricula=<?php echo $cod_matricula; ?>&id_treino=<?php echo $dadosTreino['id_treino']; ?>&id_ficha=<?php echo $id_ficha; ?>&id_usuario=<?php echo $id_usuario; ?>&nome=<?php echo $nome; ?>&id_turma=<?php echo $id_turma; ?>&modalidade=<?php echo $modalidade; ?>" onClick=" return confirm('Deseja realmente excluir exercício?');">
                                                                    <img src="images/delete.png" width="20" title="Deletar Exercício"/></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </form> <br/>
                    </div><!--div da row-->
                </div><br/><a href="script_lista.php?nome=<?php echo $_GET['nome']; ?>&id_turma=<?php echo $id_turma; ?>&modalidade=<?php echo $modalidade; ?>"><Tbutton class="btn btn-primary">Voltar à Turma</button></a>

            </div>

        </div>
    </div>
</section>
<?php include "footer.php" ?>
<script type="text/javascript">

    function carregaExercicios(tipo) {
        $.ajax({
            type: "POST",
            url: "carrega_exercicios.php",
            data: {
                tipo: tipo
            },
            beforeSend: function () {
                $('.loading').show();
                var a = '<div><img src="images/loading.gif" width="23" border="0" style=""/></div>';
                $('.loading').html(a);
            },
            success: function (data) {
                $('.loading').fadeOut();
                $('.cexercicio').fadeOut();
                $('.cexercicio').fadeIn();
                $('.cexercicio').html(data);
            }
        })
    }
    ;

</script>
