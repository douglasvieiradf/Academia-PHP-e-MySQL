<?php

require ('conexao.php');

function mostraData($data) {
    return date("d/m/Y", strtotime($data));
}

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$dt_admissao = $_POST['dt_admissao'];
$id_usuario = $_POST['id_usuario'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$perfil = $_POST['perfil'];

$sql1 = "INSERT INTO vb_usuarios (login,senha,perfil) VALUES ('$login','$senha','$perfil');";

mysqli_query($con, $sql1);

$id_usuario = mysqli_insert_id($con);

$sql2 = "INSERT INTO funcionario
	(nome, cpf, telefone, dt_admissao, id_usuario) 
	VALUES('$nome','$cpf','$telefone','$dt_admissao','$id_usuario');";

mysqli_query($con, $sql2);
//echo $sql1; $sql2; exit;
if ((mysqli_query($con, $sql1)) && (mysqli_query($con, $sql2))) {
    echo "<script type = 'text/javascript'>
    alert('Funcionário incluído com sucesso!');
    location.href = 'listaFuncionario.php'";
} else {
    echo "<script type = 'text/javascript'>
    alert('Não foi possível incluir o funcionário!');
    location.href = 'listaFuncionario.php'";
}echo "<br><br>";
?>   