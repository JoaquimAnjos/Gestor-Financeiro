<?php

spl_autoload_register(function($class_name) {

    $filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";

    if (file_exists(($filename))) {
        require_once($filename);
    }
});

date_default_timezone_set('Europe/London');

//Sessão
session_start();

?>