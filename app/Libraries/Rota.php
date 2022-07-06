<?php
//----------------------PARA EXIBIR OS ERROS NO BROWSER------------------------//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//----------------------PARA EXIBIR OS ERROS NO BROWSER------------------------//



class Rota{


   private $controlador = 'Paginas'; 
   private $metodo = 'index';
   private $parametros = [];



    //construtor
    public function __construct(){

        //se tiver a url eu a recebo se não indico o indice 0
        $url = $this->url() ? $this->url() : [0];

       
        //$proot = $_SERVER['DOCUMENT_ROOT'].'/projetomvc/app/'; //(mostra o caminho para a pasta raiz, mostrando o caminho para o apache)
        
   
        //como a url foi transformada em array no explore, 
        //então aqui será trabalhado os indices desta array,
        //verificando se existe o indice digitado (atentar-se ao indice do arquivo)
        if(file_exists(dirname(__FILE__) . '/../Controllers/'.ucwords($url[0]).'.php')): //ucwords função do php que transforma o primeiro carater em letra maiuscula, neste caso ele vai transformar por indice post[0]/feliz[1]/1[2]
            $this->controlador = ucwords($url[0]);//se o arquivo existir , seta o controlador com esse arquivo
            unset($url[0]);//desabitar 

                 
           

        endif;

        require_once dirname(__FILE__) . '/../Controllers/'.$this->controlador.'.php'; //se o arquivo de controlador existir, então sera chamado aqui
        $this->controlador = new $this->controlador;//sendo assim consigo instanciar
        


        //se existir a url no indice 1, 
        if(isset($url[1])): //verificar se o metodo existes (method_exists= metodo do php)
            if(method_exists($this->controlador, $url[1])):
                $this->metodo = $url[1];
                unset($url[1]); //desabitar 

            endif;
        endif;
        
        //verifica se esse o parametro na url, se existir, ele vai pegar os valores e atribuir a url, se não exisitir trará um array vazio
        $this->parametros = $url ? array_values($url) : [];

        //funççao do php passando os parametros para montar a url
        call_user_func_array([$this->controlador, $this->metodo], $this->parametros);



        //var_dump($this); //para testar os metodos
      
    }



    //metodo
    public function url(){
             //funçao do php (remove todos os caracteres de URL ilegais de uma string )
       $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

        //se existir
       if(isset($url)):

        $url = trim(rtrim($url));//retira os espaços em branco inicio e fim da string
    

        $url = explode('/',$url); //isso transforma as strings unica digitada pelo usuario, em string após a barra em formado de array

            return $url;
       endif;

    }
    
}