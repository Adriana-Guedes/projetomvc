<?php

class Controller{



    public function model($model){

        require_once dirname(__FILE__) . '/../Models/'.$model.'.php';
        return new $model;

       
            }

    public function view($view, $dados = []){
        $arquivo = (dirname(__FILE__) . '/../Views/'.$view.'.php');

        if(file_exists($arquivo)):
            require_once $arquivo;

        else :
            die('O arquivo de view não existe!');

    endif;

    }
}