<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Ajouter un congé";
require_once('include/head.php');
//on sélectionne tous les employés
$employes = openDB()->query('select * from utilisateur order by idUtilisateur desc');
//on sélectionne tous les conges
$conges = openDB()->query('select * from conge order by idConge desc');
require_once('include/navbar.php');
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <div class="container p-5">
        <form method="POST" action="BDD_conges.php">
            <br />
            <h2>Ajout d'un congé</h2>
            <br>
            <h6>Tous les champs sont obligatoires</h6>
            <br>
            <div class="form-group">
                <label for="formGroupExampleInput">Nom de l'employé</label>
                <select class="form-select" id="nom" name="nom" aria-label="Default select example">
                    <option selected>Sélectionnez</option> 
                    <!-- on peut sélectionner uniquement ce qui est dans la base de données -->
                    <?php foreach ($employes as $employe) { ?>
                    <option value="<?= $employe['idUtilisateur']?>"> <?= $employe['nom'] ?> </option>
                    <?php }?>

                </select>
            </div>
            <br />
            <div class="form-group">
                <label for="formGroupExampleInput">Raison du congé</label>
                <select class="form-select" id="raison" name="raison" aria-label="Default select example">
                    <option selected>Sélectionnez</option>
                    <!-- on peut sélectionner uniquement ce qui est dans la base de données -->
                    <?php foreach ($conges as $conge) { ?>
                    <option value="<?= $conge['titreConge'] ?>"> <?= $conge['titreConge'] ?> </option>
                    <?php }?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="formGroupExampleInput">Date</label>
                <input type="date" id="date" name="date" class="form-control"/>
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>

</body>

</html>