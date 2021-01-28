<?php
// connexion à mySQL
require_once(dirname(__FILE__) . '../../config/data_provider.php');

class UserModel extends DataProvider {

    public function __construct($email = "", $password = "", $nom = "", $prenom = "", $adresse = "", $tel = "", $role = "")
    {
        $this->email = $email;
        $this->password = $password;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->tel = $tel;
        $this->role = $role;
    }

    // crée un utilisateur
    public function createUsers($nom, $prenom, $adresse, $tel, $email, $password, $role) {

      $db = $this->connect();

      if($db == null) {
          return;
      }

      $sql = "INSERT INTO users (nom, prenom, adresse, tel, email, password, role ) VALUES (:nom, :prenom, :adresse, :tel, :email, :password, :role)";
      
      $smt = $db->prepare($sql);

      $smt->execute([
          ":nom" => $nom,
          ":adresse" => $adresse,
          ":tel" => $tel,
          ":prenom" => $prenom,
          ":email" => $email,
          ":password" => $password,
          ":role" => $role

      ]);

      $smt = null;
      $db = null;

   }

   // authentifié un utilisateur
    public function authenticate($email, $password) {

      $db = $this->connect();

      if($db == null) {
          return;
      }
      $sql = "SELECT * FROM users WHERE (email = :email) AND (password = :password)";

      $smt = $db->prepare($sql);
 
        $smt->execute([
            ":email" => $email,
            ":password" => $password,
        ]);

        $data = $smt->fetch();
 
        $smt = null;
        $db = null;

        if(!$data) {
            return "Data not found 404";
        }

        return $data;
  }

// vérrifier si ya une session ouverte sinon rediriger vers la page de connexion
  public function checkAuthenticate(){

    if(!isset($_SESSION['email']))
    {
      header("Location: ../login/login.php");
      die();
    }
  }

}
?>