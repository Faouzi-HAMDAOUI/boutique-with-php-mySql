<?php

/* ***********************************************************************************
 Cette page  à pour objectif d'afficher une boutique séléctionné par un visiteur, 
 et d'afficher aussi lenssemble d'image pour la boutique ainsi que ces produits
************************************************************************************** */

$id_bou = intval($_GET['id_bou']); //  récupérer mon paramétre passer dans l'url

// récupérer la boutique selectionné par le visiteur 
require_once('../users/boutiques/shopModel.php');
$shop = new BoutiqueModel();
$myShop = $shop->getMyBoutiqueById($id_bou);

// récupérer la listes des images pour la boutique séléctionné
require_once('../users/boutiques/images/imageModel.php');
$image = new ImageModel();
$myImage = $image->getMyImageById($id_bou);

// récupérer la listes des produits de la boutique séléctionné 
require_once('../users/produits/produitModel.php');
$product = new ProduitModel();
$myProduct = $product->getMyProduitById($id_bou);

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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#">Boutique En ligne</a>

          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto text-light form-inline my-2 my-lg-0">
              <li class="nav-item active">
                <a href="../../" class="btn btn-outline-success mr-2 my-2 my-sm-0" type="submit">Accueil
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li>
                <a href="../" class="btn btn-outline-success mr-2 my-2 my-sm-0" type="submit">Boutiques</a>
              </li>
              <li>
                <a href="../../produits/index.php?page=<?php echo 0; ?>" class="btn btn-outline-success mr-2 my-2 my-sm-0" type="submit">Produits</a>
              </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">

              <a href="../../login/login.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Connexion</a>
            </form>
          </div>
        </nav>
        <!-- ----------------------------End navbar------------------------------------ -->
        <!------------------------ file d'ariane------------------------------- -->
        <nav aria-label="breadcrumb" class="mt-1">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../../">Accueil</a></li>
            <li class="breadcrumb-item"><a href="../">Boutiques</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $myShop['title']; ?></li>

          </ol>
        </nav>
        <!------------------------ file d'ariane------------------------------- -->
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <?php
            // récupérer les images pour les affichés dans le carousel
            foreach ($myImage as $dataI) {
            ?>
              <li data-target="#carouselExampleCaptions" data-slide-to="<?php echo $data['id_img']; ?>"></li>
            <?php };
            unset($dataI); ?>
          </ol>

          <div class="carousel-inner">
            <div class="carousel-item active">
              <img width="700" height="450" src="../../images/<?php echo $myShop['img_bout']; ?>" class="d-block w-100" alt="...">

              <div class="carousel-caption d-none d-md-block">
                <h5><?php echo $myShop['title']; ?></h5>
                <p><?php echo $myShop['description']; ?></p>
              </div>
            </div>

            <?php
            // récupérer les images pour les affichés dans le carousel
            foreach ($myImage as $dataI) {
            ?>

              <div class="carousel-item">
                <img width="700" height="450" src="../../images/<?php echo $dataI['img']; ?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">

                </div>
              </div>
            <?php };
            unset($dataI);
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
          <h1>Bienvenue sur votre boutique : <?php echo $myShop['title']; ?></h1>
          <h5>Découvrir note gamme du produit, n'hésite pas à cliquer sur détails pour visualiser plus d'infos sur le produit... </h5>
        </div>

        <div class="row mt-3">
          <?php
          // récupérer la listes des produit pour la boutique séléctionné
          foreach ($myProduct as $dataP) {
          ?>
            <div class="col-3.5 text-center ml-4">
              <div class="card text-darck mb-3">
                <div class="card-header"><?php echo $dataP['name']; ?></div>
                <div class="card-body">
                  <img height="170" width="300" class="img-circle" src="../../images/<?php echo $dataP['img_prod']; ?>">
                </div>

                <button type="button" class="btn btn-warning"> <a href="../../produits/produit.php/?id_prod=<?php echo $dataP['id_prod']; ?>">Plus de détails...</a></button>
              </div>
            </div>
          <?php };
          unset($dataP); ?>
        </div>


      </div>

    </div>
  </div>

  <script src=" https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>