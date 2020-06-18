<?php 

class Sql extends PDO {

    private $conn;

    public function __construct() {

        $this->conn = new PDO("mysql:host=localhost;dbname=economize", "root", "");
        $this->conn->exec('SET CHARACTER SET utf8');
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
        try {

            $stmt = $this->conn->prepare($rawQuery);
            $this->setParams($stmt, $params);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $rawQuery . "<br>" . $e->getMessage();
        }

        return $stmt;
    }
    
    public function select($rawQuery, $params = array()): array {

        $stmt =  $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);//retorna um array de arrays

    }
    
    public function closeConnection() {
        $this->conn = null;
    }


}

?>