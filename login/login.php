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


    <div class="row">
      <div class="modal-content">
        <?php
        include('../header/navbar.php');
        ?>
        <!------------------------ file d'ariane------------------------------- -->
        <nav aria-label="breadcrumb" class="mt-2">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Connexion</li>

          </ol>
        </nav>
        <!------------------------ file d'ariane------------------------------- -->
        <div class="text-center">
          <img width="600" height="350" src="https://compasshp.org/build/frontend/img/hero/auth.9ab3e655.png">
        </div>
        <form class="was-validated" id="login" name="login" role="form" method="post" action="connect.php">

          <div class="mb-3">
            <label for="email">E-mail*:</label>
            <input class="form-control is-invalid" name="email" id="email" placeholder="exp: john@gmail.com" required>
            <div class="invalid-feedback">
              veuillez renseigner un email valide!
            </div>
          </div>

          <div class="mb-3">
            <label for="password">Mot de passe*:</label>
            <input class="form-control is-invalid" type="password" name="password" id="password" placeholder="....." required>
            <div class="invalid-feedback">
              veuillez renseigner un mot de passe valide!
            </div>
          </div>

          <button type="submit" id="Valider" value="Valider" class="btn btn-primary btn-lg btn-block">Connexion</button>
          <a href="signUp.php" type="button" class="btn btn-outline-success btn-lg btn-block">Créer un compte</a>
        </form>

      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>