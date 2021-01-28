<?php
session_start();

$user = $_SESSION['id_user'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];

require_once('../../login/userModel.php');
$login = new UserModel();
$login->checkAuthenticate();

$id_bou = intval($_GET['id_bou']);
require_once('./produitModel.php');
$produits = new ProduitModel();
$products = $produits->getMyproduits($id_bou, $user);

require_once('../boutiques/shopModel.php');
$boutique = new BoutiqueModel();
$myShop = $boutique->getBoutiqueById($id_bou, $user);

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
        <nav class="navbar navbar-dark bg-dark mb-4">
          <a class="navbar-brand"><?php echo $nom; ?> <?php echo $prenom; ?></a>
          <form class="form-inline">
            <a href="../../homeUser.php" class="btn btn-outline-success mr-3" type="button">Accueil
            </a>
            <a href="../allProducts.php?page=<?php echo 0; ?>" class="btn btn-outline-success mr-3 my-sm-0" type="button">Tous mes produits
            </a>
            <a class="btn btn-outline-success my-2 my-sm-0" href="../../../login/logOut.php">Déconnexion</a>
          </form>
        </nav>
        <!-- ----------------------------End navbar------------------------------------ -->
        <h1 class="mt-1 ml-3"> la listes de tous les produits sur la boutique : <?php echo $myShop['title']; ?></h1>
        <div class="row ml-3 mb-2">
          <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addProduct" data-whatever="@getbootstrap">
            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
            Ajouter un produit
          </button>
        </div>
        <div class="row">
          <?php
          foreach ($products as $product) {
          ?>
            <div class="col-sm-6">
              <div class="card ml-2 mr-2 mb-3">
                <div class="card-body text-center">
                  <h5 class="card-title"><?php echo $product['name']; ?></h5>
                  <img height="350" width="500" src="../../../images/<?php echo $product['img_prod']; ?>">
                </div>
                <p class="mb-2 ml-3">

                  <span>Prix: <?php echo $product['prix']; ?> </span> |
                  <span> <?php echo $product['disponible']; ?></span>
                </p>
                <a href="../detailsProduit.php/?id_prod=<?php echo $product['id_prod']; ?>"><span class="btn btn-outline-primary ml-3 mb-1">Voir plus...</span></a>
              </div>
            </div>
          <?php };
          unset($product); ?>
        </div>
      </div>

      <!-- --------------------ajouter un nouveau produit--------------------------- -->

      <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nouveau produit</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="mb-2">* : Champs obligatoires!</p>
              <form class="newProduct" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="hidden" class="form-control" value="<?php echo $id_bou; ?>" name="id_bou" id="id_bou">
                  <input type="hidden" class="form-control" value="<?php echo $user; ?>" name="id_user" id="id_user">
                  <label for="title" class="col-form-label">Nom*:</label>
                  <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                  <label for="img" class="col-form-label">L'image de votre produit*:</label>
                  <input type="file" class="form-control" name="img_prod" id="img_prod" required>
                </div>
                <div class="form-group">
                  <label for="adresse" class="col-form-label">prix:</label>
                  <input type="text" class="form-control" name="prix" id="prix">
                </div>
                <div class="form-group">
                  <label for="debut_sem" class="col-form-label">Disponible:</label>
                  <select class="form-control" name="disponible" id="disponible">
                    <option value="disponible">disponible</option>
                    <option value="non disponible">non disponible</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="description" class="col-form-label">Description:</label>
                  <textarea class="form-control" name="description" id="description"></textarea>
                </div>

            </div>
            <div id="resultSendProduct">
              <!-- Nous allons afficher un retour en jQuery pour j'ajout d'une boutique -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Férmer</button>
              <button type="submit" id="Valider" name="Valider" value="Valider" class="btn btn-primary">Valider</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- -------------------------end ajout produit--------------------------------- -->

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="../product.js"></script>
  <script script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>