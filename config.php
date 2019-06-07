<?php

spl_autoload_register(function($class_name) {

    $filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";

    if (file_exists(($filename))) {
        require_once($filename);
    }
});

//ALT + SHIFT + F = format
//CTRL + ALT + seta para baixo = fazer a mesma alteração para todos
// html5= constroi pagina padrão html5
// CTRL + B = abrir painel de ficheiros
//CTRL + P
// CTRL + SHIFT + F = procurar em todo o projeto
//CTRL + SHIFT + K = apagar linha
/*se posicionarmos o cursor do mouse sobre o elemento que desejamos renomear 
e pressionarmos Ctrl + F2 (para alterar no mesmo arquivo) ou apenas F2 (para alterar em todos os arquivos)*/
?>