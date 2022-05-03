
<?php
    class Venda {
        private $v_idVenda;
        private $v_valor_total_venda;
        private $v_desconto;
        private $v_c_idCliente;
        private $iv_data_venda;

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
    }

    ?>