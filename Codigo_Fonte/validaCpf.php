<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <div class="form-group text-left">

                                    <label for="cpf" validaCPF>
                                        CPF *
                                    </label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" />
                                </div>
        <?php

function validaCPF($cpf)
{
    $cpf = preg_replace('/[^0-9]/','',$cpf);

    $digitoA = 0;
    $digitoB = 0;

    for ($i = 0, $x = 10; $i <=8; $i++, $x--)
    {
        $digitoA +=$cpf[$i] * $x;
    }

    for ($i = 0, $x = 11; $i <=9; $i++, $x--)
    {
        if(str_repeat($i,11) == $cpf)
        {
            return false;
        }

        $digitoB += $cpf[$i] * $x;
    }

    $somaA =(($digitoA%11) < 2 ) ? 0 : 11-($digitoA%11);
    $somaB =(($digitoB%11) < 2 ) ? 0 : 11-($digitoB%11);

    if ($somaA != $cpf[9] || $somaB != $cpf[10])
    {
        return false;
    }
    else
    {
        return true;
    }
}

if(validaCPF(''))
{
    echo 'CPF Válido';
}
else
{
    echo 'CPF Inválido';
}
?>
                               

    </body>
</html>
