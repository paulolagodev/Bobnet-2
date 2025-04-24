<?php
session_start();

if (!isset($_SESSION['cadastro'])) {
  header('Location: signupClient.html'); // Redireciona se o Passo 1 não foi concluído
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //Recebe a informação do cadastro 3/3
  $_SESSION['cadastroPasso2'] = [
    'telefone' => $_POST["telefone"],
    'endereco' => $_POST["endereco"],
    'numero' => $_POST["numero"],
    'bairro' => $_POST["bairro"],
    'complemento' => $_POST["complemento"],
    'cep' => $_POST["cep"]
  ];

  //Redireciona para passo 3
  header('Location: signupClienteP3.php');
  exit;
}
