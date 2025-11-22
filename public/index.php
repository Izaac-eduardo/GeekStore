<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de controle Geek Store</title>
    <base href="http://<?= $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" htef="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.inputmask.min.js"></script>
    <script src="js/jquery.maskedinput-1.2.1.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script src="js/parsley.min.js"></script>
    <script>
        mostrarSenha = function() {
            const campo = document.getElementById('senha');
            if(campo.type == 'password') {
                campo.type = 'text';
            } else {
                campo.type = 'password';
            }
        }
        //msg de erro
        mensagem = function(msg, url, icone) {
            Swal.fire({
                title: msg,
                icon: icone,
                confirmButtonText: "OK",
            }).then((result) => {
               
                   location.href = url;
                
            }
        );

        }
             excluir = function(id, tabela) {
            Swal.fire({
                icon: "question",
                title: "Deseja realmente excluir este registro?",
                showCancelButton: true,
                confirmButtonText: "Excluir",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = tabela + "/excluir/" + id;
                }
            });
        }


    </script>
</head> 
<body>
   <?php
     if((!isset($_SESSION["geekstore"])) && (!$_POST)) {
             require "../views/index/login.php"; } else if((!isset($_SESSION["geekstore"])) && ($_POST)) {
                    $email = trim($_POST["email"] ?? null);
                    $senha = trim($_POST["senha"] ?? null);
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL))  {
                            echo "<script>mensagem('E-mail inválido!', 'index.php', 'error');</script>";

                    } else if (empty($senha)) {
                        echo "<script>mensagem('Digite a senha', 'index.php', 'error');</script>";
                    } else {
                        require "../controllers/IndexController.php";
                        $acao = new IndexController();
                        $acao->verificar($email, $senha);
                    }
             } else {
?>
      <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index">
                    <img src="images/geeklogo.jpeg" alt="Geek Store" class="img-fluid" style="max-width: 100px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="index">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categoria">Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produto">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="usuario">Usuários</a>
                        </li>

                    </ul>
                    <div class="d-flex"  role="search">
                        <p class="mt-4">Bem Vindo! <?php echo $_SESSION["geekstore"]["nome" ]; ?></p>
                        <a href="index/sair" class="btn btn-danger m-3 p-2"> 
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            Sair</a>
                    </div> </nav>
<main>
    <?php 
        $param = array_values(array_filter(array_map('trim', explode('/', $_GET['param'] ?? '')), 'strlen'));
    $controller = $param[0] ?? 'index';
    $acao = $param[1] ?? 'index';
    $id = $param[2] ?? null;
  $controller = ucfirst($controller) ."Controller";
  if(file_exists("../controllers/{$controller}.php")) {require "../controllers/{$controller}.php";
    $control = new $controller();
  $control->$acao($id);
} else {
    require "../views/index/erro.php";
}
  
  
  
    ?>
</main>
<?php 
       }
    ?>

</body>
</html>