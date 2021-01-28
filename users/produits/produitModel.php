<?php
// connexion à mySQL
require_once(dirname(__FILE__) . '../../../config/data_provider.php');

class ProduitModel extends DataProvider {

    public function __construct($id_bou = "",$id_user = "", $name = "" , $prix = "", $img_prod = "", $disponible = "", $description = "")
    {   
        $this->id_bou = $id_bou; 
        $this->id_user = $id_user;
        $this->name = $name;
        $this->prix = $prix;
        $this->$img_prod = $img_prod;
        $this->disponible = $disponible;
        $this->description = $description;
    }
 // Ajouter un produit
    public function addProduit($id_bou, $id_user, $name, $prix, $img_prod, $disponible, $description) {

       $db = $this->connect();

       if($db == null) {
           return;
       }

       $sql = "INSERT INTO produits (id_bou, id_user, name, prix, img_prod, disponible, description) VALUES (:id_bou, :id_user, :name, :prix, :img_prod, :disponible, :description)";
       
       $smt = $db->prepare($sql);

       $smt->execute([
           ":id_bou" => $id_bou,
           ":id_user" => $id_user,
           ":name" => $name,
           ":prix" => $prix,
           ":img_prod" => $img_prod,
           ":disponible" => $disponible,
           ":description" => $description
       ]);

       $UID = $db->lastInsertId();
       if (isset($_FILES['img_prod']) AND $_FILES['img_prod']['error'] == 0 
       AND $_FILES['img_prod']['size'] <= 200000000000000000000)
       {  

   $infos_files = pathinfo($_FILES['img_prod']['name']);
   $upload_extension = $infos_files['extension'];
   $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png','JPG', 'JPEG', 'GIF', 'PNG', 'bmp');

       if (in_array($upload_extension, $allowed_extensions))
        {

move_uploaded_file($_FILES['img_prod']['tmp_name'], '../../images/img_prod'. $UID .'.'. $upload_extension);
$db->query('UPDATE produits SET  img_prod = \'img_prod'. $UID .'.'. $upload_extension .'\'WHERE id_prod = ' . $UID );																				
     }  
}
       $smt = null;
       $db = null;

    }
    
    // récupérer tous les produits par page de 6 produits
    public function getAllproduits($page) {

        $db = $this->connect();

        if($db == null) {
            return;
        }

        $query = $db->query('SELECT * FROM produits LIMIT ' . $page . ', 6');

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;

        return $data;
    }

    public function getNbreProduits()
    {

        $db = $this->connect();

        if ($db == null) {
            return;
        }

        $query = $db->query('SELECT * FROM produits ');

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;

        return $data;
    }
     
    // récupérer tous les produit d'une boutique séléctionné par sont utilisateur
    public function getMyproduits($id_bou, $id_user) {

        $db = $this->connect();

        if($db == null) {
            return;
        }

        $query = "SELECT * FROM produits WHERE id_bou = :id_bou AND id_user = :id_user";
 
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
    
    // récupérer un produit par son utilisateur
    public function getProduitById($id_prod, $id_user) {
        $db = $this->connect();

        if($db == null) {
            return;
        }
 
        $sql = "SELECT * FROM produits WHERE id_prod = :id_prod AND id_user = :id_user ";
 
        $smt = $db->prepare($sql);
 
        $smt->execute([
            ":id_prod" => $id_prod,
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

    // récupérer un produit par un visiteur
    public function getOnProduitById($id_prod)
    {
        $db = $this->connect();

        if ($db == null) {
            return;
        }

        $sql = "SELECT * FROM produits WHERE id_prod = :id_prod ";

        $smt = $db->prepare($sql);

        $smt->execute([
            ":id_prod" => $id_prod
        ]);

        $data = $smt->fetch();

        $smt = null;
        $db = null;

        if (!$data) {
            return "Data not found 404";
        }

        return $data;
    }
    
    // récupérer les produits d'une boutique séléctionné par un visiteur 
    public function getMyProduitById($id_bou)
    {

        $db = $this->connect();

        if ($db == null) {
            return;
        }

        $query = "SELECT * FROM produits WHERE id_bou = :id_bou ";

        $smt = $db->prepare($query);

        $smt->execute([
            ":id_bou" => $id_bou
        ]);

        $data = $smt->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;

        return $data;
    }

    // chercher un produit par nom ou sa description
    public function searchProduit($search) {
       
        $db = $this->connect();

        if($db == null) {
            return;
        }

        $query= "SELECT * FROM produits WHERE name LIKE '%$search%' OR description LIKE '%$search%' ";
 
        $smt = $db->prepare($query);
 
        $smt->execute([
            ":search" => $search
        ]);

        $data = $smt->fetchAll(PDO::FETCH_ASSOC);

        $query = null;

        $db = null;
        if (!$data) {
            return [];
        }

        return $data;
    }

    // Modifier un produit par sont utilisateur
    public function updateProduit($id_prod, $id_bou, $id_user, $name, $prix, $disponible, $description) {
      
        $db = $this->connect();

        if($db == null) {
            return;
        }

       
 
        $sql = "UPDATE produits SET id_bou = :id_bou ,id_user = :id_user, name = :name, prix = :prix, disponible = :disponible, description = :description WHERE id_prod = :id_prod";
 
        $smt = $db->prepare($sql);
 
        $smt->execute([
          ":id_prod" => $id_prod,
          ":id_bou" => $id_bou,
          ":id_user" => $id_user,
          ":name" => $name,
          ":prix" => $prix,
           ":disponible" => $disponible,
           ":description" => $description
           
           
        ]);

        if (isset($_FILES['img_prod']) AND $_FILES['img_prod']['error'] == 0 
        AND $_FILES['img_prod']['size'] <= 2000000000000)
     {   
$infos_files = pathinfo($_FILES['img_prod']['name']);
$upload_extension = $infos_files['extension'];
$allowed_extensions = array('jpg', 'jpeg', 'gif', 'png','JPG', 'JPEG', 'GIF', 'PNG', 'bmp');

  if (in_array($upload_extension, $allowed_extensions))
  {
      move_uploaded_file($_FILES['img_prod']['tmp_name'], 
      '../../images/img_prod'. $id_prod .'.'. $upload_extension);
    $db->query('UPDATE produits SET  img_prod = \'img_prod'. $id_prod .'.'. $upload_extension .'\'WHERE id_prod = ' . $id_prod );																				
  }  
}
 
        $smt = null;
        $db = null;
    }

    // supprimer un produit
    public function deleteProduit($id_prod) {
      
        $db = $this->connect();

        if($db == null) {
            return;
        }

        $req = $db->query('SELECT name FROM produits WHERE id_prod = '.$id_prod.'');
        foreach( $req as $data)										
        {
            $img = $data['img_prod'];
        }
        $req->closeCursor();
                        
        unlink("../../images/".$img."");
 
        $sql = "DELETE FROM produits WHERE id_prod = :id_prod";
 
        $smt = $db->prepare($sql);
 
        $smt->execute([
            ":id_prod" => $id_prod
        ]);
 
        $smt = null;
        $db = null;
    }

}