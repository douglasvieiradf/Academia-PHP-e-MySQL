<?php include "header.php" ?>
<?php
require("conexao.php");
$_SESSION['tipo_usuario'] == 'administrador' ?: header("Location: /index.php");

function mostraData($data) {
    return date("d/m/Y", strtotime($data));
}
?>

<?php include "menu.php" ?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                            <h1 style="color:#666"><br/>&nbsp;&nbsp;Funcionários
                                <a style="position: relative;right: -170px;" align="right" href="cadastroFuncionario.php"><img src="images/newaluno.png" style="margin-right:30px;" width="45" border="0" title="Inserir Novo Funcionário"/></a>
                            </h1>
                            <div align="right"><br/><br/>
                                <form method="get" action="listaFuncionario.php" class="form-search form-inline">
                                    <label for="exampleInputName2" style="font-size:26px;">Buscar &nbsp;</label>
                                    <input class="form-control" style=" margin-right:20px ;padding: 10px; width: 30%; border:groove; font:Times New Roman, Times, serif; font-size:15px; " type="text" name="pesquisa" autofocus class="input-medium search-query"/>
                                </form><br/><br/>
                            </div><br/>

                            <table class="table table-striped table-hover table-condensed ">
                                <thead>
                                    <tr>
                                        <td style="font-size:22px; color:#000"><strong>Nome</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>CPF</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Telefone</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Data de Admissão</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Cargo</strong></td>
                                        <td style="font-size:22px; color:#000"><strong>Ativo</strong></td>
                                        <td colspan="2" style="font-size:22px; color:#000"><strong>Opções</strong></td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($_GET['pesquisa'])) {
                                        $pesquisa = $_GET['pesquisa'];

                                        $sql = "select nome, cpf, telefone, dt_admissao, u.perfil, u.status,u.id_usuario from funcionario f
                                    LEFT JOIN vb_usuarios u ON u.id_usuario = f.id_usuario
                                    WHERE 
                                    (nome LIKE '%$pesquisa%'
                                    OR
                                    cpf LIKE '%$pesquisa%'
                                    OR                                    
                                    nome LIKE '%$pesquisa%'
                                    OR
                                    telefone LIKE '%$pesquisa%'
                                    OR
                                    dt_admissao LIKE '%$pesquisa%'
                                    OR
                                    u.perfil LIKE '%$pesquisa%'
                                    OR
                                    u.status LIKE '%$pesquisa%');";
                                    } else {
                                        $sql = "select nome, cpf, telefone, dt_admissao, u.perfil, u.status,u.id_usuario from funcionario f
                                    LEFT JOIN vb_usuarios u ON u.id_usuario = f.id_usuario;";
                                    }

                                    $resultado = mysqli_query($con, $sql);

                                    while ($dados = mysqli_fetch_assoc($resultado)) {
                                        ?>

                                        <tr align="center" >
                                            <td><?php echo $dados['nome'] ?></td>
                                            <td><?php echo $dados['cpf']; ?></td>
                                            <td><?php echo $dados['telefone']; ?></td>
                                            <td><?php echo mostraData($dados['dt_admissao']); ?></td>
                                            <td><?php echo $dados['perfil']; ?></td>
                                            <td><?php echo $dados['status']; ?></td>
                                            <td><a href="ativarFuncionario.php?id_usuario=<?php echo $dados['id_usuario']; ?>" onClick=" return confirm('Deseja ativar este funcionário?');">
                                                    <img src="images/ok.png" width="20" title="Ativar Funcionário"/></a>
                                            </td>
                                            <td><a href="desativarFuncionario.php?id_usuario=<?php echo $dados['id_usuario']; ?>" onClick=" return confirm('Deseja realmente desativar funcionário?');">
                                                    <img src="images/delete.png" width="20" title="Desativar Funcionário"/></a>
                                            </td>

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
