<?php
    $comando = "";
    if(isset($_POST['comando'])){$comando = $_POST['comando'];}else if(isset($_GET['comando'])){$comando = $_GET['comando'];}
    $seletor = "";
    if(isset($_POST['seletor'])){$seletor = $_POST['seletor'];}else if(isset($_GET['seletor'])){$seletor = $_GET['seletor'];}

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    acao($comando, $seletor);

    function acao($acao, $seletor){
         if($seletor == "Autor"){
            require_once "../classes/Autor.class.php";
        } else if($seletor == "Livro"){
            require_once "../classes/Livro.class.php";
        } else if($seletor == "Livro_Autor"){
            require_once "../classes/Livro_Autor.class.php";
        } else if($seletor == "Cliente"){
            require_once "../classes/Cliente.class.php";
        } else if($seletor == "Item_venda"){
            require_once "../classes/Item_venda.class.php";
        } else if($seletor == "Venda"){
            require_once "../classes/Venda.class.php";
        }
        if($acao == "insert"){
            try{
            if($seletor == "Autor"){
                $autor = new Autor('', $_POST['a_nome'], $_POST['a_sobrenome']);
                $autor->insert();
                header("location:tabelaAutor.php");
            } else if($seletor == "Livro"){
                $livro = new Livro('', $_POST['l_titulo'], $_POST['l_ano_publicacao'], $_POST['l_isdn'], $_POST['l_preco']);
                $livro->insert();
                header("location:tabelaLivro.php");
            } else if($seletor == "Livro_Autor"){
                $livro_autor = new Livro_Autor($_POST['la_l_idLivro'], $_POST['la_a_idAutor']);
                $livro_autor->insert();
                header("location:tabelaLivro_Autor.php");
            } else if($seletor == "Cliente"){
                $cliente = new Cliente('', $_POST['c_nome'], $_POST['c_cpf'], $_POST['c_dt_nascimento']);
                $cliente->insert();
                header("location:tabelaCliente.php");
            } else if($seletor == "Venda"){
                $venda = new Venda('', $_POST['v_valor_total_venda'], $_POST['v_desconto'], $_POST['v_c_idCliente']);
                $venda->insert();
                header("location:tabelaVenda.php");
            } else if($seletor == "Item_venda"){
                $item_venda = new Item_venda($_POST['iv_v_idVenda'], $_POST['iv_l_idLivro'], $_POST['iv_quantidade'], $_POST['iv_valor_total_item'], $_POST['iv_data_venda']);
                $item_venda->insert();
                header("location:tabelaItem_venda.php");
            }
        } catch(Exception $e){
            echo "<h1>Erro ao cadastrar a conta.</h1>
            <br> Erro:".$e->getMessage();
        }
        } else if($acao == "deletar"){
        try{
            if($seletor == "Autor"){
                $autor = new Autor($_GET['id'], "", "");
                $autor->delete();
                header("location:tabelaAutor.php");
            } else if($seletor == "Livro"){
                $livro = new Livro($_GET['id'], "", "", "", "");
                $livro->delete();
                header("location:tabelaLivro.php");
            } else if($seletor == "Livro_Autor"){
                $livro_autor = new Livro_Autor($_GET['id1'], $_GET['id2']);
                $livro_autor->delete();
                header("location:tabelaLivro_Autor.php");
            } else if($seletor == "Cliente"){
                $cliente = new Cliente($_GET['id'], '', '', '');
                $cliente->delete();
                header("location:tabelaCliente.php");
            } else if($seletor == "Venda"){
                $venda = new Venda($_GET['id'], '', '', '');
                $venda->delete();
                header("location:tabelaVenda.php");
            } else if($seletor == "Item_venda"){
                $item_venda = new Item_venda($_GET['id1'], $_GET['id2'], '', '', '');
                $item_venda->delete();
                header("location:tabelaItem_venda.php");
            }
        } catch(Exception $e){
            echo "<h1>Erro ao cadastrar a conta.</h1>
            <br> Erro:".$e->getMessage();
        }
        } else if($acao == "update"){
        try{
            if($seletor == "Autor"){
                $autor = new Autor($_POST['id'], $_POST['a_nome'], $_POST['a_sobrenome']);
                $autor->update();
                header("location:tabelaAutor.php");
            } else if($seletor == "Livro"){
                $livro = new Livro($_POST['id'], $_POST['l_titulo'], $_POST['l_ano_publicacao'], $_POST['l_isdn'], $_POST['l_preco']);
                $livro->update();
                header("location:tabelaLivro.php");
            } else if($seletor == "Livro_Autor"){
                $livro_autor = new Livro_Autor($_POST['la_l_idLivro'], $_POST['la_a_idAutor']);
                $livro_autor->update($_POST['old_id1'], $_POST['old_id2']);
                header("location:tabelaLivro_Autor.php");
            } else if($seletor == "Cliente"){
                $cliente = new Cliente($_POST['id'], $_POST['c_nome'], $_POST['c_cpf'], $_POST['c_dt_nascimento']);
                $cliente->update();
                header("location:tabelaCliente.php");
            } else if($seletor == "Venda"){
                $venda = new Venda($_POST['id'], $_POST['v_valor_total_venda'], $_POST['v_desconto'], $_POST['v_c_idCliente']);
                $venda->update();
                header("location:tabelaVenda.php");
            } else if($seletor == "Item_venda"){
                $item_venda = new Item_venda($_POST['iv_v_idVenda'], $_POST['iv_l_idLivro'], $_POST['iv_quantidade'], $_POST['iv_valor_total_item'], $_POST['iv_data_venda']);
                $item_venda->update($_POST['old_id1'], $_POST['old_id2']);
                header("location:tabelaItem_venda.php");
            }
        } catch(Exception $e){
            echo "<h1>Erro ao cadastrar a conta.</h1>
            <br> Erro:".$e->getMessage();
        }
        }
    }


    function buscarDados($id,$seletor){
        $pdo = Conexao::getInstance();
        $dados = array();
    if($seletor == 'Autor'){
        $consulta = $pdo->query("SELECT * FROM Autor WHERE a_idAutor = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['a_idAutor'] = $linha['a_idAutor'];
            $dados['a_nome'] = $linha['a_nome'];
            $dados['a_sobrenome'] = $linha['a_sobrenome'];
        }
    } else if($seletor == 'Livro'){
        $consulta = $pdo->query("SELECT * FROM Livro WHERE l_idLivro = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['l_idLivro'] = $linha['l_idLivro'];
            $dados['l_titulo'] = $linha['l_titulo'];
            $dados['l_ano_publicacao'] = $linha['l_ano_publicacao'];
            $dados['l_isdn'] = $linha['l_isdn'];
            $dados['l_preco'] = $linha['l_preco'];
        }
    } else if($seletor == 'Cliente'){
        $consulta = $pdo->query("SELECT * FROM Cliente WHERE c_idCliente = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['c_idCliente'] = $linha['c_idCliente'];
            $dados['c_nome'] = $linha['c_nome'];
            $dados['c_cpf'] = $linha['c_cpf'];
            $dados['c_dt_nascimento'] = $linha['c_dt_nascimento'];
        }
    } else if($seletor == 'Venda'){
        $consulta = $pdo->query("SELECT * FROM Venda WHERE v_idVenda = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['v_idVenda'] = $linha['v_idVenda'];
            $dados['v_valor_total_venda'] = $linha['v_valor_total_venda'];
            $dados['v_desconto'] = $linha['v_desconto'];
            $dados['v_c_idCliente'] = $linha['v_c_idCliente'];
        }
    }
        return $dados;
    }


    function buscarDadosAssoc($id1, $id2, $seletor){
        $pdo = Conexao::getInstance();
        $dados = array();
    if($seletor == 'Livro_Autor'){
        $consulta = $pdo->query("SELECT * FROM Livro_Autor WHERE la_l_idLivro = $id1 AND la_a_idAutor = $id2");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['la_l_idLivro'] = $linha['la_l_idLivro'];
            $dados['la_a_idAutor'] = $linha['la_a_idAutor'];
        }
    } else if($seletor == 'Item_venda'){
        $consulta = $pdo->query("SELECT * FROM Item_venda WHERE iv_v_idVenda = $id1 AND iv_l_idLivro = $id2");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['iv_v_idVenda'] = $linha['iv_v_idVenda'];
            $dados['iv_l_idLivro'] = $linha['iv_l_idLivro'];
            $dados['iv_quantidade'] = $linha['iv_quantidade'];
            $dados['iv_valor_total_item'] = $linha['iv_valor_total_item'];
            $dados['iv_data_venda'] = $linha['iv_data_venda'];
        }
    }
        return $dados;
    }


    function listar($campo1, $campo2, $id, $classe) {
        if($classe == "Livro") {
            require_once("../classes/Livro.class.php");
            $livro = new Livro("","", "", "", "");
            $lista = $livro->buscarLivro($id);
        } else if($classe == "Autor") {
            require_once("../classes/Autor.class.php");
            $autor = new Autor("","", "");
            $lista = $autor->buscarAutor($id);
        } else if($classe == "Cliente") {
            require_once("../classes/Cliente.class.php");
            $cliente = new Cliente("","", "", "");
            $lista = $cliente->buscarCliente($id);
        } else if($classe == "Venda") {
            require_once("../classes/Venda.class.php");
            $venda = new Venda("","", "", "");
            $lista = $venda->buscarVenda($id);
        }
        $str = 0;
        foreach($lista as $linha) {
            $str .= "<option value='".$linha[$campo1]."'>".$linha[$campo2]."</option>";
        }
        return $str;
    }


?>