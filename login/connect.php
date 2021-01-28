<?php

/* ***********************************************************************************
 Cette page  à pour objectif d'authentifié et de donné accés pour l'ensembles des
  utilisateur du site, et pour contrainte du temps j'ai traité un seul cas qui est le comérçant  
************************************************************************************** */

require_once('userModel.php');
$login = new UserModel();

$status = "";
$email_db="";
$password_db = "";
$email = $_POST['email'];
$password = $_POST['password'];
 session_start();

 // vérrifié s'il a le droit (inscrit)
$auth = $login->authenticate($email, $password);

   $email_db = $auth['email'];
   $password_db = $auth['password'];
   $role = $auth['role'];

 if($_SERVER['REQUEST_METHOD'] === 'POST'){

  if($email === $email_db && $password == $password_db){
    // construire les variables du session
    $_SESSION['email'] = $auth['email'];
    $_SESSION['id_user'] = $auth['id_user'];
    $_SESSION['nom'] = $auth['nom'];
    $_SESSION['prenom'] = $auth['prenom'];
    if($role === "1")// vérrifier si l'utilisateur est un admin du site 
    {
      $status = "connexion réussite";
      header("Location: ../users/homeUser.php");
      die();
    }
    else
    {
     if($role === "2") // vérrifier si l'utilisateur est un commerçant 
    {
 
      $status = "connexion réussite";
      header("Location: ../users/homeUser.php");
      die();
    }
    }
  }
  else
  {
    $status = "erreur de connexion!";
    echo('<script language="javascript">alert("votre émail ou mot de passe invalide !");</script>') ;
    header("Location: login.php");
      die();
  }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php if($status != "") { ?>
  <h1><?php echo $status; ?></h1>
  <?php } ?>
</body>
</html>

