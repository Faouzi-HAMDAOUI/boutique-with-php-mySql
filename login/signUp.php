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
            <li class="breadcrumb-item"><a href="login.php">Connexion</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inscription</li>
          </ol>
        </nav>
        <!------------------------ file d'ariane------------------------------- -->
        <div class="text-center">
          <img width="300" height="270" src="https://cdn4.iconfinder.com/data/icons/website-kit-2/600/Sign_Up-512.png">
        </div>
        <form class="was-validated" role="form" method="POST" action="new_user.php">
          <div class="mb-3">
            <label for="nom">Nom*:</label>
            <input class="form-control is-invalid" type="text" name="nom" id="password" required>
            <div class="invalid-feedback">
              veuillez renseigner un nom valide!
            </div>
          </div>

          <div class="mb-3">
            <label for="prenom">Prénom:</label>
            <input class="form-control is-invalid" type="text" name="prenom" id="prenom">
            <div class="invalid-feedback">
              veuillez renseigner un prénom valide!
            </div>
          </div>

          <div class="mb-3">
            <label for="adresse">Adresse:</label>
            <input class="form-control is-invalid" type="text" name="adresse" id="adresse">
            <div class="invalid-feedback">
              veuillez renseigner une adresse valide!
            </div>
          </div>

          <div class="mb-3">
            <label for="tel">Téléphone:</label>
            <input class="form-control is-invalid" type="text" name="tel" id="tel">
            <div class="invalid-feedback">
              veuillez renseigner un téléphone valide!
            </div>
          </div>

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

          <button type="submit" id="Valider" name="Valider" value="Valider" class="btn btn-primary btn-lg btn-block">Valider</button>
          <a href="login.php" type="button" class="btn btn-outline-success btn-lg btn-block">Connexion</a>
        </form>

      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>