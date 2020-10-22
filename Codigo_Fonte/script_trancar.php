<?php

require('valida.php');
require('conexao.php');

$id_matricula = $_GET['id_matricula'];
$cod_matricula = $_GET['cod_matricula'];
$id_turma = $_GET['id_turma'];
$modalidade = $_GET['modalidade'];

$sql1 = "SET foreign_key_checks = 0;";
$sql = "DELETE FROM vb_matricula WHERE id_matricula='$id_matricula';";
$sql2 = "SET foreign_key_checks = 1;";
mysqli_query($con, $sql1);
//echo $sql; exit;
if (mysqli_query($con, $sql)) {
    $msg = "Matrícula trancada com sucesso!";
    mysqli_query($con, $sql2);
    echo "<script type = 'text/javascript'>
    alert('Matrícula trancada com sucesso!');
    location.href = 'script_lista.php?id_turma=$id_turma&modalidade=$modalidade;'</script>;";
} else {
    $msg = "Não foi possível trancar a matrícula!";
}
//header("Location: script_lista.php?id_turma=$id_turma&modalidade=$modalidade&msg=$msg");

echo "<br><br>";
?>
