<?php
session_start();
// if ($_SESSION['userToken'] == "") {
//     header("Location: index.php");
// }
switch ($_SESSION['page']) {
    case "index":
        header("Location: index.php");
        break;
    case "donnees":
        header("Location: talend.php");
        break;
    case "talend":
        header("Location: talend.php");
        break;
    case "sql":
        // $_SESSION['userToken'] = "";
        if (
            isset($_POST['next'])
            && !empty($_POST['sql_q1'])
            && !empty($_POST['sql_q2'])
            && !empty($_POST['sql_q3'])
        ) {
            foreach ($_POST as $key => $value) {
                $_SESSION['info'][$key] = $value;
            }

            $keys = array_keys($_SESSION['info']);

            if (in_array('next', $keys)) {
                unset($_SESSION['info']['submit']);
            }
            $_SESSION['page'] = "submit";
            header("Location: submit.php");
        }
        break;
    default:
        header("Location: index.php");
}


?>

<!DOCTYPE html>
<html style="width:100%" lang="fr">

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
                <h2>Partie 3 : SQL</h2>
            </div>
        </div>
        <form action="" method="POST">
            <div class="row text-light bg-primary rounded-3 m-3 p-3">
                <h2>Question 1</h2>
                <div class="col">
                    <label>Décrivez dans quels ordres les clauses suivantes sont exécutées :</label>
                    <ul>
                        <li>SELECT - sélection des colonnes à afficher</li>
                        <li>FROM - table à interroger</li>
                        <li>WHERE - filtre de lignes</li>
                        <li>GROUP BY - groupement de lignes</li>
                        <li>HAVING - filtre des groupes de lignes</li>
                        <li>ORDER BY - trie des colonnes</li>
                    </ul>
                    <div class="col">
                        <textarea required class="form-control" name="sql_q1"></textarea>
                    </div>
                </div>
            </div>
            <div class="row text-light bg-primary rounded-3 m-3 p-3">
                <h2>Question 2</h2>
                On souhaite ici récupérer les noms les plus populaires dans les années 90 pour chaque état.
                Une requête première requête SQL fonctionnelle a été réalisée ci-dessous :
                <img src="./assets/sql_3.png" class="w-50 p-3" alt="Jeu de données">

                <label>
                    Proposez une amélioration de cette requête.
                    On s’attachera tout particulièrement à la lisibilité, la performance et la réutilisabilité de votre solution.<br>
                    Précisez si besoin la syntaxe choisie relative au RDBMS (exemple : PostgreSQL, Hive, SQL Server, MySQL, …)
                </label>
                <div class="col">
                    <textarea required class="form-control" name="sql_q2"></textarea>
                </div>
            </div>
            <div class="row text-light bg-primary rounded-3 m-3 p-3">
                <h2>Question 3</h2>
                <div class="col-md-6 col-sm-12 p-2">
                    <img src="./assets/sql_1.png" class="w-50" alt="Jeu de données">
                </div>
                <div class="col-md-6 col-sm-12 p-2">
                    <img src="./assets/sql_2.png" class="w-50" alt="Jeu de données">
                </div>
                <div class="col-12">
                    <label>
                        Un index a été positionné sur la colonne « year ».
                        Laquelle des requêtes ci-dessus est la plus performante ? Pourquoi ?
                    </label>
                </div>
                <div class="col">
                    <textarea required class="form-control mt-2" name="sql_q3"></textarea>
                </div>
            </div>
            <input class="btn btn-light mt-3 mb-3" type="submit" name="next" value="Terminer le test">
        </form>
    </div>
    <script src="lightbox2-2.11.3/dist/js/lightbox-plus-jquery.js"></script>
</body>

</html>