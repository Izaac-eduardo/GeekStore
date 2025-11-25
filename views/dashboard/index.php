<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #3498db;
        --success-color: #27ae60;
        --warning-color: #f39c12;
        --danger-color: #e74c3c;
        --light-bg: #ecf0f1;
        --border-color: #bdc3c7;
    }

    .dashboard-header {
        padding: 0.4rem 0;
        border-bottom: 1px solid var(--light-bg);
        margin-bottom: 0.6rem;
    }

    .dashboard-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-color);
        letter-spacing: -0.5px;
        margin-bottom: 0.1rem;
    }

    .dashboard-subtitle {
        color: #7f8c8d;
        font-size: 0.7rem;
        margin-top: 0;
        font-weight: 400;
        display: none;
    }

    .stat-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: white;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }

    .stat-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .stat-card .card-body {
        padding: 0.6rem;
    }

    .stat-card .icon {
        font-size: 1.1rem;
        color: var(--primary-color);
        margin-bottom: 0.2rem;
        opacity: 0.8;
    }

    .stat-card .card-title {
        color: #7f8c8d;
        font-size: 0.6rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 0.15rem;
    }

    .stat-number {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0;
    }

    .stat-card-blue::before { background: linear-gradient(90deg, #3498db, #2980b9); }
    .stat-card-blue .icon { color: #3498db; }
    .stat-card-green::before { background: linear-gradient(90deg, #27ae60, #229954); }
    .stat-card-green .icon { color: #27ae60; }
    .stat-card-orange::before { background: linear-gradient(90deg, #f39c12, #d68910); }
    .stat-card-orange .icon { color: #f39c12; }
    .stat-card-purple::before { background: linear-gradient(90deg, #9b59b6, #8e44ad); }
    .stat-card-purple .icon { color: #9b59b6; }

    .card {
        border: none;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        background: white;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
    }

    .card:hover {
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background: #f8f9fa;
        border: none;
        padding: 0.5rem 0.7rem;
        border-bottom: 1px solid #e9ecef;
    }

    .card-header h5 {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 0.75rem;
        margin: 0;
    }

    .card-header i {
        color: var(--accent-color);
        margin-right: 0.3rem;
    }

    .card-body {
        padding: 0.6rem;
    }

    .table th {
        color: var(--primary-color);
        font-weight: 600;
        border: none;
        background: #f8f9fa;
        padding: 0.35rem 0.4rem;
        text-transform: uppercase;
        font-size: 0.65rem;
        letter-spacing: 0.2px;
    }

    .table td {
        vertical-align: middle;
        color: #2c3e50;
        padding: 0.35rem 0.4rem;
        border: none;
        border-bottom: 1px solid #e9ecef;
        font-size: 0.75rem;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
    }

    .badge-custom {
        padding: 0.2rem 0.35rem;
        border-radius: 3px;
        font-weight: 600;
        font-size: 0.65rem;
    }

    .bg-success-light { background: #d5f4e6; color: #27ae60; }
    .bg-danger-light { background: #fadbd8; color: #e74c3c; }
    .bg-warning-light { background: #fdebd0; color: #f39c12; }
    .bg-info-light { background: #d6eaf8; color: #3498db; }

    .list-group-item {
        border: none;
        border-bottom: 1px solid #e9ecef;
        padding: 0.4rem 0.7rem;
        background: white;
        font-size: 0.75rem;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .list-group-item strong {
        color: var(--primary-color);
        font-size: 0.75rem;
    }

    .list-group-item .text-muted {
        color: #95a5a6;
        font-size: 0.65rem;
    }

    .alert-empty {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        color: #7f8c8d;
        border-radius: 5px;
        padding: 0.6rem;
        text-align: center;
    }

    .alert-empty i {
        font-size: 0.9rem;
        color: #bdc3c7;
        margin-bottom: 0.2rem;
        display: none;
    }

    .alert-empty p {
        margin: 0;
        font-size: 0.65rem;
    }
</style>

<link rel="stylesheet" href="css/dashboard.css">

<div class="container-fluid" style="padding: 0.4rem;">
    <div class="dashboard-header">
        <div class="row g-0">
            <div class="col-12">
                <h1 class="dashboard-title">Dashboard</h1>
                <p class="dashboard-subtitle">Visão geral</p>
            </div>
        </div>
    </div>

    <div class="row g-2 mb-2">
        <div class="col-lg-3 col-md-6 col-6">
            <div class="card stat-card stat-card-blue">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-box"></i></div>
                    <h6 class="card-title">Produtos</h6>
                    <p class="stat-number"><?php echo intval($totalProdutos); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
            <div class="card stat-card stat-card-green">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-layer-group"></i></div>
                    <h6 class="card-title">Categorias</h6>
                    <p class="stat-number"><?php echo intval($totalCategorias); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
            <div class="card stat-card stat-card-orange">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <h6 class="card-title">Usuários</h6>
                    <p class="stat-number"><?php echo intval($totalUsuarios); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6">
            <div class="card stat-card stat-card-purple">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-shopping-bag"></i></div>
                    <h6 class="card-title">Pedidos</h6>
                    <p class="stat-number"><?php echo intval($totalPedidos ?? 0); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-2 mb-2">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-dollar-sign"></i> Faturamento</h5>
                </div>
                <div class="card-body">
                    <div style="font-size: 1.1rem; font-weight: 700; color: #27ae60; margin-bottom: 0.2rem;">
                        R$ <?php echo number_format(floatval($totalFaturamento ?? 0), 2, ',', '.'); ?>
                    </div>
                    <p style="color: #95a5a6; margin: 0; font-size: 0.65rem;">Total vendido</p>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-receipt"></i> Pedidos Recentes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 180px; overflow-y: auto;">
                        <table class="table table-sm mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">Ped.</th>
                                    <th>Cliente</th>
                                    <th class="text-end" style="width: 100px;">Total</th>
                                    <th class="text-center" style="width: 70px;">Status</th>
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
                                        <td class="text-end"><strong style="font-size: 0.7rem;">R$ <?php echo $total; ?></strong></td>
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
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-star"></i> Top Produtos</h5>
                </div>
                <div class="card-body">
                    <?php if(!empty($topProdutos)) { ?>
                        <ul class="list-group list-group-flush" style="max-height: 150px; overflow-y: auto;">
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
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-layer-group"></i> Top Categorias</h5>
                </div>
                <div class="card-body">
                    <?php if(!empty($topCategorias)) { ?>
                        <ul class="list-group list-group-flush" style="max-height: 150px; overflow-y: auto;">
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
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-warehouse"></i> Estoque Baixo</h5>
                </div>
                <div class="card-body">
                    <?php if(!empty($lowStock)) { ?>
                        <ul class="list-group list-group-flush" style="max-height: 150px; overflow-y: auto;">
                            <?php foreach($lowStock as $p) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><strong><?php echo htmlspecialchars(substr($p->nome, 0, 25)); ?></strong></div>
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
