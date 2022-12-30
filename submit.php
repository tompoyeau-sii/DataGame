<?php
session_start();

$txt = PHP_EOL .
    'Prenom : ' . $_SESSION['info']['prenom'] . PHP_EOL .
    'Première partie : Jeu de données ' . PHP_EOL .
    'Réponse 1 : ' . $_SESSION['info']['jd_q1'] . PHP_EOL .
    'Réponse 2 : ' . $_SESSION['info']['jd_q2'] . PHP_EOL .
    'Réponse 3 : ' . $_SESSION['info']['jd_q3'] . PHP_EOL .
    'Réponse 4 : ' . $_SESSION['info']['jd_q4'] . PHP_EOL .
    'Réponse 5 : ' . $_SESSION['info']['jd_q5'] . PHP_EOL . PHP_EOL .
    'Partie 2 : Talend ' . PHP_EOL .
    'Réponse 1 : ' . $_SESSION['info']['tal_q1'] . PHP_EOL .
    'Réponse 2 : ' . $_SESSION['info']['tal_q2'] . PHP_EOL .
    'Réponse 3 : ' . $_SESSION['info']['tal_q3'] . PHP_EOL . PHP_EOL .
    'Partie 3 : SQL ' . PHP_EOL .
    'Réponse 1 : ' . $_SESSION['info']['sql_q1'] . PHP_EOL .
    'Réponse 2 : ' . $_SESSION['info']['sql_q2'] . PHP_EOL .
    'Réponse 3 : ' . $_SESSION['info']['sql_q3'] . PHP_EOL;

file_put_contents('./reponses/' . $_SESSION['info']['prenom'] . '-' . date('d-m-Y'), $txt);

$to = 'tom.poyeau@sii.fr';
$subject = 'Réponse questionnaire candidat data de ' . $_SESSION['info']['prenom'];
$fichier = './reponses/' . $_SESSION['info']['prenom'] . '-' . date('d-m-Y') . ".txt";
$boundary = md5(uniqid(rand(), true));
$entete = 'Content-Type: multipart/mixed;' . "n" . 'boundary="' . $boundary . '"';

$body = 'This is a multi-part message in MIME format.' . "n";
$body .= '--' . $boundary . "n";
$body .= 'Content-Type: text/html; charset="UTF-8"' . "n";
$body .= "n";
$body .= 'Bonjour, Voici ci-joint les résultats du test du dernier candidat.';
$body .= "n";
$body .= '--' . $boundary . "n";
$body .= 'Content-Type: application/pdf; name="' . $fichier . '"' . "n";
$body .= 'Content-Transfer-Encoding: base64' . "n";
$body .= 'Content-Disposition: attachment; filename="' . $fichier . '"' . "n";
$body .= "n";
$source = file_get_contents($fichier);
$source = base64_encode($source);
$source = chunk_split($source);
$body .= $source;
$body .= "n" . '--' . $boundary . '--';

// if (mail($to, $subject, $body, $entete))
//     echo 'Mail envoyé a ' . $to;
// else
//     echo "Erreur d'envoi";
?>

<!DOCTYPE html>
<html style="width:100%" lang="en">

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
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 text-light">
                <div class="row">
                    <div class="col">
                        <h1 style="font-weight: 700;">
                            DATA GAMES by SII
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>
                            Merci ! Vous avez terminé le test. Vos résultats ont était envoyés à nos collaborateurs vont feront un retour dans les prochains jours.
                        </p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <img src="./assets/img2.png" alt="Image de synthése" />
                </div>
            </div>
        </div>
    </div>

</body>

</html>