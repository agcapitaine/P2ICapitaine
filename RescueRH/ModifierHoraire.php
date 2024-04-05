
<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Modifier les horaires";
require_once('include/head.php');
require_once('include/navbar.php');
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
            <select class="form-select" id="mois" name="mois" aria-label="Default select example">
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
                <option value="12">Décembre</option>
            </select>
            </div>
            <br>
            <div class="form-group">
            <label for="formGroupExampleInput">Année</label>
            <select class="form-select" id="annee" name="annee" aria-label="Default select example">
                <option selected>Sélectionnez</option>
                <option value="2024">2024</option>
            </select>
            </div>
            <br>
            <div class="form-group">
            <label for="formGroupExampleInput">Nombre d'heures prevues</label> <br>
            <input type="time" id="heuresPrevues" name="heuresPrevues" class="form-control" min="00:00" max="10:00" required /> 
            </div>
            <br>
            <div class="form-group">
            <label for="formGroupExampleInput">Nombre de jours d'annualisation prévus</label> <br>
            <input type="number" id="nbJours" class="form-control" name="nbJours"/> 
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>

</body>

</html>