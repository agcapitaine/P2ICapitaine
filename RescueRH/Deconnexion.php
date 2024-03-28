<?php
session_start();
unset($_SESSION['idUtilisateur']);
session_destroy();

include("include/fonctions.php");
$pageTitle = "Déconnexion";
require_once('include/head.php');

?>
<!-- on confirme a l'utilisateur qu'il est bien déconnecté -->

<!DOCTYPE html>
<html lang="fr">

<body>
    <main role="main">
        <div class="container p-5">
            <div class="col-md-12 border rounded text-center shadow-lg p-3 mt-5 mb-5 border-success">
                <h3>Vous êtes bien déconnecté(e). A bientôt !</h3>
                <br>
                <a type="button" class="btn btn-primary" href="Connexion.php">Me connecter</a>
            </div>
        </div>
    </main>

</body>

</html>