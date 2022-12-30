<?php
session_start();

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

    header("Location: submit.php");
}
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
    <div class="container text-light">
        <div class="row">
            <div class="col">
                <h1>DATA GAMES by SII</h1>
                <h2>Partie 3 : SQL</h2>
                <form class="text-center" action="" method="POST">
                    <div class="row">
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
                    <div class="row">

                        <h2>Question 2</h2>
                        On souhaite ici récupérer les noms les plus populaires dans les années 90 pour chaque état.
                        Une requête première requête SQL fonctionnelle a été réalisée ci-dessous :
                        <div class="col" style="text-align: left!important">
                            SELECT sd.state, bn.year, bn.name<br>
                            SUM(bn.num_babies) AS total<br>
                            FROM baby_names bn<br>
                            LEFT JOIN state_details sd<br>
                            ON bn.state = sd.abbreviation<br>
                            WHERE year BETWEEN 1990 AND 1999<br>
                            GROUP BY sd.state, bn.year, bn.name<br>
                            ORDER BY total DESC;<br>
                        </div>


                        <div class="p-2">
                            <label>
                                Proposez une amélioration de cette requête.
                                On s’attachera tout particulièrement à la lisibilité, la performance et la réutilisabilité de votre solution.<br>
                                Précisez si besoin la syntaxe choisie relative au RDBMS (exemple : PostgreSQL, Hive, SQL Server, MySQL, …)
                            </label>
                            <div class="col">
                                <textarea required class="form-control" name="sql_q2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h2>Question 3</h2>
                        <div class="col">
                            <label>
                                Un index a été positionné sur la colonne « year ».
                                Laquelle des requêtes ci-dessous est la plus performante ? Pourquoi ?
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <img src="./assets/sql_1.png" class="w-50" alt="Jeu de données">
                        </div>
                        <div class="col-6">
                            <img src="./assets/sql_2.png" class="w-50" alt="Jeu de données">
                        </div>
                        <div class="col">
                            <textarea required class="form-control mt-2" name="sql_q3"></textarea>
                        </div>
                    </div>
                    <input class="btn btn-light mt-2" type="submit" name="next" value="Terminer le test">
                </form>
            </div>
        </div>
    </div>

</body>

</html>