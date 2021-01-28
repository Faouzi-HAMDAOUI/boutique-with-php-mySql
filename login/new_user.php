<?php
/* ***********************************************************************************
 Cette page  est utliser comme une action pour le formulaire d'inscription
************************************************************************************** */
require_once('userModel.php');

$newUser = new UserModel();

if (isset($_POST['Valider'])){	
$nom=htmlspecialchars(addslashes($_POST['nom']));
$prenom=htmlspecialchars(addslashes($_POST['prenom']));
$adresse=htmlspecialchars(addslashes($_POST['adresse']));
$tel=htmlspecialchars(addslashes($_POST['tel']));
$email=htmlspecialchars(addslashes($_POST['email']));
$password=htmlspecialchars(addslashes($_POST['password']));
$role= '2';

$newUser->createUsers($nom, $prenom, $adresse, $tel, $email, $password, $role);

echo('<script language="javascript">alert("Votre compte à été créer avec succees !");</script>') ;
header("Location: login.php");	
die();

}

