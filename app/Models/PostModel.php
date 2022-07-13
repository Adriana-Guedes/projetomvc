<?php


class PostModel{

    private $db;

    public function __construct(){

        $this->db = new Database();

    }


    //metodo getAll
    public function  lerPosts(){
        //exite somente com relação de id do usuario
        $this->db->query("SELECT *,
        posts.id as postID,
        posts.criado_em as postDataCadastro,
        usuarios.id as usuarioId,
        usuarios.criado_em as usuarioDataCadastro
        FROM posts
        INNER JOIN usuarios ON  posts.usuario_id = usuarios.id 
        ORDER BY posts.id DESC ");
         
        return $this->db->resultados();

    }


    //metodo para salvar dados(update)
    public function armazenar($dados){
        $this->db->query("INSERT INTO posts(usuario_id, titulo, texto) VALUES (:usuario_id, :titulo, :texto)");

        $this->db->bind("usuario_id", $dados['usuario_id']);
        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("texto", $dados['texto']);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;

    
    }

    //metodo update (post)
    public function atualizar($dados){
        $this->db->query("UPDATE posts SET titulo = :titulo, texto = :texto where id = :id");

        $this->db->bind("id", $dados['id']);
        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("texto", $dados['texto']);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;

    
    }


    //metodo get Id
    public function lerPostsPorId($id){
        $this->db->query("SELECT * FROM posts where id = :id");
        $this->db->bind('id', $id);

        return $this->db->resultados();

       
    }


    public function deletar($id){
        $this->db->query("DELETE FROM posts where id = :id");

        $this->db->bind("id", $id);
     

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;

    
    }

    
}

