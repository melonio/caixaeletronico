<?php
session_start();
require "config.php";
if(isset($_SESSION['online']) && !empty($_SESSION['online']))
{
    $sql = $pdo->prepare("SELECT saldo FROM contas WHERE id = :id");
    $sql->bindValue(":id", $_SESSION['online']['id']);
    $sql->execute();
    if($sql->rowCount() > 0)
    {
        $saldo = $sql->fetch(PDO::FETCH_ASSOC);
        //print_r($saldo);
        //ext:htaccess
    }
}
else
{
    header("Location: login.php");
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
    <h1>Banco XYZ</h1>
    <strong>Titular:</strong> <?php echo $_SESSION['online']['titular'];?> <br/><br/>
    <strong>Agencia:</strong> <?php echo $_SESSION['online']['agencia'];?> <br/><br/>
    <strong>Conta:</strong> <?php echo $_SESSION['online']['agencia'];?> <br/><br/>
    <strong>Saldo: </strong><?php echo $saldo['saldo'];?> <br><br>
    <a href="sair.php">Sair</a>
</body>
</html>