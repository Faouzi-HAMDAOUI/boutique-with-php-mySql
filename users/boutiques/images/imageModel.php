<?php

// connexion à mySQL
require_once(dirname(__FILE__) . '../../../../config/data_provider.php');

class ImageModel extends DataProvider {

    public function __construct($id_bou = "", $id_user = "", $img = "")
    {   
        $this->id_bou = $id_bou;
        $this->id_user = $id_user;;
        $this->img = $img;
    }

   // Ajouter une image pour une boutique
    public function addImage($id_bou, $id_user, $img) {

       $db = $this->connect();

       if($db == null) {
           return;
       }

       $sql = "INSERT INTO images (id_bou, id_user, img) VALUES (:id_bou, :id_user, :img)";
       
       $smt = $db->prepare($sql);

       $smt->execute([
           ":id_bou" => $id_bou,
           ":id_user" => $id_user,
           ":img" => $img,
       ]);

       $UID = $db->lastInsertId();
        if (isset($_FILES['img']) AND $_FILES['img']['error'] == 0 
         AND $_FILES['img']['size'] <= 200000000000000000000)
          {   
             $infos_files = pathinfo($_FILES['img']['name']);
             $upload_extension = $infos_files['extension'];
             $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png','JPG', 'JPEG', 'GIF', 'PNG', 'bmp');

         if (in_array($upload_extension, $allowed_extensions))
         {
move_uploaded_file($_FILES['img']['tmp_name'], '../../../images/img'. $UID .'.'. $upload_extension);
$db->query('UPDATE images SET  img = \'img'. $UID .'.'. $upload_extension .'\'WHERE id_img = ' . $UID );																				
     }  
}
       $smt = null;
       $db = null;

    }

    // récupérer les images d'une boutique 
    public function getMyimages($id_bou, $id_user) {

        $db = $this->connect();

        if($db == null) {
            return;
        }

        $query = "SELECT * FROM images WHERE id_bou = :id_bou AND id_user = :id_user";
 
        $smt = $db->prepare($query);
 
        $smt->execute([
            ":id_bou" => $id_bou,
            ":id_user" => $id_user
        ]);

        $data = $smt->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;

        return $data;
    }

    public function getImageById($id_img, $id_user) {
        $db = $this->connect();

        if($db == null) {
            return;
        }
 
        $sql = "SELECT * FROM images WHERE id_img = :id_img AND id_user = :id_user ";
 
        $smt = $db->prepare($sql);
 
        $smt->execute([
            ":id_img" => $id_img,
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
    
    // récupérer les images d'une boutique (pour la partie visiteur )
    public function getMyImageById($id_bou)
    {

        $db = $this->connect();

        if ($db == null) {
            return;
        }

        $query = "SELECT * FROM images WHERE id_bou = :id_bou ";

        $smt = $db->prepare($query);

        $smt->execute([
            ":id_bou" => $id_bou
        ]);

        $data = $smt->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;

        return $data;
    }
 
    // supprimer une image pour une boutique
    public function deleteImage($id_img) {
      
        $db = $this->connect();

        if($db == null) {
            return;
        }

        $req = $db->query('SELECT img FROM images WHERE id_img = '.$id_img.'');
        foreach( $req as $data)										
        {
            $img = $data['img'];
        }
        $req->closeCursor();
                        
        unlink("../../../images/".$img."");
 
        $sql = "DELETE FROM images WHERE id_img = :id_img";
 
        $smt = $db->prepare($sql);
 
        $smt->execute([
            ":id_img" => $id_img
        ]);
 
        $smt = null;
        $db = null;
    }

}