<?php
session_start();

$user = $_SESSION['id_user'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];

require_once('shopModel.php');

$myShop = new BoutiqueModel();

require_once('./images/imageModel.php');

$images = new ImageModel();

$id_bou = intval($_GET['id_bou']);

$data = $myShop->getBoutiqueById($id_bou, $user);

$imgData = $images->getMyimages($id_bou, $user);
?>
<h1><?php echo $data['title']; ?></h1>

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
    <a href="../../produits/produits.php/?id_bou=<?php echo $data['id_bou']; ?>"><span class="badge badge-primary">Produits</span></a>
    <a href="../deleteBoutique.php/?id_bou=<?php echo $data['id_bou']; ?>"><span class="badge badge-pill badge-danger">Supprimer</span></a>
    <button data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" class="badge badge-pill badge-success">Modifier</button>

  </div>
</div>

<h2>La listes des photos pour ma boutique</h2>
<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addImage" data-whatever="@getbootstrap">
  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
  nouvelle photo
</button>
<!-- -------------------------------------- la listes des images --------------------- -->

<div class="card-group">
  <?php
  foreach ($imgData as $imageData) {
  ?>
    <div class="col-4">
      <img width="600" height="270" src="../../../images/<?php echo $imageData['img']; ?>" class="card-img-top" alt="...">

      <a href="../images/deleteImage.php/?id_img=<?php echo $imageData['id_img']; ?>" class="badge badge-danger">Supprimer</a>
    </div>
  <?php };
  unset($imageData) ?>
</div>

</div>

<!-- --------------------Modifier ma beautique--------------------------- -->



<?php unset($data); ?>