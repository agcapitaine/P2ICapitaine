<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Vérification ajout congé";
require_once('include/head.php');
$BDD = openDB();
$reussi = false;
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <?php
    if (!empty($_POST['date'])) {
        //on vérifie les saisies utilisateurs avec la fonction escape avant de les enregistrer dans des variables
        $date = escape($_POST['date']);

        //on insère les données dans la table membre
        $req = "INSERT INTO joursnontravailles (dateArret) VALUES (?)";
        $reponse = openDB()->prepare($req);
        $reponse->execute(array($date));
        $reussi = true;


    }
    
    //si l'insertion a eu lieu on informe l'utilisateur que le compte a bien été crée
    if ($reussi == true) {
        ?>
        <main role="main">
            <div class="container">
                <div class="col-md-12 border rounded text-center shadow-lg p-3 mt-5 mb-5 border-success">
                    <h3>Votre modification a bien été prise en compte.</h3>
                    <br>
                    <a type="button" class="btn btn-primary" href="Gestion.php">Continuer</a>
                </div>

            </div>
        </main>
        <?php
    }
    //sinon on affiche un message d'erreur
    else {
        ?>
        <main role="main">
            <div class="container">
                <div class="col-md-12 border rounded text-center shadow-lg p-3 mt-5 mb-5 border-warning">
                    <h3>Erreur : Votre modification n'a pas été prise en compte. </h3>
                    <br>
                    <a type="button" class="btn btn-primary" href="AjouterJoursNT.php">Recommencer</a>
                </div>
            </div>
        </main>
        <?php
    }
    ?>

</body>

</html>
