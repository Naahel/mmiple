<?php

    require('lib.inc.php');

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $co = connexionBD();

    $req = 'SELECT * FROM mmiple_clients WHERE client_email LIKE "' . $email . '"';
    $resultat = $co->query($req);
    $lignes_resultat = $resultat->rowCount();

    if ($lignes_resultat > 0) { // y a-t-il des résultats ?
        // oui : pour chaque résultat : afficher
        $ligne = $resultat->fetch(PDO::FETCH_ASSOC);
        if (password_verify($mdp, $ligne['client_mdp'])) {
            echo '<p>Connexion réussie avec succès !</p>';
            $_SESSION['clientPrenom'] = $ligne['client_prenom'];
            $_SESSION['clientNum'] = $ligne['client_code'];
            header('location: jeux.php');
        } else {
            echo '<p>KO... :(</p>';
            $message = '<h1 class="erreur">La connexion a échoué.</h1>';
            $_SESSION['error'] = $message;
            header('location: connexion.php');
        }
    }

    deconnexionBD($co);

?>