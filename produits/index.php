<?php

/* ***********************************************************************************
 Cette page  à pour objectif d'afficher tous les produit du site et de
  donner la main au visiteur d'éfféctué une recherche aussi 
************************************************************************************** */
$page = intval($_GET['page']);
// récupérer tous les produits du site
require_once('../users/produits/produitModel.php');
$produit = new ProduitModel();
$produits = $produit->getAllproduits($page);

$nbreProduits = $produit->getNbreProduits();
$nb_prods  = 0;

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

    <div class="modal-content">
      <?php
      include('../header/navbar.php');
      ?>
      <!------------------------ file d'ariane------------------------------- -->
      <nav aria-label="breadcrumb" class="mt-2">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../">Accueil</a></li>
          <li class="breadcrumb-item active" aria-current="page">Produits</li>

        </ol>
      </nav>
      <!------------------------ file d'ariane------------------------------- -->
      <h1 class="mt-4 ml-2">La listes de tous nos produits :</h1>

      <form class="form-inline mt-4 ml-2" action="search.php">
        <input class="form-control mr-sm-2" name="search" id="search" type="text" placeholder="Rechercher un produit..." aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
          Rechercher
        </button>
      </form>
      <div class="row mt-3">
        <?php
        // afficher tous les produits
        foreach ($produits as $data) {
        ?>
          <div class="col-3.5 text-center ml-4">
            <div class="card text-darck mb-3">
              <div class="card-header"><?php echo $data['name']; ?></div>
              <div class="card-body">
                <img height="170" width="300" class="img-circle" src="../images/<?php echo $data['img_prod']; ?>">
                <p>Prix: <?php echo $data['prix']; ?></p>
              </div>
              <button type="button" class="btn btn-warning"> <a href="produit.php/?id_prod=<?php echo $data['id_prod']; ?>">Plus de détails...</a></button>
            </div>
          </div>
        <?php };
        unset($data); ?>
      </div>
      <!-- ----------------Afficher ma pagination-------------------------- -->
      <div class="row align-self-center mt-5">
        <nav>
          <ul class="pagination pagination">

            <?php
            foreach ($nbreProduits as $nb_prod) {
              $nb_prods++;
            }

            if ($nb_prods % 6 == 0) {
              for ($h = 1; $h <= ($nb_prods / 6); $h++) {
            ?>
                <li class="page-item" aria-current="page">
                  <span class="page-link">
                    <a href="index.php?page=<?php echo (($h - 1) * 6) ?>">Page 0<?php echo  $h; ?>
                    </a>
                    <span class="sr-only">(current)</span>
                  </span>

                </li>
              <?php
              }
            } else {
              for ($h = 1; $h <= (($nb_prods / 6) + 1); $h++) {

              ?>
                <li class="page-item">
                  <a class="page-link" href="index.php?page=<?php echo (($h - 1) * 6) ?> ">Page 0<?php echo $h; ?></a>
                </li>
            <?php
              }
            }
            ?>

          </ul>
        </nav>

      </div>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>