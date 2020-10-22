<?php

include "header.php";
include "menu.php";

$_SESSION["tipo_usuario"] == 'aluno' ?: header("Location: /index.php");
$_SESSION['id_usuario'] ?: header("Location: /index.php");

?>

<div class="featured">
    <section id="content">
        <div class="wrap-content zerogrid">
            <div class="col-md-12">
                <div class="row block01">
                    <h1> Cálculo IMC </h1>
                    <div class="col-md-12">
                        <div class="row block01">
                            <div class="container-fluid">
                                <div class="">
                                    <fieldset>
                                        <form method="post" action="">
                                            <div class="form-group text-left">
                                                <br/>
                                                <label for="peso">
                                                    Peso: (Ex: 65) KG
                                                </label>
                                                <input type="text" class="form-control" id="peso" name="peso"
                                                       required=""/>
                                            </div>
                                            <div class="form-group text-left">
                                                <br/>
                                                <label for="altura">
                                                    Altura: (Ex: 1,75) M
                                                </label>

                                                <input type="text" class="form-control" id="altura" name="altura"
                                                       required=""/>
                                                <br/>
                                                <input class="botao" type="submit" name="Calcular" id="calcular"
                                                       value="Calcular"/>
                                            </div>
                                            <?php
                                            $imc = 0;
                                            @$_POST["peso"] = str_replace(",", ".", $_POST["peso"]);
                                            @$_POST["altura"] = str_replace(",", ".", $_POST["altura"]);
                                            $peso = isset($_POST["peso"]) ? $_POST["peso"] : null;
                                            $altura = isset($_POST["altura"]) ? $_POST["altura"] : null;

                                            if ($altura != 0) {
                                                $conta1 = $altura * $altura;
                                                @$imc = $peso / $conta1;

                                                echo "<strong>Seu indice de massa corporal é :</strong> " . round($imc, 2) . "<br>";

                                                if ($imc < 17) {
                                                    echo "Você esta muito abaixo do peso";
                                                } else if ($imc > 17 && $imc < 18.49) {
                                                    echo "Você está abaixo do peso";
                                                } else if ($imc > 18.5 && $imc < 24.99) {
                                                    echo "Você está com peso nomal";
                                                } else if ($imc > 25 && $imc < 29.99) {
                                                    echo "Você está a cima do peso";
                                                } else if ($imc > 30 && $imc < 34.99) {
                                                    echo "Você está com obesidade tipo I";
                                                } else if ($imc > 35 && $imc < 39.99) {
                                                    echo "Você está com obesidade tipo II (severa)";
                                                } else if ($imc > 40) {
                                                    echo "Você está com obesidade tipo III (mórbida)";
                                                }
                                            }

                                            ?>
                                            <div align="center">
                                                <center>
                                                    <br>
                                                    <br>
                                                    <table border="0" cellpadding="2" width="95%" bgcolor="#F7F7F7">
                                                        <tbody>
                                                        <tr>
                                                            <td width="33%" bgcolor="#C0C0C0" class="azulEscuro">
                                                                <b>IMC</b>
                                                            </td>
                                                            <td width="33%" bgcolor="#C0C0C0" class="azulEscuro"><b>Classificação</b>
                                                            </td>
                                                            <td width="34%" bgcolor="#C0C0C0" class="azulEscuro"><b>Risco
                                                                    de doença</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="33%">Menos de 18,5</td>
                                                            <td width="33%">Magreza</td>
                                                            <td width="34%">Elevado</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="33%" bgcolor="#FFFF99">Entre
                                                                18,5 e 24,9
                                                            </td>
                                                            <td width="33%" bgcolor="#FFFF99">Normal</td>
                                                            <td width="34%" bgcolor="#FFFF99">---------</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="33%">Entre 25 e 29,9</td>
                                                            <td width="33%">Sobrepeso</td>
                                                            <td width="34%">Elevado</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="33%">Entre 30 e 39,9</td>
                                                            <td width="33%">Obesidade</td>
                                                            <td width="34%">Muito elevado</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="33%">Igual ou maior de 40</td>
                                                            <td width="33%">Obesidade grave</td>
                                                            <td width="34%">Muitíssimo elevado</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                        </form>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php include "footer.php" ?>
