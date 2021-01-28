<?php
// cette page à pour objectif de supprimer une image d'une boutique par son utilisateur

require_once('imageModel.php');

$images = new ImageModel();

$id_img = intval($_GET['id_img']);
$id_bou = intval($_GET['id_bou']);

if($id_img != ""){

$images->deleteImage($id_img);

// echo('<script language="javascript">alert("Votre image à été supprimer avec succèes !");</script>') ;
	
// die();
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Votre image à été supprimé avec succès!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  header("Location: ../../detailsBoutique.php/?id_bou={$id_bou}");

} else {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  error lors de l\'la suppression de votre image, vérrifie que vous vous étes bien sur la bonne page!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}