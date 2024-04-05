<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Accueil Employé";
require_once('include/head.php');
// Avec la connexion de l'utilisateur on peut récupérer son id et proposer la bonne page
$idUtilisateur=$_SESSION['idUtilisateur'];
?>

<!DOCTYPE html>
<html lang="fr">

<body>

    <main class="mt-5 pt-4">
        <h2>Page d'accueil employé</h2>
        <br>
        <form class="" action="DonneeEmploye.php?id=<?= $idUtilisateur?>" method="post">
                        <input type="submit" name="verifier" class="btn btn-primary  btn-lg" value="Voir mes informations">
        </form>

    </main>
</div>
</body>