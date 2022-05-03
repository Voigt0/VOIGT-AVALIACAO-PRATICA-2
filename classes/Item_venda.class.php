<?php
    class Item_venda {
        private $iv_v_idVenda;
        private $iv_l_idLivro;
        private $iv_quantidade;
        private $iv_valor_total_item;
        private $iv_data_venda;

        public function __construct($idV, $idL, $quant, $total, $data) {
            $this->setIdV($idV);
            $this->setIdL($idL);
            $this->setQuant($quant);
            $this->setTotal($total);
            $this->setData($data);
           
        }

        public function getIdV() {
            return $this->iv_v_idVenda;
        }

        public function getIdL() {
            return $this->iv_l_idLivro;
        }

        public function getQuant() {
            return $this->iv_quantidade;
        }

        public function getTotal() {
            return $this->iv_valor_total_item;
        }

        public function getData() {
            return $this->iv_data_venda;
        }


        public function setIdL($idL) {
            return $this->iv_l_idLivro = $idL;
        }

        public function setIdV($idV) {
            return $this->iv_v_idVenda = $idV;
        }

        public function setQuant($quant) {
            return $this->iv_quantidade = $quant;
        }

        public function setTotal($total) {
            return $this->iv_valor_total_item = $total;
        }
        
        public function setData($data) {
            return $this->iv_data_venda = $data;
        }

 
        public function insert() {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO `recuperacaoav01`.`Item_venda` (`iv_v_idVenda`, `iv_l_idLivro`, `iv_quantidade`, `iv_valor_total_item`, `iv_data_venda`) VALUES (:iv_v_idVenda, :iv_l_idLivro, :iv_quantidade, :iv_valor_total_item, :iv_data_venda)');
            $stmt->bindValue(':iv_v_idVenda', $this->getIdV());
            $stmt->bindValue(':iv_l_idLivro', $this->getIdL());
            $stmt->bindValue(':iv_quantidade', $this->getQuant());
            $stmt->bindValue(':iv_valor_total_item', $this->getTotal());
            $stmt->bindValue(':iv_data_venda', $this->getData());
            return $stmt->execute();
    }

        public function update($old_id1, $old_id2) {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE `Item_venda` SET `iv_v_idVenda` = :iv_v_idVenda, `iv_l_idLivro` = :iv_l_idLivro, `iv_quantidade` = :iv_quantidade, `iv_valor_total_item` = :iv_valor_total_item, `iv_data_venda` = :iv_data_venda WHERE (`iv_v_idVenda` = $old_id1) and (`iv_l_idLivro` = $old_id2);");
            $stmt->bindValue(':iv_v_idVenda',  $this->setIdV($this->iv_v_idVenda), PDO::PARAM_INT);
            $stmt->bindValue(':iv_l_idLivro',  $this->setIdL($this->iv_l_idLivro), PDO::PARAM_INT);
            $stmt->bindValue(':iv_quantidade', $this->setQuant($this->iv_quantidade), PDO::PARAM_INT);
            $stmt->bindValue(':iv_valor_total_item', $this->setTotal($this->iv_valor_total_item), PDO::PARAM_STR);
            $stmt->bindValue(':iv_data_venda', $this->setData($this->iv_data_venda), PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function delete(){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM Item_venda WHERE (iv_v_idVenda = :iv_v_idVenda) AND (iv_l_idLivro = :iv_l_idLivro)');
            $stmt->bindValue(':iv_v_idVenda',  $this->setIdV($this->iv_v_idVenda), PDO::PARAM_INT);
            $stmt->bindValue(':iv_l_idLivro',  $this->setIdL($this->iv_l_idLivro), PDO::PARAM_INT);
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

        function adicionarItem($totalF, $v_idVenda){
            $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare("UPDATE `Venda` SET `v_valor_total_venda` = :totalF WHERE (`v_idVenda` = :v_idVenda);");
                $stmt->bindValue(':v_idVenda', $v_idVenda, PDO::PARAM_INT);
                $stmt->bindValue(':totalF', $totalF, PDO::PARAM_STR);
                return $stmt->execute();
        }

    }
?>