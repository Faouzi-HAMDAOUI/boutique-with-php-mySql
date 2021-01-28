<?php
// cette page à pour objectif d'ajouter une image pour un produit
session_start();
$user = $_SESSION['id_user'];
require_once('imageProdModel.php');

$newImage = new ImageProdModel();
if (!empty($_POST['id_prod'])){	
$id_prod=htmlspecialchars(addslashes($_POST['id_prod']));
$img='';
$id_user=htmlspecialchars(addslashes($_POST['id_user']));


$newImage->addImage($id_prod, $id_user, $img);

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Votre image à été ajouter avec succes!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
} else {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  error lors de  l\'ajout de votre image, vérrifie que votre image à bien été télécharger!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

