<?php
session_start();
require_once('include/head.php');
include("include/fonctions.php");
$pageTitle = "Donnée Employé";
require_once('include/head.php');
if ($_SESSION['statut']=="administrateur"){ 
    require_once('include/navbar.php');
}  

 
//selectionne les informations de cet employé
$idUtilisateur = $_GET['id'];
$req = openDb()->prepare('select * from utilisateur where idUtilisateur=?');
$req->execute(array($idUtilisateur));
$employe = $req->fetch(); 

//selectionne les heures journalières prévues
$mois = date('n');
$annee = date('Y');
$req2 = openDb()->prepare('select * from heuresprevues where mois=?');
$req2->execute(array($mois));
$heurePrevuesJours = $req2->fetch();

//compte le nombre de conges que l'employé a pris ce mois-ci
$conges = openDb()->prepare('select * from congeemploye where idUtilisateur=:element1 and month(dateConge)=:element2');
$conges->execute(array(':element1' => $idUtilisateur, ':element2' => $mois));
$nbconges = $conges->rowCount();

//compte le nombre de jours non travailles prévus ce mois-ci
$joursnontravailles = openDb()->prepare('select * from joursnontravailles where month(dateArret)=?');
$joursnontravailles->execute(array($mois));
$nbjoursnontravailles = $joursnontravailles->rowCount();

//compte le nombre de jours ouvres
function nombreJoursOuvres($mois, $annee) {
    $nombreJours = cal_days_in_month(CAL_GREGORIAN, intval($mois), intval($annee));  
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

$nbJoursTravailles = nombreJoursOuvres($mois, $annee) - $nbconges - $nbjoursnontravailles;

// Convertir le temps en secondes
$secondes = strtotime($heurePrevuesJours['heuresPrevues'])- strtotime('TODAY');
$nouvellesSecondes = $secondes * $nbJoursTravailles; // Multiplier les secondes par le nombre de jours
$heures = floor($nouvellesSecondes / 3600); // Calculer le nombre d'heures
$minutes = floor(($nouvellesSecondes % 3600) / 60); // Calculer le nombre de minutes restantes après la soustraction des heures
$secondesRestantes = $nouvellesSecondes % 60; // Calculer le nombre de secondes restantes après la soustraction des heures et des minutes
$heureParMois = sprintf("%d heures, %d minutes, %d secondes", $heures, $minutes, $secondesRestantes);



//Compter nombre heures effectuées cette année
$secondeAnneeTotal=0;
for ($month = 1; $month <= $mois; $month++) {
    $requeteA = openDb()->prepare('select * from heuresprevues where mois=?');
    $requeteA->execute(array($month));
    $heurePrevuesJoursBoucle = $requeteA->fetch();

    $congesBoucle = openDb()->prepare('select * from congeemploye where idUtilisateur=:element1 and month(dateConge)=:element2');
    $congesBoucle->execute(array(':element1' => $idUtilisateur, ':element2' => $month));
    $nbcongesBoucle = $congesBoucle->rowCount();

    $joursnontravaillesBoucle = openDb()->prepare('select * from joursnontravailles where month(dateArret)=?');
    $joursnontravaillesBoucle->execute(array($month));
    $nbjoursnontravaillesBoucle = $joursnontravaillesBoucle->rowCount();

    $nbJoursTravaillesBoucle = nombreJoursOuvres($month, $annee) - $nbcongesBoucle - $nbjoursnontravaillesBoucle;

    $secondesBoucle = strtotime($heurePrevuesJoursBoucle['heuresPrevues'])- strtotime('TODAY');
    $nouvellesSecondesBoucle = $secondesBoucle * $nbJoursTravaillesBoucle;
    $secondeAnneeTotal = $nouvellesSecondesBoucle + $secondeAnneeTotal;
}
$heuresAnnee = floor($secondeAnneeTotal / 3600); // Calculer le nombre d'heures
$minutesAnnee = floor(($secondeAnneeTotal % 3600) / 60); // Calculer le nombre de minutes restantes après la soustraction des heures
$secondesRestantesAnnee = $secondeAnneeTotal % 60; // Calculer le nombre de secondes restantes après la soustraction des heures et des minutes
$heureParAnnee = sprintf("%d heures, %d minutes, %d secondes", $heuresAnnee, $minutesAnnee, $secondesRestantesAnnee);



//récupère les conges auxquels l'employé a droit
$statutEmploye = $employe['statut'];
$congesDroit = openDb()->prepare('select * from conge where statutConcerne=?');
$congesDroit->execute(array($statutEmploye));

//compte le nombre de congé restant (dans le cas d'un type de congé précis (congé concerné))
function nombreCongesRestant($conges, $congedroit){
    $nbcongesconcerne = $congedroit['nbJours'];  
    foreach ($conges as $conge) { 
        if ($nbcongesconcerne==0){
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
                        <p><?= $heureParMois ?></p>
                        <h4>Heures effectuées cette année :</h4>
                        <p><?= $heureParAnnee ?></p>
                        <h4>Limites de l'annualisation des heures :</h4>
                        <p>1600 heures par an</p>
                        <p>10 heures par jours</p>
                        <p>48 heures maximum par semaine</p>
                    </div>
<!-- div -->
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <h4>Listes des congés pris ce mois-ci : </h4>
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
                        <?php
                            if ($_SESSION['statut']=="administrateur"){ ?>
                                <a href="AjouterConge.php">Ajouter un congé</a>
                                <?php
                            } 
                            else { ?>
                                <a href="Deconnexion.php">Se déconnecter</a>
                                <?php
                            }                     
                        ?>
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