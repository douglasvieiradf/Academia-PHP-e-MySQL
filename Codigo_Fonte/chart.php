<?php

$pdo = new PDO('mysql:host=localhost; dbname=vb_tec0279_proj_academia2; port=3306; charset=utf8', 'root', '');

    $sql = "SELECT  nome, qtd_alunos FROM graficomodalidade; ";

$statement = $pdo->prepare($sql);

$statement->execute();


while($results = $statement->fetch(PDO::FETCH_ASSOC)) {

    $result[] = $results;
}

echo json_encode($result);