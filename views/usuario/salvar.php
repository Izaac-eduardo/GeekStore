<?php 
if($_POST) {
    $nome = $_POST["nome"] ?? NULL;
    $email = $_POST["email"] ?? NULL;
    $senha = $_POST["senha"] ?? NULL;
    $id = $_POST["id"] ?? NULL;
    $telefone = $_POST["telefone"] ?? NULL;
    $redigite = $_POST["redigite"] ?? NULL;
    $ativo = $_POST["ativo"] ?? NULL;
    if(empty($nome)) {
        echo "<script>mensagem('Digite o nome do usuário!', 'usuario', 'error');</script>";
    } else if($senha != $redigite) {
         echo "<script>mensagem('As senha não são iguais!', 'usuario', 'error');</script>";
    } else if ((empty($id) && (empty($senha)))){
        echo "<script>mensagem('Preencha a senha!', 'usuario', 'error');</script>";
     }
     if(!empty($senha)) {
         $hash = password_hash($senha, PASSWORD_BCRYPT);
         $_POST["senha"] = password_hash($senha, PASSWORD_BCRYPT);
     }
     $msg = $this->usuario->salvar($_POST);
      if ($msg == 1) {
          echo "<script>mensagem('Registro salvo com sucesso!', 'usuario', 'success');</script>";
      } else {
          echo "<script>mensagem('Erro ao salvar dados!', 'usuario', 'error');</script>";
      }
}else {
    echo "<script>mensagem('Erro ao salvar dados!', 'usuario', 'error')</script>";
}