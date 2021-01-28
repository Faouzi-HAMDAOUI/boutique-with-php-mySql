<?php

// cette page sert pour une déconnexion d'un utilisateur sur le site
session_start();

session_unset();

session_destroy();

header("Location: login.php")
?>