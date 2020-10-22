<?php include "header.php" ?>
<?php include "menu.php" ?>

<?php
require ('conexao.php');

function mostraData($data_avaliacao) {
    return date("d/m/Y", strtotime($data_avaliacao));
}

$nome = $_GET['nome'];
$id_usuario = $_SESSION['id_usuario'];
$id_turma = $_GET['id_turma'];
$modalidade = $_GET['modalidade'];

$dados['data_avaliacao'] = "";
$dados['peso'] = "";
$dados['peito'] = "";
$dados['bracoEsquerdo'] = "";
$dados['coxaEsquerda'] = "";
$dados['panturrilhaEsquerda'] = "";
$dados['quadril'] = "";
$dados['altura'] = "";
$dados['cintura'] = "";
$dados['bracoDireito'] = "";
$dados['coxaDireita'] = "";
$dados['panturrilhaDireita'] = "";
$dados['id_usuario'] = "";
$dados['id_professor'] = "";
$dados['cod_matricula'] = "";
$dados['id_turma'] = "";
$dados['modalidade'] = "";

//$dados['nome'] = "";

if (isset($_GET['cod_matricula'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $sql = "select * from vb_professor p 
        LEFT JOIN funcionario f ON f.id_funcionario = p.id_funcionario
        where f.id_usuario = '$id_usuario';";
    $resultado = mysqli_query($con, $sql);
    $dados = mysqli_fetch_assoc($resultado);
}
?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class=" block01">
            <div class="col-md-12">
                <br>
                <br>
                <p align="center"><h1 style="color:#666"> Avaliação Funcional de <?php echo $nome ?> </h1><br/><br/><br/>

                <div class="row">
                    <!--  lado esquerdo !-->
                    <form method="post" action="insereFuncional.php?id_turma=<?php echo $id_turma; ?>&modalidade=<?php echo $modalidade; ?>" >

                        <div class="col-md-6">
                            <div class="form-group text-left" >

                                <div class="form-group text-left" >
                                    <label for="matricula" >
                                        Matricula
                                    </label>
                                    <input name="cod_matricula" disabled class="form-control" id="cod_matricula"  value="<?php echo $_GET['cod_matricula']; ?>"/>
                                </div> 
                                <div class="form-group text-left">
                                    <label for="data_avaliacao">
                                        Data
                                    </label>
                                    <input type="date" class="form-control" id="data_avaliacao" name="data_avaliacao" required value="<?php echo mostraData($dados['data_avaliacao']); ?>"/>
                                </div>

                                <label for="peso" >
                                    Peso (em kg - ex: 54.6 kg)
                                </label>
                                <input name="peso" type="int" class="form-control" id="peso"  required />
                                <input name="cod_matricula" type="hidden" class="form-control" id="cod_matricula"  value="<?php echo $_GET['cod_matricula']; ?>" />
                                <input name="id_professor" type="hidden" class="form-control" id="id_professor"  value="<?php echo $dados['id_professor']; ?>" />
                                <input name="id_turma" type="hidden" class="form-control" id="id_turma"  value="<?php echo $_GET['id_turma']; ?>" />
                                <input name="modalidade" type="hidden" class="form-control" id="modalidade"  value="<?php echo $_GET['modalidade']; ?>" />
                                <input name="nome" type="hidden" class="form-control" id="modalidade"  value="<?php echo $_GET['nome']; ?>" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="peito" >
                                    Peito
                                </label>
                                <input name="peito" type="int" class="form-control" id="peito"  required placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="bracoEsquerdo" >
                                    Braço Esquerdo
                                </label>
                                <input name="bracoEsquerdo" type="int" class="form-control" id="bracoEsquerdo"  required placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="coxaEsquerda" >
                                    Coxa Esquerda
                                </label>
                                <input name="coxaEsquerda" type="int" class="form-control" id="coxaEsquerda"  required placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="panturrilhaEsquerda" >
                                    Panturrilha Esquerda
                                </label>
                                <input name="panturrilhaEsquerda" type="int" class="form-control" id="panturrilhaEsquerda"  required placeholder="" />
                            </div>

                        </div>

                        <!-- Temina lado esquerdo !-->

                        <!-- lado direito !-->
                        <div class="col-md-6">
                            <div class="form-group text-left" >
                                <label for="altura" >
                                    Altura (em m - ex: 1.75 m)
                                </label>
                                <input name="altura" type="text" class="form-control" id="altura"  required placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="cintura" >
                                    Cintura (ex: 60cm)
                                </label>
                                <input name="cintura" type="text" class="form-control" id="cintura"  required placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="bracoDireito" >
                                    Braço Direito
                                </label>
                                <input name="bracoDireito" type="text" class="form-control" id="bracoDireito"  required placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="coxaDireita" >
                                    Coxa Direita
                                </label>
                                <input name="coxaDireita" type="text" class="form-control" id="coxaDireita"  required placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="panturrilhaDireita" >
                                    Panturrilha Direita
                                </label>
                                <input name="panturrilhaDireita" type="text" class="form-control" id="panturrilhaDireita"  required placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="quadril" >
                                    Quadril
                                </label>
                                <input name="quadril" type="int" class="form-control" id="quadril"  required placeholder="" />
                            </div>
                            <br>
                        </div>	 
                        <p class="btn btn-primary" ><a class="btn-primary" href="javascript:history.back(-1)">Voltar</a>  </p>    
                        <button name="salvar" type="submit" class="btn btn-primary">Salvar</button>
                        <button name="limpar" type="reset" class="btn btn-primary">Limpar</button>
                    </form>
                </div>

                <!-- Temina lado direito !-->
            </div>
        </div>
    </div>
</div>
</section>

<?php include "footer.php" ?>
