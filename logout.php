<?php
//Encerrr a sess�o
session_start();
session_unset();
session_destroy();
//header('Location: index.php');
header('Location: login.php');
?>