<?php include "header.php" ?>

<?php
require('conexao.php')
?>
<?php include "menu.php" ?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->
            <div class="col-16">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <p align="center"><br/><h2 align="center" style="color:#666"> Olá <?php echo strtoupper($_SESSION['usuario']); ?>!<br/>
                                Preencha o formulário abaixo para alterar sua senha </h2></p>
                            <p>&nbsp;</p>

                            <form id="form1" name="form1" method="post" action="alterar_senha.php" class="col-md-2 col-md-offset-5">

                                <div class="form-group text-center">
                                    <br/>
                                    <label for="nome">
                                        Nova senha:
                                    </label>
                                    <input type="password" class="form-control" name="senha" id="senha" placeholder="********"/>
                                </div>

                                <div class="form-group text-center">
                                    <br/>
                                    <label for="nome">
                                        Confirme senha:
                                    </label>
                                    <input type="password" class="form-control" name="confirme" id="confirme" placeholder="********"/>

                                </div>    
                                <input type="submit" name="Submit" value="Alterar" class="btn btn-primary" />
                                <p class="btn btn-primary" ><a class="btn-primary" href="javascript:history.back(-1)">Voltar</a>      

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php include 'footer.php'; ?>