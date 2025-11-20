<script src="js/jquery.maskedinput-1.2.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<?php 
if (!empty($id)) {
    $dados = $this->categoria->editar($id);
 
}   $id = $dados->id ?? NULL;
    $descricao = $dados->descricao ?? NULL;
    $ativo = $dados->ativo ?? NULL;
    
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Cadastro de Categorias </h2>
            </div>
            <div class="float-end">
<a href="categoria" class="btn btn-dark p-2 mr-2">
    <i class="fa fa-plus" aria-hidden="true"></i> Adicionar Categoria
</a>
<a href="categoria/listar" class="btn btn-dark p-2"> 
    <i class="fas fa-search"></i> Listar
</a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" name="formCadastro" method="post" action="categoria/salvar" enctype="multipart/form-data" data-parsley-validate="">
                <div class="row">
                    <div class="col-12 col-md-2 mb-3">
                        <label for="id">ID:</label>
                        <input type="text" readonly name="id" id="id" class="form-control" value="<?= $id ?>">
                    </div>


                    <div class="col-12 col-md-5 mb-3">
                    <label for="descricao"
                     >Descrição:</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" required="" maxlength="100"  placeholder="Nome da categoria" 
                    data-parsley-required-message="Digite o nome" value="<?= $descricao ?>"/></div>

        
                  
    <div class="col-12 col-md-5 mb-3">
        <label for="destaque">Ativo:</label>
        <select name="ativo" id="ativo" required class="form-control"
        data-parsley-required-message="Selecione">
    <option value=""></option>
<option value="S">Sim</option>
<option value="N">Não</option></select>
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
    $("#valor").maskMoney({thousands:'.', decimal:','});
</script>