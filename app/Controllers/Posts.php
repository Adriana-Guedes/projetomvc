<?php


class Posts extends Controller{


    //função estalogada de sessão.php. se não estiver logado redireciona para login
    public function __construct() {

        if(!Sessao::estaLogado()):
         Url::redirecionar('usuarios/login');

        endif;
       
    }




    public function index(){

        $this->view('posts/index');
    }





    public function cadastrar(){

        //PARA EVITA USUARIO MAL INTENCIONADOS(GARANTE QUE OS DADOS SEJAM RECEBIDOS APENAS APÓS TUDO PREENCHIDO E BOTÃO CLICADO)
        $formulario = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
       
        if(isset($formulario)):
            $dados = [
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),
               
    
            ];
            //verificar se os campos estão vazios
         if(in_array("", $formulario)):
    
            if(empty($formulario['titulo'])):
                $dados['titulo_erro'] = 'Preencha o campo titulo'; //para retornar a obrigatoriedade do campo
            endif;
    
            if(empty($formulario['texto'])):
                $dados['texto_erro'] = 'Preencha o campo texto'; //para retornar a obrigatoriedade do campo
    
            endif;
             else:
                echo 'Pode cadastrar o post';    
          
             endif;
       
        else:
            $dados = [
                'titulo' => '',
                'texto' => '',
                'titulo_erro' => '',
                'textol_erro' => '',
        
    
            ];
    
        endif;
    
        $this->view('posts/cadastrar',$dados);
    }
}