<?php

header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");

$nome= $_SESSION['nome'];

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Home</title>

<?php include_once 'header.php';?>

<h1>Olá <?php echo $nome?></h1>

<?php include_once 'footer.php';?>