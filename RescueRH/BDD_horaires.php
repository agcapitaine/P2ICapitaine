<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Vérification horaire";
require_once('include/head.php');
$BDD = openDB();
$reussi = false;
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

            
    }
    ?>
</body>
