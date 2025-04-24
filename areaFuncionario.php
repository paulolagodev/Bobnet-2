<?php
session_start();
require 'conexaoBd.php';

if (!isset($_SESSION['logadoFuncionario']) || $_SESSION['logadoFuncionario'] !== true) {
    header('Location: loginCadastroFuncionarios.php');
    exit;
}

// Processar adição/edição de cliente
// Processar adição/edição de cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['nome']) && isset($_POST['cpf'])) {
      $id = $_POST['id'] ?? null;
      $nome = $_POST['nome'];
      $cpf = $_POST['cpf'];
      $dataNascimento = $_POST['dataNascimento'] ?? null;
      $endereco = $_POST['endereco'] ?? null;
      $numero = $_POST['numero'] ?? null;
      $bairro = $_POST['bairro'] ?? null;
      $complemento = $_POST['complemento'] ?? null;
      $cep = $_POST['cep'] ?? null;
      $telefone = $_POST['telefone'] ?? null;
      $email = $_POST['email'] ?? null;
      $nomePlano = $_POST['plano'] ?? null; // Renomeado para $nomePlano

      // Obter idPlano correspondente
      $idPlano = null;
      if (!empty($nomePlano)) {
          $stmt = $pdo->prepare("SELECT idPlano FROM planos WHERE nome = ? LIMIT 1");
          $stmt->execute([$nomePlano]);
          $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
          $idPlano = $resultado ? $resultado['idPlano'] : null;
      }
      
      if ($id) {
          // Editar cliente existente
          $stmt = $pdo->prepare("UPDATE clientes SET 
              nome = ?, 
              cpf = ?, 
              dataNascimento = ?, 
              endereco = ?, 
              numero = ?, 
              bairro = ?, 
              complemento = ?, 
              cep = ?, 
              telefone = ?, 
              email = ?, 
              plano = ?,
              idPlano = ?
              WHERE idClientes = ?");
          $stmt->execute([
              $nome, $cpf, $dataNascimento, $endereco, $numero, 
              $bairro, $complemento, $cep, $telefone, $email, 
              $nomePlano, $idPlano, $id
          ]);
      } else {
          /* 
          Adicionar novo cliente
          Sempre que o funcionario cria uma conta, o usuário vem automaticamente com a senha padrão
        */
          $stmt = $pdo->prepare("INSERT INTO clientes (
              nome, senha, cpf, dataNascimento, endereco, numero, bairro, 
              complemento, cep, telefone, email, plano, idPlano
          ) VALUES (?, 'Ab#123456789', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->execute([
              $nome, $cpf, $dataNascimento, $endereco, $numero, 
              $bairro, $complemento, $cep, $telefone, $email, 
              $nomePlano, $idPlano
          ]);
      }
      
      header('Location: ' . $_SERVER['PHP_SELF']);
      exit;
  }
}

// Processar exclusão de cliente
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE idClientes = ?");
    $stmt->execute([$id]);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Buscar todos os clientes
$stmt = $pdo->query("SELECT * FROM clientes");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buscar planos disponíveis (para o select)
$planos = $pdo->query("SELECT megas,
valor, nome as nomeP FROM planos")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Clientes</title>
    <link rel="stylesheet" href="areaFuncionario.css">
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
    
    <button onclick="abrirModalNovoCliente()" class="btn" style="margin-bottom: 20px;">Adicionar Novo Cliente</button>

    <table id="tabela">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Plano</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="lista">
            <?php foreach ($clientes as $cliente): ?>
                <tr data-id="<?= $cliente['idClientes'] ?>">
                    <td><?= htmlspecialchars($cliente['nome']) ?></td>
                    <td><?= htmlspecialchars($cliente['cpf']) ?></td>
                    <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                    <td><?= htmlspecialchars($cliente['email']) ?></td>
                    <td><?= htmlspecialchars($cliente['plano']) ?></td>
                    <td>
                        <button class="btn edit" onclick="editarCliente(<?= $cliente['idClientes'] ?>)">Editar</button>
                        <a href="?delete=<?= $cliente['idClientes'] ?>" class="btn delete" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
                <!-- Mistureba gpt -->
    <!-- Modal para adicionar/editar cliente -->
    <div id="clienteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h2 id="modalTitle">Adicionar Novo Cliente</h2>
            <form method="POST" id="formCliente">
                <input type="hidden" id="id" name="id" value="">
                
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>
                
                <div class="form-group">
                    <label for="dataNascimento">Data de Nascimento:</label>
                    <input type="date" id="dataNascimento" name="dataNascimento">
                </div>
                
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco">
                </div>
                
                <div class="form-group">
                    <label for="numero">Número:</label>
                    <input type="number" id="numero" name="numero">
                </div>
                
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro">
                </div>
                
                <div class="form-group">
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento">
                </div>
                
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep">
                </div>
                
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone">
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>
                
                <div class="form-group">
                    <label for="plano">Plano:</label>
                    <select id="plano" name="plano">
                        <option value="">Selecione um plano</option>
                        <?php foreach ($planos as $plano): ?>
                            <option value="<?= htmlspecialchars($plano['nomeP']) ?>">
                                <?= htmlspecialchars($plano['nomeP']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn">Salvar</button>
            </form>
        </div>
    </div>
                          
    <script>
        // Funções para controlar o modal
        function abrirModalNovoCliente() {
            document.getElementById('modalTitle').textContent = 'Adicionar Novo Cliente';
            document.getElementById('id').value = '';
            document.getElementById('formCliente').reset();
            document.getElementById('clienteModal').style.display = 'block';
        }
        
        function fecharModal() {
            document.getElementById('clienteModal').style.display = 'none';
        }
        
        function editarCliente(idCliente) {
    // Buscar os dados do cliente via AJAX
    fetch(`buscar_cliente.php?id=${idCliente}`)
        .then(response => response.json())
        .then(cliente => {
            document.getElementById('modalTitle').textContent = 'Editar Cliente';
            document.getElementById('id').value = cliente.idClientes;
            document.getElementById('nome').value = cliente.nome || '';
            document.getElementById('cpf').value = cliente.cpf || '';
            document.getElementById('dataNascimento').value = cliente.dataNascimento || '';
            document.getElementById('endereco').value = cliente.endereco || '';
            document.getElementById('numero').value = cliente.numero || '';
            document.getElementById('bairro').value = cliente.bairro || '';
            document.getElementById('complemento').value = cliente.complemento || '';
            document.getElementById('cep').value = cliente.cep || '';
            document.getElementById('telefone').value = cliente.telefone || '';
            document.getElementById('email').value = cliente.email || '';
            
            // Definir o plano selecionado
            if (cliente.plano) {
                document.getElementById('plano').value = cliente.plano;
            } else {
                document.getElementById('plano').value = '';
            }
            
            document.getElementById('clienteModal').style.display = 'block';
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao carregar dados do cliente');
        });
}
        
        // Fechar modal ao clicar fora dele
        window.onclick = function(event) {
            const modal = document.getElementById('clienteModal');
            if (event.target === modal) {
                fecharModal();
            }
        }
    </script>
</body>
</html>