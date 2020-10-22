<?php include "header.php" ?>
<?php include "menu.php" ?>

<!--------------Content--------------->
<section id="content">
    <div class="wrap-content zerogrid">
        <div class="row block01"><!--------------Essa e a div da fundo branco--------------->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="page-header">
                            <h1 align="center" style="color: #d41319"><b>Nossa História!</b><b/>
                                <small>Uma academia perfeita para sua família</small>
                            </h1>
                        </div>
                    </div><!--col-md-12-->
                </div><!--fim da div row-->
                <div class="row">
                    <div class="col-md-6">
                        <img width=600px; height=900px alt="Bootstrap Image Preview" src="images/supino.jpg"/>
                    </div>
                    <div class="col-md-6">
                        <p class="texto">
                            Somos um grupo de desenvolvedores para oferecer este projeto para as academias
                            que precisam de um sistema pra gerenciamento, prezando sempre a saúde e o bem-estar
                            em primeiro lugar. Nosso corpo direcional tinha uma visão de futuro revolucionária para
                            a época, naquele momento as academias se preocupavam mais com o corpo e a beleza do que
                            a saúde.
                        </p>
                        <font color=#777 size="4" id="font1" onclick="mostra()">
                            Clique aqui para ler mais
                        </font>
                        <font size="3" id="font2" style="display: none" onclick="apaga()">
                            <p class="texto">Oferecemos um projeto para implementar atividades além da musculação,
                                dentre elas várias modalidades de ginástica, natação, ballet, jazz, futsal,
                                hidroginástica entre outras que se destacam por abranger alunos de 0 a 100 anos.
                            <br/>
                            </p>
                            <p style="color: #777">Clique sobre este texto para ocultá-lo.</p>
                        </font>

                        <script language="JavaScript">
                            <!--

                            function mostra() {

                                document.all.font2.style.display = "";

                            }

                            function apaga() {

                                document.all.font2.style.display = "none";

                            }

                            // -->
                        </script>
                    </div>
                </div>

            </div><!--fim da div container-fluid-->
        </div><!--Fim da div do fundo branco-->

    </div><!--wrap-content zerogrid-->
</section>
<div class="rodape">
    <div class="col-md-12">
        <div class="principios"><br/>
            <h3 align="center">MISSÃO</h3>
                    <h4>Oferecer serviços de qualidade e preços compatíveis com o mercado. Excelência e
                        sustentabilidade, proporcionando tranquilidade e bem–estar aos nossos clientes.</h4>
        </div>

        <div class="principios">
            <h3 align="center">VISÃO</h3>
                    <h4>Estar entre as maiores empresas do ramo fitness do Distrito Federal, com ética e rentabilidade,
                        reconhecida pela excelência e qualidade dos seus serviços, agregando valores motivacionais e
                        qualidade de vida aos nossos colaboradores, parceiros, alunos e sociedade.</h4>
        </div>

        <div class="principios"><br/>
            <h3 align="center">VALORES</h3>
            <h4>Ética; Respeito; Credibilidade; Valorização do capital humano; Compromisso com a qualidade; Adaptação às
                mudanças; Inovação; Foco no cliente; Sustentabilidade e Responsabilidade social.</h4>
        </div>
    </div>
</div>

<?php include "footer.php" ?>

<!--Script revelar esconder Inicio -->
<script type='text/javascript'>
    $(document).ready(function () {
        $(".mostrar").hide();
        $(".ocultar").click(function () {
            $(this).next(".mostrar").slideToggle(600);
        });
    });
</script>
<!--Script revelar esconder Final-->
