<?php
session_start();
$pageTitle = "Accueil";
require_once('include/head.php');
?>

<body>
    

<div class="container">
<main class="mt-5 pt-4">
<h2>Page d'accueil administrateur</h2>
<br>
<a href="ListeEmployes.php" class="btn btn-light" tabindex="-1" role="button" aria-disabled="true">Données des employés</a>
<br> <br>
<a href="Gestion.php"  class="btn btn-light" tabindex="-1" role="button" aria-disabled="true">Gestion</a>
<br> <br>
<a href="creation_compte.php"  class="btn btn-light" tabindex="-1" role="button" aria-disabled="true">Créer un compte</a>

</main>
</div>

</body>