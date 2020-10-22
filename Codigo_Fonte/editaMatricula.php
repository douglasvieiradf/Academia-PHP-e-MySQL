<?php include "header.php" ?>
<?php include "menu.php" ?>
<?php
require ('conexao.php');

function gravaData($dt_nascimento) {
    return date("Y-m-d", strtotime($dt_nascimento));
}

function mostraData($data) {
    return date("d/m/Y", strtotime($data));
}

function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';
    $caracteres .= $lmin;
    if ($maiusculas)
        $caracteres .= $lmai;
    if ($numeros)
        $caracteres .= $num;
    if ($simbolos)
        $caracteres .= $simb;
    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand - 1];
    }
    return $retorno;
}
?>
<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                            <div  align="center"><br/>

                                <?php
                                

                                $cod_matricula = $_POST['cod_matricula'];
                                $nome = $_POST['nome'];
                                $cpf = $_POST['cpf'];
                                $email = $_POST['email'];
                                $sexo = $_POST['sexo'];
                                $fone_fixo = $_POST['fone_fixo'];
                                $fone_celular = $_POST['fone_celular'];
                                $dt_nascimento = gravaData($_POST['dt_nascimento']);
                                $endereco = $_POST['endereco'];
                                $numero = $_POST['numero'];
                                $bairro = $_POST['bairro'];
                                $senha = geraSenha(6, false, true);
                                $senhaMd5 = md5($senha);
                                $id_cidade = $_POST['id_cidade'];
                                $id_turma = $_POST['id_turma'];
                                $modalidade = $_POST['modalidade'];

                                if ($cod_matricula == '') {
                                    $sql = "INSERT INTO vb_aluno 
			(nome, cpf, email, sexo, fone_fixo, fone_celular, dt_nascimento,  endereco, numero, bairro, senha, id_cidade, id_turma) 
			VALUES('$nome','$cpf','$email','$sexo','$fone_fixo','$fone_celular','$dt_nascimento',
			'$endereco','$numero','$bairro','$senhaMd5','$id_cidade','$id_turma');";
                                } else {
                                    $sql = "UPDATE vb_aluno SET
				nome			= '$nome',
				cpf			= '$cpf',
				email			= '$email',		
				sexo			= '$sexo',
				fone_fixo		= '$fone_fixo',
				fone_celular	= '$fone_celular',
				dt_nascimento	= '$dt_nascimento',
				endereco		= '$endereco',
				numero			= '$numero',
				bairro			= '$bairro',
                                senha                   = '$senhaMd5',    
				id_cidade		= '$id_cidade',
		 		id_turma		= '$id_turma'		
				WHERE cod_matricula = '$cod_matricula';";
                                }

                                if (mysqli_query($con, $sql)) {
                                    if ($cod_matricula == '') {
                                        $cod_matricula = mysqli_insert_id($con); //pega o número do último id registrado.	
                                    }

                                    $sqlTurma = "SELECT id_turma, m.nome as modalidade, dia, horario, f.nome as professor FROM vb_turma t
							LEFT JOIN vb_modalidade m ON t.id_modalidade = m.id_modalidade
							LEFT JOIN vb_professor p ON p.id_professor = t.id_professor
                                                        LEFT JOIN funcionario f ON f.id_funcionario = p.id_funcionario
							LEFT JOIN vb_dias d ON d.id_dia = t.id_dia
							WHERE id_turma=$id_turma;";

                                    $resultTurma = mysqli_query($con, $sqlTurma);
                                    $dadosTurma = mysqli_fetch_assoc($resultTurma);

                                    $sqlCidade = "SELECT * FROM vb_cidade WHERE id_cidade = $id_cidade;";
                                    $resultCidade = mysqli_query($con, $sqlCidade);
                                    $dadosCidade = mysqli_fetch_assoc($resultCidade);

                                    echo '<h3 class="alert alert-success" style="color:#666">Matricula editada com sucesso!</h3><br/>';
                                    echo '<h3 style="color:#666">Dados Cadastrados</h3><br/>';

                                    echo '<table  width="700px"  style="background:#effdfc; border: solid #000 1px; border-collapse:collapse; font-size:18px;">
  <tr>
    <td  style="color:#666" >&nbsp; &nbsp;<label class="formaUm" ><b>Nº matrícula:</b></label></td>
    <td ><label class="formaUm">' . $cod_matricula . '</label></td>
  </tr>
  <tr>
	<td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Nome:</b></label></td>
	<td ><label class="formaUm">' . $nome . '</label></td>
  </tr>
  <tr align="left">
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>CPF:</b></label></td>
    <td><label class="formaUm">' . $cpf . '
    </label></td>
     </tr>
  <tr>
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Sexo:</b></label></td>
    <td><label class="formaUm">' . $sexo . '</label></td>
  </tr>
  <tr align="left">
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>E-mail:</b></label></td>
    <td><label class="formaUm">' . $email . '</label></td>
  </tr>
  <tr>
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Fone fixo:</b></label></td>
    <td><label class="formaUm">' . $fone_fixo . '</label></td>
         </tr>
  <tr>
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Fone celular:</b></label></td>
    <td><label class="formaUm">' . $fone_celular . '</label></td>
  </tr>
  <tr>
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Data de Nascimento:</b></label></td>
    <td ><label class="formaUm">' . mostraData($dt_nascimento) . '</label></td>
  </tr>
  <tr>
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Endereço:</b></label></td>
    <td ><label class="formaUm">' . $endereco . '</label></td>
  </tr>
  <tr>  
  	<td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Número:</b></label></td>
	<td><label class="formaUm">' . $numero . '</label></td>
             </tr>
  <tr>
	<td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Bairro:</b></label></td>
    <td><label class="formaUm">' . $bairro . '</label></td>
  </tr>
  <tr>
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Cidade:</b></label></td>
    <td><label class="formaUm">' . $dadosCidade['cidade'] . '</label></td>
         </tr>
  <tr>
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Turma:</b></label></td>
    <td><label class="formaUm">' . $dadosTurma['modalidade'] . ' </label></td>
  </tr>
  <tr>
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Dias da Semana:</b></label></td>
    <td><label class="formaUm">' . $dadosTurma['dia'] . ' </label></td>
  </tr>
  <tr>
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Horario:</b></label></td>
    <td><label class="formaUm">' . $dadosTurma['horario'] . ' </label></td>
  </tr>
  <tr>
    <td style="color:#666">&nbsp; &nbsp;<label class="formaUm"><b>Professor:</b></label></td>
    <td><label class="formaUm">' . $dadosTurma['professor'] . ' </label></td>
  </tr>
  
</table>
  
';
                                } else {

                                    echo 'Não foi possivel efetuar matrícula, verifique os dados informados e tente novamente!<br/>';
                                    echo "Dados sobre o erro:" . mysqli_error($con);
                                }
                                echo '<br/><br/>';

                                $sql_seleciona = "SELECT * FROM vb_aluno WHERE cod_matricula='$cod_matricula'";
                                $result = mysqli_query($con, $sql_seleciona);
                                //script_lista.php?id_turma=1&modalidade=
                                while ($dados = mysqli_fetch_assoc($result)) {
                                    /* 'Nº matrícula: '.$dados['cod_matricula'].' - Nome: '.$dados['nome'].'<br/>CPF: '.$dados['cpf'].'<br/> E-mail: '.$dados['email'].' <br/>Sexo: '.$dados['sexo'].' <br/>Telefone fixo: '.$dados['fone_fixo'].' <br/>Telefone celular: '.$dados['fone_celular'].' <br/>Data de Nascimento: '.$dados['dt_nascimento'].' <br/>Peso: '.$dados['peso'].' <br/>Altura: '.$dados['altura'].' <br/>Endereço: '.$dados['endereco'].' <br/>Número: '.$dados['numero'].' <br/>Bairro: '.$dados['bairro'].' <br/>Cidade: '.$dados['id_cidade'].' <br/>Turma: '.$dados['id_turma'];
                                     */
                                    if ($cpf == $dados['cpf']) {
                                        echo '<br/><a href="script_lista.php?id_turma=' . $dados['id_turma'] . '&modalidade='.$_POST['modalidade'].'"><button class="btn btn-primary"> Voltar à turma </button></a> &nbsp';
                                    }
                                    echo '<br>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>
<?php include "footer.php" ?>
