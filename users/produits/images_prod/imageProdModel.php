<?php

require_once(dirname(__FILE__) . '../../../../config/data_provider.php');

class ImageProdModel extends DataProvider {

    public function __construct($id_prod = "", $id_user = "", $img = "")
    {   
        $this->id_prod = $id_prod;
        $this->id_user = $id_user;;
        $this->img = $img;
    }

    // Ajouter une image pour un produit
    public function addImage($id_prod, $id_user, $img) {

       $db = $this->connect();

       if($db == null) {
           return;
       }

       $sql = "INSERT INTO images_prod (id_prod, id_user, img) VALUES (:id_prod, :id_user, :img)";
       
       $smt = $db->prepare($sql);

       $smt->execute([
           ":id_prod" => $id_prod,
           ":id_user" => $id_user,
           ":img" => $img,
       ]);

       $UID = $db->lastInsertId();
if (isset($_FILES['images_prod']) AND $_FILES['images_prod']['error'] == 0 
AND $_FILES['images_prod']['size'] <= 200000000000000000000)
{   
   $infos_files = pathinfo($_FILES['images_prod']['name']);
   $upload_extension = $infos_files['extension'];
   $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png','JPG', 'JPEG', 'GIF', 'PNG', 'bmp');

     if (in_array($upload_extension, $allowed_extensions))
     {
         move_uploaded_file($_FILES['images_prod']['tmp_name'], 
         '../../../images/images_prod'. $UID .'.'. $upload_extension);
$db->query('UPDATE images_prod SET  img = \'images_prod'. $UID .'.'. $upload_extension .'\'WHERE id_img = ' . $UID );																				
     }  
}


       $smt = null;
       $db = null;

    }

// récupérer les images d'un produit par son utilisateur
    public function getMyimages($id_prod, $id_user) {

        $db = $this->connect();

        if($db == null) {
            return;
        }

        $query = "SELECT * FROM images_prod WHERE id_prod = :id_prod AND id_user = :id_user";
 
        $smt = $db->prepare($query);
 
        $smt->execute([
            ":id_prod" => $id_prod,
            ":id_user" => $id_user
        ]);

        $data = $smt->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;

        return $data;
    }

    // récupérer les images dun produit
    public function getMyimagesProduct($id_prod)
    {

        $db = $this->connect();

        if ($db == null) {
            return;
        }

        $query = "SELECT * FROM images_prod WHERE id_prod = :id_prod ";

        $smt = $db->prepare($query);

        $smt->execute([
            ":id_prod" => $id_prod
        ]);

        $data = $smt->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;

        return $data;
    }

    // récupérer les images d'un produit 
    public function getImageById($id_img, $id_user) {
        $db = $this->connect();

        if($db == null) {
            return;
        }
 
        $sql = "SELECT * FROM images_prod WHERE id_img = :id_img AND id_user = :id_user ";
 
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

 // supprimer une image pour un produit
    public function deleteImage($id_img) {
      
        $db = $this->connect();

        if($db == null) {
            return;
        }

        $req = $db->query('SELECT img FROM images_prod WHERE id_img = '.$id_img.'');
        foreach( $req as $data)										
        {
            $img = $data['img'];
        }
        $req->closeCursor();
                        
        unlink("../../../images/".$img."");
 
        $sql = "DELETE FROM images_prod WHERE id_img = :id_img";
 
        $smt = $db->prepare($sql);
 
        $smt->execute([
            ":id_img" => $id_img
        ]);
 
        $smt = null;
        $db = null;
    }

}