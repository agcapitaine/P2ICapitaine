<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Vérification ajout congé";
require_once('include/head.php');
$BDD = openDB();
$reussi = false;
$AleDroit= false;


?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <?php

    

    if (!empty($_POST['nom']) && !empty($_POST['date']) && !empty($_POST['raison'])) {
        //on vérifie les saisies utilisateurs avec la fonction escape avant de les enregistrer dans des variables
        $nom = escape($_POST['nom']);
        $date = escape($_POST['date']);
        $raison = escape($_POST['raison']);

        //on recup l'employé
        $req2 = openDb()->prepare('select * from utilisateur where idUtilisateur=?');
        $req2->execute(array($nom));
        $employe = $req2->fetch(); // Access first (and only) result line

        //prend les conges auxquels l'employé a droit
        $statutEmploye = $employe['statut'];
        $congesDroit = openDb()->prepare('select * from conge where statutConcerne=?');
        $congesDroit->execute(array($statutEmploye));

        //compte le nombre de conges que l'employé a pris
        $congesdejapris = openDb()->prepare('select * from congeemploye where idUtilisateur=?');
        $congesdejapris->execute(array($nom));
        $nbconges = $congesdejapris->rowCount();

        //compte le nombre de congé restant (dans le cas d'un type de congé précis (congé concerné))
        function nombreCongesRestant($congesdejapris, $congedroit){
            $nbcongesconcerne = $congedroit['nbJours'];  
            foreach ($congesdejapris as $conge) { 
                if ($conge['titreConge']==$congedroit['titreConge']){
                    $nbcongesconcerne=$nbcongesconcerne-1; 
                }       
            }  
            return $nbcongesconcerne; 
}

        foreach ($congesDroit as $congedroit) {
            if (($congedroit['titreConge']==$raison) && (nombreCongesRestant($congesdejapris, $congedroit)!=0)){
                    $AleDroit=true;
                    // echo nombreCongesRestant($congesdejapris, $congedroit);
            }
        }

        if ($AleDroit==true)
        {
            //on insère les données dans la table membre
            $req = "INSERT INTO congeemploye (idUtilisateur, titreConge, dateConge) VALUES (?,?,?)";
            $reponse = openDB()->prepare($req);
            $reponse->execute(array($nom, $raison, $date));
            $reussi = true;
        }


    }
    
    //si l'insertion a eu lieu on informe l'utilisateur que le compte a bien été crée
    if ($reussi == true) {
        ?>
        <main role="main">
            <div class="container">
                <div class="col-md-12 border rounded text-center shadow-lg p-3 mt-5 mb-5 border-success">
                    <h3>Votre modification a bien été prise en compte.</h3>
                    <br>
                    <a type="button" class="btn btn-primary" href="index.php">Continuer</a>
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
