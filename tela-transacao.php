<?php

header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");
//permitir entrar na página só se estiver logado na sessao
require_once ("config-sessao.php");
 
 //$nome= $_SESSION['nome'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Transações</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<!-- <div id = "menu"> -->
<div id ="interface">
<nav id = "menu"> 
<ul>
<li><a href = "tela-transacao.php">Transações</a></li>
<li><a href = "tela-conta.php">Minhas Contas</a></li>
<li><a href = "criacao-transacao.php">Criar Transação</a></li>
<li><a href = "criacao-conta.php">Criar Conta</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</nav>
<!--  </div>-->
<h1>Olá <?php/* echo $nome*/?></h1>
<h1>Transações</h1>
</div>
</body>
</html>