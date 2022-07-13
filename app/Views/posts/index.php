<div class="container py-5">

<?= Sessao::mensagem('post') ?>

    <div class="card">
        <div class="card-header bg-info text-white">
           POSTAGENS 

            <div class="btn btn-light btn-lg float-right">
               <a href="<?=URL?>/posts/cadastrar" class="btn btn-ligth"  >Escrever</a> 
            </div>
        </div>

                <div class="card-body">
                    <!-- foreach para percorrer os dados para exibição -->
                    <?php foreach($dados['posts'] as $post): ?>
                        <div class="card m-3">
                    <div class="card-header bg-secondary text-white font-weght-boldo">
                    <?= $post->titulo ?> 
                    </div>
                    <div class="card-body">
                
                    <p class="card-text"><?= $post->texto ?> </p>
                                    <!-- aqui usar o apelido da coluna dado no selesct sql-->
                  <a href="<?= URL.'/posts/ver/'.$post->postID ?> " class="btn btn-primary btn-lg float-right">Ler mais...</a>
                  </div>
                     <div class="card-footer text-muted">           <!--usar o apelido dado no álias-->
                        Escrtito por: <?= $post->nome ?>  em  <?= Checa::databr( $post->postDataCadastro) ?></div>
                </div>

            <?php endforeach ?>
        </div>
        
    </div>
</div>
