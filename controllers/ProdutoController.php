<?php 
require "../config/Conexao.php";
require "../MODELS/Produto.php";
class ProdutoController {

    private $produto;

    public function __construct()
    {
        $db = new Conexao();
        $pdo = $db->conectar();
        $this->produto = new Produto($pdo);

    }

 public function index($id) {
require "../views/produto/index.php";
     

 }
 public function salvar() {
require "../views/produto/salvar.php";
}

public function excluir($id) {
require "../views/produto/excluir.php";

}

public function listar() {
require "../views/produto/listar.php";
}
}