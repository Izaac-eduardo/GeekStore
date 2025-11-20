<?php
if (empty($id)) {
    echo "<script>mensagem('Registro inválido', 'categoria', 'error')</script>";
} else {
    $msg = $this->categoria->excluir($id);
    if ($msg) {
        echo "<script>mensagem('Registro excluído com sucesso', 'categoria', 'success')</script>";
    } else {
        echo "<script>mensagem('Erro ao excluir o registro', 'categoria', 'error')</script>";
    }
}
?>