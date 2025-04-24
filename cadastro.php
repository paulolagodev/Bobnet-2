<!-- Cadastro Passo 1 -->
<?php
session_start();
include 'funcoes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //Recebe a informação do cadastro 1/3
  $_SESSION['cadastro'] = [
    'nome' => $_POST["nome"],
    'cpf' => $_POST["cpf"],
    'nascimento' => $_POST["nascimento"],
    'senha' => $_POST["senha"]
  ];


  $verificarSenha = verificarSenha($_SESSION['cadastro']['senha']);

  if ($verificarSenha === true) {
    //Redireciona para passo 2
    header('Location: signupClienteP2.html');
    exit;
  } else {
    $_SESSION['senhainvalida'] = $verificarSenha;
    header('Location: signupCliente.php');
    exit;
  }
}
?>