<!DOCTYPE html>
<?php   
   include_once "../conf/default.inc.php";
   require_once "../conf/Conexao.php";
   include_once "../classes/Item_venda.class.php";
   include_once "../classes/Venda.class.php";
   $title = "Venda";
   $id = $_GET['id'];
   $cliente = $_GET['cliente'];
   $totalAll = 0;
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <style>
        .main {
            padding-left: 5vw;
        }

        table, th, td {
            padding: 1vw;
            border: 3px solid black;
            border-style: dotted;
        }
    </style>
</head>
<body class="">
    <?php include_once "menu.php"; ?>
    <div class="main">
        <p>Venda: <?php echo $id; ?> Cliente: <?php echo $cliente; ?></p>
        <table class="" style="background-color: #FFF;">
            <thead>
                <tr class="">
                    <th scope="col">It</th>
                    <th scope="col">Título</th>
                    <th scope="col">Qtd</th>
                    <th scope="col">Valor Unitário</th>
                    <th scope="col">Valor Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $item_venda = new Venda('', '', '', '');
                echo $item_venda->listarVenda($id);               
            ?>
            </tbody>
        </table>
        <br>
    </div>
</body>
</html>