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
                <div>

                    <button class="btn btn-2" type="submit" id="login">
                        Início

                    </button><br>

                </div>

            </form><br>
            <form action="signupCliente.php">
                <button type="submit" class="btn btn-2">
                    <p class="featured-words">
                        Registrar <span>Funcionario</span>
                    </p>
                </button>
            </form>
        </div>


        <div class="col col-2">
            <div class="btn-box">
                <a href="loginCadastroFuncionarios.php"><button class="btn btn-2" id="login">Login</button></a>
                <a href="signupFuncionario.php"><button class="btn btn-1" id="register">Registrar</button></a>
            </div>

            <form action="signupFuncionarioConfirmation.php" method="POST">
                <div class="login-form">
                    <div class="form-title">
                    </div>
                    <?php
                    if (isset($_SESSION['ja_existe'])):
                    ?>
                        <div>
                            <p class="error-message">
                                <?php
                                echo 'CPF já cadastrado';
                                ?>
                            </p>
                        </div>
                    <?php
                    endif;
                    unset($_SESSION['ja_existe']);

                    ?>
                    <div class="form-inputs">
                        <div class="input-box">
                            <input type="text" class="input-field" name="nome" placeholder="Nome" required>
                            <i class="bx bx-envelop icon"></i>
                        </div>
                        <div class="input-box">
                            <input type="text" class="input-field" name="cpf" placeholder="CPF" required>
                            <i class="bx bx-user icon"></i>
                        </div>
                        <?php
                        $cargosDisponiveis = [
                            "Atendente",
                            "Suporte",
                            "Liderança",
                            "RH"
                        ]
                        ?>
                        <div class="input-box">
                            <select name="cargo" class="input-field" id="idcargo">
                                <?php
                                foreach ($cargosDisponiveis as $cargos) { ?>
                                    <option value="<?= $cargos; ?>"> <?= $cargos; ?> </option>
                                    <<?php }
                                        ?>

                                        </select>
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
                                <span>Registrar</span>
                                <i class="bx bx-right-arrow-alt"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
</body>

</html>