<?php
session_start();
require_once('include/head.php');
include("include/fonctions.php");
$pageTitle = "Gestion";
$annee = date('Y');
$heuresPrevues = openDb()->prepare('select * from heuresprevues where annee=?');
$heuresPrevues->execute(array($annee));
$joursnontravailles = openDb()->prepare('select * from joursnontravailles where year(dateArret)=?');
$joursnontravailles->execute(array($annee));
$evenements = openDb()->prepare('select * from evenement where year(dateEvenement)=?');
$evenements->execute(array($annee));
?>

<!DOCTYPE html>
<html lang="fr">

<body>

<div class="container">
<main class="mt-5 pt-4"> 


<h1>Gestion</h1>
<br>

<h3>Bilan des heures prévues selon les mois</h3>
<br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Mois</th>
      <th scope="col">Année</th>
      <th scope="col">Nombre d'heures journalières prévues</th>
      <th scope="col">Nombre de jours d'annualisation prévus</th>
    </tr>
  </thead>
  <tbody>
    <tr>

      <?php foreach ($heuresPrevues as $heure){?>
        <th scope="row"><?= $heure['mois'] ?></th>
        <td><?= $heure['annee'] ?></td>
        <td><?= $heure['heuresPrevues'] ?></td>
        <td><?= $heure['nbJoursAnnualisation'] ?></td>

    </tr>
    <?php
    } ?>
  </tbody>
</table>
<button type="button" class="btn btn-outline-primary"><a href="ModifierHoraire.php">Modifier les horaires</a></button>

<br><br><br>
<h3>Liste des jours non travaillés</h3>
<div>
    <ol>
    <?php foreach ($joursnontravailles as $jours) { ?>
        <ul class="list-group">
        <li class="list-group-item">
            <?=$jours['dateArret'] ?>
        </li>                             
        </ul> 
    <?php } ?>
    </ol>
    
</div>
<button type="button" class="btn btn-outline-primary"><a href="AjouterJoursNT.php">Ajouter des jours non travaillés</a></button>

<br><br><br>
<h3>Liste des événements</h3>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Date</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>

      <?php foreach ($evenements as $event){?>
        <th scope="row"><?= $event['titre'] ?></th>
        <td><?= $event['dateEvenement'] ?></td>
        <td><?= $event['description'] ?></td>

    </tr>
    <?php
    } ?>
  </tbody>
</table>

<button type="button" class="btn btn-outline-primary"><a href="AjouterEvent.php">Ajouter un événement</a></button>

<br>
<br>
<br>




</main>
</div>

</body>