<!DOCTYPE html>
<?php   
   include_once "../conf/default.inc.php";
   require_once "../conf/Conexao.php";
   $title = "Venda";
   $busca = isset($_POST["busca"]) ? $_POST["busca"] : "v_idVenda";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
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
    <form method="post" style="padding-left: 5vw; padding-right: 5vw;">
        <input type="radio" id="v_idVenda" name="busca" value="v_idVenda" <?php if($busca == "v_idVenda"){echo "checked";}?>>
        <label for="huey"><h3>#ID</h3></label>
        <br>
        <input type="radio" id="v_valor_total_venda" name="busca" value="v_valor_total_venda" <?php if($busca == "v_valor_total_venda"){echo "checked";}?>>
        <label for="huey"><h3>Valor total</h3></label>
        <br>
        <input type="radio" id="v_desconto" name="busca" value="v_desconto" <?php if($busca == "v_desconto"){echo "checked";}?>>
        <label for="huey"><h3>Desconto</h3></label>
        <br><br>
        <div class="" style="padding-left: 5vw;">
            <legend>Procurar: </legend>
            <input type="text" style="width: 30vw;" name="procurar" id="procurar" value="<?php echo $procurar;?>">
            <button type="submit" class="btn btn-dark" name="acao" id="acao">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            </button>
            <br><br>
        </div>
    </form>
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
                $type = "LIKE";
                $procurar = "'%". trim($procurar) ."%'";
                if($busca != "v_idVenda" && $busca != "v_c_idCliente"){
                    $type = "<=";
                    $procurar = ($_POST["procurar"]);
                    if(is_numeric($procurar) == false){
                        $procurar = 0;
                    }
                }
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
                    <td><a href='listaVenda.php?id=<?php echo $linha['v_idVenda'];?>&cliente=<?php echo $linha['c_nome'];?>'>Detalhes...</a></td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>
</body>
</html>

<!-- <img src="img/list.svg" style="width: 1.8vw;"> -->