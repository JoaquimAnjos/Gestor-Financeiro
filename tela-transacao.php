<?php

header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");
//permitir entrar na p�gina s� se estiver logado na sessao
require_once ("config-sessao.php");
 
 //$nome= $_SESSION['nome'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Transa��es</title>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<!-- <div id = "menu"> -->
<div id ="interface">
<nav id = "menu"> 
<ul>
<li><a href = "tela-transacao.php">Transa��es</a></li>
<li><a href = "tela-conta.php">Minhas Contas</a></li>
<li><a href = "criacao-transacao.php">Criar Transa��o</a></li>
<li><a href = "criacao-conta.php">Criar Conta</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</nav>
<!--  </div>-->
<h1>Ol� <?php/* echo $nome*/?></h1>
<h1>Transa��es</h1>
</div>
</body>
</html>