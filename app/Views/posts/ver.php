       <div class="container my-5">
         <nav aria-label="breadcrumb">
           <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?= URL ?>/posts">Posts</a></li>
             <li class="breadcrumb-item active" aria-current="page"><?= $dados['post'][0]->titulo ?> </li>
           </ol>
         </nav>
         <div class="card text-center">
           <div class="card-header bg-secondary text-white font-weght-boldo">
             <?= $dados['post'][0]->titulo ?>

           </div>
           <div class="card-body">
             <p class="card-text"><?= $dados['post'][0]->texto ?> </p>

           </div>
           <div class="card-footer text-muted">
             <small>
               Escrito por: <?= $dados['usuario'][0]->nome ?> em <?= Checa::databr($dados['usuario'][0]->criado_em) ?>
             </small>
           </div>

           <!--botão de editar ficara disponivel somente para quem o criou -->
           <?php if ($dados['post'][0]->usuario_id  == $_SESSION['usuario_id']) : ?>
             <ul class="list-inline">
             <li class="list-inline-item">
               <a href="<?= URL . '/posts/editar/' . $dados['post'][0]->id ?>" class="btn btn-sm btn-primary">Editar</a>
             </li>
             <li class="list-inline-item">
                  <form action="<?= URL . '/posts/deletar/' . $dados['post'][0]->id ?>" method="POST" >
                    <input type="submit" class="btn btn-sm btn-danger" value="Deletar" >
                    </form>

             </li>
             </ul>
           <?php endif  ?>
         </div>
       </div>
       </div>