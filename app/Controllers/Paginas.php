<?php

class Paginas extends Controller{
    
    
    
    public function index(){
     //se tiver logado direcionar para posts
        if(Sessao::estaLogado()):
         Url::redirecionar('posts');

        endif;





      $dados = [
      'titulo' => 'Pagina Inicial',
            
        ];

        //$this->view('paginas/home', ['titulo' => 'Pagina Inicial', 'descricao'=> 'Curso de PHP7']);
        $this->view('paginas/home', $dados);  

    }


    public function sobre(){
        $dados = [
        'tituloPagina' => APP_NOME 
            
          ];
      
      
          $this->view('paginas/sobre', $dados);

    }
   



}
