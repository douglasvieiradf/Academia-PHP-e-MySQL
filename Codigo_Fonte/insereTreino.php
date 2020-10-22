<?php

require('valida.php');
require('conexao.php');

$nome = $_POST['nome'];
$cod_matricula = $_POST['cod_matricula'];
$id_usuario = $_SESSION['id_usuario'];
$id_turma = $_POST['id_turma'];
$modalidade = $_POST['modalidade'];

$serie = $_POST['serie'];
$repeticao = $_POST['repeticao'];
$carga = $_POST['carga'];
$id_exercicio = $_POST['id_exercicio'];
$id_ficha = $_POST['id_ficha'];

//print_r($_POST); exit;

$sqlTreino = "INSERT INTO treino (id_ficha, id_exercicio, serie, repeticao, carga) VALUES ('$id_ficha', '$id_exercicio', '$serie', '$repeticao', '$carga');";

if (mysqli_query($con, $sqlTreino)) {

    echo "<script type = 'text/javascript'>
    alert('Exercicio incluído com sucesso!');
    location.href = 'montaTreino.php?id_ficha=$id_ficha&cod_matricula=$cod_matricula&id_usuario=$id_usuario&nome=$nome&id_turma=$id_turma&modalidade=$modalidade'</script>;";
} else {
    echo "<script type = 'text/javascript'>
    alert('Não foi possível incluir o exercicio!');
    location.href = 'montaTreino.php?id_ficha=$id_ficha&cod_matricula=$cod_matricula&id_usuario=$id_usuario&nome=$nome&id_turma=$id_turma&modalidade=$modalidade'</script>;";
}

//echo "<br><br>";
?>