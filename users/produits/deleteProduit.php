<?php
// cette page à pour objectif de supprimer un produit
require_once('produitModel.php');

$produit = new ProduitModel();

$id_prod = intval($_GET['id_prod']);
$id_bou = intval($_GET['id_bou']);

if($id_prod != ""){
$produit->deleteProduit($id_prod);

echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Votre image à été supprimé avec succès!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  header("Location: ../produits.php/?id_bou={$id_bou}");

} else {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  error lors de l\'la suppression de votre image, vérrifie que vous vous étes bien sur la bonne page!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}