<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cadastro Livro</title>
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
    $seletor = "Livro";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $seletor);
    }
    $l_idLivro = isset($_POST['l_idLivro']) ? $_POST['l_idLivro'] : "";
    $l_titulo = isset($_POST['l_titulo']) ? $_POST['l_titulo'] : "";
    $l_ano_publicacao = isset($_POST['l_ano_publicacao']) ? $_POST['l_ano_publicacao'] : "";
    $l_isdn = isset($_POST['l_isdn']) ? $_POST['l_isdn'] : "";
    $l_preco = isset($_POST['l_preco']) ? $_POST['l_preco'] : "";
?>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <content>
    <form action="acao.php" method="post" id="form" style="padding-left: 5vw; padding-right: 5vw;">
        <h1>Cadastro Livro</h1>
        <br>
        <div class="form-group">
        <label for="">Título:</label>
        <input type="text" class="form-control" required name="l_titulo" id="l_titulo" placeholder="Digite o título" value="<?php if ($comando == "update"){echo $dados['l_titulo'];}?>">
        </div>
        <br>
        <div class="form-group">
        <label for="">Ano de publicação:</label>
        <input type="text" class="form-control" required name="l_ano_publicacao" id="l_ano_publicacao" placeholder="Digite o ano de publicação" value="<?php if ($comando == "update"){echo $dados['l_ano_publicacao'];}?>">
        </div>
        <br>
        <div class="form-group">
        <label for="">ISDN:</label>
        <input type="text" class="form-control" required name="l_isdn" id="l_isdn" placeholder="Digite o ISDN" value="<?php if ($comando == "update"){echo $dados['l_isdn'];}?>">
        </div>
        <br>
        <div class="form-group">
        <label for="">Preço:</label>
        <input type="text" class="form-control" required name="l_preco" id="l_preco" placeholder="Digite o preço" value="<?php if ($comando == "update"){echo $dados['l_preco'];}?>">
        </div>
        <br>
        <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
        <input type="hidden" id="seletor" name="seletor" class="seletor" value="Livro">
        <input type="hidden" name="id" id="" value="<?php if($comando == "update"){echo $id;}?>">
        <button type="submit" class="btn btn-dark" id="acao" value="ENVIAR">Enviar</button>
    </form>
    </content>
    <footer class="" id="">
    </footer>
</body>
</html>