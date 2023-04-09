<?php

require('lib.inc.php');
$co = connexionBD();

if (isset($_SESSION['clientPrenom'])) {
    $idJeu = $_GET['id'];
    $infos = recuperer_jeu($co, $idJeu); // fonction qui récupère les informations sur un jeu
    if (isset($_SESSION['panier'][$idJeu])) {
        $_SESSION['panier'][$idJeu]['quantite'] += 1;
    } else {
        $_SESSION['panier'][$idJeu] = array(
            'nom' => $infos['jeu_nom'],
            'prix' => $infos['jeu_prix_unit'],
            'quantite' => 1
        );
    }
    header('Location: jeux.php');
} else {
    header('Location: connexion.php');
}

?>