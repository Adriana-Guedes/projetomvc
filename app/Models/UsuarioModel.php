<?php


class UsuarioModel{

    private $db;

    public function __construct(){

        $this->db = new Database();

    }


    public function checarEmail($email){
        $this->db->query('SELECT email FROM usuarios WHERE email = :e');
        $this->db->bind(":e", $email);

        if($this->db->resultado()):
            return true;
        else:
            return false;

        endif;

    }


    public function armazenar($dados){
        $this->db->query("INSERT INTO usuarios(nome, email, senha) VALUES (:nome, :email, :senha)");

        $this->db->bind("nome", $dados['nome']);
        $this->db->bind("email", $dados['email']);
        $this->db->bind("senha", $dados['senha']);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }






    public function checarLogin($email, $senha){
        $this->db->query("SELECT *  FROM usuarios WHERE email = :e");
        $this->db->bind(":e", $email);
       
        //var_dump($this->db->resultado()); debugar

        if($this->db->resultado()):
           
                        
            $resultado = $this->db->resultado(); //senha verificada no banco
            // essa funçao do php verifica a senha informado pelo usuario com a senha salva em hash no banco de dados
            if(password_verify($senha, $resultado->senha)): 

              
             return $resultado;
            else:
                return false;
               
            endif;
        else:
             return false;
        endif;

    }
  
}