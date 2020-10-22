<?php

require('valida.php');
require('conexao.php');

$id_matricula = $_GET['id_matricula'];
$cod_matricula = $_GET['cod_matricula'];
$id_turma = $_GET['id_turma'];
$modalidade = $_GET['modalidade'];

$sql1 = "SET foreign_key_checks = 0;";
$sqlUpdate = "UPDATE vb_aluno SET ativo = 'n' WHERE cod_matricula='$cod_matricula'; ";
$sqlDelete = "DELETE FROM vb_matricula WHERE cod_matricula='$cod_matricula';";
$sql2 = "SET foreign_key_checks = 1;";
mysqli_query($con, $sql1);
//echo $sql; exit;

if ((mysqli_query($con, $sqlUpdate)) && (mysqli_query($con, $sqlDelete))) {
    //return confirm('Aluno excluido com sucesso!');	
    //$msg = "Aluno excluído com sucesso!";
    
    mysqli_query($con, $sql2);

    echo "<script type = 'text/javascript'>
    alert('Aluno excluido com sucesso!');
    location.href = 'script_lista.php?id_turma=$id_turma&modalidade=$modalidade;'</script>;";
} else {
    echo "<script type = 'text/javascript'>
    alert('Não foi possível excluir o aluno!');
    location.href = 'script_lista.php?id_turma=$id_turma&modalidade=$modalidade;'</script>;";

}
//header("Location: script_lista.php?id_turma=$id_turma&modalidade=$modalidade&msg=$msg");

echo "<br><br>";
?>