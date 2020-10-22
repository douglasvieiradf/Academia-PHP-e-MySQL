<style>
    @media screen and (max-width: 1000px) {
        .logot {
            display: none;
        }
    }
</style>

<div class="wrap-header zerogrid" >
<div id="logo"><a href="index.php"><img class="logot" src="./images/02.jpg"/></a></div>
    <nav>
        <div class="wrap-nav menu-redondo">
            <div class="menu" >
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="atividades.php">Atividades</a></li>
                    <li><a href="quemSomos.php">Quem Somos</a></li>
                    <li><a href="faleConosco.php">Fale Conosco</a></li>
                    <li style="background:#d41319;border-radius: 10px"><a href="matricula.php">Matricule-se</a></li>
                    <li class="dropdown ">
                        <a href="script_principal.php" class="dropdown-toggle" data-toggle="dropdown">Acesso Restrito<strong class="caret"></strong></a>
                        <ul class="dropdown-menu wrap-nav menu mhover"  >
                            <li>
                                <a id="administrador" href="#modal-container-643930" data-toggle="modal">Administrador</a>
                            </li>
                            <li>
                                <a id="modal-643931  " href="#modal-container-643931" data-toggle="modal">Aluno</a>
                            </li>
                            <li>
                                <a id="modal-643932" href="#modal-container-643932" data-toggle="modal">Professor</a>
                            </li>
                                                    </ul>
                    </li>
                </ul>
            </div>

            <div class="minimenu"><div>MENU</div>
                <select onChange="location = this.value">
                    <option></option>
                    <option value="index.php">Inicio</option>
                    <option value="atividades.php">Atividades</option>
                    <option value="quemSomos.php">Quem Somos</option>
                    <option value="faleConosco.php">Fale Conosco</option>
                    <option value="matricula.php">Matricule-se</option>
                    <option value="areaRestrita">Área Restrita</option>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acesso Restrito<strong class="caret"></strong></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a id="administrador" href="#modal-container-643930" data-toggle="modal">Administrador</a>
                            </li>
                            <li>
                                <a id="aluno" href="#modal-container-643931" data-toggle="modal">Aluno</a>
                            </li>
                            <li>
                                <a id="professor" href="#modal-container-643932" data-toggle="modal">Professor</a>
                            </li>

                </select>
            </div>
        </div>
    </nav>
</div>
</header>
<!-- Aqui finaliza o menu superior -->

<!-- Login Administrador -->

<div class="modal fade" id="modal-container-643930" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center" style="background:#87CEFA;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Login Administrador
                </h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" method="post" action="" name="formAdministrador">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label ">Usuário:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control " id="username " name="username" autofocus placeholder="Usuário">
                            <input type="hidden" name="tipo_login" id="tipo_login" value="administrador" />
                        </div>
                        <img src="images/02.jpg" width="240"   style="position: absolute; top: 17px;"  />
                    </div>
                    <div class="form-group">
                        <label for="senha" class="col-sm-2 control-label">Senha:</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="senha" name="senha"  required placeholder="*******">
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group"><br><br>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-default " onclick="return efetuaLogin('formAdministrador');">Entrar</button>
                        </div>
                        <div class="loading" align="center">

                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>
<!-- Fim Login Administrador -->

<!-- Login Aluno-->

<div class="modal fade" id="modal-container-643931" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center" style="background:#87CEFA;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Login Aluno
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="" name="formAluno">
                    <div class="form-group">
                        <label for="cpf" class="col-sm-2 control-label">CPF:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="username" name="username" autofocus placeholder="">
                            <input type="hidden" name="tipo_login" id="tipo_login" value="aluno" />
                        </div>
                        <img src="images/02.jpg" width="240"   style="position: absolute; top: 17px;"  />
                    </div>
                    <div class="form-group">
                        <label for="senha" class="col-sm-2 control-label">Senha:</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="senha" name="senha"  required placeholder="******">
                        </div>
                    </div>
                    <div class="form-group"><br><br>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-default " onclick="return efetuaLogin('formAluno');">Entrar</button>
                        </div>
                        <div class="loading" align="center">
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>

<!-- fim Login Aluno-->

<!-- Login Professor-->

<div class="modal fade" id="modal-container-643932" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center" style="background:#87CEFA;">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Login Professor
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" name="formProfessor">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Usuário:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="username" name="login" autofocus placeholder="Usuário">
                            <input type="hidden" name="tipo_login" id="tipo_login" value="professor" />
                        </div>
                        <img src="images/02.jpg" width="240"   style="position: absolute; top: 17px;"  />
                    </div>
                    <div class="form-group">
                        <label for="senha" class="col-sm-2 control-label">Senha:</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="********">
                        </div>
                    </div>
                    <div class="form-group"><br><br>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-default " onclick="return efetuaLogin('formProfessor');">Entrar</button>
                        </div>
                        <div class="loading" align="center">
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>
<!-- Fim Login Professor-->

<?php
$dados['nome'] = "";

if (isset($_SESSION["usuario"])) {
    if ($_SESSION["tipo_usuario"] == 'professor') {
        include "menuRestrito.php";
    } else if ($_SESSION["tipo_usuario"] == 'aluno') {
        include "menuRestritoAluno.php";
    } else if ($_SESSION["tipo_usuario"] == 'operador') {
        include "menuRestritoOperador.php";
    } else if ($_SESSION["tipo_usuario"] == 'administrador') {
        include "menuRestritoAdministrador.php";
    }
}
?>

