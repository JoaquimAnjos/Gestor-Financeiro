<?php

class Conta {

    private $idConta;
    private $nomeConta;
    private $valorInicial;
    private $valorAtual;
    private $idTipoConta;
    private $idUtilizador;
    
    
    
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
    
    public function getIdTipoConta()
    {
        return $this->idTipoConta;
    }
    
    public function getValorAtual()
    {
        return $this->getValorInicial();
    }
    
    public function getIdUtilizador()
    {
        return $this->idUtilizador;
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
    
    public function setIdTipoConta($idTipoConta)
    {
        $this->idTipoConta = $idTipoConta;
    }
    
    public function setIdUtilizador($idUtilizador)
    {
        $this->idUtilizador = $idUtilizador;
    }
    

    public function getListTipoConta() {
        $sql = new Sql();
        
        return $sql->select("SELECT * FROM tipo_conta ORDER BY nome");
    }
    
    public function getContaParaEditar() {
        $sql = new Sql();
        
        return $sql->select("SELECT c.id_conta, CONCAT(c.nome, ' - ',tc.nome) as conta 
             FROM conta c INNER JOIN tipo_conta tc ON (c.fk_id_tipo_conta=tc.id_tipo_conta) 
             WHERE fk_id_utilizador=:ID_UTILIZADOR", array(
            ':ID_UTILIZADOR'=>$this->getIdUtilizador()
        ));
    }
    
    public function loadById($id) {
        $sql = new Sql();
        
        $results = $sql->select("SELECT c.id_conta as id, c.nome as nome, c.valor_inicial as valor, tc.nome as tipo, tc.id_tipo_conta as id_tipo_conta 
        FROM conta c INNER JOIN tipo_conta tc ON (c.fk_id_tipo_conta = tc.id_tipo_conta) WHERE id_conta = :ID", array(
            ":ID"=>$id
        ));
        
        return $results;
    }
    
    public function loadByIdUtilizador($idUtilizador) {
        $sql = new Sql();
        
        return $sql->select("select c.id_conta as id, c.nome as nome, c.valor_inicial as valor_inicial,
                 c.valor_atual as valor_atual, tc.nome as tipo, u.username as username from conta as c 
                 inner join utilizador as u ON (c.fk_id_utilizador=u.id_utilizador)
                 inner join tipo_conta tc ON (c.fk_id_tipo_conta=tc.id_tipo_conta) 
                 where u.id_utilizador=:ID_UTILIZADOR ORDER BY c.nome", array(
                     ':ID_UTILIZADOR'=>$idUtilizador
                 ));
    }
    
    public function insert($conta) {
        $sql = new Sql();
        
        return $sql->query("INSERT INTO conta (nome, valor_inicial, valor_atual ,fk_id_tipo_conta, fk_id_utilizador) values (:NOME, :VALOR_INICIAL, :VALOR_ATUAL,:ID_TIPO_CONTA, :ID_UTILIZADOR)", array(
            ':NOME'=>$conta->getNomeConta(),
            ':VALOR_INICIAL'=>$conta->getValorInicial(),
            ':VALOR_ATUAL'=>$conta->getValorAtual(),
            ':ID_TIPO_CONTA'=>$conta->getIdTipoConta(),
            ':ID_UTILIZADOR'=>$conta->getIdUtilizador()
        ));
        
    }
    
    public function update($conta) {
        $sql = new Sql();
        
        return $sql->query("UPDATE conta SET nome = :NOME, valor_inicial = :VALOR_INICIAL, 
            valor_atual = :VALOR_ATUAL, fk_id_tipo_conta = :ID_TIPO_CONTA WHERE id_conta = :ID", array(
            
            ':NOME'=>$conta->getNomeConta(),
            ':VALOR_INICIAL'=>$conta->getValorInicial(),
            ':VALOR_ATUAL'=>$conta->getValorAtual(),
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
    
    public function countRows($idUtilizador) {
        $sql = new Sql();
        
        return $sql->select("SELECT COUNT(*) AS total FROM conta where fk_id_utilizador = :ID_UTILIZADOR", array(
            ':ID_UTILIZADOR'=>$idUtilizador
        ));
    }
}

?>

