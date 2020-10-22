<?php

require('valida.php');
require('conexao.php');

$id_avaliacao = $_GET['id_avaliacao'];
$cod_matricula = $_GET['cod_matricula'];

$sql1 = "SET foreign_key_checks = 0;";
$sqlDelete = "DELETE FROM avaliacao_funcional WHERE cod_matricula='$cod_matricula' and id_avaliacao = '$id_avaliacao';";
$sql2 = "SET foreign_key_checks = 1;";
mysqli_query($con, $sql1);
//echo $sqlDelete; exit;

if (mysqli_query($con, $sqlDelete)) {
    //return confirm('Aluno excluido com sucesso!');	
    //$msg = "Aluno excluído com sucesso!"; 
    
    mysqli_query($con, $sql2);

    echo "<script type = 'text/javascript'>
    alert('Avaliação apagada com sucesso!');
    location.href = 'gerenciaAvaliacao.php?cod_matricula=$cod_matricula&id_avaliacao=$id_avaliacao'</script>;";
} else {
    echo "<script type = 'text/javascript'>
    alert('Não foi possível apagar a avaliação!');
    location.href = 'gerenciaAvaliacao.php?cod_matricula=$cod_matricula&id_avaliacao=$id_avaliacao'</script>;";

}
echo "<br><br>";
?>
