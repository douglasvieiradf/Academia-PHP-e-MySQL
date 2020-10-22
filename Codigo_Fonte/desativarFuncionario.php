<?php

require('valida.php');
require('conexao.php');

$id_usuario = $_GET['id_usuario'];

$sql1 = "SET foreign_key_checks = 0;";
$sqlDesativar = "UPDATE vb_usuarios SET status = 'n' WHERE id_usuario='$id_usuario';";
$sql2 = "SET foreign_key_checks = 1;";
mysqli_query($con, $sqlDesativar);
//echo $sqlDesativar; exit;

if (mysqli_query($con, $sqlDesativar)) {

    echo "<script type = 'text/javascript'>
    alert('Funcionário desativado com sucesso!');
    location.href = 'listaFuncionario.php'</script>;";
} else {
    echo "<script type = 'text/javascript'>
    alert('Não foi possível desativar o funcionário!');
    location.href = 'listaFuncionario.php'</script>;";
}
//header("Location: script_lista.php?id_turma=$id_turma&modalidade=$modalidade&msg=$msg");

echo "<br><br>";
?>