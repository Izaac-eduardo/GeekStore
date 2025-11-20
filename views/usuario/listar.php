<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Listagem de usuários</h2>
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
<table class="table table-bordered table-striped">
<thead class="text-center">
    <tr>
        <td>ID</td>
        <td>Nome do usuário</td>
        <td>Telefone</td>
        <td>Opções</td>
    </tr>
</thead>
<tbody class="text-center">
    <?php 
    $dadosUsuarios = $this->usuario->listar();
    foreach($dadosUsuarios as $dados) {
        ?>
        <tr>
            <td><?= $dados->id ?></td>
            <td><?= $dados->nome ?></td>
            <td><?= $dados->telefone ?></td>
            <td>
                <a href="usuario/index/<?= $dados->id?> " class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar
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