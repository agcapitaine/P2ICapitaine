<?php
require_once('include/head.php');
include("include/fonctions.php");
$pageTitle = "Gestion";
?>

<!DOCTYPE html>
<html lang="fr">

<body>

<div class="container">
<main class="mt-5 pt-4"> 


<h2>Gestion</h2>
<br>

<p>les horaires prévus selon les mois</p>
<p>les dates de jours non travaillés</p>
<p>les dates de fermeture de l'atelier</p>
<p>les événements</p>

<form class="" action="ModifierHoraire.php" method="post">
<input type="submit" name="modifier" class="btn btn-primary  btn-lg" value="Modifier les horaires">

<form class="" action="AjouterJoursNT.php" method="post">
<input type="submit" name="modifier" class="btn btn-primary  btn-lg" value="Ajouter des jours non travaillés">                     

<form class="" action="AjouterEvent.php" method="post">
<input type="submit" name="event" class="btn btn-primary  btn-lg" value="Ajouter un événement">   

</main>
</div>

</body>