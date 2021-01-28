<?php
// cette page à pour objectif d'afficher une boutique en détails

session_start();

$user = $_SESSION['id_user'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];

require_once('shopModel.php');

$myShop = new BoutiqueModel();

require_once('images/imageModel.php');

$images = new ImageModel();

$id_bou = intval($_GET['id_bou']);

$data = $myShop->getBoutiqueById($id_bou, $user);

$imgData = $images->getMyimages($id_bou, $user);

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
              <a href="../../produits/allProducts.php?page=<?php echo 0; ?>" class="btn btn-outline-success mr-3 my-sm-0" type="button">Tous mes produits
              </a>
              <a class="btn btn-outline-success my-2 my-sm-0" href="../../../login/logOut.php">Déconnexion</a>
            </form>
          </nav>
          <!-- ----------------------------End navbar------------------------------------ -->
          <div class="resultDeleteShop"></div>
          <div id="resultat">
            <!-- Nous allons afficher les détails sur la boutique -->
          </div>
          <div id="afficher" class="afficher">
            <h1 class="ml-3"><?php echo $data['title']; ?></h1>

            <div class="card mb-3">
              <img src="../../../images/<?php echo $data['img_bout']; ?>" width="400" height="300" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"> <?php echo $data['adresse']; ?></h5>
                <p class="card-text"><?php echo $data['description']; ?></p>
                <p class="card-text">
                  <small class="text-muted">ouverture :
                    <?php echo $data['debut_sem']; ?>
                  </small>
                  <small class="text-muted">au
                    <?php echo $data['fin_sem']; ?>
                  </small>
                  <small class="text-muted">de <?php echo $data['heur_debut']; ?>
                  </small>
                  <small class="text-muted">jusuq'à <?php echo $data['heur_fin']; ?>
                  </small>
                </p>
                <div id="cardShop" class="justify-content-end">
                  <button data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" class="badge badge-pill badge-success">Modifier</button>

                  <a id="delete" href="../deleteBoutique.php/?id_bou=<?php echo $data['id_bou']; ?>"><span class="badge badge-pill badge-danger">Supprimer</span></a>

                  <a href="../../produits/produits.php/?id_bou=<?php echo $data['id_bou']; ?>"><span class="btn btn-outline-primary ">Voir tous ces produits</span></a>
                </div>

              </div>
            </div>

            <h2 class="ml-3">La listes des photos pour ma boutique</h2>
            <div class="resultadeleteImage"></div>
            <button type="button" class="btn btn-outline-primary mb-2 ml-3" data-toggle="modal" data-target="#addImage" data-whatever="@getbootstrap">
              <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
              nouvelle photo
            </button>
            <!-- -------------------------------------- la listes des images --------------------- -->

            <div class="card-group">
              <?php
              foreach ($imgData as $imageData) {
              ?>
                <div id="cardShopImage" class="col-4">
                  <img width="600" height="270" src="../../../images/<?php echo $imageData['img']; ?>" class="card-img-top" alt="...">

                  <a id="deleteImage" href="../images/deleteImage.php/?id_img=<?php echo $imageData['id_img']; ?>&id_bou=<?php echo $id_bou ?>" class="badge badge-danger justify-content-end mb-2">Supprimer</a>
                </div>
              <?php };
              unset($imageData) ?>
            </div>

          </div>

          <!-- --------------------Modifier ma beautique--------------------------- -->
        </div>



        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $data['title']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="mb-2">* : Champs obligatoires!</p>
                <form method="post" class="updateShop" id="updateShop" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="title" class="col-form-label">Titre*:</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $data['title']; ?>">
                  </div>
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="id_bou" id="id_bou" value="<?php echo $data['id_bou']; ?>" required>
                  </div>
                  <div class="form-group">
                    <img width="450" height="300" src="../../../images/<?php echo $data['img_bout']; ?>">
                    <label for="img_bout" class="col-form-label">L'image vitrine de votre beautique*:</label>
                    <input type="file" class="form-control" name="img_bout" id="img_bout" value="<?php echo $data['img_bout']; ?>" data-preview-file-type="any">
                  </div>
                  <div class="form-group">
                    <label for="adresse" class="col-form-label">Adresse*:</label>
                    <input type="text" class="form-control" name="adresse" id="adresse" value="<?php echo $data['adresse']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="debut_sem" class="col-form-label">Debut de la semaine:</label>
                    <select class="form-control" name="debut_sem" id="debut_sem">
                      <option value="<?php echo $data['debut_sem']; ?>">
                        <?php echo $data['debut_sem']; ?>
                      </option>
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
                      <option value="<?php echo $data['fin_sem']; ?>">
                        <?php echo $data['fin_sem']; ?>
                      </option>
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
                    <input type="time" class="form-control" name="heur_debut" id="heur_debut" value="<?php echo $data['heur_debut']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="heur_fin" class="col-form-label">Heur fin:</label>
                    <input type="time" class="form-control" name="heur_fin" id="heur_fin" value="<?php echo $data['heur_fin']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="description" class="col-form-label">Description:</label>
                    <textarea class="form-control" name="description" id="description"><?php echo $data['description']; ?>
            </textarea>
                  </div>

              </div>
              <div id="resultSend">
                <!-- Nous allons afficher un retour en jQuery pour j'ajout d'une boutique -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Férmer</button>
                <button type="submit" id="submit" value="Valider" class="submit btn btn-primary">Valider</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- -------------------------end modification beautique--------------------------------- -->

        <!-- -------------------------Ajouter une image--------------------------------- -->
        <div class="modal fade" id="addImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Télécharger votre image:
                  <?php echo $data['title']; ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="mb-3">* : Champs obligatoires!</p>
                <form method="post" id="addImageShop" class="addImageShop" action="../images/newPicture.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?php echo $data['id_user']; ?>">
                    <input type="hidden" class="form-control" name="id_bou" id="id_bou" value="<?php echo $data['id_bou']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="img" class="col-form-label">L'image vitrine de votre beautique*:</label>
                    <input type="file" class="form-control" name="img" id="img" required>
                  </div>

              </div>
              <div id="resultSendImage">
                <!-- Nous allons afficher un retour en jQuery pour j'ajout d'une image -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Férmer</button>
                <button type="submit" id="submit" value="Valider" class="submit btn btn-primary">Valider</button>
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
    <script type="text/javascript" src="../detailsShop.js">

    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>

</html>