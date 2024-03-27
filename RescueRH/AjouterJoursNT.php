<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Ajouter des jours non travaillés";
require_once('include/head.php');
require_once('include/navbar.php');
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <div class="container p-5">
        <form method="POST" action="BDD_jourNT.php">
            <br />
            <h2>Ajout d'un jour non travaillé</h2>
           <br>
            <div class="form-group">
                <label for="formGroupExampleInput">Date du jour concerné</label>
                <input type="date" id="date" name="date" class="form-control"/>
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>

</body>

</html>