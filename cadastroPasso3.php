<?php
include('funcoes.php');
session_start();

if (!isset($_SESSION['cadastro']) || !isset($_SESSION['cadastroPasso2'])) {
  header('Location: signupClient.html'); // Redireciona se o Passo 1 ou 2 não foi concluído
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //Recebe a informação do cadastro 3/3
  $_SESSION['cadastroPasso3'] = [

    'email' => $_POST["email"]
  ];

  //Verificação do email
  $verificarEmail = verificarEmail($_SESSION['cadastroPasso3']['email']);

  if ($verificarEmail === true) {
    header('Location: signupDataConfirmation.php');
    exit;
  } else {
    $_SESSION['erroEmail'] = true;
    header('Location: signupClienteP3.php');
    exit;
  }
}
