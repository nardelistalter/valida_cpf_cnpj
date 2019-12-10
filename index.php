<?php
    session_start();
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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Valida CPF e CNPJs</title>
</head>

<body>
    <div class="form">
        <form action="valida.php" method="POST">
            <label for=""> <strong>VERIFICAÇÃO DE CPF/CNPJ</strong></label><br>
            <input type="text" name="number" placeholder="Digite aqui"><br>
            <button type="submit" class="btn btn-info">TESTAR</button>
        </form>
    </div>
    <div id="modal-window-update" class="modal-window">
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