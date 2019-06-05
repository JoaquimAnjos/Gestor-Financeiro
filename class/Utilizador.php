<?php 

private $id;
private $nome;
private $email;
private $senha;

public function getId() {
    return $this->id;
}

public function setId($value) {
    $this->id = $value;
}

public function getNome() {
    return $this->nome;
}

public function setNome($value) {
    $this->nome = $value;
}

public function getEmail() {
    return $this->email;
}

public function setEmail($value) {
    $this->email = $value;
}

public function getSenha() {
    return $this->senha;
}

public function setSenha($value) {
    $this->senha = $value;
}

public function loadById($id) {
     $sql = new Sql();

     $results = $sql->select("SELECT * FROM  utilizador WHERE utilizador = :ID", array(
        ":ID"=>$id
     ));

     if (count($results) > 0) {

         $row = $results[0];

         $this->setId($row['id']);  
         $this->setNome($row['nome']);
         $this->setEmail($row['email']);
         $this->setSenha($row['senha']);   
         //$this->setDtcadastro(new DateTime($row['dtcdastro'])); caso houvesse data

     }
}

public function __toString() {
    return json_encode(array(
        "id"=>$this->getId(),
        "nome"=>$this->getNome(),
        ""
    ))
}




?>