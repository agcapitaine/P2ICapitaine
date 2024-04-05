<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Connexion";
require_once('include/head.php');
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <?php
    //si l'utilisateur est déjà connecté on affiche un message d'erreur
    if (isset($_SESSION['idUtilisateur'])) { ?>
        <main role="main">
            <div class="container">
                <div class="col-md-12 border rounded text-center shadow-lg p-3 mt-5 mb-5 border-warning">
                    <h3>Vous êtes déjà connecté(e)</h3>
                    <br>
                </div>
            </div>
        </main>
    <?php }
    //sinon on affiche la page connexion
    else {
        ?>
        <div class="container p-5">
            <form method="POST" action="BDD_connexion.php">
                <br />
                <h2>Connexion</h2>
                <br>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nom</label>
                    <input type="nom" required minlength="1" class="form-control" id="nom" name="nom"
                        placeholder="Entrez votre nom">
                </div>
                <br>
                <div class="form-group">
                    <label for="formGroupExampleInput">Mot de passe</label>
                    <input type="password" required minlength="1" class="form-control" id="mdp" name="mdp"
                        placeholder="Entrez votre mot de passe">
                </div>
                <br>

                <button type="submit" class="btn btn-primary">Me connecter</button>
                <br>
                <br>
                
            </form>
        </div>
        <?php
    }
    ?>


</body>