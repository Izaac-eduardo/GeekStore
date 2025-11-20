<?php
class Categoria {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function editar($id) {
        $sql = "SELECT * FROM categoria WHERE id = :id LIMIT 1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_OBJ);
    }

    public function salvar($dados) {
        if (empty($dados["id"])) {
            $sql = "INSERT INTO categoria (descricao, ativo) VALUES (:descricao, :ativo)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindValue(":descricao", $dados["descricao"]);
            $consulta->bindValue(":ativo", $dados["ativo"]);
        } else {
            $sql = "UPDATE categoria SET descricao = :descricao, ativo = :ativo WHERE id = :id LIMIT 1";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindValue(":descricao", $dados["descricao"]);
            $consulta->bindValue(":ativo", $dados["ativo"]);
            $consulta->bindValue(":id", $dados["id"]);
        }

        return $consulta->execute();
    }

    public function listar() {
        $sql = "SELECT * FROM categoria ORDER BY descricao";
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    public function excluir($id) {
        $sql = "DELETE FROM categoria WHERE id = :id LIMIT 1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        return $consulta->execute();
    }
}