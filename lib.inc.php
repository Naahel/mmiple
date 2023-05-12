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
            echo '
            <div class="game">
                <span class="text-important">
                ' . $ligne['jeu_nom'] . '
                </span>
                <a class="game-link text-important" href="ajout_panier.php?id=' . $ligne['jeu_code'] . '">+</a>
                <div class="game-content">
                    <img src="' . $ligne['jeu_photo1'] . '" alt="Photo du kingdomino">
                    <p>Édité par <strong>' . $ligne['jeu_editeur'] . '</strong></p>
                    <p>Pour des parties d\'environ <strong>' . $ligne['jeu_duree_partie'] . '</strong></p>
                    <p>Joueurs (minimum/maximum) : <strong>'. $ligne['jeu_nb_joueurs_mini'] . '/' . $ligne['jeu_nb_joueurs_maxi'] . '</strong></p>
                </div>
            </div>';
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
