<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cadastro Livro_Autor</title>
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
    require_once("acao.php");
    $comando = isset($_GET['comando']) ? $_GET['comando'] : "";
    $seletor = "Livro_Autor";
    $dados;
    if ($comando == 'update'){
    $id1 = isset($_GET['id1']) ? $_GET['id1'] : "";
    $id2 = isset($_GET['id2']) ? $_GET['id2'] : "";
    if ($id1 > 0 && $id2 > 0)
        $dados = buscarDadosAssoc($id1, $id2, $seletor);
    }
    $la_l_idLivro = isset($_POST['la_l_idLivro']) ? $_POST['la_l_idLivro'] : "";
    $la_a_idAutor = isset($_POST['la_a_idAutor']) ? $_POST['la_a_idAutor'] : "";
?>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <content>
    <form action="acao.php" method="post" id="form" style="padding-left: 5vw; padding-right: 5vw;">
        <h1>Cadastro Livro_Autor</h1>
        <br>
        <input type="hidden" id="old_id1" name="old_id1" class="old_id1" value="<?php echo $_GET['id1']; ?>">
        <input type="hidden" id="old_id2" name="old_id2" class="old_id2" value="<?php echo $_GET['id2']; ?>">
        <div class="form-group">
        <label class="formItem formText" id="">Livro:</label>
        <select class="form-select" aria-label="Escolha o livro" name="la_l_idLivro" value="">  
            <?php
                echo listar('l_idLivro', 'l_titulo', 0, 'Livro');
                ?>
        </select>
        </div>
        <br>
        <div class="form-group">
        <label class="formItem formText" id="">Autor:</label>
        <select class="form-select" aria-label="Escolha o autor" name="la_a_idAutor" value="">  
            <?php
                echo listar('a_idAutor', 'a_nome', 0, 'Autor');
                ?>
        </select>
        </div>
        <br>
        <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
        <input type="hidden" id="seletor" name="seletor" class="seletor" value="Livro_Autor">
        <input type="hidden" name="id" id="" value="<?php if($comando == "update"){echo $id;}?>">
        <button type="submit" class="btn btn-dark" id="acao" value="ENVIAR">Enviar</button>
    </form>
    </content>
    <footer class="" id="">
    </footer>
</body>
</html>