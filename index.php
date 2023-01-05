<?php
session_start();

switch ($_SESSION['page']) {
  case "index":
    $_SESSION['page'] = "index";
    $public = "6LfHbJ8jAAAAAJ66fXodkjhuhRqTCTqn9THitAa7";
    $secret = "6LfHbJ8jAAAAAAEIFj__-ODXLOeAbwie7x5cerVw";
    require_once './recaptcha/autoload.php';
    //Vérification si le prénom n'est pas vide
    if (isset($_POST['next'])) {
      if (!empty($_POST['prenom'])) {
        // Vérification du captcha
        if (isset($_POST['g-recaptcha-response'])) {
          $recaptcha = new \ReCaptcha\ReCaptcha($secret);
          $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
          //   Si le captcha est ok
          if ($resp->isSuccess()) {

            foreach ($_POST as $key => $value) {
              $_SESSION['info'][$key] = $value;
            }
            $keys = array_keys($_SESSION['info']);
            if (in_array('next', $keys)) {
              unset($_SESSION['info']['next']);
            }
            //  Assignation du token de la session
            $_SESSION['page'] = "donnees";
            header("Location: donnees.php");
            //Si le captcha est pas ok
          } else {
            $_SESSION['erreur'] = "Le captcha n'est pas valide";
          }
        } else {
          $_SESSION['erreur'] = "Le captcha n'est rempli";
        }
      } else {
        $_SESSION['erreur'] = "Veuillez complèter tous les champs";
      }
    }
    break;
  case "donnees":
    // $_SESSION['userToken'] = "";
    header("Location: donnees.php");
    break;
  case "talend":
    header("Location: talend.php");
    break;
  case "sql":
    header("Location: sql.php");
    break;
  default:
    header("Location: index.php");
    $_SESSION['page'] = "index";
}
?>

<!DOCTYPE html>
<html style="height: 100%;" lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DATA GAME by SII</title>
  <link rel="stylesheet" href="./assets/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
    grecaptcha.ready(() => {
      grecaptcha.execute($public, {
        action: 'contact'
      }).then(token => {
        document.querySelector('#recaptchaResponse').value = token;
      });
    });
  </script>
</head>

<body>
  <div class="container bg-primary p-3 rounded-3">
    <div class="row">
      <div class="col-sm-9 text-light">
        <div class="row">
          <!-- <div class="col-lg-1 col-sm col-md">
            <img width="100%" src="./assets/sii.png" alt="Logo SII" />
          </div> -->
          <div class="col">
            <h1 style="font-weight: 700;">
              DATA GAMES by SII
            </h1>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <p>
              Vous êtes sur le point de passer un test de compétences fait par SII.
              Ce test nous permettra d’évaluer vos compétences dans la data à l’aide
              de questions ouvertes, vous permettant d’exprimer vos pensées et votre
              logique.
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <p>
              Ce test dure en moyenne 20 minutes. Veuillez à prévoir le temps
              suffisant pour l’effectuer. Vous n’avez pas de temps limite, ce temps représente seulement une
              moyenne pour vous donner un ordre d'idées.
            </p>
          </div>
        </div>
        <p style="font-weight: bold; font-size:large">Lorsque vous êtes prêt, entrez votre prénom et démarrez le test !</p>
        <div class="row">
          <form action="" method="POST">

            <div class="col-sm-5 col-lg-4">
              <input style="color: #0059A3" type="prenom" required class="form-control mt-2" id="prenom" name="prenom" placeholder="Prenom">
            </div>

            <div class="g-recaptcha pt-2" data-sitekey="6LfHbJ8jAAAAAJ66fXodkjhuhRqTCTqn9THitAa7"></div>

            <div class="col-sm-4">
              <input class="btn btn-light mt-2" type="submit" name="next" value="Démarrer le test">
            </div>

          </form>
        </div>
      </div>
      <div class="col-sm-3 col-md-3">
        <img src="./assets/img1.png" alt="Image de synthése" />
      </div>
    </div>
  </div>
  </div>
  <script>

  </script>
</body>

</html>