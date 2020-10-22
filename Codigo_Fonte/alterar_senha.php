<?php

include "valida.php";
require ('conexao.php');

$codigo = $_SESSION['usuario'];
$password = $_POST['senha'];
$confirme = $_POST['confirme'];
//$tipo_login = $_SESSION['tipo_login'];

if ($password == "" || $confirme == "") {
    echo "<script type = 'text/javascript'>
    alert('Preencha todos os campos!'+$codigo);
    location.href = 'troca_senha.php'</script>;";
} else
if ($password == $confirme){
    $sql = "UPDATE vb_usuarios SET senha ='$password' WHERE login = '$codigo';";

    $query = mysqli_query($con, $sql) or die("Houve um erro na gravação dos dados, verifique os dados informados");

    echo "<script type = 'text/javascript'>
    alert('Senha alterada com sucesso!');
    location.href = 'script_principal.php'</script>;";
} else {
    echo "<script type = 'text/javascript'>
    alert('Senhas não correspondem. Tente novamente!');
    location.href = 'troca_senha.php'</script>;";
}
?>
	
