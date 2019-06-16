<?php

class Transacao {
    
    private $idTransacao;
    private $descricao;
    private $valor;
    private $data;
    private $idTipo;
    private $idConta;
    private $idUtilizador;
    
    
    
    public function getIdTransacao()
    {
        return $this->idTransacao;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getValor()
    {
       return $this->valor;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getIdTipo()
    {
        return $this->idTipo;
    }

    public function getIdConta()
    {
        return $this->idConta;
    }

    public function getIdUtilizador()
    {
        return $this->idUtilizador;
    }
    
    public function setIdTransacao($idTransacao)
    {
        $this->idTransacao = $idTransacao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setValor($valor)
    {
        if ( $this->getIdTipo() == 1) {
            $this->valor = $valor;
        } else {
            $this->valor = -$valor;
        }
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;
    }

    public function setIdConta($idConta)
    {
        $this->idConta = $idConta;
    }

    public function setIdUtilizador($idUtilizador)
    {
        $this->idUtilizador = $idUtilizador;
    }
    
    public function loadByIdUtilizador() {
        $sql = new Sql();
        
        return $sql->select("SELECT t.id_transacao as id, t.descricao as descricao, t.valor as valor, t.data_transacao as data_transacao, 
               CONCAT(c.nome, ' - ',tc.nome) as conta ,tt.descricao as tipo_transacao FROM transacao t
               INNER JOIN tipo_transacao tt ON (t.fk_id_tipo_transacao = tt.id_tipo_transacao)
               INNER JOIN conta c ON (t.fk_id_conta = c.id_conta)
               INNER JOIN tipo_conta tc ON (c.fk_id_tipo_conta= tc.id_tipo_conta)
               INNER JOIN utilizador u ON (t.fk_id_utilizador = u.id_utilizador) WHERE id_utilizador=:ID_UTILIZADOR ORDER BY data_transacao", array(
                   ':ID_UTILIZADOR'=>$this->getIdUtilizador()
               ));
    }
    
    public function loadById() {
        $sql = new Sql();
        
        return $sql->select("SELECT t.id_transacao as id, t.descricao as descricao, t.valor as valor, t.data_transacao as data_transacao, 
                c.id_conta as id_conta, CONCAT(c.nome, ' - ',tc.nome) as conta, tt.id_tipo_transacao as id_tipo_transacao,
               tt.descricao as tipo_transacao FROM transacao t
               INNER JOIN tipo_transacao tt ON (t.fk_id_tipo_transacao = tt.id_tipo_transacao)
               INNER JOIN conta c ON (t.fk_id_conta = c.id_conta)
               INNER JOIN tipo_conta tc ON (c.fk_id_tipo_conta= tc.id_tipo_conta)
               INNER JOIN utilizador u ON (t.fk_id_utilizador = u.id_utilizador) WHERE id_transacao=:ID", array(
                   ':ID'=>$this->getIdTransacao()
               ));
    }

    public function insert() {
        $sql = new Sql();
        
        return $sql->query("INSERT INTO transacao (descricao, valor, data_transacao, fk_id_tipo_transacao, 
            fk_id_conta, fk_id_utilizador) 
            values (:DESCRICAO, :VALOR, :DATA, :ID_TIPO_TRANSACAO, :ID_CONTA, :ID_UTILIZADOR)", array(
            ':DESCRICAO'=>$this->getDescricao(),
            ':VALOR'=>$this->getValor(),
            ':DATA'=>$this->getData(),
            ':ID_TIPO_TRANSACAO'=>$this->getIdTipo(),
            ':ID_CONTA'=>$this->getIdConta(),
            ':ID_UTILIZADOR'=>$this->getIdUtilizador()
        ));
    }
    
    public function getTiposTransacao() {
        $sql = new Sql();
        
        return $sql->select("SELECT * FROM tipo_transacao");
    }
    
    public function getContas() {
        
        $sql = new Sql();
        
        return $sql->select("SELECT c.id_conta as id_conta, c.nome as nome, tc.nome as tipo_conta 
             FROM conta c INNER JOIN tipo_conta as tc ON (c.fk_id_tipo_conta=tc.id_tipo_conta) 
             WHERE fk_id_utilizador=:ID_UTILIZADOR ORDER BY nome", array(
            ':ID_UTILIZADOR'=>$this->getIdUtilizador()
        ));
    }
    
    public function countRows() {
        $sql = new Sql();
        
        return $sql->select("SELECT COUNT(*) AS total FROM transacao where fk_id_utilizador = :ID_UTILIZADOR", array(
            ':ID_UTILIZADOR'=>$this->getIdUtilizador()
        ));
    }
    
    public function delete() {
        $sql = new Sql();
        
        return $sql->query("DELETE FROM transacao WHERE id_transacao= :ID", array(
            ':ID'=>$this->getIdUtilizador()
        ));
    }
    
    public function update() {
        $sql = new Sql();
        
        return $sql->query("UPDATE transacao SET descricao = :DESCRICAO, valor = :VALOR,
            data_transacao = :DATA_TRANSACAO, fk_id_tipo_transacao = :ID_TIPO_TRANSACAO,
             fk_id_conta = :ID_CONTA WHERE id_transacao = :ID", array(
                
                ':DESCRICAO'=>$this->getDescricao(),
                ':VALOR'=>$this->getValor(),
                ':DATA_TRANSACAO'=>$this->getData(),
                ':ID_TIPO_TRANSACAO'=>$this->getIdTipo(),
                 'ID_CONTA'=>$this->getIdConta(),
                ':ID'=> $this->getIdTransacao()
            ));
    }
    
    /*public static function getListTipoConta() {
        $sql = new Sql();
        
        return $sql->select("SELECT * FROM tipo_conta ORDER BY nome");
    }*/
    
}

?>