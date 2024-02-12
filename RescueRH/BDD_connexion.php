<?php
session_start();
include("include/fonctions.php");
$pageTitle = "Vérification connexion";
require_once('include/head.php');
$BDD = openDB();
?>

<!DOCTYPE html>
<html lang="fr">

<body>
    <?php
    if (!empty($_POST['nom']) && !empty($_POST['mdp'])) {
        //on vérifie les saisies utilisateurs avec la fonction escape avant de les enregistrer dans des variables
        $nom = escape($_POST['nom']);
        $mdp = escape($_POST['mdp']);

        // on cree la requete
        $requete = "SELECT * FROM utilisateur WHERE nom = ?";
        $reponse = $BDD->prepare($requete);
        $reponse->execute(array($nom));

        // on récupére tous les enregistrements dans un tableau
        $enregistrements = $reponse->fetchAll();

        // pour connaitre le nombre d'enregistrements
        $nombreReponses = count($enregistrements);

        // si l'utilisateur existe
        if ($nombreReponses > 0) {
            // on vérifie si le mot de passe crypté de la base de données correspond au mot de passe du formulaire
            $mdp_crypte = $enregistrements[0]['mdp'];
            if (password_verify($mdp, $mdp_crypte)) {

                //on cree des variables de seesions pour enregistrer les informations de l'utilisateur
                $_SESSION['mdp'] = $enregistrements[0]['mdp'];
                $_SESSION['nom'] = $enregistrements[0]['nom'];
                $_SESSION['prenom'] = $enregistrements[0]['prenom'];
                $_SESSION['statut'] = $enregistrements[0]['statut'];
                redirect('index.php');

            }
            //si le mdp ne correspond pas on affiche un message d'erreur
            else {
                ?>
                <main role="main">
                    <div class="container">
                        <div class="col-md-12 border rounded text-center shadow-lg p-3 mt-5 mb-5 border-warning">
                            <h3>Mot de passe incorrect</h3>
                            <br>
                            <form class="" action="Connexion.php" method="post">
                                <input type="submit" name="connexion" class="btn btn-primary"
                                    value="Retourner à la page de connexion">
                            </form>
                        </div>
                    </div>
                </main>
                <?php

            }
        }
        //si la requete ne retourne rien on affiche un autre message d'erreur
        else {
            ?>
            <main role="main">
                <div class="container">
                    <div class="col-md-12 border rounded text-center shadow-lg p-3 mt-5 mb-5 border-warning">
                        <h3>Compte introuvable</h3>
                        <p>Vous ne semblez pas avoir de compte chez nous</p>
                        <br>
                        <form class="" action="Creation_compte.php" method="post">
                            <input type="submit" name="connexion" class="btn btn-primary" value="Créer un compte">
                        </form>
                    </div>
                </div>
            </main>
            <?php
        }
    }

    ?>

</body>

</html>