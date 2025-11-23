<?php class Produto {
    private $pdo;
    public function __construct( $pdo) {
        $this->pdo = $pdo;
    }
    public function editar($id) {
$sql = "select * from produto where id = :id limit 1";
$consulta = $this->pdo->prepare($sql);  
$consulta->bindParam(":id", $id);
$consulta->execute();

return $consulta->fetch(PDO::FETCH_OBJ);


    }
     public function listarCategoria() {
        $sql = "select * from categoria order by descricao";
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }
    public function salvar($dados) {
$estoque = $dados["estoque"] ?? 0;
if(empty($dados["id"])) {
$sql = "insert into produto (nome, categoria_id, descricao, valor, estoque, destaque, ativo, imagem) values
(:nome, :categoria_id, :descricao, :valor, :estoque, :destaque, :ativo, :imagem)";
$consulta = $this->pdo->prepare($sql);
$consulta->bindValue(":nome", $dados["nome"]);
$consulta->bindValue(":categoria_id", $dados["categoria_id"]);
$consulta->bindValue(":descricao", $dados["descricao"]);
$consulta->bindValue(":valor", $dados["valor"]);
$consulta->bindValue(":estoque", $estoque, PDO::PARAM_INT);
$consulta->bindValue(":destaque", $dados["destaque"]);
$consulta->bindValue(":ativo", $dados["ativo"]);
$consulta->bindValue(":imagem", $dados["imagem"]);

    } else {
        $sql = "Update produto set nome = :nome, categoria_id = :categoria_id, descricao = :descricao, valor = :valor, estoque = :estoque, destaque = :destaque, ativo = :ativo, imagem = :imagem
        where id = :id limit 1";
        $consulta = $this->pdo->prepare($sql);
$consulta->bindValue(":nome", $dados["nome"]);
$consulta->bindValue(":categoria_id", $dados["categoria_id"]);
$consulta->bindValue(":descricao", $dados["descricao"]);
$consulta->bindValue(":valor", $dados["valor"]);
        $consulta->bindValue(":estoque", $estoque, PDO::PARAM_INT);
$consulta->bindValue(":destaque", $dados["destaque"]);
$consulta->bindValue(":ativo", $dados["ativo"]);
$consulta->bindValue(":imagem", $dados["imagem"]);
$consulta->bindValue(":id", $dados["id"]);
        
}
return $consulta->execute();
}
public function listar() {
    $sql = "select * from produto order by nome";
    $consulta = $this->pdo->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_OBJ);
}
}