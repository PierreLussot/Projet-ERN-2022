  <?php
    /* include_once('./_db/connexionDB.php') */
    ?>

  <!-- navbar -->
  <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
          <a class="navbar-brand" href="index.php">Accueil</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link" href="_profil/membres.php">Membres</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="_forum/forum.php">Forum</a>
                  </li>
                  <?php if (!isset($_SESSION['id'])) {

                    ?>
                      <li class="nav-item">
                          <a class="nav-link" href="inscription.php">Inscription</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="connexion.php">Connexion</a>
                      </li>
                  <?php
                    } else {
                    ?>
                      <li class="nav-item">
                          <a class="nav-link" href="_profil/profil.php">Mon profil</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                      </li>
                  <?php
                    }

                    ?>



              </ul>
          </div>
      </div>
  </nav>