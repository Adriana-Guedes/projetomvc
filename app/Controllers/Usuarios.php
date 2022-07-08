<?php


class Usuarios extends Controller{

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

    elseif (strlen($formulario['senha']) <6):
        $dados['senha_erro'] = 'A senha deve ter no minimo  6 caracteres';
    elseif($formulario['senha'] != $formulario['confirmar_senha']):
       $dados['confirmar_senha_erro'] = 'As senhas são diferentes';

    else:
        $dados['senha'] = password_hash($formulario['senha'],PASSWORD_DEFAULT);
        echo 'Pode cadastrar! ';
    endif;
endif;


    //echo 'Senha Original: '.$formulario['senha'].'<hr>';
    //não usada mais 
    //echo 'Senha md5: '.md5($formulario['senha']).'<hr>';
    // echo 'Senha sha1: '.sha1($formulario['senha']).'<hr>';

    //senha criptografada fortemente
    //$SenhaSegura = password_hash($formulario['senha'],PASSWORD_DEFAULT);
   // echo 'Senha hash: '.$SenhaSegura.'<hr>';

        var_dump($formulario);
    else:
        $dados = [
            'nome' => '',
            'email' => '',
            'senha' => '',
            'confirmar_senha' => '',
        ];

    endif;

    $this->view('usuarios/cadastrar',$dados);
}



}