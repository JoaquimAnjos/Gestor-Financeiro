<?php 

require_once("config.php");

$sql = new Sql();

$user = $sql->select("SELECT * FROM utilizador");

echo json_encode($user);


?>