<?php
// connexion à mySQL
require_once(dirname(__FILE__) . '../../../config/data_provider.php');

class BoutiqueModel extends DataProvider {

    public function __construct($id_user = "",$title = "", $img_bout = "", $adresse = "", $debut_sem = "", $fin_sem = "", $heur_debut = "", $heur_fin = "", $description = "")
    {   
        $this->id_user = $id_user; 
        $this->title = $title;
        $this->img_bout = $img_bout;
        $this->$adresse = $adresse;
        $this->debut_sem = $debut_sem;
        $this->fin_sem = $fin_sem;
        $this->heur_debut = $heur_debut;
        $this->heur_fin = $heur_fin;
        $this->description = $description;
    }

    // Ajouter une nouvelle boutique
    public function addBoutique($id_user, $title, $img_bout, $adresse, $debut_sem, $fin_sem, $heur_debut, $heur_fin, $description) {

       $db = $this->connect();

       if($db == null) {
           return;
       }

       $sql = "INSERT INTO boutiques (id_user, title, img_bout, adresse, debut_sem, fin_sem, heur_debut, heur_fin, description) VALUES (:id_user, :title, :img_bout, :adresse, :debut_sem, :fin_sem, :heur_debut, :heur_fin, :description)";
       
       $smt = $db->prepare($sql);

       $smt->execute([
           ":id_user" => $id_user,
           ":title" => $title,
           ":img_bout" => $img_bout,
           ":adresse" => $adresse,
           ":debut_sem" => $debut_sem,
           ":fin_sem" => $fin_sem,
           ":heur_debut" => $heur_debut,
           ":heur_fin" => $heur_fin,
           ":description" => $description
       ]);

       $UID = $db->lastInsertId(); // récupérer l'id de dernier élément ajouter 
      
       // télécharger et ajouter l'image de la boutique
        $infos_files = pathinfo($_FILES['img_bout']['name']);
        $upload_extension = $infos_files['extension'];
        $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG', 'bmp');

        if (in_array($upload_extension, $allowed_extensions)) {
            move_uploaded_file(
                $_FILES['img_bout']['tmp_name'],
                '../../images/img_bout' . $UID . '.' . $upload_extension
            );
            $db->query('UPDATE boutiques SET  img_bout = \'img_bout' . $UID . '.' . $upload_extension . '\'WHERE id_bou = ' . $UID);
        } 
       $smt = null;
       $db = null;

    }

    // récupérer toutes les boutique de site
    public function getAllBoutiques() {

        $db = $this->connect();

        if($db == null) {
            return;
        }

        $query = $db->query('SELECT * FROM boutiques');

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;

        return $data;
    }

    // récupérer les 6 premier boutique inseret dans la base de données
    public function getLimitBoutiques() {

        $db = $this->connect();

        if($db == null) {
            return;
        }

        $query = $db->query('SELECT * FROM boutiques LIMIT 6');

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;

        return $data;
    }

    // récupérer les boutique par utilisateur 
    public function getMyBoutiques($id_user) {

        $db = $this->connect();

        if($db == null) {
            return;
        }

        $query = "SELECT * FROM boutiques WHERE id_user = :id_user";
 
        $smt = $db->prepare($query);
 
        $smt->execute([
            ":id_user" => $id_user
        ]);

        $data = $smt->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;

        return $data;
    }
 // récupérer une boutique d'un utilisateur connecté
    public function getBoutiqueById($id_bou, $id_user) {
        $db = $this->connect();

        if($db == null) {
            return;
        }
 
        $sql = "SELECT * FROM boutiques WHERE id_bou = :id_bou AND id_user = :id_user ";
 
        $smt = $db->prepare($sql);
 
        $smt->execute([
            ":id_bou" => $id_bou,
            ":id_user" => $id_user
        ]);

        $data = $smt->fetch();
 
        $smt = null;
        $db = null;

        if(!$data) {
            return "Data not found 404";
        }

        return $data;
    }

    // récupérer une boutique pour un visiteur 
    public function getMyBoutiqueById($id_bou)
    {
        $db = $this->connect();

        if ($db == null) {
            return;
        }

        $sql = "SELECT * FROM boutiques WHERE id_bou = :id_bou ";

        $smt = $db->prepare($sql);

        $smt->execute([
            ":id_bou" => $id_bou
        ]);

        $data = $smt->fetch();

        $smt = null;
        $db = null;

        if (!$data) {
            return "Data not found 404";
        }

        return $data;
    }

 // modifier une boutique
    public function updateboutique($id_bou, $id_user, $title, $adresse, $debut_sem, $fin_sem, $heur_debut, $heur_fin, $description) {
      
        $db = $this->connect();

        if($db == null) {
            return;
        }
        $sql = "UPDATE boutiques SET id_user = :id_user ,title = :title, adresse = :adresse, debut_sem = :debut_sem, fin_sem = :fin_sem, heur_debut = :heur_debut, heur_fin = :heur_fin, description = :description WHERE id_bou = :id_bou";
 
        $smt = $db->prepare($sql);
 
        $smt->execute([
          ":id_bou" => $id_bou,
          ":id_user" => $id_user,
          ":title" => $title,
           ":adresse" => $adresse,
           ":debut_sem" => $debut_sem,
           ":fin_sem" => $fin_sem,
           ":heur_debut" => $heur_debut,
           ":heur_fin" => $heur_fin,
           ":description" => $description
           
           
        ]);

        if (isset($_FILES['img_bout']) AND $_FILES['img_bout']['error'] == 0 
        AND $_FILES['img_bout']['size'] <= 2000000000000)
     {   
          $infos_files = pathinfo($_FILES['img_bout']['name']);
          $upload_extension = $infos_files['extension'];
          $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png','JPG', 'JPEG', 'GIF', 'PNG', 'bmp');

  if (in_array($upload_extension, $allowed_extensions))
  {
      move_uploaded_file($_FILES['img_bout']['tmp_name'], 
      '../../images/img_bout'. $id_bou .'.'. $upload_extension);
    $db->query('UPDATE boutiques SET  img_bout = \'img_bout'. $id_bou .'.'. $upload_extension .'\'WHERE id_bou = ' . $id_bou );																				
  }  
}
 
        $smt = null;
        $db = null;
    }
    
    // supprimer une boutique
    public function deleteBoutique($id_bou) {
      
        $db = $this->connect();

        if($db == null) {
            return;
        }

        $req = $db->query('SELECT img_bout FROM boutiques WHERE id_bou = '.$id_bou.'');
        foreach( $req as $data)										
        {
            $img_bout = $data['img_bout'];
        }
        $req->closeCursor();
          // supprimer l'image de la boutique dans le dossier images               
        unlink("../../images/".$img_bout.""); 
        $sql = "DELETE FROM boutiques WHERE id_bou = :id_bou";
 
        $smt = $db->prepare($sql);
 
        $smt->execute([
            ":id_bou" => $id_bou
        ]);
 
        $smt = null;
        $db = null;
    }

}