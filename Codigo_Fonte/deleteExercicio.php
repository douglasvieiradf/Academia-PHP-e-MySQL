<?php

require('valida.php');
require('conexao.php');

$cod_matricula = $_GET['cod_matricula'];
$id_ficha = $_GET['id_ficha'];
$nome = $_GET['nome'];
$id_treino = $_GET['id_treino'];
$id_usuario = $_SESSION['id_usuario'];
$id_turma = $_GET['id_turma'];
$modalidade = $_GET['modalidade'];

$sql1 = "SET foreign_key_checks = 0;";
$sqlDelete = "DELETE FROM treino WHERE id_treino='$id_treino';";
$sql2 = "SET foreign_key_checks = 1;";
mysqli_query($con, $sql1);
//echo $sqlDelete; exit;

if (mysqli_query($con, $sqlDelete)) {
    
    mysqli_query($con, $sql2);

    echo "<script type = 'text/javascript'>
    alert('Exercício excluido com sucesso!');
    location.href = 'montaTreino.php?cod_matricula=$cod_matricula&id_usuario=$id_usuario&nome=$nome&id_ficha=$id_ficha&id_turma=$id_turma&modalidade=$modalidade'</script>;";
} else {
    echo "<script type = 'text/javascript'>
    alert('Não foi possível excluir o Exercício!');
    location.href = 'montaTreino.php?cod_matricula=$cod_matricula&id_usuario=$id_usuario&nome=$nome&id_ficha=$id_ficha&id_turma=$id_turma&modalidade=$modalidade'</script>;";

}
//header("Location: script_lista.php?id_turma=$id_turma&modalidade=$modalidade&msg=$msg");

echo "<br><br>";
?>