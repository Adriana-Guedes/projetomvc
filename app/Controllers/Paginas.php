<?php

class Paginas extends Controller{
    
    
    
    public function index(){
      $dados = [
      'titulo' => 'Pagina Inicial',
      'descricao'=> 'Curso de PHP7',
      
        ];

        //$this->view('paginas/home', ['titulo' => 'Pagina Inicial', 'descricao'=> 'Curso de PHP7']);
        $this->view('paginas/home', $dados);  

    }


    public function sobre(){
        $dados = [
        'tituloPagina' => 'Pagina Sobre Nós'  
            
          ];
      
      
          $this->view('paginas/sobre', $dados);

    }
   



}
