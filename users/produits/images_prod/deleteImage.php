<?php
// cette page à pour objectif de supprimer une image d'un produit
session_start();
$user = $_SESSION['id_user'];

require_once('imageProdModel.php');

$images = new ImageProdModel();

$id_img = intval($_GET['id_img']);
$id_prod = intval($_GET['id_prod']);
if($id_img != ""){
$images->deleteImage($id_img);

echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Votre image à été supprimé avec succès!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  header("Location: ../../detailsProduit.php/?id_prod={$id_prod}");

} else {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  error lors de l\'la suppression de votre image, vérrifie que vous vous étes bien sur la bonne page!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}