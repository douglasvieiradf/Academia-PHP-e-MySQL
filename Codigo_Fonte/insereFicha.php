<?php

require('valida.php');
require('conexao.php');
$nome = $_POST['nome'];
$id_turma = $_POST['id_turma'];
$modalidade = $_POST['modalidade'];
//print_r($_POST); exit;
$cod_matricula = $_POST['cod_matricula'];
$id_usuario = $_SESSION['id_usuario'];

$observacoes = $_POST['observacoes'];
$inicio_treino = $_POST['inicio_treino'];
$fim_treino = $_POST['fim_treino'];

$tipo = $_GET['tipo'];
if($tipo == 'insere')
{
    $sqlFicha = "INSERT INTO ficha (observacoes,inicio_treino,fim_treino,id_professor,cod_matricula) VALUES ('$observacoes', '$inicio_treino', '$fim_treino', '$id_usuario', '$cod_matricula');";
   // echo $sqlFicha; exit;
        if (mysqli_query($con, $sqlFicha)) {

        echo "<script type = 'text/javascript'>
        alert('Salvo com sucesso!');
        </script>;";
    } else {
        echo "<script type = 'text/javascript'>
        alert('Não foi possível salvar a ficha!');
        </script>;";
    }
    $id_ficha = mysqli_insert_id($con);
}
elseif($tipo == 'edita')
{
    $id_ficha = $_GET['id_ficha'];
    $sqlFicha = "UPDATE ficha SET observacoes = '$observacoes',inicio_treino = '$inicio_treino',fim_treino = '$fim_treino',id_professor = '$id_usuario' WHERE id_ficha = '$id_ficha';";
    if (mysqli_query($con, $sqlFicha)) {

        echo "<script type = 'text/javascript'>
        alert('Salvo com sucesso!');
        </script>;";
    } else {
        echo "<script type = 'text/javascript'>
        alert('Não foi possível salvar a ficha!');
        </script>;";
    }
}

if($id_ficha < 1){ $id_ficha = ''; }

    echo "<script type = 'text/javascript'>
   
    location.href = 'montaTreino.php?id_ficha=$id_ficha&cod_matricula=$cod_matricula&id_usuario=$id_usuario&nome=$nome&id_turma=$id_turma&modalidade=$modalidade'</script>;";

?>