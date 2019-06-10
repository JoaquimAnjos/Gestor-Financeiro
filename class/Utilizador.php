<?php 

class Utilizador { // falta fazer close na conexão

    private $idUtilizador;
    private $nome;
    private $username;
    private $email;
    private $senha;

    public function getIdUtilizador() {
        return $this->idUtilizador;
    }

    public function setIdUtilizador($value) {
        $this->idUtilizador = $value;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($value) {
        $this->nome = $value;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($value) {
        $this->username = $value;
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
        
        $results = $sql->select("SELECT * FROM  utilizador WHERE id_utilizador = :ID", array(
            ":ID"=>$id
        ));
        
        if (count($results) > 0) {
            
            $this->setDados($results[0]);
        }
        
        return $results;
    }
    

    public function loadByUsername($username) {
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM  utilizador WHERE username = :USERNAME", array(
            ":USERNAME"=>$username
        ));

        if (count($results) > 0) {

            $this->setDados($results[0]);
        }
        
        return $results;
    }

    public static function search($nome) {
        $sql = new Sql();

        return $sql->select("SELECT * FROM utilizador WHERE nome LIKE :SEARCH ORDER BY nome", array(
            ':SEARCH'=>"%".$nome."%"

        ));
    }

    public function login($username, $password) {
        
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM  utilizador WHERE username = :USERNAME AND senha = :PASSWORD", array(
            ":USERNAME"=>$username,
            ":PASSWORD"=>md5($password)
        ));

        if (count($results) > 0) {

            $this->setDados($results[0]);
             
        } /*else {
            throw new Exception("Login e/ou senha inválido.");
        }*/
        return $results;
    }

    public function setDados($dados) {
        $this->setIdUtilizador($dados['id_utilizador']);  
        $this->setNome($dados['nome']);
        $this->setUsername($dados['username']);
        $this->setEmail($dados['email']);
        $this->setSenha($dados['senha']);  
        //$this->setDtcadastro(new DateTime($row['dtcdastro'])); caso houvesse data
    }

    public function insert($utilizador) {
        $sql = new Sql();

        return $sql->query("INSERT INTO utilizador (nome, username ,email, senha) values (:NOME, :USERNAME, :EMAIL, :SENHA)", array(
            ':NOME'=>$utilizador->getNome(),
            ':USERNAME'=>$utilizador->getUsername(),
            ':EMAIL'=>$utilizador->getEmail(),
            ':SENHA'=>$utilizador->getSenha()
        ));
        
    }

    public function __toString() {
        return json_encode(array(
            "id_utilizador"=>$this->getIdUtilizador(),
            "nome"=>$this->getNome(),
            "username"=>$this->getUsername(),
            "email"=>$this->getEmail(),
            "senha"=>$this->getSenha()
            //"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

}
?>