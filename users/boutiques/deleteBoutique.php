<?php
// cette page à pour objectif de supprimer une boutique par son utilisateur

require_once('shopModel.php');

$boutique = new BoutiqueModel();

$id_bou = intval($_GET['id_bou']);
if ($id_bou != "") {
$boutique->deleteBoutique($id_bou);

// echo('<script language="javascript">alert("Votre boutique a ete supprimer avec succees !");</script>') ;

// die();
 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Votre boutique à été supprimé avec succès!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  header("Location: ../../homeUser.php");

} else {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  error lors de l\'la suppression de votre boutique, vérrifie que vous vous étes bien sur la bonne page!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}