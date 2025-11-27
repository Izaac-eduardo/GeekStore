<?php 
  class Usuario {
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function getUsuario($email) {

            $sql = "select * from usuario where email = :email limit 1";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":email", $email);
            $consulta->execute();
    return $consulta->fetch(PDO::FETCH_OBJ);
    }

   public function editar($id){
    $sql = "select * from usuario where id= :id limit 1";
    $consulta = $this->pdo->prepare($sql);  
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    return $consulta->fetch(PDO::FETCH_OBJ);
   }
public function salvar($dados){ 
        if (empty($dados["id"])) {
            // INSERT novo usuário
            $sql = "insert into usuario (nome, email, senha, telefone, ativo) values
            (:nome, :email, :senha, :telefone, :ativo)";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindValue(":nome", $dados["nome"]);
            $consulta->bindValue(":email", $dados["email"]);
            $consulta->bindValue(":senha", $dados["senha"]);
            $consulta->bindValue(":telefone", $dados["telefone"]);
            $consulta->bindValue(":ativo", $dados["ativo"]);
        } else if(empty($dados["senha"])) {
            // UPDATE usuário existente sem alterar a senha
            $sql = "update usuario set nome = :nome, email = :email, telefone = :telefone, ativo = :ativo where id = :id limit 1";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindValue(":nome", $dados["nome"]);
            $consulta->bindValue(":email", $dados["email"]);
            $consulta->bindValue(":telefone", $dados["telefone"]);
            $consulta->bindValue(":ativo", $dados["ativo"]);
            $consulta->bindValue(":id", $dados["id"]);
        } //update de senha
        else{
            $sql = "update usuario set nome = :nome, email = :email, telefone = :telefone, ativo = :ativo, senha = :senha where id = :id limit 1";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindValue(":nome", $dados["nome"]);
            $consulta->bindValue(":email", $dados["email"]);
            $consulta->bindValue(":telefone", $dados["telefone"]);
            $consulta->bindValue(":ativo", $dados["ativo"]);
            $consulta->bindValue(":id", $dados["id"]);
            $consulta->bindValue(":senha", $dados["senha"]);
        }
        return $consulta->execute() ? 1 : 0;
    }
        public function listar (){
            $sql = "select id, nome, telefone from usuario order by nome";
            $consulta = $this->pdo->prepare($sql);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }
         public function excluir ($id){
            $sql = "delete from usuario where id = :id limit 1";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":id", $id);
            return $consulta->execute();
        }
}
