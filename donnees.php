<?php
session_start();
if ($_SESSION['userToken'] == "") {
    header("Location: index.php");
}
$_SESSION['userToken'] = "";

if (isset($_POST['next']) && !empty($_POST['jd_q1']) && !empty($_POST['jd_q2']) && !empty($_POST['jd_q3']) && !empty($_POST['jd_q4']) && !empty($_POST['jd_q5'])) {
    foreach ($_POST as $key => $value) {
        $_SESSION['info'][$key] = $value;
    }
    $keys = array_keys($_SESSION['info']);
    if (in_array('next', $keys)) {
        unset($_SESSION['info']['next']);
    }
    $_SESSION['userToken'] = $_SESSION['token'];
    header("Location: talend.php");
}

?>

<!DOCTYPE html>
<html lang="fr">

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
    <link href="lightbox2-2.11.3/dist/css/lightbox.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="row text-light bg-primary rounded-3 m-3 p-3">
            <div class="col">
                <h1>DATA GAMES by SII</h1>
                <h2 class="w-auto">Partie 1 : Jeu de données</h2>
                <p>
                    Nous avons à disposition deux jeux de données comme visible ci-dessous. <br>
                    Les données relatives aux noms de bébés (baby_names), à peu près 5 millions de lignes, sont stockées dans des fichiers parquet.<br>
                    Les données relatives aux états (state_details), 51 lignes, sont stockées dans une table Hbase nommée « state_details ».
                </p>
                <a tabindex="-1" href="./assets/jeu_de_donnees.png" class="w-50 rounded-2" data-lightbox="image-1" data-title="Jeu de données" alt="Jeu de données">
                    <img src="./assets/jeu_de_donnees.png" class="w-50 rounded-2" alt="Jeu de données">
                </a>
            </div>
        </div>
        <form action="" method="POST">

            <div class="row bg-primary rounded-3 m-3 p-3 text-light">
                <h2>Question 1</h2>
                <div class="col">
                    <label class="mb-2">Que pensez-vous du choix d’une table Hbase pour le stockage des données Etats ?</label>
                    <textarea required class="form-control" rows="1" name="jd_q1"></textarea>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light">
                <h2>Question 2</h2>
                <div class="class">
                    <label class="mb-2">Outre le choix d’une table Hbase, la table state_details à pour rowKey la colonne « state ». Commenter ce choix. Quels sont les impacts de ce design de rowKey ?</label>
                    <textarea required class="form-control" rows="1" name="jd_q2"></textarea>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light">
                <h2>Question 3</h2>
                <div class="col">
                    <label class="mb-2">Définissez le phénomène de « hotspotting » ?</label>
                    <textarea required class="form-control" rows="1" name="jd_q3"></textarea>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light">
                <h2>Question 4</h2>
                <div class="col">
                    <label class="mb-2">Comment éviter ce phénomène de « hotspotting » ? (citez 3 techniques)</label>
                    <textarea required class="form-control" rows="1" name="jd_q4"></textarea>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light">
                <h2>Question 5</h2>
                <div class="col">
                    <label class="mb-2">Comment redéfiniriez-vous la rowKey ?</label>
                    <textarea required class="form-control" rows="1" name="jd_q5"></textarea>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <input class="btn btn-primary mt-3 mb-3" type="submit" name="next" value="Suivant">
                </div>
            </div>
        </form>
    </div>
    <script src="lightbox2-2.11.3/dist/js/lightbox-plus-jquery.js"></script>
</body>

</html>