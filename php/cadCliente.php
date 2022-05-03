<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cadastro Cliente</title>
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
    $comando = isset($_GET['comando']) ? $_GET['comando'] : "";
    $seletor = "Cliente";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $seletor);
    }
    $c_idCliente = isset($_POST['c_idCliente']) ? $_POST['c_idCliente'] : "";
    $c_nome = isset($_POST['c_nome']) ? $_POST['c_nome'] : "";
    $c_cpf = isset($_POST['c_cpf']) ? $_POST['c_cpf'] : "";
    $c_dt_nascimento = isset($_POST['c_dt_nascimento']) ? $_POST['c_dt_nascimento'] : "";
?>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <content>
    <form action="acao.php" method="post" id="form" style="padding-left: 5vw; padding-right: 5vw;">
        <h1>Cadastro Cliente</h1>
        <br>
        <div class="form-group">
        <label for="">Nome:</label>
        <input type="text" class="form-control" required name="c_nome" id="c_nome" placeholder="Digite o nome" value="<?php if ($comando == "update"){echo $dados['c_nome'];}?>">
        </div>
        <br>
        <div class="form-group">
        <label for="">CPF:</label>
        <input type="text" minlength="11" maxlength="11" class="form-control" required name="c_cpf" id="c_cpf" placeholder="Digite o CPF" value="<?php if ($comando == "update"){echo $dados['c_cpf'];}?>">
        </div>
        <br>
        <div class="form-group">
        <label for="">Data de nascimento:</label>
        <input type="date" max="<?php echo date('Y-m-d');?>" class="form-control" required name="c_dt_nascimento" id="c_dt_nascimento" placeholder="Digite a data de nascimento" value="<?php if ($comando == "update"){echo $dados['c_dt_nascimento'];}?>">
        </div>
        <br>
        <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
        <input type="hidden" id="seletor" name="seletor" class="seletor" value="Cliente">
        <input type="hidden" name="id" id="" value="<?php if($comando == "update"){echo $id;}?>">
        <button type="submit" class="btn btn-dark" id="acao" value="ENVIAR">Enviar</button>
    </form>
    </content>
    <footer class="" id="">
    </footer>
</body>
</html>