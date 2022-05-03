
<?php
    class Venda {
        private $v_idVenda;
        private $v_valor_total_venda;
        private $v_desconto;
        private $v_c_idCliente;

        public function __construct($id, $valor, $desconto, $idCliente) {
            $this->setId($id);
            $this->setValor($valor);
            $this->setDesconto($desconto);
            $this->setCliente($idCliente);
        }

        public function getId() {
            return $this->v_idVenda;
        }

        public function getValor() {
            return $this->v_valor_total_venda;
        }

        public function getDesconto() {
            return $this->v_desconto;
        }

        public function getCliente() {
            return $this->v_c_idCliente;
        }


        public function setId($id) {
            return $this->v_idVenda = $id;
        }

        public function setValor($valor) {
            return $this->v_valor_total_venda = $valor;
        }

        public function setDesconto($desconto) {
            return $this->v_desconto = $desconto;
        }

        public function setCliente($idCliente) {
            return $this->v_c_idCliente = $idCliente;
        }

       

        public function insert() {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO Venda (v_valor_total_venda, v_desconto, v_c_idCliente, iv_data_venda) VALUES(:v_valor_total_venda, :v_desconto, :v_c_idCliente)');
            $stmt->bindValue(':v_valor_total_venda', $this->getValor());
            $stmt->bindValue(':v_desconto', $this->getDesconto());
            $stmt->bindValue(':v_c_idCliente', $this->getCliente());
            
            return $stmt->execute();
        }

        public function update() {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE `Venda` SET `v_valor_total_venda` = :v_valor_total_venda, `v_desconto` = :v_desconto, `v_c_idCliente` = :v_c_idCliente WHERE (`v_idVenda` = :v_idVenda);");
            $stmt->bindValue(':v_idVenda', $this->setId($this->v_idVenda), PDO::PARAM_INT);
            $stmt->bindValue(':v_valor_total_venda', $this->setValor($this->v_valor_total_venda), PDO::PARAM_STR);
            $stmt->bindValue(':v_desconto', $this->setDesconto($this->v_desconto), PDO::PARAM_STR);
            $stmt->bindValue(':v_c_idCliente', $this->setCliente($this->v_c_idCliente), PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function delete(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM Venda WHERE v_idVenda = :v_idVenda');
            $stmt->bindValue(':v_idVenda',$this->setId($this->v_idVenda), PDO::PARAM_INT);
            
            return $stmt->execute();
        }

       
        public function buscarVenda($id){
            require_once("../conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM Venda';
            if($id > 0){
                $query .= ' WHERE v_idVenda = :id';
                $stmt->bindParam(':id', $id);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;
        }

        public function listarVenda($id){
            require_once("../conf/Conexao.php");
            $conexao = Conexao::getInstance();
            $query = "SELECT v_idVenda, v_valor_total_venda, v_desconto, l_titulo, iv_quantidade, iv_valor_total_item, c_nome, l_preco
                                    FROM Venda, Item_venda, Cliente, Livro
                                    WHERE v_idVenda LIKE '$id%'
                                    AND iv_v_idVenda = v_idVenda
                                    AND l_idLivro = iv_l_idLivro 
                                    AND c_idCliente = v_c_idCliente
                                    ORDER BY v_idVenda";
            $stmt = $conexao->prepare($query);
            $stmt->execute();
            $str = "";
            $totalAll = 0;
            foreach($stmt->fetchAll() as $linha) {
                $str .= "<tr>";
                $str .= "<td>". $linha['v_idVenda'] ."</td>";
                $str .= "<td>". $linha['l_titulo'] ."</td>";
                $str .= "<td>". $linha['iv_quantidade'] ."</td>";
                $str .= "<td>". number_format ($linha['l_preco'], 2, ',', '.') ."</td>";
                $str .= "<td>". number_format ($linha['l_preco']*$linha['iv_quantidade'], 2, ',', '.') ."</td>";
                $str .= "</tr>";
                $totalUni = $linha['l_preco'] * $linha['iv_quantidade'];
                $totalAll = $totalUni + $totalAll;
                $desconto = $linha['v_desconto'];
                $totalFin = $totalAll - $desconto;
            }
            $str .= "<p>Total: ". number_format ($totalAll, 2, ',', '.') ."</p>";
            $str .= "<p>Desconto: ". number_format ($desconto, 2, ',', '.') ."</p>";
            $str .= "<p>Total Venda: ". number_format ($totalFin, 2, ',', '.') ."</p>";
            return $str;
        }
    }

    ?>