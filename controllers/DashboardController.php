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

            // Faturamento por mês (para gráfico)
            try {
                $faturamentoMes = $pedidoModel->faturamentoPorMes(6);
            } catch (Exception $e) {
                $faturamentoMes = [];
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
