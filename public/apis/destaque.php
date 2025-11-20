<?php 
header("Content-Type: application/json");

$id = $_GET["id"] ?? NULL;

require "../../config/Conexao.php";
$db = new Conexao();
$pdo = $db->conectar();

// GET: retorna produtos em destaque (destaque = 'S')
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($id)) {
        $sql = "select * from produto where ativo = 'S' and destaque = 'S' and id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_ASSOC);
    } else {
        $sql = "select * from produto where ativo = 'S' and destaque = 'S' order by nome";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    echo json_encode($dados);
    exit;
}

// POST: atualiza flag destaque (S/N) para um produto (administrativo)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $destaque = $_POST['destaque'] ?? null; // 'S' or 'N'

    if (empty($id) || !in_array($destaque, ['S','N'])) {
        echo json_encode(['success' => false, 'message' => 'Parâmetros inválidos.']);
        exit;
    }

    $sql = "update produto set destaque = :destaque where id = :id";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(':destaque', $destaque);
    $consulta->bindParam(':id', $id);
    $ok = $consulta->execute();

    if ($ok) {
        echo json_encode(['success' => true, 'message' => 'Destaque atualizado com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar destaque.']);
    }
    exit;
}

// Outros métodos não suportados
http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método não suportado']);

?>