<?php

header('Content-Type: text/html; charset=iso-8859-1');
require_once("config.php");

//Sessão
session_start();

if (!isset($_SESSION['logado'])) {
    //header('Location: index.php');
    header('Location: login.php');
}

$nome= $_SESSION['nome'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Home</title>
</head>
<body>
<h1>Olá <?php echo $nome?></h1>
<a href="logout.php">Logout</a>
</body>
</html>