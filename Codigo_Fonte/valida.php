<?php
session_start();
if(!$_SESSION['usuario'])
{
	session_destroy();
	header("Location: index.php?erro=Você não possui permissão!");
}
?>
<div align="right">
<a href="logout.php">Sair</a>
</div>