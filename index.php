<?php 

//header('Content-Type: text/html; charset=UTF-8');
require_once("config.php");

//Carrega um utilizador
//$root = new Utilizador();
//$root->loadById(1);
//echo $root;

//Carrega uma lista de utilizadores
//$lista = Utilizador::getList();
//echo json_encode($lista);

//Carrega uma lista de utilizadores buscando pelo nome
//$search = Utilizador::search("Maria");
//echo json_encode($search);

//carrega utilizador usando login e senha
$utilizador = new Utilizador();
$utilizador->login("João", md5("1234"));
echo $utilizador;


?>