<?php
    session_cache_expire(5);
    session_start();
    require "config.php";

    if(isset($_POST['agencia']) && !empty($_POST['agencia']))
    {
        $_SESSION['dados'] = $_POST['agencia'];
        $agencia = addslashes($_POST['agencia']);
        $conta = addslashes($_POST['conta']);
        $senha = addslashes($_POST['senha']);
        $sql = $pdo->prepare("SELECT*FROM contas WHERE agencia = :agencia AND conta = :conta AND senha = :senha");
        $sql->bindValue(":agencia", $senha);
        $sql->bindValue(":conta", $conta);
        $sql->bindValue(":senha", md5($senha));
        $sql->execute();
        if($sql->rowCount()>0)
        {
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['online'] = $dados;
            header("Location: index.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <title>Banco XYZ</title>
</head>
<body>
    <main class="container rounded">

    <h1 style="margin-top: 40px; margin-bottom: 40px;" class="text-primary text-center"><span class="badge badge-info">Melonio BankCode</span></h1>
    <h3 class="text-secondary h5 text-center">Acesse já sua conta!</h3>
    <div class="row d-flex justify-content-center">
        <div class="col-sm-6">
            <form method="post" autocomplete="off">
                <fieldset style="padding: 30px; border:1px solid #ccc" class="rounded">
                    <div class="form-group">
                        <label for="agencia">Agência:</label>
                        <input class="form-control" id="agencia" autocomplete="off" type="text" name="agencia" value=""/>
                        <small class="form-text text-muted">Sua agência</small>
                    </div>
                    <div class="form-group">
                        <label for="conta">Conta:</label>
                        <input class="form-control" id="conta" autocomplete="off" type="text" name="conta" value=""/>
                        <small class="form-text text-muted">Sua conta</small>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input id="senha" class="form-control" autocomplete="off" type="password" name="senha" value=""/>
                        <small class="form-text text-muted">Sua senha</small>
                    </div>        
                    <div class="text-center">
                    <input class="btn btn col-6 btn-primary" type="submit" value="Login">
                    </div>
                </fieldset>
            </form>
    </div>
    </div>
    </main>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>