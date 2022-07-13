
<div class="col-x1-8 col-md-6 mx-auto p-5">

<!-- uma div acima, com opção de retorno-->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?=URL?>/posts">Posts</a></li>
    <li class="breadcrumb-item active" aria-current="page">Escrever</li>
  </ol>
</nav>

    <div class="card">
        <div class="card-header bg-secondary text-white" >
            <h2>Escrever Post</h2>
        </div>
        <div class="card-body bg-ligth" >
      
            <!--no atcion informar o destino dos dados para este formulario, para carregar os metodos da classe informada -->
            <form name="login" method="POST" action="<?=URL?>/posts/cadastrar">
          
            <div class="form-group">
                <label for="titulo">Título: <sup class="text-danger">*</label>
                <input type="text" name="titulo" id="titulo"   class="form-control <?= $dados['titulo_erro'] ? 'is-invalid' : ''  ?>"  >   
                <div class="invalid-feedback"> 
                    <?= $dados['titulo_erro'] ?> 
                </div>
            </div>


            <div class="form-group">
                <label for="texto">Texto: <sup class="text-danger">*</label>
                <textarea name="texto" name="texto" id="texto"    value="<?=$dados['texto']?>"   class="form-control <?= $dados['texto_erro'] ? 'is-invalid' : ''  ?>"  rows="5" ><?= $dados['texto']?> </textarea>   
                <div class="invalid-feedback"> 
                    <?= $dados['texto_erro'] ?> 
                </div>
            </div>

                    <input type="submit" value="Cadastrar" class="btn btn-info btn-block">
            
                 </form>
              </div>
            </div>

        </div>
    </div>

</div>