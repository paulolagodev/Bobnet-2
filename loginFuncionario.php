<?php
session_start();
include('funcoes.php');
require("conexaobd.php");
$erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (!empty($cpf) && !empty($senha)) {
        //var_dump($user);

        $stmt = $pdo->prepare("SELECT  idFuncionario, cpf, nome, senha, cargo FROM funcionarios WHERE cpf = ?");
        $stmt->execute([$cpf]);
        $funcionario = $stmt->fetch();

        if ($funcionario && $senha === $funcionario['senha']) {
            $_SESSION = [
                'user_id' => $funcionario['idFuncionario'],
                'username' => $funcionario['nome'],
                'cargo' => $funcionario['cargo'],
                'logadoFuncionario' => true
            ];
            header('Location: areaFuncionario.php');
            exit;
        } else {
            $_SESSION['senhainvalida'] = true;
            header('Location: loginCadastroFuncionarios.php');
            exit;
        }
    }
}
