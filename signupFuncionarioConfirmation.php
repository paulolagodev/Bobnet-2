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
    <form class="container" action="cadastroFuncionario.php">


        <?php if (verificarCpfBd($_SESSION['cadastroFuncionario']['cpf'])): ?>
            <div class="error-message">
                <h2>CPF já cadastrado em nosso sistema. Por favor, verifique seus dados ou entre em contato com o suporte.</h2>
                <?php
                $_SESSION['ja_existe'] = true;
                header('Location: signupFuncionario.php');
                ?>
            </div>
        <?php else: ?>
            <h1 class="success-message">Cadastro Concluído!</h1><br>

            <div class="dados-cadastro">

                <h2>Dados Pessoais</h2>
                <p><strong>Nome:</strong> <?php echo htmlspecialchars($_SESSION['cadastroFuncionario']['nome']); //htmlspecialchars sendo usado para evitar bugs com caracteres especiais 
                                            ?></p>
                <p><strong>CPF:</strong> <?php echo htmlspecialchars($_SESSION['cadastroFuncionario']['cpf']); ?></p>
                <p><strong>CPF:</strong> <?php echo htmlspecialchars($_SESSION['cadastroFuncionario']['cargo']); ?></p>

                <div class="input-box">
                    <button type="submit" class="input-submit" name="registro" id="idregistro">
                        Próximo
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