<?php 

class Sql extends PDO {

    private $conn;

    public function __construct() {

        $this->conn = new PDO("mysql:host=localhost;dbname=economize", "root", "");
        $this->conn->exec('SET CHARACTER SET utf8');
        //$this->conn->exec("SET NAMES 'utf8'");
        //$this->conn->exec('SET character_set_connection=utf8');
        //$this->conn->exec('SET character_set_client=utf8');
        //$this->conn->exec('SET character_set_results=utf8');
    }

    private function setParams($statement, $parameters = array()) {

        foreach ($parameters as $key => $value) {

            $this->setParam($statement, $key, $value);

        }
    }

    private function setParam($statement, $key, $value) {

        $statement->bindParam($key, $value);

    }

    public function query($rawQuery, $params = array()) {

        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();

        return $stmt;
    }

    public function select($rawQuery, $params = array()): array {

        $stmt =  $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


}

?>