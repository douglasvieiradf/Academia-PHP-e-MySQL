<?php

require('valida.php');
require('conexao.php');

$id_usuario = $_GET['id_usuario'];

$sql1 = "SET foreign_key_checks = 0;";
$sqlAtivar = "UPDATE vb_usuarios SET status = 's' WHERE id_usuario='$id_usuario';";
$sql2 = "SET foreign_key_checks = 1;";
mysqli_query($con, $sqlAtivar);
//echo $sqlAtivar; exit;

if (mysqli_query($con, $sqlAtivar)) {

    echo "<script type = 'text/javascript'>
    alert('Funcionário ativado com sucesso!');
    location.href = 'listaFuncionario.php'</script>;";
} else {
    echo "<script type = 'text/javascript'>
    alert('Não foi possível ativar o funcionário!');
    location.href = 'listaFuncionario.php'</script>;";
}

echo "<br><br>";
?>