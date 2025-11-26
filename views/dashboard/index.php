<link rel="stylesheet" href="css/dashboard.css">

<div class="container-fluid dashboard-container">
    <div class="dashboard-header">
        
    </div>

    <div class="row g-2 mb-2">
        <div class="col-lg-3 col-md-6 col-6">
            <div class="card stat-card stat-card-blue">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-box"></i></div>
                    <h6 class="card-title">PRODUTOS</h6>
                    <p class="stat-number"><?php echo intval($totalProdutos); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
            <div class="card stat-card stat-card-green">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-layer-group"></i></div>
                    <h6 class="card-title">CATEGORIAS</h6>
                    <p class="stat-number"><?php echo intval($totalCategorias); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
            <div class="card stat-card stat-card-orange">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <h6 class="card-title">USUÁRIOS</h6>
                    <p class="stat-number"><?php echo intval($totalUsuarios); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
            <div class="card stat-card stat-card-purple">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-shopping-bag"></i></div>
                    <h6 class="card-title">PEDIDOS</h6>
                    <p class="stat-number"><?php echo intval($totalPedidos ?? 0); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-2 mb-2">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-dollar-sign"></i> FATURAMENTO TOTAL</h5>
                </div>
                <div class="card-body">
                    <div class="faturamento-valor">
                        R$ <?php echo number_format(floatval($totalFaturamento ?? 0), 2, ',', '.'); ?>
                    </div>
                    <p class="faturamento-texto">TOTAL VENDIDO</p>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-receipt"></i>PEDIDOS RECENTES</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-responsive-scroll">
                        <table class="table table-sm table-sm-custom">
                            <thead>
                                <tr>
                                    <th class="table-col-pedido">Ped.</th>
                                    <th>Cliente</th>
                                    <th class="text-end table-col-total">Total</th>
                                    <th class="text-center table-col-status">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($recentOrders)) {
                                    foreach($recentOrders as $r) {
                                        $data = isset($r->data) && $r->data ? date('d/m/Y H:i', strtotime($r->data)) : '-';
                                        $total = isset($r->total) ? number_format($r->total, 2, ',', '.') : '0,00';
                                        $cliente = isset($r->cliente_nome) ? $r->cliente_nome : ('Pedido '.$r->id);
                                        $status = htmlspecialchars($r->status ?? 'Pendente');
                                        $status_class = strtolower($status) === 'completo' || strtolower($status) === 'enviado' ? 'bg-info-light' : 'bg-warning-light';
                                ?>
                                    <tr>
                                        <td><strong>#<?php echo $r->id; ?></strong></td>
                                        <td><?php echo htmlspecialchars(substr($cliente, 0, 12)); ?></td>
                                        <td class="text-end"><strong class="table-total-strong">R$ <?php echo $total; ?></strong></td>
                                        <td class="text-center"><span class="badge-custom <?php echo $status_class; ?>"><?php echo substr($status, 0, 3); ?></span></td>
                                    </tr>
                                <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="5">
                                            <div class="alert-empty">
                                                <i class="fas fa-inbox"></i>
                                                <p class="pedido-margin">Nenhum pedido registrado</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-2 mb-2">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-box"></i> PRODUTOS MAIS VENDIDOS</h5>
                </div>
                <div class="card-body">
                    <?php if(!empty($topProdutos)) { ?>
                        <ul class="list-group list-group-flush list-scroll">
                            <?php foreach($topProdutos as $p) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><strong><?php echo htmlspecialchars(substr($p->nome, 0, 18)); ?></strong></div>
                                    <span class="badge-custom bg-success-light"><?php echo intval($p->quantidade_vendida); ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <div class="alert-empty">
                            <p>Sem vendas</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-layer-group"></i> CATEGORIAS COM MAIS PEDIDOS</h5>
                </div>
                <div class="card-body">
                    <?php if(!empty($topCategorias)) { ?>
                        <ul class="list-group list-group-flush list-scroll">
                            <?php foreach($topCategorias as $c) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><strong><?php echo htmlspecialchars(substr($c->nome, 0, 18)); ?></strong></div>
                                    <span class="badge-custom bg-info-light"><?php echo intval($c->total_pedidos); ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <div class="alert-empty">
                            <p>Sem pedidos</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-warehouse"></i> ESTOQUE BAIXO</h5>
                </div>
                <div class="card-body">
                    <?php if(!empty($lowStock)) { ?>
                        <ul class="list-group list-group-flush list-scroll">
                            <?php foreach($lowStock as $p) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><strong><?php echo htmlspecialchars(substr($p->nome, 0, 20)); ?></strong></div>
                                    <span class="badge-custom bg-danger-light"><?php echo intval($p->estoque); ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <div class="alert-empty">
                            <p>Estoque OK</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>
