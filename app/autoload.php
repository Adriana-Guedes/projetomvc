<?php



//autoload - responsavel pelo carregamento automatico de classes
spl_autoload_register(function($classe){

    $diretorios = [
        'Libraries',
         'Helpers'
   
       ];



    foreach($diretorios as $diretorio):
     
              if((file_exists(dirname(__DIR__).'/app/'.$diretorio.'/'.$classe.'.php'))):
                require_once (dirname(__DIR__).'/app/'.$diretorio.'/'.$classe.'.php');

              
        endif;
    endforeach;

});



