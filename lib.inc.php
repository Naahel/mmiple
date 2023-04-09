<?php

session_start();
require 'secretxyz123.php';

function connexionBD()
{
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=mmiple;charset=UTF8;port=3306', utilisateur, password);
        $bdd->query('SET NAMES utf8;');
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }
    return $bdd;
}

function deconnexionBD($bdd)
{
    $bdd = null;
}

function afficherJeux($bdd)
{
    $req = "SELECT * FROM mmiple_jeux";

    try {
        $resultat = $bdd->query($req);
    } catch (PDOException $e) {
        echo '<p>Erreur : ' . $e->getMessage() . '</p>';
        die();
    }

    $lignes_resultat = $resultat->rowCount();
    if ($lignes_resultat > 0) {
        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
            echo
            '
                <li>
                    <div class="nomdujeu">
                        <h2>' . $ligne['jeu_nom'] . '</h2>
                    </div>
                    <p>
                        Édité par ' . $ligne['jeu_editeur'] . ' <br>
                        Pour des parties d\'environ ' . $ligne['jeu_duree_partie'] . ' minutes <br>
                        Joueurs (mini/maxi) : (' . $ligne['jeu_nb_joueurs_mini'] . '/' . $ligne['jeu_nb_joueurs_maxi'] . ') <br><br>

                        <a style="color: red" href="ajout_panier.php?id=' . $ligne['jeu_code'] . '">Ajouter au panier</a>
                    </p>
                    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow>
                        <ul class="uk-slideshow-items">
                            <li>
                                <img src="' . $ligne['jeu_photo1'] . '" alt="" uk-cover>
                            </li>
                            <li>
                                <img src="' . $ligne['jeu_photo2'] . '" alt="" uk-cover>
                            </li>
                            <li>
                                <img src="' . $ligne['jeu_photo3'] . '" alt="" uk-cover>
                            </li>
                        </ul>
                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                    </div>
                </li>
                ';
        }
    } else {
        echo '<p>Pas de résultat !</p>';
    }
}

// fonction qui récupère les informations sur un jeu
// et les retourne ou bien retourne null si le jeu n'existe pas
function recuperer_jeu($co, $id)
{
    $req = "SELECT * FROM mmiple_jeux WHERE jeu_code=" . $id; // créer la requête
    //echo '<p>'.$req.'</p>'."\n";
    try {
        $resultat = $co->query($req); // exécuter la requête
    } catch (PDOException $e) {
        print "Erreur : " . $e->getMessage() . '<br />';
        die();
    }
    // compter le nombre de résultats
    $lignes_resultat = $resultat->rowCount();
    if ($lignes_resultat > 0) { // y a-t-il des résultats ?
        // oui : pour chaque résultat : afficher
        return $resultat->fetch(PDO::FETCH_ASSOC);
    } else {
        // non, on renvoie la valeur "null"
        return null;
    }
}

// fonction afficherPanier() qui affiche le contenu
// du panier sous la forme d'une table HTML
function afficherPanier($co)
{
    if (empty($_SESSION['panier'])) { // la panier est vide ?
        $tablePanier = '<p class="erreur">Désolé, votre panier est vide !</p>';
    } else { // sinon le panier contient quelque chose
        $tablePanier = '<table id="tablePanier">' . "\n";
        $tablePanier .= '<thead><th>Jeu</th><th>Prix</th>
    <th>Quantité</th><th>Total</th></thead>' . "\n";
        $tablePanier .= '</table>' . "\n";
    }
    return $tablePanier;
}
