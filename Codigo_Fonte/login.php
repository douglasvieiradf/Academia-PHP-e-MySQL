<?php

session_start();
sleep(2);

require ('conexao.php');

$login = $_POST['username'];
$senha = $_POST['senha'];
$tipo_login = $_POST['tipo_login'];
//$ativo = $_POST['ativo'];
//se login e senha vazios
if ($login == "" || $senha == "") {
    echo 0;
} else if
 ($tipo_login == 'aluno') {
    $senha = $_POST['senha'];
    $sql = "SELECT * FROM vb_aluno WHERE cpf = '$login' AND senha = '$senha' and ativo = 's';";

    $resultado = mysqli_query($con, $sql) or die("Erro na seleção da tabela.");
    $linhas = mysqli_num_rows($resultado);
    $dados = mysqli_fetch_assoc($resultado);

    if ($linhas > 0) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $login;
        $_SESSION['id_usuario'] = $dados['cod_matricula'];
        $_SESSION['tipo_usuario'] = $tipo_login;
        $_SESSION['nome'] = $dados['nome'];



//Login e senha corretos
        echo 2;
    } else {
        session_destroy();


//se os dados inseridos estiverem errados
        echo 6;
        //echo mysqli_error($con);
    }
} else if
 ($tipo_login == 'professor'){
    $sql = "select * from funcionario f
LEFT JOIN vb_usuarios u ON f.id_usuario = u.id_usuario
WHERE login = '$login' AND senha = '$senha' AND perfil = '$tipo_login' and status = 's';";

    $resultado = mysqli_query($con, $sql) or die("Erro na seleção da tabela.");
    $linhas = mysqli_num_rows($resultado);
    $dados = mysqli_fetch_assoc($resultado);

    if ($linhas > 0) {
        $_SESSION['id_professor'] = $dados['id_usuario'];
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $login;
        $_SESSION['id_usuario'] = $dados['id_usuario'];
        $_SESSION['tipo_usuario'] = $tipo_login;
        $_SESSION['nome'] = $dados['nome'];


//Login e senha corretos
        echo 1;
    } else {
        session_destroy();


//se os dados inseridos estiverem errados
        echo 6;
        echo mysqli_error($con);
    }
}
else if
 ($tipo_login == 'administrador'){
    $sql = "select * from funcionario f
LEFT JOIN vb_usuarios u ON f.id_usuario = u.id_usuario
WHERE login = '$login' AND senha = '$senha' AND perfil = '$tipo_login' and status = 's';";

    $resultado = mysqli_query($con, $sql) or die("Erro na seleção da tabela.");
    $linhas = mysqli_num_rows($resultado);
    $dados = mysqli_fetch_assoc($resultado);

    if ($linhas > 0) {
        $_SESSION['id_funcionario'] = $dados['id_usuario'];
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $login;
        $_SESSION['id_usuario'] = $dados['nome'];
        $_SESSION['tipo_usuario'] = $tipo_login;
        $_SESSION['nome'] = $dados['nome'];


//Login e senha corretos
        echo 3;
    } else {
        session_destroy();


//se os dados inseridos estiverem errados
        echo 6;
        echo mysqli_error($con);
    }
}
/*if ($tipo_login == "professor") {
    echo 1;
} else if ($tipo_login == "aluno") {
    echo 2;
} else if ($tipo_login == "administrador") {
    echo 3;
}*/
?>
