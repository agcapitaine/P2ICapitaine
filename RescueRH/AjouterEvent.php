<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Ajouter un événement";
require_once('include/head.php');
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <div class="container p-5">
        <form method="POST" action="BDD_event.php">
            <br />
            <h2>Ajout d'un événement</h2>
            <br>
            <h6>Tous les champs sont obligatoires</h6>
            <br>

            <div class="form-group">
                <label for="formGroupExampleInput">Date</label>
                <input type="date" id="date" name="date" class="form-control"/>
            </div>
            <br>
            
            <div class="form-group">
            <div class="mb-3">
                <label for="formGroupExampleInput">Titre de l'événement</label>   
                <input type="textarea" class="form-control" id="titre" name ="titre">
            </div>
            </div>

            
            <div class="form-group">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>

</body>

</html>