<section >
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-default"  role="navigation" style="background-color: #eaf2ff; margin-bottom: -80px;" >

                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav" >
                                        <li class="active" s >
                                            <div  align="left"  >
                                                <!--<h3 style="color:#666" ><?php echo $msg; ?></h3>-->
                                                <h3 style="color:#666" >Área do Professor</h3>
                                                <h3 style="color:#666" >Bem-vindo(a) <?php echo strtoupper($_SESSION["nome"]); ?>!</h3>
                                                <!--<h3 style="color:#666" >Bem-vindo(a) <?php echo $dados['nome']; ?>!</h3>-->

                                                <div class="menu" align="right" >
                                                    <ul >

                                                        <li><a  align="center" style="color:#000000" href="dashProfessor.php">Painel</a></li>
                                                        <li><a  align="center" style="color:#000000" href="script_principal.php">Turmas</a></li>
                                                        <li></button> <a align="center" style="color:#000000" href ="troca_senha.php" >Alterar Senha</a></li>
                                                        <li><a  align="center" style="color:#000000" href="logout.php">Sair</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </li>


                                    </ul>


                                </div>

                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/jquery-3.1.0.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
