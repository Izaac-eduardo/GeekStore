<?php 
if(empty($id)) {
    echo"<script>mensagem('Registro inválido', 'produto', 'error')</script>";
} else {
    $msg = $this->produto->excluir($id);
    if ($msg == 1) {
        echo"<script>mensagem('Registro excluído com sucesso', 'produto', 'success')</script>";
        
    } else {
        echo"<script>mensagem('Erro ao excluir o registro', 'produto', 'error')</script>";
    }
}
?>