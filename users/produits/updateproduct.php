<?php
// cette page à pour objectif de modifier un produit

session_start();

require_once('produitModel.php');

$id_user = $_SESSION['id_user'];

$produit = new ProduitModel();
if (!empty($_POST['name']) && !empty($_POST['prix']) && !empty($_POST['id_bou']))
{	
$id_prod=htmlspecialchars(addslashes($_POST['id_prod']));
$name=htmlspecialchars(addslashes($_POST['name']));
$id_bou=htmlspecialchars(addslashes($_POST['id_bou']));

$prix=htmlspecialchars(addslashes($_POST['prix']));
$disponible=htmlspecialchars(addslashes($_POST['disponible']));
$description=htmlspecialchars(addslashes($_POST['description']));

$produit->updateProduit($id_prod, $id_bou, $id_user, $name, $prix, $disponible, $description);

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Votre produit à été modifié avec succés!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
} else {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  error lors de  la modification de votre produit, vérrifie que vous avez bien remplir vos champs!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}