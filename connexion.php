<?php require 'lib.inc.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<?php require 'debut_html.inc.php'; ?>

<body>
    <?php require 'menu_html.inc.php'; ?>

    <div id="contenu">
        <h1>Connexion</h1>
        <?php if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; unset ($_SESSION['msg']); } ?>
        <form action="connexion_verif.php" method="post">
            Adresse e-mail : <input type="text" name="email" /><br />
            Mot de passe : <input type="password" name="mdp" /><br />
            <input type="submit" value="Envoyer">
        </form>
    </div>
</body>

</html>