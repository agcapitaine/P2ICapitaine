
<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Modifier les horaires";
require_once('include/head.php');
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <div class="container p-5">
        <form method="POST" action="BDD_horaires.php">
            <br />
            <h2>Modifier les horaires</h2>
            <br>
            <h6>Tous les champs sont obligatoires</h6>
            <br>

            <div class="form-group">
            <label for="formGroupExampleInput">Mois</label>
            <select class="form-select" id="statut" name="statut" aria-label="Default select example">
                <option selected>Sélectionnez</option>
                <option value="1">Janvier</option>
                <option value="2">Février</option>
                <option value="3">Mars</option>
                <option value="4">Avril</option>
                <option value="5">Mai</option>
                <option value="6">Juin</option>
                <option value="7">Juillet</option>
                <option value="8">Août</option>
                <option value="9">Septembre</option>
                <option value="10">Octobre</option>
                <option value="11">Novembre</option>
                <option value="4">Décembre</option>
            </select>
            </div>
            <br>
            <label for="start">Année</label>
            <input type="date" id="annee" name="annee" value="2018-07-22" min="2018-01-01" max="2036-12-31" />
            <br>
            <div class="form-group">
            <label for="formGroupExampleInput">Année</label>
            <select class="form-select" id="statut" name="statut" aria-label="Default select example">
                <option selected>Sélectionnez</option>
                <option value="1">Salarie</option>
                <option value="2">Alternant</option>
                <option value="3">Stagiaire</option>
                <option value="4">Administrateur</option>
            </select>
            </div>
            <br>

            <br>
            <button type="submit" class="btn btn-primary">Créer mon compte</button>
        </form>
    </div>

</body>

</html>