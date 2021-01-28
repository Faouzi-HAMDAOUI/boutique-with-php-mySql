 <?php

  /* ***********************************************************************************
 Cette page  à pour objectif d'afficher toutes les boutiques du site 
************************************************************************************** */

  // récupérer toutes les boutique du site
  require_once('../users/boutiques/shopModel.php');
  $shop = new BoutiqueModel();
  $myShop = $shop->getAllBoutiques();

  ?>

 <!doctype html>
 <html lang="en">

 <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   <title>Ma Beautique Enligne</title>
 </head>

 <body>
   <div class="container">


     <div class="modal-content">
       <?php
        include('../header/navbar.php');
        ?>
       <!------------------------ file d'ariane------------------------------- -->
       <nav aria-label="breadcrumb" class="mt-2">
         <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="../">Accueil</a></li>
           <li class="breadcrumb-item active" aria-current="page">Boutiques</li>

         </ol>
       </nav>
       <!------------------------ file d'ariane------------------------------- -->
       <div class="mt-4">
         <h1>Bienvenue sur votre boutique enligne</h1>
         <h5>choisissez une boutique parmis nos merveilleuses boutiques et faites vos chooping </h5>
       </div>

       <div class="row mt-3">
         <?php
          // afficher toutes les boutiques du site
          foreach ($myShop as $data) {
          ?>
           <div class="col-6 text-center">
             <div class="card text-darck ml-1 mr-1 mb-3">
               <div class="card-header"><?php echo $data['title']; ?></div>
               <div class="card-body">
                 <img height="200" width="350" class="img-circle" src="../images/<?php echo $data['img_bout']; ?>">
               </div>
               <button type="button" class="btn btn-warning"> <a href="boutique.php/?id_bou=<?php echo $data['id_bou']; ?>">faites vous shopping</a></button>

             </div>
           </div>
         <?php };
          unset($data); ?>
       </div>
     </div>
   </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 </body>

 </html>