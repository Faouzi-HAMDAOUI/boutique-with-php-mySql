<?php
session_start();
require_once('shopModel.php');


$user = $_SESSION['id_user'];

$updateBoutique = new BoutiqueModel();
if (!empty($_POST['title']) && !empty($_POST['adresse'])) {	
$title=htmlspecialchars(addslashes($_POST['title']));
$id_bou=htmlspecialchars(addslashes($_POST['id_bou']));
$adresse=htmlspecialchars(addslashes($_POST['adresse']));
$debut_sem=htmlspecialchars(addslashes($_POST['debut_sem']));
$fin_sem=htmlspecialchars(addslashes($_POST['fin_sem']));
$heur_debut=htmlspecialchars(addslashes($_POST['heur_debut']));
$heur_fin=htmlspecialchars(addslashes($_POST['heur_fin']));
$description=htmlspecialchars(addslashes($_POST['description']));

$updateBoutique->updateboutique($id_bou, $user,$title, $adresse, $debut_sem, $fin_sem, $heur_debut, $heur_fin, $description);

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Votre boutique à été ajouté avec succes!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
// header("Location: detailsBoutique.php/?id_bou=$id_bou");	
// die();

}else {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  error lors de l\'ajout de votre boutique, vérrifie que vous avez bien remplir vos champs!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

