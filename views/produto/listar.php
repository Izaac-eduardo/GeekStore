<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Lista de Produtos </h2>
            </div>
            <div class="float-end">
<a href="produto" class="btn btn-dark p-2 mr-2">
    <i class="fas fa-file"></i> Adicionar Produto
</a>
<a href="produto/listar" class="btn btn-dark p-2"> 
    <i class="fas fa-search"></i> Listar
</a>
            </div>
        </div>
        <div class="card-body">
<table class="table table-bordered text-center">
<thead class="text-center">
    <tr>
        <td>ID</td>
        <td>Imagem</td>
        <td>Nome do Produto</td>
        <td>Estoque</td>
        <td>Valor</td>
        <td>Ativo</td>
        <td>Opções</td>
    </tr>
</thead>
<tbody class="text-center">
    <?php 
    $dadosProduto = $this->produto->listar();
    foreach($dadosProduto as $dados) {
        
       $valor = number_format($dados->valor, 2, ".", ".");
       if($dados->ativo == 'S') 
        $ativo = "Sim";
        else 
        $ativo = "Não";
       ?>
    <tr class="text-center">
        <td class="text-center"><?=$dados->id?></td>
        <td class="text-center">
            <img src="arquivos/<?= $dados->imagem ?>" alt="" width="100px">
        </td>
        <td class="text-center">
            <?=$dados->nome?>
            </td>
                        <td class="text-center">
                                <?= $dados->estoque ?? 0 ?>
                        </td>
            <td class="text-center">
              R$  <?=$valor ?>
            </td>
            <td class="text-center">
                <?= $ativo ?>
            </td>
            <td width="200px">
                <a href="produto/index/<?= $dados->id?>" class="btn btn-warning ml-0">
                    <i class="fas fa-edit"></i> Editar
                </a> 
                <a href="javascript:excluir(<?=$dados->id ?>, 'produto')" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Excluir
                </a>
            </td>
    </tr>
    <?php
    }
    
    
    
    ?>
</tbody>
</table>
        </div>
    </div>
</div>