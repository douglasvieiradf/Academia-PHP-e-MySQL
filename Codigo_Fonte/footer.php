<!--------------Footer--------------->
<footer style="background: #000000">     <!--cor anterior #74AFF9-->
    <div class="wrap-footer zerogrid" >
        <div class="row">
            <div class="col-1-3">
                <div class="wrap-col">
                    <div class="box">
                        <div class="heading"><h2>FAÇA SEU ORÇAMENTO</h2></div>
                        <div class="content">
                            <p>Centro Universitário do Distrito Federal - UDF <br/>
                                Brasília - DF<br/>
                                Seg/sex 06h às 21h<br/>
                                Sábado 08h às 12h<br/>
                                 </p>

                        </div>
                        <div class="heading"><h2>CONTATO</h2></div>
                        <div class="content">
                            <p>Telefone:(61) 3468-1101 <br/>
                                Fax: (61)3468-1110 <br/>
                                E-mail: desenvolvedoresdf@gmail.com<br/>
                                <img src="images/instalogo.png" width="20" height="22" /> Instagram: desenvolvedoresdf<br/>
                                <img src="images/facelogo.png" width="20" height="22" /> Facebook: desenvolvedores Fitness
                            </p>

                        </div>


                    </div>
                </div>
            </div>
            <div class="col-2-3">
                <div class="wrap-col">
                    <div class="box">
                        <div class="heading"><h2> NOSSOS PARCEIROS</h2></div>
                        <div class="content">
                            <div class="gallery">
                                <a href="http://www.pumpsuplementos.com/"><img src="images/udf.jpg"  style="width: 192px; height: 111px" /></a>
                                <a href="http://www.naturalfitsport.com/"><img src="images/naturalfit.jpg" style="width: 192px; height: 111px" /></a>
                                <a href="http://www.integralmedica.com.br/"><img src="images/integral.jpg" style="width: 192px; height: 111px"/></a>
                            </div>
                        </div>
                        <div class="content">
                            <div class="gallery">
                                <a href="http://www.maxformsuplementos.com.br/"><img  src="images/pump.png" style="width: 192px; height: 111px"/></a>
                                <a href="http://www.cooplemidiomas.com.br/"><img src="images/cooplem.jpg" style="width: 192px; height: 111px"/></a>
                                <a href="http://www.senac.br/"><img src="images/maxform.png"  style="width: 192px; height: 111px"/></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>Desenvolvedores UDF - todos os direitos reservados © 2020</p>
        </div>


    </div>
    <!--   Aqui Termina o container    -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.1.0.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function efetuaLogin(form)
        {

            if (form == 'formAdministrador')
            {
                var username = formAdministrador.username.value;
                var senha = formAdministrador.senha.value;
                var tipo_login = formAdministrador.tipo_login.value;
            }
            else if (form == 'formAluno')
            {
                var username = formAluno.username.value;
                var senha = formAluno.senha.value;
                var tipo_login = formAluno.tipo_login.value;
            }
            else if (form == 'formProfessor')
            {
                var username = formProfessor.username.value;
                var senha = formProfessor.senha.value;
                var tipo_login = formProfessor.tipo_login.value;
            }
            else if (form == 'formOperador')
            {
                var username = formOperador.username.value;
                var senha = formOperador.senha.value;
                var tipo_login = formOperador.tipo_login.value;
            }
            $.ajax({
                type: "POST",
                url: "login.php",
                data: {
                    username: username,
                    senha: senha,
                    tipo_login: tipo_login
                },
                beforeSend: function () {
                    var a = '<div><img src="images/loading.gif" width="70" border="0" /><br />Verificando dados...</div>';
                    $('.loading').html(a);
                },
                success: function (data) {
                    if (data == 0)
                    {
                        $('.loading').html('<div class="alert alert-danger">Todos os campos são obrigatórios</div>');
                        setTimeout(function () {
                            $('.loading').html('');

                        }, 2500);
                    }
                    else if (data == 6)
                    {
                        $('.loading').html('<div class="alert alert-danger">Dados não encontrados</div>');
                        setTimeout(function () {
                            $('.loading').html('');

                        }, 2500);
                    }
                    else if (data == 1)
                    {
                        $('.loading').html('<div class="alert alert-success">Aguarde...</div>');
                        setTimeout(function () {
                            window.location = "script_principal.php";
                        }, 2000);
                    }
                    else if (data == 2)
                    {
                        $('.loading').html('<div class="alert alert-success">Aguarde...</div>');
                        setTimeout(function () {
                            window.location = "listaFichas.php";
                        }, 2000);
                    }
                    else if (data == 3)
                    {
                        $('.loading').html('<div class="alert alert-success">Aguarde...</div>');
                        setTimeout(function () {
                            window.location = "listaFuncionario.php";
                        }, 2000);
                    }
                }
            })

        }
    </script>
</footer>
</body>
</html>