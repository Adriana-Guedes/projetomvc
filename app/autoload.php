<?php


//autoload - responsavel pelo carregamento automatico de classes
spl_autoload_register(function($classe){

$diretorios = [
    //pastas a serem percorridas para carregamento automatico
    'Libraries',
    'Helpers'

];

    foreach($diretorios as $diretorio):
        $arquivo = (__DIR__.DIRECTORY_SEPARATOR.$diretorio.DIRECTORY_SEPARATOR.$classe.'php');
        if(file_exists($arquivo)):
            require_once $arquivo ;
            
            echo($diretorio);
            
        endif;
    endforeach;

});

