<?php

class Conta {

    private $idConta;
    private $nomeConta;
    private $valorInicial;
    private $idTipoConta;
    
    
    public function getIdConta()
    {
        return $this->idConta;
    }

    public function getNomeConta()
    {
        return $this->nomeConta;
    }
    
    public function getValorInicial()
    {
        return $this->valorInicial;
    }

    public function setIdConta($idConta)
    {
        $this->idConta = $idConta;
    }
    
    public function setNomeConta($nomeConta)
    {
        $this->nomeConta = $nomeConta;
    }

    public function setValorInicial($valorInicial)
    {
        $this->valorInicial = $valorInicial;
    }
    
    public function getIdTipoConta()
    {
        return $this->idTipoConta;
    }
    
    public function setIdTipoConta($idTipoConta)
    {
        $this->idTipoConta = $idTipoConta;
    }

    public static function getListTipoConta() {
        $sql = new Sql();
        
        return $sql->select("SELECT * FROM tipo_conta ORDER BY nome");
    }
    
    public function loadById($id) {
        $sql = new Sql();
        
        $results = $sql->select("SELECT c.id_conta as id, c.nome as nome, c.valor_inicial as valor, tc.nome as tipo, tc.id_tipo_conta as id_tipo_conta FROM conta c INNER JOIN tipo_conta tc ON (c.fk_id_tipo_conta = tc.id_tipo_conta) WHERE id_conta = :ID", array(
            ":ID"=>$id
        ));
        
        return $results;
    }
    
    public static function loadAll() {
        $sql = new Sql();
        
        return $sql->select("SELECT c.id_conta as id, c.nome as nome, c.valor_inicial as valor,tc.nome as tipo FROM conta c INNER JOIN tipo_conta tc ON (c.fk_id_tipo_conta = tc.id_tipo_conta) ORDER BY c.nome");
    }
    
    public function insert($conta) {
        $sql = new Sql();
        
        return $sql->query("INSERT INTO conta (nome, valor_inicial ,fk_id_tipo_conta) values (:NOME, :VALOR_INICIAL, :ID_TIPO_CONTA)", array(
            ':NOME'=>$conta->getNomeConta(),
            ':VALOR_INICIAL'=>$conta->getValorInicial(),
            ':ID_TIPO_CONTA'=>$conta->getIdTipoConta()
        ));
        
    }
    
    public function update($conta) {
        $sql = new Sql();
        
        return $sql->query("UPDATE conta SET nome = :NOME, valor_inicial = :VALOR_INICIAL, fk_id_tipo_conta = :ID_TIPO_CONTA WHERE id_conta = :ID", array(
            ':NOME'=>$conta->getNomeConta(),
            ':VALOR_INICIAL'=>$conta->getValorInicial(),
            ':ID_TIPO_CONTA'=>$conta->getIdTipoConta(),
            ':ID'=> $conta->getIdConta()
        ));
    }
    
    public function delete($id) {
        $sql = new Sql();
        
        return $sql->query("DELETE FROM conta WHERE id_conta = :ID", array(
            ':ID'=>$id
        ));
    }
    
    public function countRows() {
        $sql = new Sql();
        
        return $sql->select("SELECT COUNT(*) AS total FROM conta");
    }
}

?>

