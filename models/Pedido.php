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

    // Faturamento por mês para os últimos N meses
    public function faturamentoPorMes($months = 6) {
        $sql = "SELECT DATE_FORMAT(p.data, '%Y-%m') AS ym, IFNULL(SUM(i.qtde * i.valor),0) AS total
                FROM pedido p
                LEFT JOIN item i ON i.pedido_id = p.id
                WHERE p.data >= DATE_SUB(CURDATE(), INTERVAL :months MONTH)
                GROUP BY ym
                ORDER BY ym ASC";

        $consulta = $this->pdo->prepare($sql);
        $consulta->bindValue(':months', (int)$months, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }
}
