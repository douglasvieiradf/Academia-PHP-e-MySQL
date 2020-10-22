<?php
session_start();
sleep(1);

require ('conexao.php');

$tipo = $_POST['tipo'];


$sql = "SELECT * FROM exercicio where tipoExercicio = '$tipo';";

$result_exercicio = mysqli_query($con, $sql) or die("Erro na seleção da tabela.");
echo '<select class="form-control" name="id_exercicio" required><option value"">Selecione</option>';
while ($dados_exercicio = mysqli_fetch_assoc($result_exercicio)) {

    echo '<option value="'.$dados_exercicio['id_exercicio'].'">'.$dados_exercicio['exercicio'].'</option>';
}
echo '</select>';

?>