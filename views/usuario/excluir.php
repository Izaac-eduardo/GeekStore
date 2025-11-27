<?php
if (empty($id)) {
    echo "<script>mensagem('Registro inválido', 'usuario', 'error')</script>";
} else {
    $msg = $this->usuario->excluir($id);
    if ($msg) {
        echo "<script>mensagem('Registro excluído com sucesso', 'usuario', 'success')</script>";
    } else {
        echo "<script>mensagem('Erro ao excluir o registro', 'usuario', 'error')</script>";
    }
}
?>
