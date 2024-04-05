<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Vérification horaire";
require_once('include/head.php');
$BDD = openDB();
$reussi = false;
require_once('include/navbar.php');
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <?php
    if (!empty($_POST['mois']) && !empty($_POST['annee']) && !empty($_POST['heuresPrevues']) && !empty($_POST['nbJours'])) {
        //on vérifie les saisies utilisateurs avec la fonction escape avant de les enregistrer dans des variables
        $mois = escape($_POST['mois']);
        $annee = escape($_POST['annee']);
        $heuresPrevues = escape($_POST['heuresPrevues']);
        $nbJours = escape($_POST['nbJours']);

        // on crée la requête pour trouver l'id
        $requete = "SELECT * FROM heuresprevues WHERE annee=:element1 AND mois=:element2";
        $reponse = $BDD->prepare($requete);
        $reponse->execute(array(':element1' => $annee, ':element2' => $mois));
        $result = $reponse->fetch();

        $id = $result['idHeure']; // Accès à la colonne 'id'

        //Execution de la requête
        $sql = "UPDATE heuresprevues SET mois='$mois', annee='$annee', heuresPrevues='$heuresPrevues', nbJoursAnnualisation='$nbJours' WHERE idHeure=$id";
        $answer = $BDD->query($sql);
        $nbAnswer = $answer->rowCount();
        $reussi=true;

    }
    
    //si la modification a eu lieu on informe l'utilisateur que la modification a été prise en compte
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
                    <a type="button" class="btn btn-primary" href="ModifierHoraire.php">Recommencer</a>
                </div>
            </div>
        </main>
        <?php
    }
    ?>

</body>

</html>
