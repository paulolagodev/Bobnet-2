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
    <div class="form-container">
        <form class="col col-1" action="index.php">
            <div>
                <button class="btn btn-2" type="submit" id="login">
                    Início
                </button>
            </div>
            <p class="featured-words">Página de <span>Registro</span></p>

        </form>




        <div>
            <div class="btn-box">
                <button class="btn btn-1" id="register">
                    Passo 3
                </button>
            </div>

        </div>

        <!--Login form container-->
        <form class="regsiter-form" method="POST" action="cadastroPasso3.php">
            <div class="form-title">
                <!-- <span>Registro</span> -->
            </div>
            <!-- Caso o email não esteja valido deve aparecer -->
            <!-- Ao apertar F5 deve desaparecer -->
            <?php
            if (isset($_SESSION['erroEmail'])):
            ?>
                <div>
                    <p>Email inválido.</p>
                </div>
            <?php
                unset($_SESSION['erroEmail']);
            endif;

            ?>

            <div class="form-inputs">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Email" name="email" id="idemail" required>
                    <i class="bx bx-user icon"></i>
                </div>

                <!-- <?php
                        /*   $planosDisponiveis = [
                    "Plano Super 70MB",
                    "Plano Prime 100MB",
                    "Plano Hiper 150MB",
                    "Plano Full 200MB"
                ]
                ?>
                <div class="input-box">
                    <select name="plano" id="idplanoo">
                        <?php
                        foreach ($planosDisponiveis as $planos) { ?>
                            <option value="<?= $planos; ?>"> <?= $planos; ?> </option>
                            <<?php }*/
                        ?>

                                </select>
                </div> -->


                <div class="input-box">

                    <button type="submit" class="input-submit" name="registro" id="idregistro">
                        <span>Próximo</span>
                        <i class="bx bx-right-arrow-alt"></i>
                    </button>

                </div>
            </div>


        </form>
</body>

</html>