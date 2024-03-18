<?php
session_start();
require_once('include/head.php');
include("include/fonctions.php");
$pageTitle = "Liste employés";
$employes = openDB()->query('select * from utilisateur order by idUtilisateur desc');
?> 

<!DOCTYPE html>
<html lang="fr">

<body>

<div class="container">
<main class="mt-5 pt-4"> 

<h2>Liste des employés</h2>
<br>
<br>
<section style="background-color: #eee;">
        <div class="container py-5">
            <?php foreach ($employes as $employe) { 
                if ($employe['statut']!= 'administrateur') {?>
                <div class="row justify-content-center mb-3">
                    <div class="col-md-12 col-xl-10">
                    <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                    <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                    <h4>
                        <?= $employe['nom'] ?>
                    </h4>
                    <h4>
                        <?= $employe['prenom'] ?>
                    </h4>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6">
                    <form class="" action="DonneeEmploye.php?id=<?= $employe['idUtilisateur'] ?>" method="post">
                        <input type="submit" name="verifier" class="btn btn-primary  btn-lg" value="Voir l'employé">
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>
                <?php } ?>              
            <?php } ?>
        </div>
</section>


</main>
</div>

</body>