<?php
    session_start();
    //include('functions.php');
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Valida CPF e CNPJs</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            font: calibri;
            font-size: 22;                 
        }

        body {
            background-color: #848484; 
        }

        div {
            margin-top: 8em;
            margin-left: 35%;
        }

        form {
            padding: 4em;
            width: 25em;
            background-color: #4F4F4F;
            border-radius: 0.4em;
            -moz-border-radius: 0.4em;
            -webkit-border-radius: 0.4em;                
            box-shadow: 0px 0px 12px 5px white;
            -webkit-box-shadow: 0px 0px 12px 5px white;
            -moz-box-shadow: 0px 0px 12px 5px white;
        }

        input, button, label {
            margin-left: 1.4em;
            margin-top: 1em;
            width: 14em; 
            text-align: center;      
        }

        input {
            margin-top: 0.5em;
            background-color: #FDF5E6;
            border-radius: 0.2em;
            height: 2em;
        }

        label {
            margin-top: -2em;
            margin-bottom: 0em;
            color: #F2F5A9;
        }

        button {
            padding-top: 0.5em;
            font-weight: bold;
        }

        h1, h2, h3 {
            color: #F2F5A9;
            text-align: center
        }

        /*FORMATAÇÃO DA JANELA MODAL*/
        .modal-window {
            z-index: 3;
            width: 100%;
            height: 100%;
            top: -8em;
            left: -35%;
            background-color: rgba(0, 0, 0, 0.8);
            position: fixed;
            display: none;
        }

        .modal-window:target {
            display: block;
        }

        /*MODAL BOX COM FORM DE 2 INPUTS*/
        .modal-box {
            width: 30em;
            position: absolute;
            margin-left: -260px;
            left: 50%;
            top: -5%;
        }

        div .div-return {
            padding-top: 7em;;
            width: 30em;
            height: 8.65cm;
            margin: 0em;
            position: absolute;
            background-color: #4F4F4F;
            border-radius: 0.4em;
            -moz-border-radius: 0.4em;
            -webkit-border-radius: 0.4em;                
            box-shadow: 0px 0px 12px 5px white;
            -webkit-box-shadow: 0px 0px 12px 5px white;
            -moz-box-shadow: 0px 0px 12px 5px white;
            overflow: hidden; /* qualquer objeto que estiver dentro não vai aparecer seus excessos*/
        }

        #close {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            position: absolute;
            background: #000;
            width: 0.7cm;
            height: 0.7cm;
            text-align: center;
            right: 0.5em;
            top: 0.5em;
        }
    </style>
</head>
<body>
    <div class="form">
        <form action="valida.php" method="POST">
           <label for=""> <strong>VERIFICAÇÃO DE CPF/CNPJ</strong></label><br>
            <input type="text" name="number" placeholder="Digite aqui"><br>
            <button type="submit" class="btn btn-info">TESTAR</button>
        </form>
    </div>
    <div id="modal-window-update" class="modal-window" >
        <div class="modal-box">
            <div class="div-return">
                <h1><strong><?php echo $_SESSION['number']; ?></strong></h1>
                <h2><?php echo $_SESSION['message']; ?></h2>
            </div>                
            <a href="../index.php" id="close">X</a> 
        </div>
    </div>
</body>
</html>
