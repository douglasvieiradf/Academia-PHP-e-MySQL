<?php include "header.php" ?>
<?php include "menu.php" ?>
<?php
require ('conexao.php');

function mostraData($data) {
    return date("d/m/Y", strtotime($data));
}

$dados['cod_matricula'] = "";
$dados['nome'] = "";
$dados['cpf'] = "";
$dados['email'] = "";
$dados['sexo'] = "";
$dados['fone_fixo'] = "";
$dados['fone_celular'] = "";
$dados['dt_nascimento'] = "";
$dados['endereco'] = "";
$dados['numero'] = "";
$dados['bairro'] = "";
$dados['id_cidade'] = "";
$dados['id_turma'] = "";

if (isset($_GET['cod_matricula'])) {
    $pre = 'Editar';
    $btn = 'Atualizar';
    $cod_matricula = $_GET['cod_matricula'];
    $sql = "SELECT * FROM vb_aluno WHERE cod_matricula = '$cod_matricula';";
    $resultado = mysqli_query($con, $sql);
    $dados = mysqli_fetch_assoc($resultado);
} else {
    $pre = 'Nova';
    $btn = 'INSCREVA-SE';
}
?>
<!-- função para valdidar CPF !-->
<script>
function verificarCPF(c){
    var i;
    c = c.replace(/.-[^\d]+/g,'');
    s = c;

    var c = s.substr(0,9);
    var dv = s.substr(9,2);
    var d1 = 0;
    var v = false;

    for (i = 0; i < 9; i++){
        d1 += c.charAt(i)*(10-i);
    }
    if (d1 == 0){
        alert(" CPF Inválido")
        v = true;
        return false;
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(0) != d1){
        alert(" CPF Inválido")
        v = true;
        return false;
    }

    d1 *= 2;
    for (i = 0; i < 9; i++){
        d1 += c.charAt(i)*(11-i);
    }
    d1 = 11 - (d1 % 11);
    if (d1 > 9) d1 = 0;
    if (dv.charAt(1) != d1){
        alert(" CPF Inválido")
        v = true;
        return false;
    }
    if (!v) {
        alert( " CPF Válido")
    }
}
</script>
<!-- fim da função  para valdidar CPF  !-->
<section id="content">
    <div class="row" >
        <div class="gladiator ">
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><h1 align="center" style="font-size: 50px; color: #FFF"><b><?php echo $pre; ?> Matrícula &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br/></h1>
        </div>
    </div>
    <div class="wrap-content zerogrid">

        <div class="row block01">
            <div class="container-fluid">
                <div class="">
                    <fieldset>
                        <form method="post" action="insereMatricula.php" >
                            <input type="hidden" name="cod_matricula" value="<?php echo $dados['cod_matricula']; ?>"  />
                            <input type="hidden" name="nome" value="<?php echo $dados['nome']; ?>"  />
                            <div class="col-md-12">
                                <br/><br/><h2 align="center" style="color:#000  ">Essa é a sua chance de sair da inércia e ganhar bem-estar! <p>Não perca tempo, venha viver uma vida saudável!</h2></p><br/><br/>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group text-left">
                                    <br/>
                                    <label for="nome">
                                        Nome completo *
                                    </label>
                                    <input type="text" class="form-control" id="nome" name="nome" required value="<?php echo $dados['nome']; ?>"/>
                                </div>

                                <div class="form-group text-left">

                                    <label for="email">
                                        E-mail
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $dados['email']; ?>"/>
                                </div>


                                <div class="form-group text-left">
                                    <label for="fone_fixo">
                                        Telefone Fixo
                                    </label>
                                    <input type="text" class="form-control" id="fone_fixo" maxlength="10"  name="fone_fixo" value="<?php echo $dados['fone_fixo']; ?>"/>
                                </div>

                                <div class="form-group text-left">
                                    <label for="endereco">
                                        Endereço
                                    </label>
                                    <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $dados['endereco']; ?>"/>
                                </div>

                                <div class="form-group text-left">
                                    <label for="bairro">
                                        Bairro
                                    </label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $dados['bairro']; ?>"/>
                                </div>
                                <div class="form-group text-left">
                                    <label for="turma">
                                        Turma *
                                    </label>
                                    <?php
                                    $sql_turma = "SELECT id_turma, m.nome as modalidade, dia, horario, f.nome as professor FROM vb_turma t
							LEFT JOIN vb_modalidade m ON t.id_modalidade = m.id_modalidade
							LEFT JOIN vb_professor p ON p.id_professor = t.id_professor
                                                        LEFT JOIN funcionario f ON f.id_funcionario = p.id_funcionario
							LEFT JOIN vb_dias d ON d.id_dia = t.id_dia;";

                                    $result_turma = mysqli_query($con, $sql_turma);
                                    ?>
                                    <select class="form-control" id="id_turma" name="id_turma" required>
                                        <option value=""> </option>
                                        <?php
                                        while ($dados_turma = mysqli_fetch_array($result_turma)) {
                                            ?>
                                            <option value="<?php echo $dados_turma ['id_turma']; ?>"
                                            <?php
                                            if ($dados_turma['id_turma'] == $dados['id_turma']) {
                                                echo 'selected="selected"';
                                            }
                                            ?> >
                                                        <?php
                                                        echo
                                                        $dados_turma ['id_turma'] . " - "
                                                        . $dados_turma ['modalidade'] . " - "
                                                        . $dados_turma ['dia'] . " - "
                                                        . $dados_turma ['horario'] . " - Prof. "
                                                        . $dados_turma ['professor']
                                                        ?>

                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <br/>
                                <div class="form-group text-left">

                                    <label for="cpf">
                                        CPF *
                                    </label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" onblur="return verificarCPF(this.value)" required value="<?php echo $dados['cpf']; ?>"/>
                                </div>

                                <div class="form-group text-left">
                                    <label for="sexo">
                                        Sexo *
                                    </label><br/>
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default">
                                            <input type="radio" name="sexo" value="masculino" id="masc" autocomplete="off" required value="<?php echo $dados['sexo']; ?>" <?php
                                            if ($dados['sexo'] == 'masculino') {
                                                echo 'checked="checked"';
                                            }
                                            ?>> Masculino
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="sexo" value="feminino" id="fem" autocomplete="off" required value="<?php echo $dados['sexo']; ?>"<?php
                                            if ($dados['sexo'] == 'feminino') {
                                                echo 'checked="checked"';
                                            }
                                            ?>> Feminino
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group text-left">
                                    <label for="fone_celular">
                                        Telefone Celular
                                    </label>
                                    <input type="text" class="form-control" id="fone_celular"  maxlength="11" name="fone_celular" value="<?php echo $dados['fone_celular']; ?>"/>
                                </div>

                                <div class="form-group text-left">

                                    <label for="dt_nascimento">
                                        Data de Nascimento *
                                    </label>
                                    <input type="date" class="form-control" id="dt_nascimento" name="dt_nascimento" required value="<?php echo ($dados['dt_nascimento']); ?>" />
                                </div>

                                <div class="form-group text-left">
                                    <label for="numero">
                                        Número *
                                    </label>
                                    <input type="text" class="form-control" id="numero" name="numero" required value="<?php echo $dados['numero']; ?>"/>
                                </div>


                                <div class="form-group text-left">

                                    <label for="cidade">
                                        Cidade *
                                    </label>
                                    <?php
                                    $sql_cidade = "SELECT * FROM vb_cidade ORDER BY cidade ASC;";
                                    $result_cidade = mysqli_query($con, $sql_cidade);
                                    ?>
                                    <select class="form-control" id="id_cidade" name="id_cidade" required>
                                        <option  value=""> </option>
                                        <?php
                                        while ($dados_cidade = mysqli_fetch_assoc($result_cidade)) {
                                            ?>
                                            <option value="<?php echo $dados_cidade['id_cidade']; ?>"
                                            <?php
                                            if ($dados_cidade['id_cidade'] == $dados['id_cidade']) {
                                                echo 'selected="selected"';
                                            }
                                            ?>
                                                    >
                                                        <?php echo $dados_cidade ['cidade']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>


                                </div>


                            </div>
                            <p align="center" style="color:#f90">* Campos obrigatórios</p><br/>
                            <label class="link"><br/><br/><input class="btn btn-primary" type="submit" name="enviar" id="enviar" value="<?php echo $btn; ?>"></label>

                        </form>
                    </fieldset>
                </div><br/>
            </div>
        </div><!--wrap-content zerogrid-->
</section>


















<?php include "footer.php" ?>
