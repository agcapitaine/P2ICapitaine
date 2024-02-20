<?php
require_once('include/head.php');
include("include/fonctions.php");
$pageTitle = "Donnée Employé";
require_once('include/head.php');

//selectionne les informations de cet employé
$idUtilisateur = $_GET['id'];
$req = openDb()->prepare('select * from utilisateur where idUtilisateur=?');
$req->execute(array($idUtilisateur));
$employe = $req->fetch(); // Access first (and only) result line

?>

<!DOCTYPE html>
<html lang="fr">

<body>

<div class="container">
<main class="mt-5 pt-4"> 

<h2>Donnée d'un employé</h2>

<h2>
    <?= $employe['statut'] ?>
</h2>

<p>heures effectuées ce mois-ci</p>
<p>heures effectuées cette année</p>
<p>objectifs de l'annualisation des heures</p>
<p>liste des congés déjà prit par l'employé</p>
<p>liste des congés auxquels droit</p>
<a href="AjouterConge.php">Ajouter un congé</a>

</main>
</div>

</body>