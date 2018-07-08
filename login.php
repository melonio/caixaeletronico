<?php
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco XYZ</title>
</head>
<body>
    <pre>
        <?php print_r($_SESSION); ?>
    </pre>
    <h1>Banco XYZ</h1>
    <h3>Acesse já sua conta!</h3>
    <form method="post" action="">
        Agencia:
        <input autocomplete="off" type="text" name="agencia" value=""/> <br><br>
        Conta:
        <input autocomplete="off" type="text" name="conta" value=""/> <br><br>
        Senha:
        <input autocomplete="off" type="password" name="senha" value=""/> <br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>