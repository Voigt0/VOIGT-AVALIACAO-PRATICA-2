<!DOCTYPE html>
<?php   
   include_once "../conf/default.inc.php";
   require_once "../conf/Conexao.php";
   include_once "../classes/Item_venda.class.php";
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
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT v_idVenda, v_valor_total_venda, v_desconto, l_titulo, iv_quantidade, iv_valor_total_item, c_nome, l_preco
                                        FROM Venda, Item_venda, Cliente, Livro
                                        WHERE v_idVenda LIKE '$id%'
                                        AND iv_v_idVenda = v_idVenda
                                        AND l_idLivro = iv_l_idLivro 
                                        AND c_idCliente = v_c_idCliente
                                        ORDER BY v_idVenda");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    $totalUni = $linha['l_preco'] * $linha['iv_quantidade'];
                    $totalAll = $totalUni + $totalAll;
                    $desconto = $linha['v_desconto'];
                    $totalFin = $totalAll - $desconto;                    
                    $item_venda = new Item_venda('', '', '', '', '');
                    $item_venda->adicionarItem($totalFin, $id);
            ?>
            <tr>
                <td><?php echo $linha['v_idVenda'];?></td>
                <td><?php echo $linha['l_titulo'];?></td>
                <td><?php echo $linha['iv_quantidade'];?></td>
                <td><?php echo number_format ($linha['l_preco'], 2, ',', '.');?></td>
                <td><?php echo number_format ($totalUni, 2, ',', '.');?></td>
            </tr>
            <?php } ?> 
            </tbody>
        </table>
        <br>
        <p>Total: <?php echo number_format ($totalAll, 2, ',', '.');?></p>
        <p>Desconto: <?php echo number_format ($desconto, 2, ',', '.');?></p>
        <p>Total da venda: <?php echo number_format ($totalFin, 2, ',', '.');?></p>
    </div>
</body>
</html>