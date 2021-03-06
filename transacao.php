<?php
    session_start();
    require "config.php";
    if(isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
        $valor = str_replace(",",".",$_POST['valor']);
        $sql = $pdo->prepare("INSERT INTO historico(id_conta, tipo, valor, data_operacao) VALUES (:id_conta, :tipo, :valor, NOW())");
        $sql->bindValue(":id_conta", $_SESSION['online']['id']);
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":valor", floatval($valor));
        $sql->execute();
        if($tipo == 0)
        {
            $sql = $pdo->prepare("UPDATE contas SET saldo = saldo + :saldo WHERE id = :id");
            $sql->bindValue(":saldo", $valor);
            $sql->bindValue(":id", $_SESSION['online']['id']);
            $sql->execute();
            
        }
        else
        {
            $sql = $pdo->prepare("UPDATE contas SET saldo = saldo - :saldo WHERE id = :id");
            $sql->bindValue(":saldo", $valor);
            $sql->bindValue(":id", $_SESSION['online']['id']);
            $sql->execute();
        }
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <main class="container">
        <div style="margin-top: 100px;" class="row d-flex justify-content-center">
            
            <div class="col-md-6">
            <h6>Fazer transação <span class="badge badge-secondary">Depósitos ou Saques<span></h6>
                <form method="post">
                    <div class="form-group">
                        <select class="form-control" name="tipo" id="seletor">
                            <option value="0">Depósito</option>
                            <option value="1">Saque</option>
                        </select>
                    </div>
                    <div class="form-group"><input autocomplete="off" pattern="^[0-9,.]+$" class="form-control" type="text" name="valor" id=""/></div>
                    <input id="btn-ts" class="btn btn-success" type="submit" value="FAZER DEPÓSITO">
                </form>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="script.js" type="text/javascript"></script>
</body>
</html>