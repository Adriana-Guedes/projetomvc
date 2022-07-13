<?php


class Posts extends Controller
{


    //função estalogada de sessão.php. se não estiver logado redireciona para login
    public function __construct()
    {

        if (!Sessao::estaLogado()) :
            Url::redirecionar('usuarios/login');

        endif;

        $this->postModel = $this->model('PostModel');
        $this->usuarioModel = $this->model('UsuarioModel');
    }




    public function index()
    {
        $dados = [

            'posts' => $this->postModel->lerPosts()

        ];


        $this->view('posts/index', $dados);
    }




    //metodo para cadastrar
    public function cadastrar()
    {

        //PARA EVITA USUARIO MAL INTENCIONADOS(GARANTE QUE OS DADOS SEJAM RECEBIDOS APENAS APÓS TUDO PREENCHIDO E BOTÃO CLICADO)
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) :
            $dados = [
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),
                'usuario_id' => $_SESSION['usuario_id']

            ];


            //verificar se os campos estão vazios
            if (in_array("", $formulario)) :

                if (empty($formulario['titulo'])) :
                    $dados['titulo_erro'] = 'Preencha o campo titulo'; //para retornar a obrigatoriedade do campo
                endif;

                if (empty($formulario['texto'])) :
                    $dados['texto_erro'] = 'Preencha o campo texto'; //para retornar a obrigatoriedade do campo
                endif;

            else :
                if ($this->postModel->armazenar($dados)) :
                    Sessao::mensagem('post', 'Post cadastrado com sucesso!');
                    Url::redirecionar('posts');
                else :
                    die("Erro ao armazenar post no banco de dados");



                endif;

            endif;

        else :
            $dados = [
                'titulo' => '',
                'texto' => '',
                'titulo_erro' => '',
                'textol_erro' => '',


            ];

        endif;

        $this->view('posts/cadastrar', $dados);
    }








    //metodo para editar posts
    public function editar($id)
    {

        //PARA EVITA USUARIO MAL INTENCIONADOS(GARANTE QUE OS DADOS SEJAM RECEBIDOS APENAS APÓS TUDO PREENCHIDO E BOTÃO CLICADO)
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) :
            $dados = [
                'id' => $id,
                'titulo' => trim($formulario['titulo']),
                'texto' => trim($formulario['texto']),


            ];


            //verificar se os campos estão vazios
            if (in_array("", $formulario)) :

                if (empty($formulario['titulo'])) :
                    $dados['titulo_erro'] = 'Preencha o campo titulo'; //para retornar a obrigatoriedade do campo
                endif;

                if (empty($formulario['texto'])) :
                    $dados['texto_erro'] = 'Preencha o campo texto'; //para retornar a obrigatoriedade do campo
                endif;

            else :
                if ($this->postModel->atualizar($dados)) :
                    Sessao::mensagem('post', 'Post atualizado com sucesso!');
                    Url::redirecionar('posts');
                else :
                    die("Erro ao atualizar post ");



                endif;

            endif;


        else :


            //vai pegar os dados do metodo abaixo e carregar os dados para traze-los para modificação
            $post = $this->postModel->lerPostsPorId($id);

            if ($post[0]->usuario_id != $_SESSION['usuario_id']) :
                Sessao::mensagem('post', 'Você não tem autorização para editar esse post', 'alert alert-danger');
                Url::redirecionar('posts');
            endif;

            $dados = [
                'id' => $post[0]->id,
                'titulo' => $post[0]->titulo,
                'texto' => $post[0]->texto,
                'titulo_erro' => '',
                'textol_erro' => '',


            ];

        endif;



        $this->view('posts/editar', $dados);
    }









    //metodo para visualizar posts por id

    public function ver($id)
    {

        $post = $this->postModel->lerPostsPorId($id);
        $usuario = $this->usuarioModel->lerUsuarioPorId($post[0]->usuario_id);




        $dados = [
            'post' => $post,
            'usuario' => $usuario,


        ];



        $this->view('posts/ver', $dados);
    }







    public function deletar($id)
    {

        //chegando autorização para que não permita o delete (pessoas mal intencionadas)
        if (!$this->checarAutorização($id)) :

            //transformar a variavel o id que esta vindo como string em inteiro
            $id = filter_var($id, FILTER_VALIDATE_INT);
            //METODO PARA VERIFICAR O METODO ( P VER SE ESTAR VINDO GET OU POST, NECESSITAMOS DE POST)
            //METODO, A VARIAVEL QUE SERA ANALIZADA, E IRA ELIMIAR CARACTERIES INVALIDOS)
            $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

            // se existir e for do metodo post
            if ($id && $metodo == 'POST') :
                if ($this->postModel->deletar($id));
                Sessao::mensagem('post', 'Post deletado com sucesso');
                Url::redirecionar('posts');
                endif;
            else:
                Sessao::mensagem('post', 'Você não tem autorização para editar esse post', 'alert alert-danger');
                Url::redirecionar('posts');
            endif;

        

        //debugar
        //echo '<br>';
        //var_dump($id);
       // echo '<br>';
        //var_dump($metodo);
    }



    private function checarAutorização($id)
    {
        $post = $this->postModel->lerPostsPorId($id);

        if ($post[0]->usuario_id != $_SESSION['usuario_id']) :
            return true;
        else :
            return false;

        endif;
    }
}
