<?php

/* ***********************************************************************************
 Cette page  est la page d'accuel pour mon site sur laquelle on trouve un carousel 
 qui affiche toutes les boutiques présente sur le site, et aussi une liste 
 de 6 boutiques (6 pour des raisons d'affichage)
************************************************************************************** */

// récupérer la listes de mes boutique pour le carousel
require_once('users/boutiques/shopModel.php');
$boutique = new BoutiqueModel();
$boutiques = $boutique->getAllBoutiques();
$limitBoutiques = $boutique->getLimitBoutiques(); // limié à 6

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

  <body>
    <div class="container">

      <div class="row">
        <div class="modal-content">
          <!-- ----------------------------navbar------------------------------------ -->
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Boutique En ligne</a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
              <ul class="navbar-nav mr-auto text-light form-inline my-2 my-lg-0">
                <li class="nav-item active">
                  <a class="btn btn-outline-success mr-2 my-2 my-sm-0" type="submit">Accueil
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li>
                  <a href="boutiques/" class="btn btn-outline-success mr-2 my-2 my-sm-0" type="submit">Boutiques</a>
                </li>
                <li>
                  <a href="produits/?page=<?php echo 0; ?>" class="btn btn-outline-success mr-2 my-2 my-sm-0" type="submit">Produits</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">

                <a href="login/login.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Connexion</a>
              </form>
            </div>
          </nav>
          <!-- ----------------------------End navbar------------------------------------ -->

          <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <?php
              foreach ($boutiques as $data) {
              ?>
                <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $data['id_bou']; ?>"></li>
              <?php };
              unset($shop); ?>
            </ol>

            <div class="carousel-inner">
              <div class="carousel-item active">
                <img width="700" height="450" src="images/Boutique06.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Bienvenue sur votre boutique en ligne</h5>
                  <p>Faites vous visites on choisons une boutique! faites vous choix c'est gratuits !</p>
                </div>
              </div>
              <?php
              foreach ($boutiques as $data) {
              ?>

                <div class="carousel-item">
                  <img width="700" height="450" src="images/<?php echo $data['img_bout']; ?>" class="d-block w-100" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                    <h5> <?php echo $data['title']; ?></h5>
                    <p><?php echo $data['adresse']; ?></p>
                  </div>
                </div>
              <?php };
              unset($data);
              ?>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>

          </div>
        </div>

        <div class="modal-content">
          <div class="text-center mt-4">
            <h1>Bienvenue sur votre boutique enligne</h1>
            <h5>choisissez une boutique parmis nos merveilleuses boutiques et faites vos chooping </h5>
          </div>

          <div class="row mt-3">
            <?php
            foreach ($limitBoutiques as $data) {
            ?>
              <div class="col-3.5 text-center ml-4">
                <div class="card text-darck mb-3">
                  <div class="card-header"><?php echo $data['title']; ?></div>
                  <div class="card-body">
                    <img height="170" width="300" class="img-circle" src="images/<?php echo $data['img_bout']; ?>">
                  </div>
                  <button type="button" class="btn btn-warning"> <a href="./boutiques/boutique.php/?id_bou=<?php echo $data['id_bou']; ?>">faites vous shopping</a></button>
                </div>
              </div>
            <?php };
            unset($data); ?>
          </div>


        </div>

      </div>
    </div>

  </body>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>