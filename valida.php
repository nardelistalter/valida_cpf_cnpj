<?php
    session_start();

/**
 * @package  valida_cpf_cnpj
 * @author   Nardeli Miguel Stalter <@nardelistalter@gmail.com>
 * @version  v1.0
 * @access   public
 */

    /**
     * Verifica se o campo foi preenchido com algum valor
     * @param string $_POST['number']
    */
    if (!empty($_POST['number'])) {

        // Extrai e mantêm somente os caracteres numéricos dos dados digitados
        $number = preg_replace('/[^0-9]/is', '', $_POST['number']);
        
        // Conta o número de caracteres numéricos
        $numberChar = strlen($number);

        //Se o número for menor ou igual a 11, então pode ser UM CPF
        if ($numberChar >= 1 && $numberChar <= 11) {
            // Extrai os caracteres digitados e atribui ao array
            // Verifica e completa com 'zero(s)' à esquerda, caso NÃO tenha(m) sido informado(s)
            // Exibe o resultado no Alert
            $soma = 0;
            $char = array();
            for ($i = 0; $i < 11; $i++) { 
                $char[] = $numberChar - (11 - $i) >= 0 ? substr($number, $numberChar - (11 - $i), 1) : 0;
                if ($i < 9) {                    
                    /* Soma da multiplicação dos 9 primeiros caracteres do cpf digitado pelo número da sua respectiva posição, iniciando em 1:
                       o 1º por 1, o 2º por 2, e assim sucessivamente... */
                    $soma += $char[$i] * ($i + 1);
                }
            }

            // Valida o Primeiro Dígito: Identifica o resto da divisão do cálculo por 11
            $resto = $soma % 11;

            // Se o resultado for igual a 10, atribui valor 0. Senão mantêm o valor.
            if ($resto == 10) {
                $resto = 0;
            }

            // Compara o PRIMEIRO dígito verificador informado com o resultado do cálculo
            if ($resto == $char[9]) {
                 /* Se for verdadeiro, soma a multiplicação de cada um dos 10 primeiros caracteres do cpf digitado pelo número da 
                    sua respectiva posição, iniciando em 0: o 1º por 0, o 2º por 1, e assim sucessivamente */
                $soma = 0;
                for ($i = 0; $i < 10; $i++) {                   
                    $soma += $char[$i] * $i;
                }

                // Identifica o resto da divisão por 11
                $resto = $soma % 11;

                // Se o resultado for igual a 10, atribui valor 0. Senão mantêm o valor
                if ($resto == 10) {
                    $resto = 0;
                }

                // Compara o SEGUNDO dígito verificador informado com o resultado do cálculo
                if ($resto == $char[10]) {
                    //true;
                    $_SESSION['number'] = $char[0] . $char[1] . $char[2] . "." . $char[3] . $char[4] . $char[5] . "." . $char[6] . $char[7] . $char[8] . "-" . $char[9] . $char[10];
                    $_SESSION['message'] = "É um CPF válido!";

                } else {
                    //false;
                    $_SESSION['number'] = $char[0] . $char[1] . $char[2] . "." . $char[3] . $char[4] . $char[5] . "." . $char[6] . $char[7] . $char[8] . "-" . $char[9] . $char[10];
                    $_SESSION['message'] = "NÃO é um CPF válido!";
             
                }
            } else {
                //false
                $_SESSION['number'] = $char[0] . $char[1] . $char[2] . "." . $char[3] . $char[4] . $char[5] . "." . $char[6] . $char[7] . $char[8] . "-" . $char[9] . $char[10];
                $_SESSION['message'] = "NÃO é um CPF válido!";
 
            }            

        // Se o número de caracteres for maior 11 e menor igual a 14, verifica se é UM CNPJ
        } elseif ($numberChar >= 1 && $numberChar <= 14) {            
            // Extrai os caracteres digitados e atribui às variáveis
            // Verifica e completa com 'zero(s)' à esquerda, caso NÃO tenha(m) sido informado(s)
            $soma = 0;
            $char = array();

            for ($i = 0; $i < 14; $i++) { 
                $char[] = $numberChar - (14 - $i) >= 0 ? substr($number, $numberChar - (14 - $i), 1) : 0;
                if ($i < 4) {
                    /* Soma a multiplicação dos 4 primeiros caracteres do cnpj digitado pela seguinte sequência de números: 
                    5	4	3	2	e...*/
                    $soma += $char[$i] * (5 - $i);
                } elseif ($i < 12) {
                    /* ... soma a multiplicação do 5º ao 12º caractere do cnpj digitado pela seguinte sequência de números: 
                    9	8	7	6	5	4	3	2*/
                    $soma += $char[$i] * (13 - $i);
                }
            }

            // Identifica o resto da divisão por 11
            $resto = $soma % 11;

            // Se o resultado for menor que 2, atribuir valor 0, senão deve subtrair o valor resultante de 11
            if ($resto < 2) {
                $resto = 0;
            } else {
                $resto = 11 - $resto;
            }

            // Compara o resultado com o PRIMEIRO dígito verificador informado
            if ($resto == $char[12]) {
                $soma = 0;
                for ($i = 0; $i < 14; $i++) { 
                    if ($i < 5) {
                        /* Soma a multiplicação dos 5 primeiros caracteres do cnpj digitado pela seguinte sequência de números: 
                        6   5	4	3	2	e...*/
                        $soma += $char[$i] * (6 - $i);
                    } elseif ($i < 13) {
                        /* ... soma a multiplicação do 6º ao 13º caractere do cnpj digitado pela seguinte sequência de números: 
                        9	8	7	6	5	4	3	2*/
                        $soma += $char[$i] * (14 - $i);
                    }
                }
                
                // Identifica o resto da divisão do cálculo por 11
                $resto = $soma % 11;
                
                // Se o resultado for menor que 2, atribuir valor 0, senão deve subtrair o valor resultante de 11
                if ($resto < 2) {
                    $resto = 0;
                } else {
                    $resto = 11 - $resto;
                }

                // Compara o resultado com o SEGUNDO dígito verificador informado
                if ($resto == $char[13]) {
                    //true;
                    $_SESSION['number'] = $char[0] . $char[1] . "." . $char[2] . $char[3] . $char[4] . "." . $char[5] . $char[6] . $char[7] . "/" . $char[8] . $char[9] . $char[10] . $char[11] . "-" . $char[12] . $char[13];
                    $_SESSION['message'] = "É um CNPJ válido!";                    
  
                } else {
                    //false
                    $_SESSION['number'] = $char[0] . $char[1] . "." . $char[2] . $char[3] . $char[4] . "." . $char[5] . $char[6] . $char[7] . "/" . $char[8] . $char[9] . $char[10] . $char[11] . "-" . $char[12] . $char[13];
                    $_SESSION['message'] = "NÃO é um CNPJ válido!"; 
  
                }
                
            } else {
                //false
                $_SESSION['number'] = $char[0] . $char[1] . "." . $char[2] . $char[3] . $char[4] . "." . $char[5] . $char[6] . $char[7] . "/" . $char[8] . $char[9] . $char[10] . $char[11] . "-" . $char[12] . $char[13];
                $_SESSION['message'] = "NÃO é um CNPJ válido!"; 

            }

        } else {
            $_SESSION['number'] = ($numberChar > 0 ? $number . ': ' : '');
            $_SESSION['message'] = "Isso é qualquer coisa, menos um CPF/CNPJ!"; 

        }

    } else {
        $_SESSION['number'] = null;
        $_SESSION['message'] = "Favor informar o valor!"; 
    }

    //Redireciona para a tela inicial
    header("location:../valida_cpf_cnpj/index.php/#modal-window-update"); 
?>