<?php
session_start();
include('funcoes.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Cliente</title>
    <!--BOXICONS-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--STYLE-->
    <link rel="stylesheet" href="signupCliente.css">
</head>

<body>
    <form class="container" action="cadastroConfirmacao.php">


        <?php if (verificarCpfBd($_SESSION['cadastro']['cpf'])): ?>
            <div class="error-message">
                <h2>CPF já cadastrado em nosso sistema. Por favor, verifique seus dados ou entre em contato com o suporte.</h2>
                <?php
                $_SESSION['ja_existe'] = true;
                header('Location: signupCliente.php');
                ?>
            </div>
        <?php else: ?>
            <h1 class="success-message">Clique em confirmar para concluir o cadastro!</h1><br>
            <div >
                <h3>Confirme os dados abaixo!<br></h3><br>
            </div>

            <div class="dados-cadastro">

                <h2>Dados Pessoais</h2>
                <p><strong>Nome:</strong> <?php echo htmlspecialchars($_SESSION['cadastro']['nome']); //htmlspecialchars sendo usado para evitar bugs com caracteres especiais 
                                            ?></p>
                <p><strong>CPF:</strong> <?php echo htmlspecialchars($_SESSION['cadastro']['cpf']); ?></p>
                <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($_SESSION['cadastro']['nascimento']); ?></p>
                <p><strong>Telefone:</strong> <?php echo htmlspecialchars($_SESSION['cadastroPasso2']['telefone']); ?></p>

                <h2>Endereço</h2>
                <p><strong>Endereço:</strong> <?php echo htmlspecialchars($_SESSION['cadastroPasso2']['endereco']); ?></p>
                <p><strong>Número:</strong> <?php echo htmlspecialchars($_SESSION['cadastroPasso2']['numero']); ?></p>
                <p><strong>Bairro:</strong> <?php echo htmlspecialchars($_SESSION['cadastroPasso2']['bairro']); ?></p>
                <p><strong>Complemento:</strong> <?php echo htmlspecialchars($_SESSION['cadastroPasso2']['complemento']); ?></p>
                <p><strong>CEP:</strong> <?php echo htmlspecialchars($_SESSION['cadastroPasso2']['cep']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['cadastroPasso3']['email']); ?></p>


                <div class="input-box">
                    <button type="submit" class="input-submit" name="registro" id="idregistro">
                        Confirmar
                        <i class="bx bx-right-arrow-alt"></i>
                    </button>
                </div>
            </div>

            <!-- <p style="text-align: center; margin-top: 30px;">
                <a href="login.html" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Ir para Login</a>
            </p> -->
        <?php endif; ?>

    </form>


</body>

</html>