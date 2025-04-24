<?php

require('conexaobd.php');
session_start();

if (!isset($_SESSION['cadastro']) || !isset($_SESSION['cadastroPasso2']) || !isset($_SESSION['cadastroPasso3'])) {
    header('Location: signupCliente.php'); //Retorna para o inicio do cadastro
    exit;
}

$dados = array_merge($_SESSION['cadastro'], $_SESSION['cadastroPasso2'], $_SESSION['cadastroPasso3']);

$query = "INSERT INTO clientes(nome, cpf, dataNascimento, senha, telefone, endereco, numero, bairro, complemento, cep, email) 
              VALUES (:nome, :cpf, :nascimento, :senha, :telefone, :endereco, :numero, :bairro, :complemento, :cep, :email)";

$stmt = $pdo->prepare($query);
$stmt->execute([
    ':nome' => $_SESSION['cadastro']['nome'],
    ':cpf' => $_SESSION['cadastro']['cpf'],
    ':nascimento' => $_SESSION['cadastro']['nascimento'],
    ':senha' => $_SESSION['cadastro']['senha'],
    ':telefone' => $_SESSION['cadastroPasso2']['telefone'],
    ':endereco' => $_SESSION['cadastroPasso2']['endereco'],
    ':numero' => $_SESSION['cadastroPasso2']['numero'],
    ':bairro' => $_SESSION['cadastroPasso2']['bairro'],
    ':complemento' => $_SESSION['cadastroPasso2']['complemento'],
    ':cep' => $_SESSION['cadastroPasso2']['cep'],
    ':email' => $_SESSION['cadastroPasso3']['email']
]);

header('Location: loginCliente.php');
//}

$pdo = null;
//session_destroy();
exit;
