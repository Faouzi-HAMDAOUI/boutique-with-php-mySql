<?php
// récupérer mes boutiques
session_start();

$user = $_SESSION['id_user'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];

require_once('./shopModel.php');
$boutique = new BoutiqueModel();

$myShops = $boutique->getMyBoutiques($user);

foreach ($myShops as $shop) {
?>
  <div class="card mb-3">
    <img src="../images/<?php echo $shop['img_bout']; ?>" width="400" height="300" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"> <?php echo $shop['title']; ?></h5>
      <p class="card-text"><?php echo $shop['description']; ?></p>
      <p class="card-text"><small class="text-muted"><?php echo $shop['adresse']; ?></small></p>
      <a href="boutiques/detailsBoutique.php/?id_bou=<?php echo $shop['id_bou']; ?>"><span class="btn btn-outline-info">Plus de détails...</span></a>
    </div>
  </div>
<?php };
unset($shop); ?>