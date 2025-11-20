<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Lista de Categorias </h2>
            </div>
            <div class="float-end">
<a href="produto" class="btn btn-dark p-2 mr-2">
    <i class="fas fa-file"></i> Adicionar Categoria
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
        <td>Descrição</td>
        <td>Ativo</td>
        <td >Opções</td>
    </tr>
</thead>
<tbody class="text-center">
    <?php 
    $dadosCategoria= $this->categoria->listar();
    foreach($dadosCategoria as $dados) {
        
    
       if($dados->ativo == 'S') 
        $ativo = "Sim";
        else 
        $ativo = "Não";
       ?>
    <tr class="text-center">
        <td class="text-center"><?=$dados->id?></td>
       
        <td class="text-center">
            <?=$dados->descricao?>
            </td>
           
            <td class="text-center">
                <?= $ativo ?>
            </td>
            <td width="200px">
                <a href="categoria/index/<?= $dados->id?>" class="btn btn-warning ml-0">
                    <i class="fas fa-edit"></i> Editar
                </a> 
                <a href="javascript:excluir(<?=$dados->id ?>, 'categoria')" class="btn btn-danger">
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