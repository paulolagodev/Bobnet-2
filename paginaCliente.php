<?php
session_start();
include('funcoes.php');
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: loginCliente.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do cliente</title>
    <!--Link css-->
    <link rel="stylesheet" href="area-cliente.css">
    <!--Link icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!--Link icons-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!--Icone whatsapp-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!--Botao flutuante whatsapp-->
    <div class="button-whatsapp">
        <a href='https://api.whatsapp.com/send?phone=5581985960647&' target="_blank" class="icon">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    <div class="main--content">
        <div class="header--wrapper">

            <div class="header--title">
                <a href="index.php">
                    <h2>Início</h2>
                </a>
                <span>BOBNET</span>
                <h2>Página do cliente</h2>
            </div>
            <div class="user--info">
                <a href="logout.php">
                    <div class="logout--box">
                        <i class="fas fa-sign-out-alt"></i>
                        Sair
                    </div>
                </a>

            </div>

        </div>
        <div class="card--container">
            <h3 class="main--title">
                Planos disponíveis
            </h3>
            <div class="card--wrapper">
                <div class="cards spacer layer-4 " data-tilt data-tilt-glare>
                    <ul>
                        <h1>BASIC</h1>
                        <li><span class="material-symbols-outlined">
                                speed
                            </span>70 MEGA</li>
                        <li><span class="material-symbols-outlined">
                                wifi
                            </span>WI-FI 5G EM COMODATO</li>
                        <li><span class="material-symbols-outlined">
                                router
                            </span>INSTALAÇÃO GRÁTIS</li>
                        <li><span class="material-symbols-outlined">
                                tv_remote
                            </span>IPTV STREAMING</li>
                    </ul>
                    <div class="price">
                        <h4>Por apenas: R$50,00</h4>
                    </div>
                    <div class="btn-cards first">
                        <a href='https://api.whatsapp.com/send?phone=5581985960647&' target="_blank">CONTRATAR BOBNET</a>
                    </div>
                </div>
                <div class="cards spacer layer-3" data-tilt data-tilt-glare>

                    <ul>
                        <h1>PRIME</h1>
                        <li><span class="material-symbols-outlined">
                                speed
                            </span>100 MEGA</li>
                        <li><span class="material-symbols-outlined">
                                wifi
                            </span>WI-FI 5G EM COMODATO</li>
                        <li><span class="material-symbols-outlined">
                                router
                            </span>INSTALAÇÃO GRÁTIS</li>
                        <li><span class="material-symbols-outlined">
                                tv_remote
                            </span>IPTV STREAMING</li>
                    </ul>
                    <div class="price">
                        <h4>Por apenas: R$80,00</h4>
                    </div>
                    <div class="btn-cards second">
                        <a href='https://api.whatsapp.com/send?phone=5581985960647&' target="_blank">CONTRATAR BOBNET</a>
                    </div>
                </div>
                <div class="cards spacer layer-1" data-tilt data-tilt-glare>
                    <ul>
                        <h1>HIPER</h1>
                        <li><span class="material-symbols-outlined">
                                speed
                            </span>150 MEGA</li>
                        <li><span class="material-symbols-outlined">
                                wifi
                            </span>WI-FI 5G EM COMODATO</li>
                        <li><span class="material-symbols-outlined">
                                router
                            </span>INSTALAÇÃO GRÁTIS</li>
                        <li><span class="material-symbols-outlined">
                                tv_remote
                            </span>IPTV STREAMING</li>
                    </ul>
                    <div class="price">
                        <h4>Por apenas: R$110,00</h4>
                    </div>
                    <div class="btn-cards third">
                        <a href='https://api.whatsapp.com/send?phone=5581985960647&' target="_blank">CONTRATAR BOBNET</a>
                    </div>
                </div>
                <div class="cards spacer layer-2" data-tilt data-tilt-glare>
                    <ul>
                        <h1>FULL</h1>
                        <li><span class="material-symbols-outlined">
                                speed
                            </span>200 MEGA</li>
                        <li><span class="material-symbols-outlined">
                                wifi
                            </span>2 WI-FI 5G EM COMODATO</li>
                        <li><span class="material-symbols-outlined">
                                router
                            </span>INSTALAÇÃO GRÁTIS</li>
                        <li><span class="material-symbols-outlined">
                                tv_remote
                            </span>IPTV STREAMING</li>
                    </ul>
                    <div class="price">
                        <h4>Por apenas: R$130,00</h4>
                    </div>
                    <div class="btn-cards fourth">
                        <a href='https://api.whatsapp.com/send?phone=5581985960647&' target="_blank">CONTRATAR BOBNET</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabular-wrapper">
            <h3 class="main--title">
                Dados financeiros
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Plano</th>
                            <th>Megas</th>
                            <th>Data de vencimento</th>
                            <th>Valor do plano</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php
                    $planoAtual = verificarPlanos($_SESSION['planoatual']);
                    ?>
                    <tbody>
                        <?php
                        if ($_SESSION['planoatual'] == null) {
                            echo "<tr><td>O usuário ainda não possui um plano</td></tr>";
                        } else {
                            echo "
                        <tr>
                            <td>" .
                                $planoAtual['nome']
                                . "</td>
                            <td>" . $planoAtual['megas'] . "</td>
                            <td>20-09-2025</td>
                            <td>R$" . $planoAtual['valor'] . "</td>
                            <td>Pendente</td>

                        </tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>