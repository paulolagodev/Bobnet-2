<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login&Registro Funcionario</title>
    <!--BOXICONS-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--STYLE-->
    <link rel="stylesheet" href="loginCadastroFuncionarios-style.css">
</head>

<body>
    <div class="form-container">
        <div class="col col-1">
            <form action="index.php">
                <button class="btn btn-2" type="submit" id="login">
                    Início

                </button>

            </form><br>
            <form action="loginCliente.php">
                <button type="submit" class="btn btn-2">
                    <p class="featured-words">
                        Login <span>Funcionario</span>
                    </p>
                </button>
            </form>
        </div>


        <div class="col col-2">
            <div class="btn-box">
                <button class="btn btn-1" id="login">Login</button>
                <a href="signupFuncionario.php"><button class="btn btn-2" id="register">Registrar</button></a>
            </div>


            <!--Login form container-->
            <form action="loginFuncionario.php" method="POST">
                <div class="login-form">
                    <div class="form-title">
                        <span>Login</span>
                    </div>
                    <div class="form-inputs">
                        <?php
                        if (isset($_SESSION['senhainvalida'])):
                        ?>
                            <div>
                                <p class="error-message">
                                    <?php
                                    echo 'CPF ou senha inválidos.';
                                    ?>
                                </p>
                            </div>
                        <?php
                        endif;
                        unset($_SESSION['senhainvalida']);

                        ?>
                        <?php
                        if (isset($_SESSION['cadastroConcluido'])):
                        ?>
                            <div>
                                <p class="sucesso-mensagem">
                                    <?php
                                    echo 'Cadastro concluído.';
                                    ?>
                                </p>
                            </div>
                        <?php
                        endif;
                        unset($_SESSION['cadastroConcluido']);

                        ?>
                        <div class="input-box">
                            <input type="text" name="cpf" class="input-field" placeholder="CPF" required>
                            <i class="bx bx-user icon"></i>
                        </div>
                        <div class="input-box">
                            <input type="password" class="input-field" placeholder="Senha" name="senha" required>
                            <i class="bx bx-lock-alt icon"></i>
                        </div>
                        <div class="forgot-pass">
                            <a href="#">Esqueceu a senha?</a>
                        </div>
                        <div class="input-box">
                            <button class="input-submit">
                                <span>Login</span>
                                <i class="bx bx-right-arrow-alt"></i>
                            </button>
                        </div>
                    </div>
            </form>



        </div>
    </div>
</body>

</html>