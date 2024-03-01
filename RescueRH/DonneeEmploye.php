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

$mois = date('n');
$annee = date('Y');
$req2 = openDb()->prepare('select * from heuresprevues where mois=?');
$req2->execute(array($mois));
$heurePrevuesJours = $req2->fetch();

$conges = openDb()->prepare('select * from congeemploye where idUtilisateur=?');
$conges->execute(array($idUtilisateur));
$nbconges = $conges->rowCount();

$joursnontravailles = openDb()->prepare('select * from joursnontravailles where month(dateArret)=?');
$joursnontravailles->execute(array($mois));
$nbjoursnontravailles = $joursnontravailles->rowCount();



?>

<!DOCTYPE html>
<html lang="fr">

<body>

<div class="container">
<main class="mt-5 pt-4"> 

<h2>Donnée d'un employé</h2>

<br>


<h3>
    <?= $employe['nom'] ?>
</h3>
<h3>
    <?= $employe['prenom'] ?>
</h3>

<br>
<br>
<section style="background-color: #eee;">
        <div class="container py-5">
                <div class="row justify-content-center mb-3">
                    <div class="col-md-12 col-xl-10">
                    <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                    <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                        <h4>Heures effectuées ce mois-ci :</h4>
                        <p><?= $heurePrevuesJours['heuresPrevues'] ?></p>
                        <h4>Heures effectuées cette année :</h4>
                        <p>heures effectuées cette année</p>
                        <h4>Objectifs de l'annualisation des heures :</h4>
                        <p>objectifs de l'annualisation des heures</p>
                    </div>
<!-- div -->
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <h4>Listes des congés déjà pris : </h4>
                        <p>liste des congés déjà pris par l'employé</p>
                        <h4>Nombre jours non travailles : </h4>
                        <p><?= $nbjoursnontravailles ?></p>
                        <h4>Listes des congés auxquels droit : </h4>
                        <p>liste des congés auxquels droit</p>
                        <a href="AjouterConge.php">Ajouter un congé</a>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>
        </div>
</section>





</main>
</div>

</body>