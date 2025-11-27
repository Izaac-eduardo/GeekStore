<?php
class Pedido {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Retorna pedidos recentes com total calculado a partir da tabela item
    public function listarRecentes($limit = 5) {
        $sql = "SELECT p.id, c.nome AS cliente_nome, p.data, IFNULL(SUM(i.qtde * i.valor),0) AS total
                FROM pedido p
                LEFT JOIN cliente c ON p.cliente_id = c.id
                LEFT JOIN item i ON i.pedido_id = p.id
                GROUP BY p.id, c.nome, p.data
                ORDER BY p.data DESC
                LIMIT :limit";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    // Soma todos os itens de todos os pedidos
    public function totalFaturamento() {
        $sql = "SELECT IFNULL(SUM(i.qtde * i.valor),0) AS total
                FROM item i";
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_OBJ)->total ?? 0;
    }

    // Conta pedidos
    public function contar() {
        $sql = "SELECT COUNT(*) AS total FROM pedido";
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_OBJ)->total ?? 0;
    }

    // Produtos mais vendidos (top N)
    public function topProdutos($limit = 5) {
        $sql = "SELECT p.id, p.nome, SUM(i.qtde) AS quantidade_vendida
                FROM produto p
                LEFT JOIN item i ON i.produto_id = p.id
                GROUP BY p.id, p.nome
                ORDER BY quantidade_vendida DESC
                LIMIT :limit";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    // Categorias com melhor desempenho (mais pedidos)
    public function topCategorias($limit = 5) {
        $sql = "SELECT c.id, c.descricao AS nome, COUNT(DISTINCT p.id) AS total_pedidos, SUM(i.qtde) AS quantidade_vendida
                FROM categoria c
                LEFT JOIN produto pr ON pr.categoria_id = c.id
                LEFT JOIN item i ON i.produto_id = pr.id
                LEFT JOIN pedido p ON p.id = i.pedido_id
                WHERE p.id IS NOT NULL
                GROUP BY c.id, c.descricao
                ORDER BY total_pedidos DESC
                LIMIT :limit";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    // Calcula o ticket médio (valor médio por pedido)
    public function ticketMedio() {
        $totalPedidos = $this->contar();
        if ($totalPedidos == 0) {
            return 0;
        }
        $totalFaturamento = $this->totalFaturamento();
        return $totalFaturamento / $totalPedidos;
    }

    }


