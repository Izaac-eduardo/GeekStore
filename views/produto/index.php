<!-- include summernote css/js -->
<script src="js/jquery.maskedinput-1.2.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<?php 
if (!empty($id)) {
    $dados = $this->produto->editar($id);
 
}    $id = $dados->id ?? NULL;
    $nome = $dados->nome ?? NULL;
    $descricao = $dados->descricao ?? NULL;
    $valor= $dados->valor ?? NULL; 
    $destaque = $dados->destaque ?? NULL;
    $ativo = $dados->ativo ?? NULL;
    $imagem = $dados->imagem ?? NULL;
    $categoria_id = $dados->categoria_id ?? NULL;
    $valor = number_format($valor, 2, ",", ".");
    $estoque = $dados->estoque ?? 0;

?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Cadastro de Produtos </h2>
            </div>
            <div class="float-end">
<a href="produto" class="btn btn-dark p-2 mr-2">
    <i class="fa fa-plus" aria-hidden="true"></i> Adicionar Produto
</a>
<a href="produto/listar" class="btn btn-dark p-2"> 
    <i class="fas fa-search"></i> Listar
</a>
            </div>
        </div>
        <div class="card-body">
            <form method="post" name="formCadastro" method="post" action="produto/salvar" enctype="multipart/form-data" data-parsley-validate="">
                <div class="row">
                    <div class="col-12 col-md-1">
                        <label for="id">ID:</label>
                        <input type="text" readonly name="id" id="id" class="form-control" value="<?= $id ?>">
                    </div>
                    <div class="col-12 col-md-8 mb-3">
                    <label for="nome"
                     >Nome:</label>
                  
                    <input type="text" name="nome" id="nome" class="form-control" required="" maxlength="100"  placeholder="Nome do Produto" 
                    data-parsley-required-message="Digite o nome" value="<?= $nome ?>"/></div>
             <div class="col-12 col-md-3">
                <label for="categoria_id">Categoria</label>
                <select name="categoria_id" id="categoria_id" required class="form-control" data-parsley-required-message="Selecione uma categoria">
                    <option value=""></option>
                    <?php
$dadosCategoria = $this->produto->listarCategoria();
foreach ($dadosCategoria as $dados) {
    $selected = ($dados->id == $categoria_id) ? 'selected' : '';
    ?>
    <option value="<?= $dados->id ?>" <?= $selected ?>>
        <?= $dados->descricao?>
    </option>
    <?php
}
                    ?>
                </select>
             </div>
            </div>
            <br>
                   <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="descricao">Descrição do produto:</label>
                        <textarea name="descricao" id="descricao" class="form-control" required data-parsley-required-message="Digite uma descricao"><?=$descricao?></textarea>
                    </div>
</div> <br>
<div class="row">
    <div class="col-12 col-md-6">
        <label for="imagem">Selecione uma imagem</label>
        <input type="file" name="imagem" id="imagem" class="form-control" accept=".jpg,">
        <input type="hidden" name="imagem" value="<?= $imagem ?>">
    </div>
    <div class="col-12 col-md-2">
        <label for="valor">Valor:</label>
        <input type="valor" name="valor" id="valor" class="form-control" required data-parsley-required-message="Digite o valor" value="<?= $valor ?>">
    </div>
    <div class="col-12 col-md-2">
        <label for="estoque">Estoque:</label>
        <input type="number" name="estoque" id="estoque" min="0" class="form-control" placeholder="0" value="<?= $estoque ?>">
    </div>
    <div class="col-12 col-md-2">
        <label for="destaque">Destaque:</label>
        <select name="destaque" id="destaque" required class="form-control"
        data-parsley-required-message="Selecione">
    <option value=""></option>
<option value="S">Sim</option>
<option value="N">Não</option></select>
<script>
    $("#destaque").val("<?= $destaque ?>");
</script>
    </div>
    <div class="col-12 col-md-2">
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
    $(document).ready(function() {
        $('#descricao').summernote({
            height: 200
        });
    });
    $("#valor").maskMoney({thousands:'.', decimal:','});
</script>