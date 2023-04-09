<header>
    <img src="img/logo_mmiple.png" alt="mmiple logo" id="logo" />
    <nav>
        <a href="index.php">Accueil</a> -
        <a href="jeux.php">Jeux</a> -
        <a href="contact.php">Contact</a>
    </nav>
    <div id="connexion">
        <a href="panier.php">
            <?php
            if(isset($_SESSION['clientPrenom'])){
                if (isset($_SESSION['panier'])) {
                    $total = 0;
                    foreach ($_SESSION['panier'] as $liste) {
                        $total += $liste['quantite'];
                    }
                    if($total <= 9){
                        echo '<span class="uk-badge" id="panier_jeux">'.$total.'</span>';
                    } else {
                        echo '<span class="uk-badge" id="panier_jeux">9+</span>';
                    }
                }
            }
            ?>
        </span>

            <img src="http://149.91.83.164/lectio/img/m2202/caddie.png" id="panier" />
        </a>
        &nbsp;
        <?php
        if (isset($_SESSION['clientPrenom'])) {
            echo 'Bonjour ' . $_SESSION['clientPrenom'] . '&nbsp;';
            echo '<a href="deconnexion.php">Déconnexion</a>';
        } else {
            echo '<a href="connexion.php">Connexion</a> / ';
            echo '<a href="inscription.php">Inscription</a>';
        }
        ?>

    </div>
</header>