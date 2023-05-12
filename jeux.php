<?php require('lib.inc.php'); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMiple</title>
    <link rel="stylesheet" href="assets/main.css">
    <script src="https://kit.fontawesome.com/b20f28079e.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <img src="assets/images/logo_mmiple.png" alt="Logo de MMiple">
        <nav>
            <a href="index.php">Accueil</a>
            <a href="jeux.php">Jeux</a>
            <a href="contact.php">Contact</a>
        </nav>
        <div id="member">
            <?php
            if (isset($_SESSION['clientPrenom'])) {
                echo '
                        <a class="uk-badge" href="panier.php">
                            <span>
                                <i class="fa-solid fa-cart-shopping"></i>';
                if (isset($_SESSION['panier'])) {
                    $total = 0;
                    foreach ($_SESSION['panier'] as $liste) {
                        $total += $liste['quantite'];
                    }
                    if ($total <= 9) {
                        echo '<span class="uk-badge">' . $total . '</span>';
                    } else {
                        echo '9+</span>';
                    }
                }
                echo '</a>';
            }
            ?>
            <?php
            if (isset($_SESSION['clientPrenom'])) {
                echo 'Bienvenue <strong>' . $_SESSION['clientPrenom'] . '</strong> | ';
                echo '<a href="deconnexion.php">Déconnexion</a>';
            } else {
                echo '<a href="connexion.php">Connexion</a> | ';
                echo '<a href="inscription.php">Inscription</a>';
            }
            ?>
        </div>
    </header>

    <div id="container">
        <h1>Liste des jeux</h1>
        <div id="grid-container">
            <?php
            $co = connexionBD();
            /*
                if (isset($_SESSION['panier'])) {
                    var_dump($_SESSION['panier']);
                }
                */
            afficherJeux($co);
            deconnexionBD($co);
            ?>
        </div>
    </div>
</body>

</html>