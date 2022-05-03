<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cadastro Venda</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/cadastro.css'>
    <script src='../js/main.js'></script>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
</head>
<body>
<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    include_once "acao.php";
    require_once "acao.php";
    $comando = isset($_GET['comando']) ? $_GET['comando'] : "";
    $seletor = "Venda";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $seletor);
    }
    $v_idVenda = isset($_POST['v_idVenda']) ? $_POST['v_idVenda'] : "";
    $v_valor_total_venda = isset($_POST['v_valor_total_venda']) ? $_POST['v_valor_total_venda'] : "";
    $v_desconto = isset($_POST['v_desconto']) ? $_POST['v_desconto'] : "";
    $v_c_idCliente = isset($_POST['v_c_idCliente']) ? $_POST['v_c_idCliente'] : "";
?>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <content>
    <form action="acao.php" method="post" id="form" style="padding-left: 5vw; padding-right: 5vw;">
        <h1>Cadastro Venda</h1>
        <br>
        <div class="form-group">
        <label for="">Valor total da venda:</label>
        <input type="text" class="form-control" required name="v_valor_total_venda" id="v_valor_total_venda" placeholder="Digite o total da venda" value="<?php if ($comando == "update"){echo $dados['v_valor_total_venda'];}?>">
        </div>
        <br>
        <div class="form-group">
        <label for="">Valor desconto:</label>
        <input type="text" class="form-control" required name="v_desconto" id="v_desconto" placeholder="Digite o desconto" value="<?php if ($comando == "update"){echo $dados['v_desconto'];}?>">
        </div>
        <br>
        <div class="form-group">
        <select class="form-select" aria-label="Escolha o cliente" name="v_c_idCliente" value="">  
            <?php
                echo lista_cliente(0);
            ?>
        </select>
        </div>
        <br>
        <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
        <input type="hidden" id="seletor" name="seletor" class="seletor" value="Venda">
        <input type="hidden" name="id" id="" value="<?php if($comando == "update"){echo $id;}?>">
        <button type="submit" class="btn btn-dark" id="acao" value="ENVIAR">Enviar</button>
    </form>
    </content>
    <footer class="" id="">
    </footer>
</body>
</html>