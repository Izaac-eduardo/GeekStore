<?php 
if(!empty($id)) {
    $dados = $this->usuario->editar($id);
}
$id = $dados->id ?? NULL;
$nome = $dados->nome ?? NULL;
$email = $dados->email ?? NULL;
$telefone = $dados->telefone ?? NULL;
$ativo = $dados->ativo ?? NULL;
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Cadastro de usuários</h2>
            </div>
            <div class="float-end">
               <a href="usuario" title="Novo" class="btn btn-dark">
                <i class="fa fa-plus" aria-hidden="true"></i> Novo Usuário
               </a>
               <a href="usuario/listar" title="Listar " class="btn btn-dark">
                <i class="fas fa-search"></i>Listar
               </a>
            </div>
        </div>
        <div class="card-body">
            <form name="formUsuario" method="post" data-parsley-validate="" action="usuario/salvar">
                <div class="row">
                    <div class="col-12 col-md-1">
                        <label for="id">ID:</label>
                        <input type="text" readonly name="id" id="id" class="form-control" value="<?= $id ?>">
                    </div>
                    <div class="col-12 col-md-11 ">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-control" required maxlength="100" placeholder="Nome do usuário" data-parsley-required-message="Digite o nome do usuário" value="<?= $nome ?>"/>
                    </div> 
                </div>
                <br>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" accept="email" class="form-control" required maxlength="100" placeholder="Email do usuário" data-parsley-required-message="Digite o email do usuário" data-parsley-type-message="Digite um email válido" value="<?= $email ?>"/>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" class="form-control" maxlength="100" placeholder="Senha do usuário" 
                        data-parsley-type-message="Digite uma senha válida"/>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="redigite">Confirme a senha:</label>
                        <input type="password" name="redigite" id="redigite" class="form-control" maxlength="100" placeholder="Confirme sua senha do usuário" data-parsley-equalto="#senha" data-parsley-equalto-message="As senhas não conferem"/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" required maxlength="15" placeholder="Telefone do usuário" data-parsley-required-message="Digite um telefone válido" value="<?= $telefone ?>"/> 
                    </div>
                    <div class="col-12 col-md-2">
                        <label for="ativo">Ativo:</label>
                        <select name="ativo" id="ativo" class="form-control" required placeholder="Selecione o status do usuário" data-parsley-required-message="Selecione o status do usuário" >
                            <option value=""></option>
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>
                        <script>
                            $("#ativo").val("<?= $ativo ?>");
                        </script> 
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success float-end">
                    <i class="fas fa-check"></i> Salvar
                </button>
                
            </form>
        </div>
    </div>
</div>
          <script>
                        $("#telefone").inputmask("(99) 99999-9999");
            </script>