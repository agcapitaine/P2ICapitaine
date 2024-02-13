<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Vérification compte";
require_once('include/head.php');
$reussi = false;

$nom = escape($_POST['nom']);
$nom_identique = openDB()->query("select * from utilisateur where nom='$nom'");
$nb_nom = $nom_identique->rowCount();

if ($nb_nom == 0) {
    //on vérifie les saisies utilisateurs avec la fonction escape avant de les enregistrer dans des variables
    $mdp = escape($_POST['mdp']);
    //on crypte le mot de passe dans la base de donnees
    $mdp_crypte = password_hash($mdp, PASSWORD_DEFAULT);   
    $nom = escape($_POST['nom']);
    $prenom = escape($_POST['prenom']);
    $statut = escape($_POST['statut']);

    //on insère les données dans la table membre
    $req = "INSERT INTO utilisateur (mdp, nom, prenom, statut) VALUES (?,?,?,?)";
    $reponse = openDB()->prepare($req);
    $reponse->execute(array($mdp_crypte, $nom, $prenom, $statut));
    $reussi = true;
}
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <?php
    //si l'insertion a eu lieu on informe l'utilisateur que le compte a bien été crée
    if ($reussi == true) {
        ?>
        <main role="main">
            <div class="container">
                <div class="col-md-12 border rounded text-center shadow-lg p-3 mt-5 mb-5 border-success">
                    <h3>Félicitations ! Votre compte a bien été créé.</h3>
                    <br>
                    <a type="button" class="btn btn-primary" href="Connexion.php">Me connecter</a>
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
                    <h3>Erreur : ce pseudo n'est pas disponible. Veuillez en choisir un autre.</h3>
                    <br>
                    <a type="button" class="btn btn-primary" href="creation_compte.php">Recommencer</a>
                </div>
            </div>
        </main>
        <?php
    }
    ?>

</body>

</html>