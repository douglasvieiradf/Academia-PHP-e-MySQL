<?php include "header.php" ?>
<?php
$msg = 0;
@$msg = $_REQUEST['msg'];
if (isset($_GET['msg']) AND $_GET['msg'] == 'sim') {
    $enviado = 'sim';
} else {
    $enviado = 'nao';
}
?>

<?php include "menu.php" ?>

<section id="content">
    <div class="wrap-content zerogrid">
        <div class=" block01">
            <br>
            <br>
            <img alt="Carousel Bootstrap First"  src="images/atende.jpg"   width="899px" />

            <div > 
                <div class="row block01" >
                    <br>

                    <div class="" >
                        <form action="processaForm.php" method="post" />
                            <div class="col-md-12">
                                <h1 align="center" style="color: #d41319"><b>Fale Conosco </b></h1>
                                <br/>
                                <h2 align="center" style="color:#666"> A Academia Fitness acredita que é importante estar sempre disponível para seus clientes. Por isso, 
                                    <br/>  caso você precise de alguma informação, tirar dúvidas ou enviar alguma sugestão, fique a vontade!
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="">
                            <div class="col-md-6">
                                <fieldset>
                                    <form  method="post" >
                                        
                                        <div class="form-group text-left" >
                                            <label for="nome" >
                                                Nome *
                                            </label>
                                            <input name="nome" type="text" class="form-control" id="nome"  required placeholder="Informe seu nome" />
                                        </div>
                                        
                                        <div class="form-group text-left">
                                            <label for="email">
                                                Email *
                                            </label>
                                            <input name="email" type="email" class="form-control" id="email" required placeholder="meu_email@exemplo.com.br" />
                                        </div>
                                        <div class="form-group text-left" >

                                            <label for="assunto">
                                                Assunto *
                                            </label>
                                            <input name="assunto" type="text" class="form-control" id="assunto" required placeholder="Digite o que deseja" />
                                        </div>

                                        <div class="form-group text-left">
                                            <label for="mensagem">
                                                Mensagem *
                                            </label>
                                            <textarea placeholder="Coloque aqui o seu texto"  name="mensagem" type="tel" class="form-control" id="mensagem" rows="5" required/></textarea>
                                        </div>
                                        <p align="center" style="color:#f90">* Campos obrigatórios</p><br/>
                                        <button type="submit" class="btn btn-default"  >Enviar</button>
                                        <button name="limpar" type="reset" class="btn btn-default">Limpar</button>

                                        <button type="button" class="btn btn-success" id="chama_modal" data-toggle="modal" data-target=".bs-example-modal-sm" style="display:none;">Enviar</button>
                                         
                                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" >
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <br>
                                                    Mensagem enviada com sucesso! <br>
                                                    Aguarde nosso retorno.
                                                    <br>
                                                    <br>
                                                    <button type="button" class="btn btn-default" ><a href="index.php"> Inicio</a></button>
                                                    <button type="button" class="btn btn-default"><a href="faleConosco.php"> Voltar</a></button>
                                                    <br>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                            </div>
                            <div class="col-md-6">

                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3840.573058426184!2d-47.88788513562729!3d-15.720795375335976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdd62e955fb5d88ce!2sIguatemi+Brasilia!5e0!3m2!1spt-BR!2sbr!4v1474086245677" width="460" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    </fieldset>
            </div>
        </div>
</section>
<?php include "footer.php" ?>
<?php
if ($enviado == 'sim') {
    ?>
    <script type="text/javascript">
        $('#chama_modal').click();
    </script></section>
<?php } ?>
