<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Vérification ajout evenement";
require_once('include/head.php');
$BDD = openDB();
$reussi = false;
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <?php
    if (!empty($_POST['date']) && !empty($_POST['titre']) && !empty($_POST['description'])) {
        //on vérifie les saisies utilisateurs avec la fonction escape avant de les enregistrer dans des variables
        $titre = escape($_POST['titre']);
        $date = escape($_POST['date']);
        $description = escape($_POST['description']);

        //on insère les données dans la table evenement
        $req = "INSERT INTO evenement (dateEvenement, titre, description) VALUES (?,?,?)";
        $reponse = openDB()->prepare($req);
        $reponse->execute(array($date, $titre, $description));
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
                    <a type="button" class="btn btn-primary" href="AjouterConge.php">Recommencer</a>
                </div>
            </div>
        </main>
        <?php
    }
    ?>

</body>

</html>
