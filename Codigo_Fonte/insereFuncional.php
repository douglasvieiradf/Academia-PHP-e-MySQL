<?php include "header.php" ?>
<?php include "menu.php" ?>
<?php
$id_usuario = $_SESSION['id_usuario'];
$id_turma = $_GET['id_turma'];
$modalidade = $_GET['modalidade'];
$nome = $_POST['nome'];
?>

<div class="featured" >
    <section id="content">
        <div class="wrap-content zerogrid">
            <div class="row block01">
                <div class="col-md-12" >
                    <div class="row block01" id="pprint">
                        <div class="container-fluid">
                            <div class="">
                                <fieldset>
                                    <h1 style="color:#666"><br/>&nbsp;&nbsp;Cálculo IMC
                                        <a class="btn btn-info" style="position: relative;right: -170px;" align="right" href="montaTreino.php?cod_matricula=<?php echo $_POST['cod_matricula']; ?>&id_usuario=<?php echo $_SESSION['id_usuario'] ?>&nome=<?php echo $_POST['nome'] ?>&id_turma=<?php echo $_GET['id_turma'] ?>&modalidade=<?php echo $_GET['modalidade'] ?>"><img src="images/aluno.png" style="margin-right:0px;" width="60" border="0" title="Montar treino"/></a>
                                    </h1>
                                    <?php
                                    require ('conexao.php');
                                    $data_avaliacao = str_replace(',', '.', $_POST['data_avaliacao']);
                                    $peso = str_replace(',', '.', $_POST['peso']);
                                    $peito = str_replace(',', '.', $_POST['peito']);
                                    $bracoEsquerdo = str_replace(',', '.', $_POST['bracoEsquerdo']);
                                    $coxaEsquerda = str_replace(',', '.', $_POST['coxaEsquerda']);
                                    $panturrilhaEsquerda = str_replace(',', '.', $_POST['panturrilhaEsquerda']);
                                    $quadril = str_replace(',', '.', $_POST['quadril']);
                                    $altura = str_replace(',', '.', $_POST['altura']);
                                    $cintura = str_replace(',', '.', $_POST['cintura']);
                                    $bracoDireito = str_replace(',', '.', $_POST['bracoDireito']);
                                    $coxaDireita = str_replace(',', '.', $_POST['coxaDireita']);
                                    $panturrilhaDireita = str_replace(',', '.', $_POST['panturrilhaDireita']);
                                    $id_professor = str_replace(',', '.', $_POST['id_professor']);
                                    $cod_matricula = str_replace(',', '.', $_POST['cod_matricula']);



                                    $imc = 0;
                                    if ($altura != 0) {
                                        $conta1 = $altura * $altura;
                                        @$imc = $peso / $conta1;
                                        echo "<h2> O Indice de Massa Corporal é : <b>" . round($imc, 2) . "</b><br/>";


                                        if ($imc < 17) {
                                            echo "Aluno muito abaixo do peso</h2><br/>";
                                        } else if ($imc > 17 && $imc < 18.49) {
                                            echo "Aluno está abaixo do peso</h2><br/>";
                                        } else if ($imc > 18.5 && $imc < 24.99) {
                                            echo "Aluno com peso normal</h2><br/>";
                                        } else if ($imc > 25 && $imc < 29.99) {
                                            echo "Aluno acima do peso</h2><br/>";
                                        } else if ($imc > 30 && $imc < 34.99) {
                                            echo "Aluno com obesidade tipo I</h2><br/>";
                                        } else if ($imc > 35 && $imc < 39.99) {
                                            echo "Aluno com obesidade tipo II (severa)</h2><br/>";
                                        } else if ($imc > 40) {
                                            echo "Aluno com obesidade tipo III (mórbida)</h2><br/>";
                                        }
                                    }



                                    $sql = "INSERT INTO avaliacao_funcional
			(data_avaliacao, peso, peito, bracoEsquerdo, coxaEsquerda, panturrilhaEsquerda, quadril, altura, cintura,  bracoDireito, coxaDireita, panturrilhaDireita,imc, id_professor, cod_matricula) 
			VALUES('$data_avaliacao','$peso','$peito','$bracoEsquerdo','$coxaEsquerda','$panturrilhaEsquerda','$quadril','$altura',
			'$cintura','$bracoDireito','$coxaDireita','$panturrilhaDireita','$imc','$id_professor','$cod_matricula');";

                                    //echo $sql;
                                    //exit;

                                    if (mysqli_query($con, $sql)) {

                                        echo '<h3 class="alert alert-success" style="color:#666">Dados cadastrados com sucesso!</h3><br/>';
                                    } else {

                                        echo "Não cadastrado<br/>";
                                    }
                                    ?>
                                    <!--bgcolor="#FFFF99" bgcolor="#F7F7F7"-->
                                    <div align="center">
                                        <input name="id_turma" type="hidden" class="form-control" id="id_turma"  value="<?php echo $dados['id_turma']; ?>" />
                                        <input name="modalidade" type="hidden" class="form-control" id="modalidade"  value="<?php echo $dados['modalidade']; ?>" />

                                        <h2>Verifique o índice na tabela</h2>
                                        <center>

                                            <table class="tableImc">
                                                <tbody><tr >
                                                        <td width="33%" bgcolor="#C0C0C0" class="success"><b>IMC</b></td>
                                                        <td width="33%" bgcolor="#C0C0C0" class="success"><b>Classificação</b></td>
                                                        <td width="34%" bgcolor="#C0C0C0" class="success"><b>Risco
                                                                de doença</b></td>
                                                    </tr>
                                                    <tr  <?php
                                                    if ($imc < 17) {
                                                        echo 'style="background-color: #FFFF99"';
                                                    }
                                                    ?>>
                                                        <td width="33%">Menos de 17</td>
                                                        <td width="33%">Muito abaixo do peso</td>
                                                        <td width="34%">Elevado</td>
                                                    </tr>
                                                    <tr <?php
                                                    if ($imc > 17 && $imc < 18.49) {
                                                        echo 'style="background-color: #FFFF99"';
                                                    }
                                                    ?>>
                                                        <td width="33%">Entre 17 e 18,49</td>
                                                        <td width="33%">Abaixo do peso</td>
                                                        <td width="34%">Elevado</td>
                                                    </tr>
                                                    <tr <?php
                                                    if ($imc > 18.5 && $imc < 24.99) {
                                                        echo 'style="background-color: #FFFF99"';
                                                    }
                                                    ?>>
                                                        <td width="33%">Entre 18,5 e 24,99</td>
                                                        <td width="33%">Peso normal</td>
                                                        <td width="34%">Saudável</td>
                                                    </tr>
                                                    <tr <?php
                                                    if ($imc > 25 && $imc < 29.99) {
                                                        echo 'style="background-color: #FFFF99"';
                                                    }
                                                    ?>>
                                                        <td width="33%">Entre 25 e 29,99</td>
                                                        <td width="33%">Sobrepeso</td>
                                                        <td width="34%">Relativamente elevado</td>
                                                    </tr>
                                                    <tr <?php
                                                    if ($imc > 30 && $imc < 34.99) {
                                                        echo 'style="background-color: #FFFF99"';
                                                    }
                                                    ?>>
                                                        <td width="33%">Entre 30 e 34,99</td>
                                                        <td width="33%">Obesidade grau I</td>
                                                        <td width="34%">Elevado</td>
                                                    </tr>
                                                    <tr <?php
                                                    if ($imc > 35 && $imc < 39.99) {
                                                        echo 'style="background-color: #FFFF99"';
                                                    }
                                                    ?>>
                                                        <td width="33%">Entre 35 e 39,99</td>
                                                        <td width="33%">Obesidade grau II</td>
                                                        <td width="34%">Elevado</td>
                                                    </tr >
                                                    <tr <?php
                                                    if ($imc > 40) {
                                                        echo 'style="background-color: #FFFF99"';
                                                    }
                                                    ?>>
                                                        <td width="33%">Acima de 40</td>
                                                        <td width="33%">Obesidade grau III</td>
                                                        <td width="34%">Muitíssimo elevado</td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                            <a href="script_lista.php?id_turma=<?php echo $_POST['id_turma']; ?>&modalidade=<?php echo $_POST['modalidade']; ?>&nome=<?php echo $dados['nome']; ?>"><button class="btn btn-primary">Voltar à Turma</button></a>
                                            <button class="btn btn-primary" onclick="javascript:printDiv('pprint');">Imprimir página</button><br/><br/><br/><br/>
                                            </form>
                                            </fieldset>
                                        </center>

                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
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
