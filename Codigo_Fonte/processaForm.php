<?php

$para = "douglasvieiradf@gmail.com";
$assunto = "Contato pelo site";
$nome = $_REQUEST['nome'];
$email = $_REQUEST['email'];
$assunto = $_REQUEST['assunto'];
$mensagem = $_REQUEST['mensagem'];

echo $nome . "<br>";
echo $email . "<br>";
echo $assunto . "<br>";
echo $mensagem;


$corpo = "<strong> Mensagem do Usuário </strong><br><br>";
$corpo .="<strong> Nome: </strong> $nome";
$corpo .="<br><strong> Email: </strong> $email";
$corpo .="<br><strong> Telefone: </strong> $assunto";
$corpo .="<br><strong> Mensagem: </strong> $mensagem";

$header.= "Content-Type: text/html; charset= utf-8\n";
$header = "From: $email Reply-to: $email\n";



@mail($para, $assunto, $corpo, $header);

echo '<script>';
echo 'window.location = "faleConosco.php?msg=sim";';
echo '</script>';

//header("location:faleConosco.php?msg=sim");
?>