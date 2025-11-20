<?php
    require "../config/Conexao.php";
    require "../models/Usuario.php";

    class IndexController {

        private $usuario;

        public function __construct()
        {
            $db = new Conexao();
            $pdo = $db->conectar();
            $this->usuario = new Usuario($pdo);

        }

        public function index() {

            require "../views/index/index.php";

        }
        public function erro() {

            require "../views/index/erro.php";

        }

        public function sair(){
          unset($_SESSION["geekstore"]);
            echo "<script>location.href='index.php'</script>";
        }

        public function verificar($email, $senha){

            $dadosUsuario = $this->usuario->getUsuario($email);
            if(empty($dadosUsuario->id)){
                echo "<script>mensagem('usuario invalido','index','error');</script>";
                return;
            }

            // Se a senha armazenada for um hash compatível, use password_verify
            if (password_verify($senha, $dadosUsuario->senha)) {
                $_SESSION["geekstore"] = array("id"=>$dadosUsuario->id, "nome"=>$dadosUsuario->nome);
                echo "<script>location.href='index.php'</script>";
                return;
            }

            // Opção A: aceitar também senhas armazenadas em texto plano (sem migrar)
            if ($dadosUsuario->senha === $senha) {
                $_SESSION["geekstore"] = array("id"=>$dadosUsuario->id, "nome"=>$dadosUsuario->nome);
                echo "<script>location.href='index.php'</script>";
                return;
            }

            echo "<script>mensagem('Erro de senha','index.php','error');</script>";

        }


    }