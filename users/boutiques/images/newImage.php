<?php
// cette page à pour objectif d'ajouter une nouvelle image pour une boutique

session_start();
require_once('imageModel.php');

$user = $_SESSION['id_user'];

$newImage = new ImageModel();
if (!empty($_POST['id_bou'])){	
$id_bou=htmlspecialchars(addslashes($_POST['id_bou']));
$img='';
$id_user=htmlspecialchars(addslashes($_POST['id_user']));


$newImage->addImage($id_bou, $id_user, $img);

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Votre image à été ajouté avec succès!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
} else {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  error lors de l\'ajout de votre image, vérrifie que vous avez bien télécharger votre image!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}


