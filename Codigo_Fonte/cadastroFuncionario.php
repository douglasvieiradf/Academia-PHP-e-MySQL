<?php include "header.php" ?>
<?php include "menu.php" ?>
<?php
require ('conexao.php');

function mostraData($dt_admissao) {
    return date("d/m/Y", strtotime($dt_admissao));
}

$dados['nome'] = "";
$dados['cpf'] = "";
$dados['telefone'] = "";
$dados['dt_admissao'] = "";
$dados['id_usuario'] = "";
$dados['login'] = "";
$dados['senha'] = "";
$dados['perfil'] = "";

?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class=" block01">
            <div class="col-md-12">
                <br>
                <br>
                <p align="center"><h1 style="color:#666"> Cadastro de Funcionário </h1><br/>

                <div class="row">
                    <!--  lado esquerdo !-->
                    <form method="post" action="insereFuncionario.php" >
                       <div class="col-md-6">
                            <div class="form-group text-left" >
                                <label for="nome" >
                                    Nome
                                </label>
                                <input name="nome" type="text" class="form-control" id="nome"   placeholder="" />
                                <input name="id_usuario" type="hidden" class="form-control" id="id_usuario"  value="<?php echo $_GET['id_usuario']; ?>" />
                                
                            </div>
                            <div class="form-group text-left" >
                                <label for="perfil" >
                                    Cargo
                                </label>
                                <select name="perfil" type="text" class="form-control" id="perfil"  />
                                <option value="opcao">Selecione uma opção</option>
                                <option value="professor">Professor</option>
                                
                                </select>
                            </div>
                            <div class="form-group text-left" >
                                <label for="cpf" >
                                    CPF
                                </label>
                                <input name="cpf" type="text" class="form-control" id="cpf"   placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="telefone" >
                                    Telefone
                                </label>
                                <input name="telefone" type="text" class="form-control" id="telefone"   placeholder="" />
                            </div>
                        </div>

                        <!-- Temina lado esquerdo !-->

                        <!-- lado direito !-->
                        <div class="col-md-6">
                            <div class="form-group text-left" >
                                <label for="dt_admissao" >
                                    Data de Admissão
                                </label>
                                <input name="dt_admissao" type="date" class="form-control" id="dt_admissao"   placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="login" >
                                    Login
                                </label>
                                <input name="login" type="text" class="form-control" id="login"   placeholder="" />
                            </div>
                            <div class="form-group text-left" >
                                <label for="senha" >
                                    Senha
                                </label>
                                <input name="senha" type="password" class="form-control" id="senha"   placeholder="" />
                            </div>
                            
                            <br>
                        </div>
                        <button name="limpar" type="submit" class="btn btn-primary">Salvar</button>    
                        <button name="limpar" type="reset" class="btn btn-primary">Limpar</button>
                    </form>
                </div>

                <!-- Temina lado direito !-->
                
            </div>
        </div>
    </div>
</div>
</section>

<?php include "footer.php" ?>