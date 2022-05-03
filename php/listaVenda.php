<!DOCTYPE html>
<?php   
   include_once "../conf/default.inc.php";
   require_once "../conf/Conexao.php";
   $title = "Venda";
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <style>
    </style>
</head>
<body class="">
    <?php include_once "menu.php"; ?>
    <div class="">
        <table class="table table-striped" style="background-color: #FFF;">
            <thead>
                <tr class="table-dark">
                    <th scope="col">#ID</th>
                    <th scope="col">Valor total da venda</th>
                    <th scope="col">Desconto</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Alterar</th>
                    <th scope="col">Excluir</th>
                    <th scope="col">Listar</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM Venda, Cliente
                                        WHERE $busca $type $procurar
                                        AND c_idCliente = v_c_idCliente
                                        ORDER BY $busca");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $linha['v_idVenda'];?></th>
                    <td scope="row"><?php echo $linha['v_valor_total_venda'];?></td>
                    <td scope="row"><?php echo $linha['v_desconto'];?></td>
                    <td scope="row"><?php echo $linha['c_nome'];?></td>
                    <td scope="row"><a href="cadVenda.php?id=<?php echo $linha['v_idVenda'];?>&comando=update"><img src="../img/history-solid.svg" style="width: 3vw;"></a></td>
                    <td><a onclick="return confirm('Deseja mesmo excluir?')" href="acao.php?id=<?php echo $linha['v_idVenda'];?>&seletor=Venda&comando=deletar"><img src="../img/trash.svg" style="width: 3vw;"></a></td>
                    <td><a href='listaVenda.php?id=<?php echo $linha['v_idVenda'];?>'>Detalhes...</a></td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>
</body>
</html>