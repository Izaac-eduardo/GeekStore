<?php 
$id = $_POST["id"] ?? NULL;
$nome = trim($_POST["nome"] ?? NULL);
$categoria_id = $_POST["categoria_id"] ?? NULL;
$descricao = trim($_POST["descricao"] ?? NULL);
$valor = trim($_POST["valor"] ?? NULL);
$ativo = $_POST["ativo"] ?? NULL;
$destaque = $_POST["destaque"] ?? NULL;

$valor = str_replace(".", "", $valor);
$_POST["valor"] = str_replace(",", ".", $valor);

$estoque = $_POST["estoque"] ?? 0;
// garantir inteiro
$estoque = intval(str_replace([".",","], ["",""], $estoque));
$_POST["estoque"] = $estoque;

if(empty($nome) || empty($categoria_id) || empty($descricao) || empty($valor) || empty($ativo) || empty($destaque)) {
    echo "<script>alert('Preencha todos os campos obrigatórios');window.history.back();</script>";
    exit;
}
//$imagem = $_POST["imagem"] ?? time().".jpg";
//$_POST["imagem"] = $imagem;
$imagem = NULL;
if(!empty($_FILES["imagem"]["name"])) {
    $imagem = time().".jpg";
    $_POST["imagem"] = $imagem;
}
$_POST["estoque"] = $estoque;
$msg = $this->produto->salvar($_POST);
if($msg) {
    if(!empty($imagem)) {
        $arquivoDestino = "arquivos/{$imagem}";
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $arquivoDestino);
    }
    echo "<script>mensagem('Sucesso ao salvar dados', 'produto/listar', 'success')</script>";
} else {
    echo "<script>mensagem('Erro ao salvar dados', 'produto', 'error')</script>";
}