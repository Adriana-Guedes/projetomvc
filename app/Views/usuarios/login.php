
<div class="col-x1-4 col-md-6 mx-auto p-5">
    <div class="card">
        <div class="card-header bg-secondary text-white" >
            <h2>Login</h2>
</div>
            <small>Informe seus dados para fazer login!</small>

            <!--no atcion informar o destino dos dados para este formulario, para carregar os metodos da classe informada -->
            <form name="login" method="POST" action="<?=URL?>/usuarios/login">
          
            <div class="form-group">
                <label for="email">Email: <sup class="text-danger">*</label>
                <input type="text" name="email" id="email"    value="<?=$dados['email']?>"   class="form-control <?= $dados['email_erro'] ? 'is-invalid' : ''  ?>"  >   
                <div class="invalid-feedback"> 
                    <?= $dados['email_erro'] ?> 
                </div>
            </div>


            <div class="form-group">
                <label for="senha">Senha: <sup class="text-danger">*</label>
                <input type="password" name="senha" id="senha"    value="<?=$dados['senha']?>"   class="form-control <?= $dados['senha_erro'] ? 'is-invalid' : ''  ?>"  >   
                <div class="invalid-feedback"> 
                    <?= $dados['senha_erro'] ?> 
                </div>
            </div>


          

                <div class="row">
                    <div class="col-md-6">
                    <input type="submit" value="Login" class="btn btn-info btn-block">
             </div>
                    <div class="col">
                    <a href="<?= URL?>/usuarios/cadastrar">Não tem uma conta? Cadastra-se</a>
                

                    </div>
            </div>


        </div>
    </div>

</div>