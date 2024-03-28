
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="ListeEmployes.php">Liste des Employés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Gestion.php">Gestion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="creation_compte.php">Créer un compte</a>
        </li>
      </ul>
      <div class="nav col-12 col-lg-auto me-lg-auto mb-2 align-items-center justify-content-center mb-md-0">
                <?php
                //si l'utilisateur est connecté on indique "Bonjour" suivi de son pseudo et le bouton "Deconnexion"
                if (isset($_SESSION['idUtilisateur'])) {
                    ?>
                    <a type="button" class="btn btn-dark disabled" href="Connexion.php">Bonjour
                        <?php echo $_SESSION['nom'] ?>
                    </a>
                    <a class="nav-link" href="Deconnexion.php">Déconnexion</a>
                    <?php
                }
                //sinon on affiche le bouton "Connexion" et le bouton "Inscription"
                else {
                    ?>
                    <a class="nav-link" href="Connexion.php">Connexion</a>
                    <a class="nav-link" href="creation_compte.php">Inscription</a>
                    <?php
                }
                ?>
            </div>
    </div>
  </div>
</nav>
</header>