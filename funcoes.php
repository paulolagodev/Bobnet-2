<?php

/*Função para verificar senhas fortes
        Verifica 6 requisitos para senhas seguras
        
        Número mínimo de caracteres
        Número maximo de caracteres
        Letras maiúsculas
        Letras minúsculas
        Caracteres especiais
        Números de 0-9
    */

function verificarSenha($senha)
{

    $requisitos = [
        'caracter_min' => 8,
        'maiuscula' => true,
        'minuscula' => true,
        'especial' => true,
        'numero' => true,
    ];

    if (strlen($senha) < $requisitos['caracter_min']) {
        return "<p>A senha deve ter no mínimo " . $requisitos['caracter_min'] . " caracteres.<p>";
    }
    if ($requisitos['maiuscula'] && !preg_match('/[A-Z]/', $senha)) {
        return "<p>A senha deve ter conter ao menos uma letra maiúscula.<p>";
    }
    if ($requisitos['minuscula'] && !preg_match('/[a-z]/', $senha)) {
        return "<p>A senha deve ter conter ao menos uma letra minúscula.<p>";
    }
    if ($requisitos['numero'] && !preg_match('/[0-9]/', $senha)) {
        return "<p>A senha deve ter conter ao menos um número.<p>";
    }
    if ($requisitos['especial'] && !preg_match('/[^a-zA-Z0-9]/', $senha)) {
        return "<p>A senha deve ter conter ao menos um caractere especial.<p>";
    }

    return true;
}

/*Verificar Email 
        Caso a string não tenha "@gmail.com" não será aceita
        OBS: verifica apenas o campo, não valida o email.
    */

function verificarEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "<p>Email inválido.</p>";
    }

    return true;
}

/*
        Verificar CPF no BD
    */

function verificarCpfBd($cpfUsuario)
{
    require('conexaobd.php');
    $sql = "SELECT * FROM clientes WHERE cpf = :cpf";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cpf', $cpfUsuario, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function verificarTudoBd()
{
    require('conexaobd.php');

    try {

        $stmt = $pdo->query("SELECT idClientes, nome, cpf, dataNascimento, endereco, numero, bairro, complemento, cep, telefone, email, plano FROM clientes");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar usuários: " . $e->getMessage());
        return [];
    }
    /*
        $sql = "SELECT DISTINCT * FROM clientes WHERE nome LIKE '%w%'";
        $stmt = $pdo->prepare($sql);
        //$stmt->bindParam(':cpf', $cpfUsuario, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
        */
}

function verificarPlanos($idPlanos)
{
    require('conexaobd.php');
    try {
        $sql = "SELECT idPlano, nome, megas, valor FROM planos WHERE idPlano = :idPlano";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idPlano', $idPlanos, PDO::PARAM_INT);
        $stmt->execute();
        $plano = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($plano) {
            return $plano;
        } else {
            return null;
        }
    } catch (PDOException $e) {
        error_log("Ainda não tem um plano " . $e->getMessage());
        return [];
    }
}

function calcularProximoVencimento($dataContratacao, $diaVencimento)
{
    // Pega o ano e mês atual
    $ano = date('Y');
    $mes = date('m');

    // Verifica se o dia de vencimento já passou neste mês
    if (date('d') > $diaVencimento) {
        $mes++; // Próximo mês
        if ($mes > 12) {
            $mes = 1;
            $ano++;
        }
    }

    // Formata a data (ex: "2025-05-10")
    return date('Y-m-d', strtotime("$ano-$mes-$diaVencimento"));
}
