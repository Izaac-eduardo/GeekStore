<?php
    require "../config/Conexao.php";
    require "../models/Pedido.php";

    class DashboardController {

        private $pdo;

        public function __construct()
        {
            $db = new Conexao();
            $this->pdo = $db->conectar();

        }

        public function index() {

            // Totais básicos para produtos/categorias/usuarios
            try {
                $sql = "select count(*) as total from produto";
                $consulta = $this->pdo->prepare($sql);
                $consulta->execute();
                $totalProdutos = $consulta->fetch(PDO::FETCH_OBJ)->total ?? 0;
            } catch (Exception $e) {
                $totalProdutos = 0;
            }

            try {
                $sql = "select count(*) as total from categoria";
                $consulta = $this->pdo->prepare($sql);
                $consulta->execute();
                $totalCategorias = $consulta->fetch(PDO::FETCH_OBJ)->total ?? 0;
            } catch (Exception $e) {
                $totalCategorias = 0;
            }

            try {
                $sql = "select count(*) as total from usuario";
                $consulta = $this->pdo->prepare($sql);
                $consulta->execute();
                $totalUsuarios = $consulta->fetch(PDO::FETCH_OBJ)->total ?? 0;
            } catch (Exception $e) {
                $totalUsuarios = 0;
            }

            // Métricas relacionadas a pedidos usando model Pedido
            $pedidoModel = new Pedido($this->pdo);
            try {
                $totalPedidos = $pedidoModel->contar();
            } catch (Exception $e) {
                $totalPedidos = 0;
            }

            try {
                $totalFaturamento = $pedidoModel->totalFaturamento();
            } catch (Exception $e) {
                $totalFaturamento = 0;
            }

            try {
                $recentOrders = $pedidoModel->listarRecentes(5);
            } catch (Exception $e) {
                $recentOrders = [];
            }

            // Produtos mais vendidos (top 5)
            try {
                $sql = "SELECT p.id, p.nome, SUM(i.qtde) AS quantidade_vendida
                        FROM produto p
                        LEFT JOIN item i ON i.produto_id = p.id
                        GROUP BY p.id, p.nome
                        ORDER BY quantidade_vendida DESC
                        LIMIT 5";
                $consulta = $this->pdo->prepare($sql);
                $consulta->execute();
                $topProdutos = $consulta->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                $topProdutos = [];
            }

            // Categorias com maior número de pedidos
            try {
                $sql = "SELECT c.id, c.nome, COUNT(DISTINCT p.id) AS total_pedidos
                        FROM categoria c
                        LEFT JOIN produto pr ON pr.categoria_id = c.id
                        LEFT JOIN item i ON i.produto_id = pr.id
                        LEFT JOIN pedido p ON p.id = i.pedido_id
                        GROUP BY c.id, c.nome
                        ORDER BY total_pedidos DESC
                        LIMIT 5";
                $consulta = $this->pdo->prepare($sql);
                $consulta->execute();
                $topCategorias = $consulta->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                $topCategorias = [];
            }

            // Produtos com estoque baixo
            try {
                $sql = "SELECT id, nome, estoque FROM produto WHERE estoque <= 5 ORDER BY estoque ASC LIMIT 5";
                $consulta = $this->pdo->prepare($sql);
                $consulta->execute();
                $lowStock = $consulta->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                $lowStock = [];
            }

            require "../views/dashboard/index.php";

        }

    }
