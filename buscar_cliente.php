<?php
require_once 'conexaoBd.php';

header('Content-Type: application/json');

require 'conexaoBd.php';

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT c.*, p.nome as plano_nome 
                             FROM clientes c
                             LEFT JOIN planos p ON c.idPlano = p.idPlano
                             WHERE c.idClientes = ?");
        $stmt->execute([$id]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($cliente) {
            // Padroniza o nome do campo para 'plano'
            $cliente['plano'] = $cliente['plano_nome'];
            unset($cliente['plano_nome']);
            echo json_encode($cliente);
        } else {
            echo json_encode(['error' => 'Cliente não encontrado']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID não fornecido']);
}
?>