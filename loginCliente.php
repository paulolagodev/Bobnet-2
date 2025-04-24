<?php
session_start();
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
    <link rel="stylesheet" href="loginCliente.css">
</head>

<body>

    <div class="form-container">

        <div class="col col-1">
            <form action="index.php">
                <div>

                    <button class="btn btn-2" type="submit" id="login">
                        Início
                    </button><br>

                </div><br>

            </form>
            <form action="loginCadastroFuncionarios.php"><button type="submit" class="btn btn-2">
                    <p class="featured-words">Login <span>Usuário</span></p>
                </button></form>
        </div>





        <div class="col col-2">

            <div class="btn-box">
                <a href="loginCliente.php"><button class="btn btn-1" id="login">
                        Login
                    </button></a>
            </div>


            <div>

                <div class="btn-box">
                    <a href="signupCliente.php"><button class="btn btn-2" id="register">
                            Registro
                        </button></a>
                </div>

            </div>

            <!--Login form container-->
            <form class="login-form" method="POST" action="login.php">
                <div class="form-title">
                    <span>Login</span>
                </div>
                <div class="form-inputs">
                    <?php
                    if (isset($_SESSION['senhainvalida'])):
                    ?>
                        <div class="error-message">
                            <p >
                                <?php
                                echo 'CPF ou senha inválidos.';
                                ?>
                            </p>
                        </div>
                    <?php
                    endif;
                    unset($_SESSION['senhainvalida']);

                    ?>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="CPF" name="cpf" id="idcpf" required>
                        <i class="bx bx-user icon"></i>
                    </div>

                    <div class="input-box">
                        <input type="password" class="input-field" placeholder="Password" name="senha" id="idsenha" required>
                        <i class="bx bx-lock-alt icon"></i>
                    </div>
                    <div class="forgot-pass">
                        <a href="#">Forgot password?</a>
                    </div>
                    <div class="input-box">
                        <button type="submit" class="input-submit" name="login" id="idlogin">
                            <span>Login</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="social-login">
                    <!-- <i class="bx bxl-google"></i>
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-github"></i> -->
                </div>
            </form>
</body>
</html>