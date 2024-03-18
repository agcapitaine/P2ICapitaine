<?php
session_start();
require_once('include/head.php');
include("include/fonctions.php");
$pageTitle = "Donnée Employé";
require_once('include/head.php');
 
//selectionne les informations de cet employé
$idUtilisateur = $_GET['id'];
$req = openDb()->prepare('select * from utilisateur where idUtilisateur=?');
$req->execute(array($idUtilisateur));
$employe = $req->fetch(); // Access first (and only) result line

//selectionne les heures journalières prévues
$mois = date('n');
$annee = date('Y');
$req2 = openDb()->prepare('select * from heuresprevues where mois=?');
$req2->execute(array($mois));
$heurePrevuesJours = $req2->fetch();

//compte le nombre de conges que l'employé a pris ce mois-ci
$conges = openDb()->prepare('select * from congeemploye where idUtilisateur=?');
$conges->execute(array($idUtilisateur));
$nbconges = $conges->rowCount();

//compte le nombre de jours non travailles prévus ce mois-ci
$joursnontravailles = openDb()->prepare('select * from joursnontravailles where month(dateArret)=?');
$joursnontravailles->execute(array($mois));
$nbjoursnontravailles = $joursnontravailles->rowCount();

//compte le nombre de jours ouvres
function nombreJoursOuvres($mois, $annee) {
    $nombreJours = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);   
    $joursOuvres = 0;   
    // Parcourir tous les jours du mois
    for ($jour = 1; $jour <= $nombreJours; $jour++) {
        // Récupérer le timestamp UNIX pour le jour
        $timestamp = mktime(0, 0, 0, $mois, $jour, $annee);       
        // Vérifier si le jour est un weekend (samedi ou dimanche)
        $jourSemaine = date('N', $timestamp);
        if ($jourSemaine <= 5) {
            $joursOuvres++;
        }
    }   
    return $joursOuvres;
}

// $heureParMois = $heurePrevuesJours*4;
// nombreJoursOuvres($mois, $annee) - $nbconges - $joursnontravailles;


//compte le nombre de conges auxquels l'employé a droit
$statutEmploye = $employe['statut'];
$congesDroit = openDb()->prepare('select * from conge where statutConcerne=?');
$congesDroit->execute(array($statutEmploye));

//compte le nombre de congé restant (dans le cas d'un type de congé précis (congé concerné))
function nombreCongesRestant($conges, $congedroit){
    $nbcongesconcerne = $congedroit['nbJours'];  
    foreach ($conges as $conge) { 
        if ($nbcongesconcerne==1){
            return "Plus de congés disponibles.";
        }      
        else if ($conge['titreConge']==$congedroit['titreConge']){
            $nbcongesconcerne=$nbcongesconcerne-1; 
        }
    }
        return $nbcongesconcerne;   
}

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
                        <ol>
                            <?php foreach ($conges as $conge) { ?>
                                <ul class="list-group">
                                <li class="list-group-item"><p><?= $conge['dateConge'] ?></p></li>                             
                                </ul> 
                            <?php } ?>
                        </ol>

                        <h4>Listes des congés auxquels droit : </h4>
                        <ol>
                        <?php foreach ($congesDroit as $congedroit) { 
                            $conges = openDb()->prepare('select * from congeemploye where idUtilisateur=?');
                            $conges->execute(array($idUtilisateur));
                            ?>
                                <ul class="list-group">
                                <li class="list-group-item">
                                    <p> Titre du congé : <?= $congedroit['titreConge'] ?></p>
                                    <p> Nombre de jours alloués : <?= $congedroit['nbJours'] ?></p>
                                    <p> Nombre de jours alloués restant : <?= nombreCongesRestant($conges, $congedroit) ?></p>
                                </li>                             
                                </ul> 
                            <?php } ?>
                        </ol>
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