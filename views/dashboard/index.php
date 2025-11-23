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
        padding: 2rem 0;
        border-bottom: 2px solid var(--light-bg);
        margin-bottom: 2rem;
    }

    .dashboard-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary-color);
        letter-spacing: -0.5px;
    }

    .dashboard-subtitle {
        color: #7f8c8d;
        font-size: 0.95rem;
        margin-top: 0.5rem;
        font-weight: 400;
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
        padding: 1.75rem;
    }

    .stat-card .icon {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
        opacity: 0.8;
    }

    .stat-card .card-title {
        color: #7f8c8d;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
    }

    .stat-number {
        font-size: 2rem;
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
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        background: white;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: #f8f9fa;
        border: none;
        padding: 1.25rem;
        border-bottom: 1px solid #e9ecef;
    }

    .card-header h5 {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 1.05rem;
        margin: 0;
    }

    .card-header i {
        color: var(--accent-color);
    }

    .card-body {
        padding: 1.5rem;
    }

    .table th {
        color: var(--primary-color);
        font-weight: 600;
        border: none;
        background: #f8f9fa;
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table td {
        vertical-align: middle;
        color: #2c3e50;
        padding: 0.875rem 1rem;
        border: none;
        border-bottom: 1px solid #e9ecef;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
    }

    .badge-custom {
        padding: 0.4rem 0.7rem;
        border-radius: 4px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .bg-success-light { background: #d5f4e6; color: #27ae60; }
    .bg-danger-light { background: #fadbd8; color: #e74c3c; }
    .bg-warning-light { background: #fdebd0; color: #f39c12; }
    .bg-info-light { background: #d6eaf8; color: #3498db; }

    .list-group-item {
        border: none;
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 1.5rem;
        background: white;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .list-group-item strong {
        color: var(--primary-color);
    }

    .list-group-item .text-muted {
        color: #95a5a6;
    }

    .alert-empty {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        color: #7f8c8d;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
    }


    .alert-empty i {
        font-size: 2rem;
        color: #bdc3c7;
        margin-bottom: 0.5rem;
    }
</style>

<link rel="stylesheet" href="css/dashboard.css">

<div class="container-fluid">
    <div class="dashboard-header">
        <div class="row">
            <div class="col-12">
                <h1 class="dashboard-title">Dashboard</h1>
                <p class="dashboard-subtitle">Visão geral do seu negócio e métricas principais</p>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card stat-card-blue">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-box"></i></div>
                    <h6 class="card-title">Produtos</h6>
                    <p class="stat-number"><?php echo intval($totalProdutos); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card stat-card-green">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-layer-group"></i></div>
                    <h6 class="card-title">Categorias</h6>
                    <p class="stat-number"><?php echo intval($totalCategorias); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card stat-card-orange">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <h6 class="card-title">Usuários</h6>
                    <p class="stat-number"><?php echo intval($totalUsuarios); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card stat-card-purple">
                <div class="card-body">
                    <div class="icon"><i class="fas fa-shopping-bag"></i></div>
                    <h6 class="card-title">Pedidos</h6>
                    <p class="stat-number"><?php echo intval($totalPedidos ?? 0); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-dollar-sign"></i> Faturamento Total</h5>
                </div>
                <div class="card-body">
                    <div class="faturamento-total">
                        R$ <?php echo number_format(floatval($totalFaturamento ?? 0), 2, ',', '.'); ?>
                    </div>
                    <p class="faturamento-label">Valor total de vendas</p>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-receipt"></i> Pedidos Recentes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="table-width-pedido">Pedido</th>
                                    <th>Cliente</th>
                                    <th class="text-end table-width-total">Total</th>
                                    <th class="text-end table-width-data">Data</th>
                                    <th class="text-center table-width-status">Status</th>
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
                                        <td><?php echo htmlspecialchars($cliente); ?></td>
                                        <td class="text-end"><strong>R$ <?php echo $total; ?></strong></td>
                                        <td class="text-end"><small><?php echo $data; ?></small></td>
                                        <td class="text-center"><span class="badge-custom <?php echo $status_class; ?>"><?php echo $status; ?></span></td>
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

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-chart-line"></i> Faturamento (últimos meses)</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartFaturamento" height="80"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-warehouse"></i> Estoque Baixo</h5>
                </div>
                <div class="card-body">
                    <?php if(!empty($lowStock)) { ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($lowStock as $p) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?php echo htmlspecialchars($p->nome); ?></strong><br>
                                        <small class="text-muted">ID: #<?php echo $p->id; ?></small>
                                    </div>
                                    <span class="badge-custom bg-danger-light"><?php echo intval($p->estoque); ?> un.</span>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <div class="alert-empty">
                            <i class="fas fa-check-circle success-icon"></i>
                            <p>Todos os produtos com estoque adequado</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function(){
            const raw = <?php echo json_encode($faturamentoMes ?? []); ?>;
            const labels = [];
            const data = [];
            if(raw.length > 0) {
                raw.forEach(r => {
                    const parts = r.ym.split('-');
                    const year = parts[0];
                    const month = parts[1];
                    labels.push(month + '/' + year);
                    data.push(parseFloat(r.total));
                });
            }

            const ctx = document.getElementById('chartFaturamento').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Faturamento (R$)',
                        data: data,
                        borderColor: '#2c3e50',
                        backgroundColor: 'rgba(44, 62, 80, 0.08)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#3498db',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: { 
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'R$ ' + value.toLocaleString('pt-BR', {maximumFractionDigits: 0});
                                },
                                color: '#7f8c8d',
                                font: { size: 11, weight: 500 }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: '#7f8c8d',
                                font: { size: 11, weight: 500 }
                            }
                        }
                    },
                    plugins: {
                        legend: { 
                            display: true,
                            labels: {
                                font: { size: 12, weight: 600 },
                                color: '#2c3e50',
                                boxWidth: 12,
                                padding: 15
                            }
                        },
                        filler: {
                            propagate: true
                        }
                    }
                }
            });
        })();
    </script>

</div>
