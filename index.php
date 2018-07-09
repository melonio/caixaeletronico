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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <title>Banco XYZ</title>
</head>
<body>

    <main class="container">
        <div class="jumbotron bg-white">
            <h4>Olá, <?php echo $_SESSION['online']['titular'];?> <span class="badge badge-info">Painel</span></h4>
            <!-- <div class="display-4">Olá, <?//php echo $_SESSION['online']['titular'];?></div> -->

            <table style="border-radius=14px;" class="table text-center table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr class="">
                        <th>Agência</th>
                        <th>Conta</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody class="bg-info">
                    <tr>
                        <td><?php echo $_SESSION['online']['agencia'];?> </td>
                        <td><?php echo $_SESSION['online']['conta'];?></td>
                        <td>R$ <?php echo $saldo['saldo'];?></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <a class="btn btn-danger col-3" href="sair.php">Sair</a>
            </div>

            <p class="lead">Suas transações de forma rápida, fácil e segura!</p>
            <hr class="my-4">

            <h5>Movimentações <span class="badge badge-success">Acompanhamento</span></h5>

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nº Transação</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody id="mvs">
                        <?php
                        $sql = $pdo->prepare("SELECT*FROM historico WHERE id_conta = :id_conta");
                        $sql->bindValue(":id_conta", $_SESSION["online"]["id"]);
                        $sql->execute();
                        if($sql->rowCount()>0)
                        {
                            foreach($sql->fetchAll() as $item)
                            {
                        ?>
                                <tr>
                                    <td class="id"><?php echo $item['id']; ?></td>
                                    <td class="tipo"><? echo $item['tipo'];?></td>
                                    <td class="data"><?php echo date("d/m/Y H:i", strtotime($item['data_operacao']));?></td>
                                    <td class="valor"><?php echo $item['valor']; ?></td>
                                </tr>
                        <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
            
        </div>
    </main>

    <!-- <h1>Banco XYZ</h1>
    <strong>Titular:</strong> <?php echo $_SESSION['online']['titular'];?> <br/><br/>
    <strong>Agencia:</strong> <?php echo $_SESSION['online']['agencia'];?> <br/><br/>
    <strong>Conta:</strong> <?php echo $_SESSION['online']['agencia'];?> <br/><br/>
    <strong>Saldo: </strong><?php echo $saldo['saldo'];?> <br><br> -->
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="script.js" type="text/javascript"></script>
</body>
</html>