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
$estoqueVal = $dados["estoque"] ?? 0;
if(empty($dados["id"])) {
$sql = "insert into produto (nome, categoria_id, descricao, valor, destaque, ativo, imagem, estoque) values
(:nome, :categoria_id, :descricao, :valor, :destaque, :ativo, :imagem, :estoque)";
$consulta = $this->pdo->prepare($sql);
$consulta->bindValue(":nome", $dados["nome"]);
$consulta->bindValue(":categoria_id", $dados["categoria_id"]);
$consulta->bindValue(":descricao", $dados["descricao"]);
$consulta->bindValue(":valor", $dados["valor"]);
$consulta->bindValue(":destaque", $dados["destaque"]);
$consulta->bindValue(":ativo", $dados["ativo"]);
$consulta->bindValue(":imagem", $dados["imagem"]);
    $consulta->bindValue(":estoque", $estoqueVal);

    } else {
        $sql = "Update produto set nome = :nome, categoria_id = :categoria_id, descricao = :descricao, valor = :valor, destaque = :destaque, ativo = :ativo, imagem = :imagem, estoque = :estoque
        where id = :id limit 1";
        $consulta = $this->pdo->prepare($sql);
$consulta->bindValue(":nome", $dados["nome"]);
$consulta->bindValue(":categoria_id", $dados["categoria_id"]);
$consulta->bindValue(":descricao", $dados["descricao"]);
$consulta->bindValue(":valor", $dados["valor"]);
$consulta->bindValue(":destaque", $dados["destaque"]);
$consulta->bindValue(":ativo", $dados["ativo"]);
$consulta->bindValue(":imagem", $dados["imagem"]);
        $consulta->bindValue(":estoque", $estoqueVal);
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
public function excluir($id) {
    $sql = "delete from produto where id = :id limit 1";
    $consulta = $this->pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    return $consulta->execute();
}}