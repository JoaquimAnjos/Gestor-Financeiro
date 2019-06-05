<?php 

require_once("config.php");

$root = new Utilizador();

$root->loadById(1);

echo $root;


?>