<?php include "header.php" ?>
<?php
require("conexao.php");
$cod_matricula = $_GET['cod_matricula'];
$nome = $_GET['nome'];
$inicio_treino = $_GET['inicio_treino'];
$fim_treino = $_GET['fim_treino'];
$observacoes = $_GET['observacoes'];
$id_usuario = $_SESSION['id_usuario'];
$id_ficha = $_GET['id_ficha'];

function mostraData($data) {
    return date("d/m/Y", strtotime($data));
}
?>

<?php include "menu.php" ?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01" id="pprint"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                            <div class="col-md-1">
                                &nbsp;
                            </div>

                            <div class="col-md-10"><div class="panel panel-primary">
                            </br>
                            </br>
                            
                            
                                    <div class="panel-heading"><b>Ficha do Aluno</b></div>
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="col-md-12"><br/><br/>
                                                <div class="form-group text-left">
                                                    <br/><b>
                                                        <input type="text" readonly class="form-control" id="nome" name="nome" required value="<?php echo $nome ?>"/>
                                                    </b></div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group text-left">
                                                    <label for="inicioTreino">
                                                        Iniciar treino em:
                                                    </label>
                                                    <input type="date" readonly class="form-control" id="inicio_treino" name="inicio_treino" required value="<?php echo $inicio_treino ?>"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group text-left">
                                                    <label for="fimTreino">
                                                        Executar treino até:
                                                    </label>
                                                    <input type="date" readonly class="form-control" id="fim_treino" name="fim_treino" required value="<?php echo $fim_treino ?>"/>
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
                                                    <textarea readonly name="observacoes" type="text" class="form-control" id="observacoes" rows=5" /><?php echo $observacoes ?></textarea>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><b>Treino do Aluno <?php echo $nome ?></b></div>
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
                                                        <td style="font-size:18px; color:#000"><strong>Adicionar Seção</strong></td>
                                                        <td style="font-size:18px; color:#000"><strong>Desempenho</strong></td>
                                                   
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_treino = "select e.exercicio, e.tipoExercicio, e.id_exercicio, serie, repeticao,carga from treino t
                                                    left join exercicio e ON e.id_exercicio = t.id_exercicio
                                                    WHERE id_ficha = '$id_ficha' ORDER BY e.exercicio ;";

                                                    $result_treino = mysqli_query($con, $sql_treino);
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
                                                            <td>
                                                            <a href="script_adicionar_secao.php?id_exercicio=<?php echo $dadosTreino['id_exercicio']; ?>&id_ficha=<?php echo $id_ficha ?>&cod_matricula=<?php echo $cod_matricula; ?>&nome=<?php echo $nome ?>&inicio_treino=<?php echo $inicio_treino ?>&fim_treino=<?php echo $fim_treino ?>&observacoes=<?php echo $observacoes ?>">
                                                                    <img src="images/plus1.png" width="20" title="Adicionar Seção"/>
                                                            </a>
                                                            </td>
                                                            <td>
                                                            <a href="graficoSecao.php?id_exercicio=<?php echo $dadosTreino['id_exercicio']; ?>">
                                                                    <img src="images/aluno.png" width="20" title="Ver desempenho"/>
                                                            </a>
                                                            </td>
                                                        </tr>
                                                        
                                                       
                                                            <!-- Modal
                                                            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar nova seção</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                  
                                                            <form method="post" action="insereSecao.php" >
                                                            <div class="row">
                                                            <div class="col-md-3" style="margin-left: 20px">
                                                            <input type='hidden' name='id_ficha' value='<?php //echo "$id_ficha";?>'/> 
                                                            <input type='hidden' name='id_exercicio' value='<?php //echo "$dadosTreino";?>'/> 
                                                                    <div class="form-group text-left" >
                                                                        <label for="series" >
                                                                            Séries
                                                                        </label>
                                                                        <input name="series" type="text" class="form-control" id="serie"   placeholder="" />
                                                                    
                                                                    </div>
                                                                    <div class="form-group text-left" >
                                                                        <label for="repeticoes" >
                                                                            Repetições
                                                                        </label>
                                                                        <input name="repeticoes" type="text" class="form-control" id="repeticoes"   placeholder="" />
                                                                    </div>
                                                                    <div class="form-group text-left" >
                                                                        <label for="carga" >
                                                                            Carga
                                                                        </label>
                                                                        <input name="carga" type="text" class="form-control" id="carga"   placeholder="" />
                                                                    </div>
                                                                </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                                    
                                                    <button type="submit" class="btn btn-primary"  title="Adicionar novo"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Adicionar</button>


                                                                </div>
                                                                <?php
                                                                //$id_ficha = $id_ficha;
                                                                ?>
                                                    </form>
                                                     -->

                      
                                         
                                                                </div>
                                                            </div>
                                                            </div>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                &nbsp;
                            </div>

                        </div>

                    </div> 
                </div>
            </div><br/><p class="btn btn-primary" ><a class="btn-primary" href="javascript:history.back(-1)">Voltar</a>  </p>    
            <button class="btn btn-primary" onclick="javascript:printDiv('pprint');">Imprimir treino</button><br/><br/><br/><br/>


        </div>
    </div>
</section>
<?php include "footer.php" ?>
<script language="javascript" type="text/javascript">
    function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML =
                "<html><head><title></title></head><body>" +
                divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;


    }
</script>