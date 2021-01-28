<?php
// cette page à pour objectif de récupérer tous les produits par ces utilisateurs
session_start();

$user = $_SESSION['id_user'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];

$page = intval($_GET['page']);

require_once('../../login/userModel.php');
$login = new UserModel();
$login->checkAuthenticate();

require_once('./produitModel.php');
$produits = new ProduitModel();
$products = $produits->getAllproduits($page);

$nbreProduits = $produits->getNbreProduits();
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
    <div class="row">
      <div class="modal-content">
        <!-- ----------------------------navbar------------------------------------ -->
        <nav class="navbar navbar-dark bg-dark">
          <a class="navbar-brand"><?php echo $nom; ?> <?php echo $prenom; ?></a>
          <form class="form-inline">
            <a href="../homeUser.php" class="btn btn-outline-success mr-3" type="button">Accueil
            </a>
            <a href="#" class="btn btn-outline-success mr-3 my-sm-0" type="button">Tous mes produits
            </a>
            <a class="btn btn-outline-success my-2 my-sm-0" href="../../login/logOut.php">Déconnexion</a>
          </form>
        </nav>
        <!-- ----------------------------End navbar------------------------------------ -->
        <h1 class="mt-4"> La listes de tous mes produits: </h1>
        <div class="row">
          <?php
          foreach ($products as $product) {
          ?>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $product['name']; ?></h5>
                  <img height="350" width="500" src="../../images/<?php echo $product['img_prod']; ?>">
                </div>
                <p class="mb-2 ml-3">

                  <span>Prix: <?php echo $product['prix']; ?> </span> |
                  <span> <?php echo $product['disponible']; ?></span>
                </p>
                <a href="./detailsProduit.php/?id_prod=<?php echo $product['id_prod']; ?>"><span class="btn btn-outline-primary ml-3 mb-1">Voir plus...</span></a>
              </div>
            </div>
          <?php };
          unset($product); ?>
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
                  <li class="page-item active" aria-current="page">
                    <span class="page-link">
                      <a href="allProducts.php?page=<?php echo (($h - 1) * 6) ?>">Page 0<?php echo  $h; ?>
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
                    <a class="page-link" href="allProducts.php?page=<?php echo (($h - 1) * 6) ?> ">Page 0<?php echo $h; ?></a>
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
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>