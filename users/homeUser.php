<?php

/* ***********************************************************************************
 Cette page  est la premier page sur laquelle l'utilisateur arrive aprés sa connexion, 
 et sur laquelle il vas trouvé lensembles du ces boutiques 
************************************************************************************** */

// établire la session et initialiser les variables de session
session_start();
$user = $_SESSION['id_user'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];

// 2éme méthode de stocké les informations en utilisent les les cookiés
/** 
setcookie('user', $_SESSION['id_user'], time() + 365 * 24 * 3600, null, null, false, true);
setcookie('nom', $_SESSION['nom'], time() + 365 * 24 * 3600, null, null, false, true);
setcookie('prenom', $_SESSION['prenom'], time() + 365 * 24 * 3600, null, null, false, true);
setcookie('email', $_SESSION['email'], time() + 365 * 24 * 3600, null, null, false, true);
 */

// Vérrifier si l'utilisateur est connecté
require_once('../login/userModel.php');
$login = new UserModel();
$login->checkAuthenticate();

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Ma Beautique Enligne</title>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="modal-content">
        <!-- ----------------------------navbar------------------------------------ -->
        <nav class="navbar navbar-dark bg-dark">
          <a class="navbar-brand"><?php echo $nom; ?> <?php echo $prenom; ?></a>
          <form class="form-inline">
            <a href="homeUser.php" class="btn btn-outline-success mr-3" type="button">Accueil
            </a>
            <a href="./produits/allProducts.php?page=<?php echo 0; ?>" class="btn btn-outline-success mr-3 my-sm-0" type="button">Tous mes produits
            </a>
            <a class="btn btn-outline-success my-2 my-sm-0" href="../login/logOut.php">Déconnexion</a>
          </form>
        </nav>
        <!-- ----------------------------End navbar------------------------------------ -->
        <h1 class="mt-5 ml-3">La listes de mes beautique</h1>
        <div class="row ml-3">
          <button width="50" type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#nouvelleBoutique" data-whatever="@getbootstrap">
            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
            Nouvelle beautique
          </button>
        </div>


        <!-- Afficher l'essemble de mes boutique -->
        <div class="afficher">

        </div>

      </div>
    </div>

  </div>

  <!-- --------------------ajouter une nouvelle beautique--------------------------- -->

  <div class="modal fade" id="nouvelleBoutique" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nouvelle boutique</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

        <div class="modal-body">
          <p class="mb-2">* : Champs obligatoires!</p>
          <form method="post" class="addShops" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title" class="col-form-label">Titre*:</label>
              <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div class="form-group">
              <label for="img_bout" class="col-form-label">L'image vitrine de votre beautique*:</label>
              <input type="file" class="form-control" name="img_bout" id="img_bout" data-preview-file-type="any" required>
            </div>
            <div class="form-group">
              <label for="adresse" class="col-form-label">Adresse*:</label>
              <input type="text" class="form-control" name="adresse" id="adresse" required>
            </div>
            <div class="form-group">
              <label for="debut_sem" class="col-form-label">Debut de la semaine:</label>
              <select class="form-control" name="debut_sem" id="debut_sem">
                <option value="lundi">lundi</option>
                <option value="mardi">mardi</option>
                <option value="mercredi">mercredi</option>
                <option value="jeudi">jeudi</option>
                <option value="vendredi">vendredi</option>
                <option value="samedi">samedi</option>
                <option value="dimanche">dimanche</option>
              </select>
            </div>

            <div class="form-group">
              <label for="fin_sem" class="col-form-label">Fin de la semaine:</label>
              <select class="form-control" name="fin_sem" id="fin_sem">
                <option value="vendredi">vendredi</option>
                <option value="samedi">samedi</option>
                <option value="dimanche">dimanche</option>
                <option value="lundi">lundi</option>
                <option value="mardi">mardi</option>
                <option value="mercredi">mercredi</option>
                <option value="jeudi">jeudi</option>
              </select>
            </div>
            <div class="form-group">
              <label for="heur_debut" class="col-form-label">Heur début:</label>
              <input type="time" value="08:00:00" class="form-control" name="heur_debut" id="heur_debut">
            </div>
            <div class="form-group">
              <label for="heur_fin" class="col-form-label">Heur fin:</label>
              <input type="time" value="18:00:00" class="form-control" name="heur_fin" id="heur_fin">
            </div>
            <div class="form-group">
              <label for="description" class="col-form-label">Description:</label>
              <textarea class="form-control" name="description" id="description"></textarea>
            </div>
            <p class="mt-2">* : Champs obligatoires!</p>
        </div>
        <div id="resultSend">
          <!-- Nous allons afficher un retour en jQuery pour j'ajout d'une boutique -->
        </div>
        <div class="modal-footer">
          <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="submit" id="submit" value="Valider" class="submit btn btn-primary">Valider</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- -------------------------end ajout beautique--------------------------------- -->

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="./boutiques/shop.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>