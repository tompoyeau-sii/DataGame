<?php
session_start();

switch ($_SESSION['page']) {
    case "index":
        header("Location: index.php");
        break;
    case "donnees":
        if (isset($_POST['next']) && !empty($_POST['jd_q1']) && !empty($_POST['jd_q2']) && !empty($_POST['jd_q3']) && !empty($_POST['jd_q4']) && !empty($_POST['jd_q5'])) {
            foreach ($_POST as $key => $value) {
                $_SESSION['info'][$key] = $value;
            }
            $keys = array_keys($_SESSION['info']);
            if (in_array('next', $keys)) {
                unset($_SESSION['info']['next']);
            }
            $_SESSION['page'] = "talend";
            $_SESSION['finP1'] = time();
            header("Location: talend.php");
        }
        break;
    case "talend":
        header("Location: talend.php");
        break;
    case "sql":
        header("Location: sql.php");
        break;
    default:
        header("Location: index.php");
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
        <form id="formDonnees" action="" method="POST">
            <div class="row bg-primary rounded-3 m-3 p-3 text-light" id="question1">
                <h2>Question 1</h2>
                <div class="col">
                    <label class="mb-2">Que pensez-vous du choix d’une table Hbase pour le stockage des données Etats ?</label>
                    <textarea oninput="autoGrow(this)" class=" form-control" id="jd_q1" rows="1" name="jd_q1" pattern="[a-zA-ZÀ-ÿ0-9 -.!:;,\" ]+" title="Seuls les caractères suivants sont autorisés pour ce champs: -.!:;,\""></textarea>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light" id="question2">
                <h2>Question 2</h2>
                <div class="class">
                    <label class="mb-2">Outre le choix d’une table Hbase, la table state_details à pour rowKey la colonne « state », commenter ce choix. Quels sont les impacts de ce design de rowKey ?</label>
                    <textarea oninput="autoGrow(this)" class=" form-control" id="jd_q2" rows="1" name="jd_q2"  pattern="[a-zA-ZÀ-ÿ0-9 -.!:;,\" ]+" title="Seuls les caractères suivants sont autorisés pour ce champs: -.!:;,\""></textarea>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light" id="question3">
                <h2>Question 3</h2>
                <div class="col">
                    <label class="mb-2">Définissez le phénomène de « hotspotting » ?</label>
                    <textarea oninput="autoGrow(this)" class=" holder form-control" id="jd_q3" rows="1" name="jd_q3"  pattern="[a-zA-ZÀ-ÿ0-9 -.!:;,\" ]+" title="Seuls les caractères suivants sont autorisés pour ce champs: -.!:;,\""></textarea>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light" id="question4">
                <h2>Question 4</h2>
                <div class="col">
                    <label class="mb-2">Comment éviter ce phénomène de « hotspotting » ? (citez 3 techniques)</label>
                    <textarea oninput="autoGrow(this)" class=" form-control" id="jd_q4" rows="1" name="jd_q4" pattern="[a-zA-ZÀ-ÿ0-9 -.!:;,\" ]+" title="Seuls les caractères suivants sont autorisés pour ce champs: -.!:;,\""></textarea>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light" id="question5">
                <h2>Question 5</h2>
                <div class="col">
                    <label class="mb-2">Comment redéfiniriez-vous la rowKey ?</label>
                    <textarea oninput="autoGrow(this)" class=" form-control" id="jd_q5" rows="1" name="jd_q5"  pattern="[a-zA-ZÀ-ÿ0-9 -.!:;,\" ]+" title="Seuls les caractères suivants sont autorisés pour ce champs: -.!:;,\""></textarea>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <input class="btn btn-primary mt-3 mb-3" type="submit" id="submit" name="next" value="Suivant">
                </div>
            </div>
        </form>
    </div>
    <script src="lightbox2-2.11.3/dist/js/lightbox-plus-jquery.js"></script>
    <script type="text/javascript">
        console.log(document.getElementById("formDonnees"))
        document.getElementById("formDonnees").addEventListener("submit", function(event) {
            var jd_q1 = document.getElementById("jd_q1").value;
            var jd_q2 = document.getElementById("jd_q2").value;
            var jd_q3 = document.getElementById("jd_q3").value;
            var jd_q4 = document.getElementById("jd_q4").value;
            var jd_q5 = document.getElementById("jd_q5").value;
            if (jd_q5 == "" || jd_q5 == null) {
                document.getElementById("jd_q5").placeholder = "*Vous devez compléter ce champs"
                document.getElementById("question5").scrollIntoView();
                event.preventDefault();
            }
            if (jd_q4 == "" || jd_q4 == null) {
                document.getElementById("jd_q4").placeholder = "*Vous devez compléter ce champs"
                document.getElementById("question4").scrollIntoView();
                event.preventDefault();
            }
            if (jd_q3 == "" || jd_q3 == null) {
                document.getElementById("jd_q3").placeholder = "*Vous devez compléter ce champs"
                document.getElementById("question3").scrollIntoView();
                event.preventDefault();
            }
            if (jd_q2 == "" || jd_q2 == null) {
                document.getElementById("jd_q2").placeholder = "*Vous devez compléter ce champs"
                document.getElementById("question2").scrollIntoView();
                event.preventDefault();
            }
            if (jd_q1 == "" || jd_q1 == null) {
                document.getElementById("jd_q1").placeholder = "*Vous devez compléter ce champs"
                document.getElementById("question1").scrollIntoView();
                event.preventDefault();
            }
        });

        function autoGrow(element) {
            element.style.height = "5px";
            element.style.height = element.scrollHeight + "px";
        }
    </script>
</body>

</html>