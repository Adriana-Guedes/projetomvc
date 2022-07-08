<?php


class Usuarios extends Controller{

    public function __construct()
    {
        $this->usuarioModel = $this->model('UsuarioModel');
    }

public function cadastrar(){

    //PARA EVITA USUARIO MAL INTENCIONADOS(GARANTE QUE OS DADOS SEJAM RECEBIDOS APENAS APÓS TUDO PREENCHIDO E BOTÃO CLICADO)
    $formulario = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
   
    if(isset($formulario)):
        $dados = [
            'nome' => trim($formulario['nome']),
            'email' => trim($formulario['email']),
            'senha' => trim($formulario['senha']),
            'confirmar_senha' => trim($formulario['confirmar_senha']),

        ];
        //verificar se os campos estão vazios
     if(in_array("", $formulario)):

        if(empty($formulario['nome'])):
            $dados['nome_erro'] = 'Preencha o campo nome'; //para retornar a obrigatoriedade do campo
        endif;

        if(empty($formulario['email'])):
            $dados['email_erro'] = 'Preencha o campo e-mail'; //para retornar a obrigatoriedade do campo
        endif;

        if(empty($formulario['senha'])):
            $dados['senha_erro'] = 'Preencha o campo senha'; //para retornar a obrigatoriedade do campo
           
        endif;


        if(empty($formulario['confirmar_senha'])):
            $dados['confirmar_senha_erro'] = 'Confirme a senha'; //para retornar a obrigatoriedade do campo
                  
    endif;
else:
    //expressões regulares - regex ( corrigir conforme video 35)
    if(!preg_match('/^([áÁàÀÃãÉéêÊíÍìÌóÒõÕòÒÔôúÚÙùcCaA-zZ]+)+((\s[áÁàÀÃãÉéêÊíÍìÌóÒõÕòÒÔôúÚÙùcCaA-zZ]+)+)?$/',$formulario['nome'])):
        $dados['nome_erro'] = 'O nome informado é invalido';

    elseif(!filter_var($formulario['email'], FILTER_VALIDATE_EMAIL)):
        $dados['email_erro'] = 'O e-mail informado é invalido';   

    elseif($this->usuarioModel->checarEmail($formulario['email'])):
        $dados['email_erro'] = 'O email informado esta cadastrado';  

    elseif (strlen($formulario['senha']) <6):
        $dados['senha_erro'] = 'A senha deve ter no minimo  6 caracteres';
    elseif($formulario['senha'] != $formulario['confirmar_senha']):
       $dados['confirmar_senha_erro'] = 'As senhas são diferentes';

    else:
        $dados['senha'] = password_hash($formulario['senha'],PASSWORD_DEFAULT);

        if($this->usuarioModel->armazenar($dados)):
            echo 'Cadastro realizado com sucesso! <hr>';

    else:
        die("Erro ao armazenar usuario no banco de dados");
    endif;
      
    endif;
endif;


    //echo 'Senha Original: '.$formulario['senha'].'<hr>';
    //não usada mais 
    //echo 'Senha md5: '.md5($formulario['sen••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••
    //senha criptografada fortemente
    //$SenhaSegura = password_hash($formulario['senha'],PASSWORD_DEFAULT);
   // echo 'Senha hash: '.$SenhaSegura.'<hr>';

       // var_dump($formulario);(para debugar)
    else:
        $dados = [
            'nome' => '',
            'email' => '',
            'senha' => '',
            'confirmar_senha' => '',
            'nome_erro' => '',
            'email_erro' => '',
            'senha_erro' => '',
            'confirmar_senha_erro' => '',

        ];

    endif;

    $this->view('usuarios/cadastrar',$dados);
}







public function login(){

    //PARA EVITA USUARIO MAL INTENCIONADOS(GARANTE QUE OS DADOS SEJAM RECEBIDOS APENAS APÓS TUDO PREENCHIDO E BOTÃO CLICADO)
    $formulario = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
   
    if(isset($formulario)):
        $dados = [
          
            'email' => trim($formulario['email']),
            'senha' => trim($formulario['senha']),
          

        ];
        //verificar se os campos estão vazios
     if(in_array("", $formulario)):

        if(empty($formulario['email'])):
            $dados['email_erro'] = 'Preencha o campo e-mail'; //para retornar a obrigatoriedade do campo
        endif;

        if(empty($formulario['senha'])):
            $dados['senha_erro'] = 'Preencha o campo senha'; //para retornar a obrigatoriedade do campo
           
        endif;

else:
    //expressões regulares - regex ( corrigir conforme video 35)
    if(!filter_var($formulario['email'], FILTER_VALIDATE_EMAIL)):
        $dados['email_erro'] = 'O e-mail informado é invalido';   

    else:
         $usuario = $this->usuarioModel->checarLogin($formulario['email'], $formulario['senha']);
         
        
         if($usuario):
            $this->criarSessaoUsuario($usuario);
         else:
            echo 'Usuario ou senha invalidos <hr>';


       endif;
    endif;
endif;
    else:
        $dados = [
            
            'email' => '',
            'senha' => '',
            'email_erro' => '',
            'senha_erro' => '',
        

        ];

    endif;

    $this->view('usuarios/login',$dados);
}

private function criarSessaoUsuario($usuario){

    //variavel super global para criar uma sessão
    $_SESSION['usuario_id'] = $usuario->id;
    $_SESSION['usuario_nome'] = $usuario->nome;
    $_SESSION['usuario_email'] = $usuario->email;
    }

    public function sair(){
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);

        session_destroy();
        //após destruição da sessão do usuario ele redireciona para o index
        header('Location: '.URL.'/paginas/index');
    }
}