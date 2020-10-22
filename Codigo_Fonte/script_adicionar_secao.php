<?php include "header.php" ?>
<?php
require("conexao.php");
$id_exercicio = $_GET['id_exercicio'];
$id_ficha = $_GET['id_ficha'];
$cod_matricula = $_GET['cod_matricula'];
$nome = $_GET['nome'];
$inicio_treino = $_GET['inicio_treino'];
$fim_treino = $_GET['fim_treino'];
$observacoes = $_GET['observacoes'];
$id_usuario = $_SESSION['id_usuario'];
//$id_usuario = $_SESSION['id_usuario'];
//$nome = $_GET['nome'];
?>

<?php include "menu.php" ?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
        <form method="post" action="insereSecao.php" >
                                                            <div class="row">
                                                            <div class="col-md-3" style="margin-left: 20px">
                                                            <input type='hidden' name='id_ficha' value='<?php echo "$id_ficha";?>'/> 
                                                            <input type='hidden' name='id_exercicio' value='<?php echo "$id_exercicio";?>'/> 
                                                            <input type='hidden' name='cod_matricula' value='<?php echo "$cod_matricula";?>'/> 
                                                            <input type='hidden' name='nome' value='<?php echo "$nome";?>'/> 
                                                            <input type='hidden' name='inicio_treino' value='<?php echo "$inicio_treino";?>'/> 
                                                            <input type='hidden' name='fim_treino' value='<?php echo "$fim_treino";?>'/> 
                                                            <input type='hidden' name='observacoes' value='<?php echo "$observacoes";?>'/> 
                                                            <input type='hidden' name='id_usuario' value='<?php echo "$id_usuario";?>'/> 
                                                            <div class="form-group text-left">
                                                                <label for="data_secao">
                                                                    Data
                                                                </label>
                                                                <input type="date" class="form-control" id="data_secao" name="data_secao" placeholder="" />
                                                            </div>
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
                                                                $id_ficha = $id_ficha;
                                                                ?>
                                                    </form>
        </div>
    </div>
</section>
<?php include "footer.php" ?>