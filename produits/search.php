<?php

/* ***********************************************************************************
 Cette page  à pour objectif d'afficher un produit rechercher par un visiteur 
************************************************************************************** */
$search = intval($_GET['search']);
//$search = htmlspecialchars(addslashes($_POST['search']));
// récupérer le produit rechercher
require_once('../users/produits/produitModel.php');
$produit = new ProduitModel();
$produits = $produit->searchProduit($search);

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
    <?php
    include('../header/navbar.php');
    ?>
    <div class="modal-content">
      <a href="index.php?page=<?php echo 0; ?>" class="ml-2 mt-4">Retour</a>
      <div class="row mt-3">

        <?php
        // afficher tous les produits rechercher
        foreach ($produits as $dataS) {
        ?>
          <div class="col-3.5 text-center ml-4">
            <div class="card text-darck mb-3">
              <div class="card-header"><?php echo $dataS['name']; ?></div>
              <div class="card-body">
                <img height="170" width="300" class="img-circle" src="../images/<?php echo $dataS['img_prod']; ?>">
                <p>Prix: <?php echo $dataS['prix']; ?></p>
              </div>
              <button type="button" class="btn btn-warning"> <a href="produit.php/?id_prod=<?php echo $dataS['id_prod']; ?>">Plus de détails...</a></button>
            </div>
          </div>
        <?php };
        unset($dataS); ?>
      </div>

    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>