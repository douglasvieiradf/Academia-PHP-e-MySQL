<?php include "header.php" ?>
<?php include "menu.php" ?>
<?php
require ('conexao.php');

function gravaData($data) {
    return date("Y-m-d", strtotime($data));
}

$cod_matricula = $_GET['cod_matricula'];
?>
<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <p><h2 style="color:#666">Dados do Aluno</h2></p>
                            <table class="table table-striped table-hover table-condensed ">
                                <thead>
                                    <tr>
                                        <td style="font-size:22px; color:#000"><strong>Nome</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Modalidade</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Dias</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Horário</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Turma</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                <div  align="center"><br/>
                                    <?php
                                    $sql = "SELECT nome, cpf, email,sexo ,fone_fixo,fone_celular,dt_nascimento,peso,
                                    altura,endereco,numero,bairro,id_cidade,id_turma from vb_aluno 
                                    WHERE cod_matricula = '$cod_matricula';";

                                    $resultado = mysqli_query($con, $sql);

                                    while ($dados = mysqli_fetch_assoc($resultado)) {
                                        ?>
                                        while ($dados = mysqli_fetch_assoc($resultado)) {
                                        ?>

                                        <tr align="center" >
                                            <td><?php echo $sql['nome']; ?></td>
                                            <td class=""><?php echo $dados['modalidade']; ?></td>
                                            <td class=""><?php echo $dados['dia']; ?></td>
                                            <td class=""><?php echo $dados['horario']; ?></td>
                                            
                                        </tr>
                                    <?php } ?>
                            </table>



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php include "footer.php" ?>