<?php
//Encerrr a sessão
session_start();
session_unset();
session_destroy();
//header('Location: index.php');
header('Location: login.php');
?>