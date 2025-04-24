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
    <?php
    session_start();
    ?>
    <div class="form-container">
        <div class="col col-1">
            <form action="index.php">
                <button class="btn btn-2" type="submit" id="login">
                    Início
                </button>
            </form><br>

            <form action="signupFuncionario.php">
                <button type="submit" class="btn btn-2">
                    <p class="featured-words">
                        Página de <span>Registro</span>
                    </p>
                </button>
            </form>

        </div>

        <div class="col col-2">

            <div class="btn-box">
                <a href="loginCliente.php"><button class="btn btn-2" id="login">
                        Login
                    </button></a>
            </div>





            <div>

                <div class="btn-box">
                    <a href="signupCliente.php"><button class="btn btn-1" id="register">
                            Registro
                        </button></a>
                </div>

            </div>

            <!--Login form container-->
            <form class="regsiter-form" method="POST" action="cadastro.php">
                <div class="">
                    <!-- <span>Registro</span> -->
                </div>
                <div class="form-inputs">
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Nome completo" name="nome" id="idnome" required>
                        <i class="bx bx-user icon"></i>
                    </div>
                    <?php
                    if (isset($_SESSION['ja_existe'])):
                    ?>
                        <div>
                            <p class="error-message">
                                <?php
                                echo 'Usuário já cadastrado';
                                ?>
                            </p>
                        </div>
                    <?php
                    endif;
                    unset($_SESSION['ja_existe']);

                    ?>

                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="CPF" name="cpf" id="idcpf" required>
                        <i class="bx bx-lock-alt icon"></i>
                    </div>
                    <div class="input-box">
                        <input type="date" class="input-field" placeholder="Nascimento: yyyy-mm-dd" name="nascimento" id="idnascimento" required>
                        <i class="bx bx-lock-alt icon"></i>
                    </div>
                    <!--  -->
                    <?php
                    if (!isset($_SESSION['senhainvalida'])):
                    ?>
                        <div class="message">
                            <p>A senha deve conter no mínimo 8 caracteres -</p>
                            <p>1 Letra Maiúscula - 1 letra minúscula - 1 número - 1 caractere especial</p>
                        </div>
                    <?php
                        unset($_SESSION['senhainvalida']);
                    endif;


                    ?>
                    <!--  -->
                    <?php
                    if (isset($_SESSION['senhainvalida'])):
                    ?>
                        <div class="error-message">
                            <p>
                                <?php
                                echo $_SESSION['senhainvalida'];
                                ?>
                            </p>
                        </div>
                    <?php
                    endif;
                    unset($_SESSION['senhainvalida']);

                    ?>
                    <div class="input-box">
                        <input type="password" class="input-field" placeholder="Senha" name="senha" id="idsenha" required>
                        <i class="bx bx-lock-alt icon"></i>
                    </div>

                    <div class="forgot-pass">
                        <a href="#">Forgot password?</a>
                    </div>

                    <div class="input-box">
                        <button type="submit" class="input-submit" name="registro" id="idregistro">
                            <span>Registrar</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </button>
                    </div>
                </div>
            </form>
</body>

</html>