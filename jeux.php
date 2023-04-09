<?php require 'lib.inc.php'; require 'debut_html.inc.php'; ?>

<?php require 'menu_html.inc.php'; ?>

        <div id="contenu">
            <h1>Liste des jeux</h1>
            <ul>
                <?php
                    $co = connexionBD();
                    if(isset($_SESSION['panier'])){ var_dump($_SESSION['panier']); }
                    afficherJeux($co);
                    deconnexionBD($co);
                ?>
            </ul>
        </div>

<?php require 'fin_html.inc.php'; ?>
