<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['logadoFuncionario']) || $_SESSION['logadoFuncionario'] !== true) {
    header('Location: loginCadastroFuncionarios.php');
    exit;
}

// Processar adição/edição de cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome']) && isset($_POST['cpf'])) {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Editar cliente existente
            $id = $_POST['id'];
            $stmt = $pdo->prepare("UPDATE clientes SET nome = ?, cpf = ? WHERE id = ?");
            $stmt->execute([$nome, $cpf, $id]);
        } else {
            // Adicionar novo cliente
            $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf) VALUES (?, ?)");
            $stmt->execute([$nome, $cpf]);
        }
        
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Processar exclusão de cliente
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Buscar todos os clientes
$stmt = $pdo->query("SELECT * FROM clientes");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Clientes</title>
    <style>
        /* Seu CSS existente permanece o mesmo */
    </style>
</head>
<body>
    <form class="col col-1" action="index.php">
        <div>
            <button class="btn btn-2" type="submit" id="login">Início</button>
        </div><br>
    </form>
    <div class="botoes">
        <a href="logoutFuncionario.php">
            <button class="btn btn-2">sair</button>
        </a>
    </div>
    <h1>Controle de Clientes</h1>

    <div class="form">
        <form method="POST" id="formCliente">
            <input type="hidden" id="id" name="id" value="">
            <input type="text" id="nome" name="nome" placeholder="Nome do cliente">
            <input type="text" id="cpf" name="cpf" placeholder="CPF">
            <button type="submit">Salvar</button>
        </form>
    </div>

    <table id="tabela">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="lista">
            <?php foreach ($clientes as $cliente): ?>
                <tr data-id="<?= $cliente['id'] ?>">
                    <td><?= htmlspecialchars($cliente['nome']) ?></td>
                    <td><?= htmlspecialchars($cliente['cpf']) ?></td>
                    <td>
                        <button class="btn edit" onclick="editarCliente(this)">Editar</button>
                        <a href="?delete=<?= $cliente['id'] ?>" class="btn delete" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function editarCliente(botao) {
            const linha = botao.closest('tr');
            const id = linha.dataset.id;
            const nome = linha.cells[0].textContent;
            const cpf = linha.cells[1].textContent;
            
            document.getElementById('id').value = id;
            document.getElementById('nome').value = nome;
            document.getElementById('cpf').value = cpf;
            
            // Rolando até o formulário
            document.querySelector('.form').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>