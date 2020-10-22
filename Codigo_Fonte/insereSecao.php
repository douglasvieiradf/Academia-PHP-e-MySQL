<?php

require('valida.php');
require('conexao.php');


function gravaData($dataSecao) {
    return date("Y-m-d", strtotime($dataSecao));
}

$serie = $_POST['series'];
$repeticao = $_POST['repeticoes'];
$carga = $_POST['carga'];
$id_exercicio = $_POST['id_exercicio'];
$id_ficha = $_POST['id_ficha'];
$dataSecao = gravaData($_POST['data_secao']);
$cod_matricula = $_POST['cod_matricula'];
$nome = $_POST['nome'];
$inicio_treino = $_POST['inicio_treino'];
$fim_treino = $_POST['fim_treino'];
$observacoes = $_POST['observacoes'];
$id_usuario = $_SESSION['id_usuario'];

$sqlTreino = "INSERT INTO secao (dt_secao, qtd_serie, repeticao, carga, id_ficha, id_exercicio) VALUES ('$dataSecao', '$serie', '$repeticao', '$carga', '$id_ficha', '$id_exercicio');";



if (mysqli_query($con, $sqlTreino)) {

    echo "<script type = 'text/javascript'>
    alert('Exercicio incluído com sucesso!');
    location.href = 'verTreino.php?id_ficha=$id_ficha&cod_matricula=$cod_matricula&nome=$nome&inicio_treino=$inicio_treino&fim_treino=$fim_treino&observacoes=$observacoes'</script>;";
} else {
    echo "<script type = 'text/javascript'>
    alert('Não foi possível incluir o exercicio!');
    location.href = 'verTreino.php?id_ficha=$id_ficha&cod_matricula=$cod_matricula&nome=$nome&inicio_treino=$inicio_treino&fim_treino=$fim_treino&observacoes=$observacoes'</script>;";
}

//echo "<br><br>";
?>