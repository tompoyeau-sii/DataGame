<?php
session_start();

switch ($_SESSION['page']) {
    case "index":
        header("Location: index.php");
        break;
    case "donnees":
        header("Location: donnees.php");
        break;
    case "talend":
        if (
            isset($_POST['next'])
            && !empty($_POST['tal_q1'])
            && !empty($_POST['tal_q2'])
            && !empty($_POST['tal_q3'])

        ) {
            foreach ($_POST as $key => $value) {
                $_SESSION['info'][$key] = $value;
            }

            $keys = array_keys($_SESSION['info']);

            if (in_array('next', $keys)) {
                unset($_SESSION['info']['next']);
            }
            $_SESSION['userToken'] = $_SESSION['token'];
            $_SESSION['page'] = "sql";
            $_SESSION['finP2'] = time();
            header("Location: sql.php");
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="./assets/style.css">
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
                <h2>Partie 2 : Talend</h2>
                <p>
                    Un job Talend Spark Batch a été développé pour répondre aux besoins de nos utilisateurs métier :
                </p>
                <a tabindex="-1" href="./assets/talend_1.png" class="w-50 rounded-2" data-lightbox="image-1" data-title="Talend Spark Batch" data-alt="Talend Spark Batch">
                    <img src="./assets/talend_1.png" class="w-50 rounded-2" alt="Jeu de données">
                </a>
            </div>
        </div>
        <form action="" id="formTalend" method="POST">
            <div class="row bg-primary rounded-3 m-3 p-3 text-light" id="question1">
                <div class="col">
                    <h2>Question 1</h2>
                    <label>Au vu de ce sous job, quelles critiques peuvent être émises ?</label>
                    <div class="col">
                        <textarea oninput="autoGrow(this)" class="form-control" rows="1" name="tal_q1" id="tal_q1" pattern="[a-zA-ZÀ-ÿ0-9 -.!:;,\" ]+" title="Seuls les caractères suivants sont autorisés pour ce champs: -.!:;,\""></textarea>
                    </div>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light" id="question2">
                <h2>Question 2</h2>
                <div class="col">
                    <label>Avez-vous des pistes d’améliorations ? Lesquelles ?</label>
                    <div class="col">
                        <textarea oninput="autoGrow(this)" class="form-control" rows="1" name="tal_q2" id="tal_q2" pattern="[a-zA-ZÀ-ÿ0-9 -.!:;,\" ]+" title="Seuls les caractères suivants sont autorisés pour ce champs: -.!:;,\""></textarea>
                    </div>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light">
                <div class="col">
                    <p>Zoomons sur le composant tMap_4 :</p>
                    <div class="row">
                        <div class="col-sm-4 col-md-6 col-lg-8">
                            <a tabindex="-1" href="./assets/talend_2.png" class="rounded-2" data-lightbox="image-1" data-title="tMap_4" alt="Talend Spark Batch">
                                <img src="./assets/talend_2.png" class="w-100 mb-3" alt="Img tMap4">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a tabindex="-1" href="./assets/talend_3.png" class="rounded-2" data-lightbox="image-1" data-title="tMap_4" alt="Talend Spark Batch">
                                <img src="./assets/talend_3.png" class="w-100 mb-3" alt="Img tMap4">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row bg-primary rounded-3 m-3 p-3 text-light" id="question3">
                <div class="col-12">
                    <h2>Question 3</h2>
                    <label>Quelles améliorations proposeriez-vous ?</label>
                </div>
                <div class="col-12">
                    <textarea oninput="autoGrow(this)" class=" form-control" rows="1" id="tal_q3" name="tal_q3" pattern="[a-zA-ZÀ-ÿ0-9 -.!:;,\" ]+" title="Seuls les caractères suivants sont autorisés pour ce champs: -.!:;,\""></textarea>
                </div>
            </div>

            <div class=" row text-center">
                <div class="col">
                    <input class="btn btn-primary mt-3 mb-3" type="submit" id="submitTalend" name="next" value="Suivant">
                </div>
            </div>

        </form>
    </div>

    <script src="lightbox2-2.11.3/dist/js/lightbox-plus-jquery.js"></script>
    <script type="text/javascript">
        document.getElementById("formTalend").addEventListener("submit", function(event) {
            var tal_q1 = document.getElementById("tal_q1").value;
            var tal_q2 = document.getElementById("tal_q2").value;
            var tal_q3 = document.getElementById("tal_q3").value;
            if (tal_q3 == "" || tal_q3 == null) {
                document.getElementById("tal_q3").placeholder = "*Vous devez compléter ce champs"
                document.getElementById("question3").scrollIntoView();
                event.preventDefault();
            }
            if (tal_q2 == "" || tal_q2 == null) {
                document.getElementById("tal_q2").placeholder = "*Vous devez compléter ce champs"
                document.getElementById("question2").scrollIntoView();
                event.preventDefault();
            }
            if (tal_q1 == "" || tal_q1 == null) {
                document.getElementById("tal_q1").placeholder = "*Vous devez compléter ce champs"
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