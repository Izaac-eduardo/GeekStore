<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Dashboard</h1>
            <p class="text-muted">Visão geral rápida do sistema</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                    <p class="card-text display-6"><?php echo intval($totalProdutos); ?></p>
                </div>
                <div class="card-footer">
                    <a href="produto" class="btn btn-light btn-sm">Ver produtos</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Categorias</h5>
                    <p class="card-text display-6"><?php echo intval($totalCategorias); ?></p>
                </div>
                <div class="card-footer">
                    <a href="categoria" class="btn btn-light btn-sm">Ver categorias</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title">Usuários</h5>
                    <p class="card-text display-6"><?php echo intval($totalUsuarios); ?></p>
                </div>
                <div class="card-footer">
                    <a href="usuario" class="btn btn-light btn-sm">Ver usuários</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Pedidos</h5>
                    <p class="card-text display-6"><?php echo intval($totalPedidos ?? 0); ?></p>
                </div>
                <div class="card-footer">
                    <a href="pedido" class="btn btn-light btn-sm">Ver pedidos</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Faturamento</h5>
                    <p class="card-text display-6 text-success">R$ <?php echo number_format(floatval($totalFaturamento ?? 0), 2, ',', '.'); ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Valor total (exclui pedidos cancelados quando aplicável)</small>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Recentes</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th class="text-end">Total</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($recentOrders)) {
                                    foreach($recentOrders as $r) {
                                        $data = isset($r->data) && $r->data ? date('d/m/Y H:i', strtotime($r->data)) : '-';
                                        $total = isset($r->total) ? number_format($r->total, 2, ',', '.') : '0,00';
                                        $cliente = isset($r->cliente_nome) ? $r->cliente_nome : ('Pedido '.$r->id);
                                ?>
                                    <tr>
                                        <td><?php echo $r->id; ?></td>
                                        <td><?php echo htmlspecialchars($cliente); ?></td>
                                        <td class="text-end">R$ <?php echo $total; ?></td>
                                        <td><?php echo $data; ?></td>
                                        <td><?php echo htmlspecialchars($r->status ?? '-'); ?></td>
                                    </tr>
                                <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="5">Sem pedidos registrados</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-8 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Faturamento (últimos meses)</h5>
                    <canvas id="chartFaturamento" height="120"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Produtos com estoque baixo</h5>
                    <?php if(!empty($lowStock)) { ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($lowStock as $p) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo htmlspecialchars($p->nome); ?>
                                    <span class="badge bg-danger rounded-pill"><?php echo intval($p->estoque); ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p class="text-muted">Nenhum produto com estoque baixo.</p>
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
            // Preencher meses consecutivos (garantir sequência mesmo se alguns meses não tiverem vendas)
            if(raw.length > 0) {
                raw.forEach(r => {
                    // r.ym no formato YYYY-MM
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
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.2,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    },
                    plugins: {
                        legend: { display: true }
                    }
                }
            });
        })();
    </script>

</div>
