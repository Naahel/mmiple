<?php

require 'lib.inc.php';

$email = $_POST['email'];
$mdp = $_POST['mdp'];
$co = connexionBD();

$req = 'SELECT * FROM mmiple_clients WHERE client_email LIKE "' . $email . '"';
$resultat = $co->query($req);

// on calcule le nombre de lignes renvoyées
$lignes_resultat = $resultat->rowCount();
if ($lignes_resultat > 0) { // y a-t-il des résultats ?
    // oui : pour chaque résultat : afficher
    $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
    if (password_verify($mdp,$ligne['client_mdp'])) {
        echo '<p>OK... :)</p>';
        $_SESSION['clientPrenom'] = $ligne['client_prenom'];
        $_SESSION['clientNum'] = $ligne['client_code'];
        header('location: jeux.php');
    } else {
        echo '<p>KO... :(</p>';
        $message = '<h1 class="erreur">Désolé, le login saisi n\'existe pas !</h1>';
        $_SESSION['msg'] = $message;
        header('location: connexion.php');
    }
}

deconnexionBD($co);
