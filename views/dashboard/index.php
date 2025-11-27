<link rel="stylesheet" href="css/dashboard.css">

<div class="container-fluid dashboard-container">
   

    <!-- KPI Cards - Stats -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card stat-card stat-card-blue">
                <div class="card-body">
                    <div class="stat-header">
                        <div class="icon"><i class="fas fa-box"></i></div>
                        <h6 class="card-title">PRODUTOS</h6>
                    </div>
                    <p class="stat-number"><?php echo intval($totalProdutos); ?></p>
                    <small class="stat-trend"><i class="fas fa-arrow-up"></i> Ativos no estoque</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card stat-card stat-card-green">
                <div class="card-body">
                    <div class="stat-header">
                        <div class="icon"><i class="fas fa-layer-group"></i></div>
                        <h6 class="card-title">CATEGORIAS</h6>
                    </div>
                    <p class="stat-number"><?php echo intval($totalCategorias); ?></p>
                    <small class="stat-trend"><i class="fas fa-arrow-up"></i> Produtos organizados</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card stat-card stat-card-orange">
                <div class="card-body">
                    <div class="stat-header">
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <h6 class="card-title">USUÁRIOS</h6>
                    </div>
                    <p class="stat-number"><?php echo intval($totalUsuarios); ?></p>
                    <small class="stat-trend"><i class="fas fa-arrow-up"></i> Administradores</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card stat-card stat-card-purple">
                <div class="card-body">
                    <div class="stat-header">
                        <div class="icon"><i class="fas fa-shopping-bag"></i></div>
                        <h6 class="card-title">PEDIDOS</h6>
                    </div>
                    <p class="stat-number"><?php echo intval($totalPedidos ?? 0); ?></p>
                    <small class="stat-trend"><i class="fas fa-arrow-up"></i> Total de vendas</small>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-3 mb-4">
        <div class="col-lg-4">
            <div class="card h-100 faturamento-card">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <div class="faturamento-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="faturamento-valor">
                        R$ <?php echo number_format(floatval($totalFaturamento ?? 0), 2, ',', '.'); ?>
                    </div>
                    <p class="faturamento-texto">FATURAMENTO TOTAL</p>
                    <div class="sparkline">
                        <div class="spark-bar" style="height: 40%;"></div>
                        <div class="spark-bar" style="height: 60%;"></div>
                        <div class="spark-bar" style="height: 45%;"></div>
                        <div class="spark-bar" style="height: 80%;"></div>
                        <div class="spark-bar" style="height: 65%;"></div>
                        <div class="spark-bar" style="height: 90%;"></div>
                        <div class="spark-bar active" style="height: 75%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100 ticket-medio-card">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <div class="ticket-icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="ticket-valor">
                        R$ <?php 
                            $ticketMedio = ($totalPedidos > 0) ? floatval($totalFaturamento ?? 0) / intval($totalPedidos) : 0;
                            echo number_format($ticketMedio, 2, ',', '.'); 
                        ?>
                    </div>
                    <p class="ticket-texto">TICKET MÉDIO</p>
                    <div class="ticket-gauge">
                        <div class="gauge-fill" style="width: 68%;"></div>
                    </div>
                    <small class="gauge-label"><?php echo intval($totalPedidos ?? 0); ?> pedidos realizados</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="fas fa-history"></i> PEDIDOS RECENTES</h5>
                </div>
                <div class="card-body p-0">
                    <div class="timeline-orders">
                        <?php if(!empty($recentOrders)) {
                            $count = 0;
                            foreach($recentOrders as $r) {
                                if($count >= 4) break;
                                $total = isset($r->total) ? number_format($r->total, 2, ',', '.') : '0,00';
                                $cliente = isset($r->cliente_nome) ? $r->cliente_nome : ('Cliente '.$r->id);
                        ?>
                            <div class="timeline-order-item">
                                <div class="order-marker"></div>
                                <div class="order-content">
                                    <span class="order-id">#<?php echo $r->id; ?></span>
                                    <span class="order-cliente"><?php echo htmlspecialchars(substr($cliente, 0, 15)); ?></span>
                                </div>
                                <div class="order-value">R$ <?php echo $total; ?></div>
                            </div>
                        <?php $count++; }
                        } else { ?>
                            <div class="alert-empty m-3">
                                <i class="fas fa-inbox"></i>
                                <p>Nenhum pedido</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Insights: Top Produtos, Categorias, Estoque Baixo -->
    <div class="row g-3">
        <div class="col-lg-4">
            <div class="card h-100 insight-card">
                <div class="card-header">
                    <h5><i class="fas fa-fire"></i> TOP PRODUTOS</h5>
                    <span class="insight-badge">Mais vendidos</span>
                </div>
                <div class="card-body">
                    <?php if(!empty($topProdutos)) { ?>
                        <ul class="list-group list-group-flush list-scroll">
                            <?php $rank = 1; foreach($topProdutos as $p) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="product-rank">
                                        <span class="rank-number">0<?php echo $rank; ?></span>
                                        <strong><?php echo htmlspecialchars(substr($p->nome, 0, 18)); ?></strong>
                                    </div>
                                    <span class="badge-custom bg-success-light"><?php echo intval($p->quantidade_vendida); ?></span>
                                </li>
                            <?php $rank++; } ?>
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
            <div class="card h-100 insight-card">
                <div class="card-header">
                    <h5><i class="fas fa-crown"></i> CATEGORIAS POPULARES</h5>
                    <span class="insight-badge">Mais pedidos</span>
                </div>
                <div class="card-body">
                    <?php if(!empty($topCategorias)) { ?>
                        <ul class="list-group list-group-flush list-scroll">
                            <?php $rank = 1; foreach($topCategorias as $c) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="product-rank">
                                        <span class="rank-number">0<?php echo $rank; ?></span>
                                        <strong><?php echo htmlspecialchars(substr($c->nome, 0, 18)); ?></strong>
                                    </div>
                                    <span class="badge-custom bg-info-light"><?php echo intval($c->total_pedidos); ?></span>
                                </li>
                            <?php $rank++; } ?>
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
            <div class="card h-100 stock-alert-card">
                <div class="card-header stock-alert-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="header-text">
                            <h5>ESTOQUE BAIXO</h5>
                            <span class="subtitle"><?php echo count($lowStock ?? []); ?> produtos precisam de atenção</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if(!empty($lowStock)) { ?>
                        <div class="stock-list">
                            <?php foreach($lowStock as $p) { 
                                $stockPercent = min(($p->estoque / 10) * 100, 100);
                                $stockClass = $p->estoque <= 3 ? 'critical' : ($p->estoque <= 5 ? 'warning' : 'low');
                            ?>
                                <div class="stock-item <?php echo $stockClass; ?>">
                                    <div class="stock-info">
                                        <span class="stock-name"><?php echo htmlspecialchars(substr($p->nome, 0, 22)); ?></span>
                                        <div class="stock-bar">
                                            <div class="stock-bar-fill" style="width: <?php echo $stockPercent; ?>%;"></div>
                                        </div>
                                    </div>
                                    <div class="stock-qty">
                                        <span class="qty-number"><?php echo intval($p->estoque); ?></span>
                                        <span class="qty-label">un.</span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="stock-ok">
                            <div class="ok-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h6>Tudo certo!</h6>
                            <p>Todos os produtos estão com estoque adequado</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>
