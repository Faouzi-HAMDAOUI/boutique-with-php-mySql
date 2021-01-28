<?php
// cette page à pour objectif d'afficher un produit en détails

session_start();

$user = $_SESSION['id_user'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];

require_once('produitModel.php');

$product = new ProduitModel();

require_once('images_prod/imageProdModel.php');

$images = new ImageProdModel();

$id_prod = intval($_GET['id_prod']);

$data = $product->getProduitById($id_prod, $user);

$imgData = $images->getMyimages($id_prod, $user);

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
          <nav class="navbar navbar-dark bg-dark">
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
          <h1 class=" mt-4 text-center"><?php echo $data['name']; ?></h1>
          <div class="resultadeleteProd">
          </div>
          <div class="card mb-3">
            <img src="../../../images/<?php echo $data['img_prod']; ?>" width="400" height="300" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Prix: <?php echo $data['prix']; ?></h5>
              <p class="card-text"> <?php echo $data['description']; ?></p>
              <p class="card-text">
                <small class="text-muted">
                  <?php echo $data['disponible']; ?>
                </small>
              </p>
              <a id="deleteProd" href="../deleteProduit.php/?id_prod=<?php echo $data['id_prod']; ?>&id_bou=<?php echo $data['id_bou']; ?>">
                <span class="badge badge-pill badge-danger">Supprimer</span></a>
              <button data-toggle="modal" data-target="#updateProduct" data-whatever="@getbootstrap" class="badge badge-pill badge-success">Modifier</button>
            </div>
          </div>

          <h2 class="ml-3">La listes des photos pour ce produit :</h2>
          <div class="resultadeleteImage">
          </div>
          <div class="row ml-3 mb-2">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addImage" data-whatever="@getbootstrap">
              <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
              Nouvelle photo
            </button>
          </div>
          <!-- ------------------------- la listes des images de produit --------------------- -->

          <div id="cardProdImage" class="card-group mt-2">
            <?php
            foreach ($imgData as $imageData) {
            ?>
              <div class="col-4">
                <img width="600" height="270" src="../../../images/<?php echo $imageData['img']; ?>" class="card-img-top" alt="...">

                <a id="deleteImageProd" href="../images_prod/deleteImage.php/?id_img=<?php echo $imageData['id_img']; ?>&id_prod=<?php echo $imageData['id_prod']; ?>" class="badge badge-danger">Supprimer</a>
              </div>
            <?php };
            unset($imageData) ?>
          </div>

        </div>

        <!-- --------------------modifier un produit--------------------------- -->
        <div class="modal fade" id="updateProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modification d'un produit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="mb-2">* : Champs obligatoires!</p>
                <form class="updateProduct" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="hidden" class="form-control" value="<?php echo $data['id_prod']; ?>" name="id_prod" id="id_prod">
                    <input type="hidden" class="form-control" value="<?php echo $data['id_bou']; ?>" name="id_bou" id="id_bou">
                    <input type="hidden" class="form-control" value="<?php echo $user; ?>" name="id_user" id="id_user">
                    <label for="title" class="col-form-label">Nom*:</label>
                    <input type="text" class="form-control" value="<?php echo $data['name']; ?>" name="name" id="name" required>
                  </div>
                  <div class="form-group">
                    <img src="../../../images/<?php echo $data['img_prod']; ?>">
                    <label for="img" class="col-form-label">L'image par défaut de votre produit*:</label>
                    <input type="file" class="form-control" value="<?php echo $data['img_prod']; ?>" name="img_prod" id="img_prod">
                  </div>
                  <div class="form-group">
                    <label for="adresse" class="col-form-label">prix:</label>
                    <input type="text" class="form-control" value="<?php echo $data['prix']; ?>" name="prix" id="prix">
                  </div>
                  <div class="form-group">
                    <label for="debut_sem" class="col-form-label">Disponible:</label>
                    <select class="form-control" name="disponible" id="disponible">
                      <option value="non disponible">disponible</option>
                      <option value="<?php echo $data['disponible']; ?>">
                        <?php echo $data['disponible']; ?>
                      </option>
                      <option value="non disponible">non disponible</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="description" class="col-form-label">Description:</label>
                    <textarea class="form-control" name="description" id="description">
           <?php echo $data['description']; ?>
            </textarea>
                  </div>

              </div>
              <div id="resultSendProductU">
                <!-- Nous allons afficher un retour en jQuery pour la modification d'un produit -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Férmer</button>
                <button type="submit" id="submit" value="Valider" class="submit btn btn-primary">Valider</button>
              </div>
              </form>
            </div>
          </div>
        </div>


        <!-- -------------------------end modifier produit--------------------------------- -->

        <!-- ---------------------Ajouter une image pour un produit------------------------ -->
        <div class="modal fade" id="addImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Télécharger votre image:
                  <?php echo $data['name']; ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="mb-2">* : Champs obligatoires!</p>
                <form class="newImageProd" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?php echo $data['id_user']; ?>">
                    <input type="hidden" class="form-control" name="id_prod" id="id_prod" value="<?php echo $data['id_prod']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="img" class="col-form-label">L'image de produit*:</label>
                    <input type="file" class="form-control" name="images_prod" id="images_prod" required>
                  </div>

              </div>
              <div id="resultSendProductI">
                <!-- Nous allons afficher un retour en jQuery pour l'ajout d'une image -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Férmer</button>
                <button type="submit" id="submit" value="submit" class="submit btn btn-primary">Valider</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- -------------------------end ajout d'une image--------------------------------- -->
        <?php unset($data); ?>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="../detailsProduct.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>

</html>