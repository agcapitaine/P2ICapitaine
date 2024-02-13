<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Créer un compte";
require_once('include/head.php');
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <div class="container p-5">
        <form method="POST" action="BDD_compte.php">
            <br />
            <h2>Création d'un compte</h2>
            <br>
            <h6>Tous les champs sont obligatoires</h6>
            <br>
            <div class="form-group">
                <label for="formGroupExampleInput">Nom</label>
                <input type="text" required minlength="1" maxlength="50" class="form-control" id="nom" name="nom"
                    placeholder="Entrez votre nom">
            </div>
            <br />
            <div class="form-group">
                <label for="formGroupExampleInput">Prénom</label>
                <input type="text" required minlength="1" maxlength="50" class="form-control" id="prenom" name="prenom"
                    placeholder="Entrez votre prénom">
            </div>
            <br>
            <div class="form-group">
                <label for="formGroupExampleInput">Mot de passe (au moins 8 caractères dont une minuscule, une majuscule
                    et un chiffre)</label>
                <input type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,50}" class="form-control"
                    id="mdp" name="mdp" placeholder="Entrez votre mot de passe">
            </div>
            <br>
            <div class="form-group">
            <label for="formGroupExampleInput">Statut</label>
            <select class="form-select" id="statut" name="statut" aria-label="Default select example">
                <option selected>Sélectionnez</option>
                <option value="1">Salarie</option>
                <option value="2">Alternant</option>
                <option value="3">Stagiaire</option>
                <option value="3">Administrateur</option>
            </select>
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Créer mon compte</button>
        </form>
    </div>

</body>

</html>