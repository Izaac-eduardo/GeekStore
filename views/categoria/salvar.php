<?php 
$id = $_POST["id"] ?? NULL;
$descricao = trim($_POST["descricao"] ?? NULL);
$ativo = $_POST["ativo"] ?? NULL;


if (empty($descricao) || empty($ativo)) {
    echo "<script>alert('Preencha todos os campos obrigatórios');window.history.back();</script>";
    exit;
}

$msg = $this->categoria->salvar($_POST);
if ($msg) {
    echo "<script>mensagem('Sucesso ao salvar dados', 'categoria/listar', 'success')</script>";
} else {
    echo "<script>mensagem('Erro ao salvar dados', 'categoria', 'error')</script>";
}