<?php

/* ***********************************************************************************
 Cette page  à pour objectif d'afficher une produit en détails séléctionné par un 
 visiteur, et d'afficher aussi lenssemble d'image pour ce produit
************************************************************************************** */

// récupérer le paramétre passer en ULR
$id_prod = intval($_GET['id_prod']);

require_once('../users/produits/produitModel.php');
$product = new ProduitModel();
$data = $product->getOnProduitById($id_prod);

require_once('../users/produits/images_prod/imageProdModel.php');
$images = new ImageProdModel();
$imgData = $images->getMyimagesProduct($id_prod);

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
              <a href="../../boutiques/" class="btn btn-outline-success mr-2 my-2 my-sm-0" type="submit">Boutiques</a>
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

      <div class="modal-content">
        <!------------------------ file d'ariane------------------------------- -->
        <nav aria-label="breadcrumb" class="mt-2">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../../">Accueil</a></li>
            <li class="breadcrumb-item"><a href="../?page=<?php echo 0; ?>">Produits</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $data['name']; ?></li>

          </ol>
        </nav>
        <!------------------------ file d'ariane------------------------------- -->

        <!-- le card de mon produit -->
        <div class="card mb-3 ">
          <div class="row no-gutters mt-5">
            <div class="col-md-4">
              <img height="300" src="../../images/<?php echo $data['img_prod']; ?>" class="card-img" alt="...">
              <h1 class="ml-4">Prix : <?php echo $data['prix']; ?> euros</h1>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h3 class="card-title mb-2"><?php echo $data['name']; ?></h3>
                <p class="card-text mb-4"><?php echo $data['description']; ?>.</p>
                <p class="card-text mt-4"><small class="text-muted">Ce produis est : <?php echo $data['disponible']; ?> dans la boutique</small></p>
              </div>
            </div>
          </div>
        </div>

        <!-- End Card de mon produit  -->

        <h2>Plus d'images sur le produit :</h2>

        <!-- -------------------------------------- la listes des images --------------------- -->

        <div class="card-group mt-2">
          <?php
          foreach ($imgData as $imageData) {
          ?>
            <div class="col-4">
              <img width="600" height="270" src="../../images/<?php echo $imageData['img']; ?>" class="card-img-top" alt="...">
            </div>
          <?php };
          unset($imageData) ?>
        </div>

      </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="../detailsProduct.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>

</html>