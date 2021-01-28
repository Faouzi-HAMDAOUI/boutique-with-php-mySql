<?php
// cette page à pour objectif d'ajouter une nouvelle boutique

session_start();
require_once('shopModel.php');


$user = $_SESSION['id_user'];

$newBoutique = new BoutiqueModel();
if (!empty($_POST['title']) && !empty($_POST['adresse'])) {
  $title = htmlspecialchars(addslashes($_POST['title']));
  $img_bout = '';
  $adresse = htmlspecialchars(addslashes($_POST['adresse']));
  $debut_sem = htmlspecialchars(addslashes($_POST['debut_sem']));
  $fin_sem = htmlspecialchars(addslashes($_POST['fin_sem']));
  $heur_debut = htmlspecialchars(addslashes($_POST['heur_debut']));
  $heur_fin = htmlspecialchars(addslashes($_POST['heur_fin']));
  $description = htmlspecialchars(addslashes($_POST['description']));

  $newBoutique->addBoutique($user, $title, $img_bout, $adresse, $debut_sem, $fin_sem, $heur_debut, $heur_fin, $description);
  

  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  Votre boutique à été ajouté avec succès!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

} else {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  error lors de l\'ajout de votre boutique, vérrifie que vous avez bien remplir vos champs!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
