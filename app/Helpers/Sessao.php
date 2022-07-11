<?php

class Sessao{


    //mensagens de erro e de sucesso ao logar ( uma caixa de mensagem)

    public static function mensagem($nome, $texto = null, $classe = null){

        //se o nome não estiver vazio
        if(!empty($nome)):

            //se o texto não estiver vazio e estiver vazio a sessão
            if(!empty($texto) && empty($_SESSION[$nome])):
                //se o nome não estiver vazio a sessão nome
                if(!($_SESSION[$nome])):
                    unset($_SESSION[$nome]);//remove a sessão
                
                endif;
                //criar a sessão
                $_SESSION[$nome] = $texto;
                $_SESSION[$nome.'classe'] = $classe;

                //sessão não estiver vazio e o texto tiver(cria)
                elseif(!empty($_SESSION[$nome]) && empty($texto)):                          
                    $classe = !empty($_SESSION[$nome.'classe']) ? $_SESSION[$nome.'classe'] : 'alert alert-success';
                    echo '<div class="'.$classe.'">'.$_SESSION[$nome].'</div>';//é criado a classe


                    unset($_SESSION[$nome]); //após criado remoção da sessão
                    unset($_SESSION[$nome.'classe']); //remoção da classe

                endif;
            endif;           
            
            
    }


    //função estar logado
    public static function estaLogado(){
        if(isset($_SESSION['usuario_id'])):
            return true;
        else:
            return false;
   
           endif;
    }
}

