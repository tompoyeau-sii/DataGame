<?php
session_start();

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
        header("Location: sql.php");
        break;
    case "submit":
        $_SESSION['page'] = "index";
        $_SESSION['token'] = "null";

        $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
        $_SESSION['info']['prenom'] = str_replace($search, $replace, $_SESSION['info']['prenom']);

        $prenom = $_SESSION['info']['prenom'];
        $prenom = ucfirst(strtolower($prenom));

        function ConvertisseurTime($Time)
        {
            if ($Time < 3600) {
                $heures = 0;

                if ($Time < 60) {
                    $minutes = 0;
                } else {
                    $minutes = round($Time / 60);
                }

                $secondes = floor($Time % 60);
            } else {
                $heures = round($Time / 3600);
                $secondes = round($Time % 3600);
                $minutes = floor($secondes / 60);
            }

            $secondes2 = round($secondes % 60);

            $TimeFinal = "$heures h $minutes min $secondes2 s";
            return $TimeFinal;
        }

        $temps = $_SESSION['fin'] - $_SESSION['debut'];
        $temps=ConvertisseurTime($temps);


        $txt = PHP_EOL .
            'Candidat : ' . $_SESSION['info']['prenom'] . PHP_EOL . PHP_EOL .
            'Durée du test : ' . $temps . PHP_EOL .
            'Première partie : Jeu de données ' . PHP_EOL . PHP_EOL .
            'Question 1 : Que pensez-vous du choix d’une table Hbase pour le stockage des données Etats ?' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['jd_q1'] . PHP_EOL . PHP_EOL .
            'Question 2 : Outre le choix d’une table Hbase, la table state_details à pour rowKey la colonne « state ». Commenter ce choix. Quels sont les impacts de ce design de rowKey ?' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['jd_q2'] . PHP_EOL . PHP_EOL .
            'Question 3 : Définissez le phénomène de « hotspotting » ?' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['jd_q3'] . PHP_EOL . PHP_EOL .
            'Question 4 : Comment éviter ce phénomène de « hotspotting » ? (citez 3 techniques)' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['jd_q4'] . PHP_EOL . PHP_EOL .
            'Question 5 : Comment redéfiniriez-vous la rowKey ?' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['jd_q5'] . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL .
            'Partie 2 : Talend ' . PHP_EOL . PHP_EOL .
            'Question 1 : Au vu de ce sous job, quelles critiques peuvent être émises ?' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['tal_q1'] . PHP_EOL . PHP_EOL .
            'Question 2 : Avez-vous des pistes d’améliorations ? Lesquelles ?' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['tal_q2'] . PHP_EOL . PHP_EOL .
            'Question 3 : Quelles améliorations proposeriez-vous ?' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['tal_q3'] . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL .
            'Partie 3 : SQL ' . PHP_EOL . PHP_EOL .
            'Question 1 : Décrivez dans quels ordres les clauses suivantes sont exécutées' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['sql_q1'] . PHP_EOL . PHP_EOL .
            'Question 2 : Proposez une amélioration de cette requête.
            On s’attachera tout particulièrement à la lisibilité, la performance et la réutilisabilité de votre solution.<br>
            Précisez si besoin la syntaxe choisie relative au RDBMS (exemple : PostgreSQL, Hive, SQL Server, MySQL, …)' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['sql_q2'] . PHP_EOL . PHP_EOL .
            'Question 3 : Laquelle des requêtes ci-dessus est la plus performante ? Pourquoi ?' . PHP_EOL .
            'Réponse : ' . $_SESSION['info']['sql_q3'] . PHP_EOL;

        file_put_contents('./reponses/' . $_SESSION['info']['prenom'] . '-' . date('d-m-Y') . ".txt", $txt);

        $mails = ["tom.poyeau@sii.fr", "nicolas.pettazzoni@sii.fr"];
        foreach ($mails as $personne) {
            $mail = $personne; // Déclaration de l'adresse de destination.
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
            {
                $passage_ligne = "\r\n";
            } else {
                $passage_ligne = "\n";
            }
            //=====Déclaration des messages au format texte et au format HTML.
            $message_txt = "Réponse d'un candidat";
            $message_html = '
                <p class=MsoNormal><b><face=Arial>
                <h3 style="font-family:Arial;">Résultats du test passé par ' . $prenom . '</h3>
                <p style="font-family:Arial;">
                    ' . $prenom . ' a terminé le questionnaire DataTest. Ses résultats sont disponibles en pièce jointe de ce mail. 
                </p><br>
                <p style="font-family:Arial; color:red;">
                    Ceci est un message automatique, merci de ne pas y répondre.
                </p>
                </font></b></p>
                ';
            //==========

            //=====Lecture et mise en forme de la pièce jointe.
            $fichier   = fopen("./reponses/" . $_SESSION['info']['prenom'] . '-' . date('d-m-Y') . ".txt", "r");
            $attachement = fread($fichier, filesize("./reponses/" . $_SESSION['info']['prenom'] . '-' . date('d-m-Y') . ".txt"));
            $attachement = chunk_split(base64_encode($attachement));
            fclose($fichier);
            //==========

            //=====Création de la boundary.
            $boundary = "-----=" . md5(rand());
            $boundary_alt = "-----=" . md5(rand());
            //==========

            //=====Définition du sujet.
            $sujet = "Resultats du test passe par " . $prenom;
            //=========

            //=====Création du header de l'e-mail.
            $header = "From: \"DataTest by SII\"<noreply@datatest.sii-lemans.fr>" . $passage_ligne;
            $header .= "Reply-to: \"DataTest by SII\" <noreply@datatest.sii-lemans.fr>" . $passage_ligne;
            $header .= "MIME-Version: 1.0" . $passage_ligne . "Content-type: text/plain; charset=\"UTF-8\"" . $passage_ligne;
            $header .= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
            //==========

            //=====Création du message.
            $message = $passage_ligne . "--" . $boundary . $passage_ligne;
            $message .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary_alt\"" . $passage_ligne;
            $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;
            //=====Ajout du message au format texte.
            $message .= "Content-Type: text/plain; charset=\"UTF-8\"" . $passage_ligne;
            $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
            $message .= $passage_ligne . $message_txt . $passage_ligne;
            //==========

            $message .= $passage_ligne . "--" . $boundary_alt . $passage_ligne;

            //=====Ajout du message au format HTML.
            $message .= "Content-Type: text/html; charset=\"UTF-8\"" . $passage_ligne;
            $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
            $message .= $passage_ligne . $message_html . $passage_ligne;
            //==========

            //=====On ferme la boundary alternative.
            $message .= $passage_ligne . "--" . $boundary_alt . "--" . $passage_ligne;
            //==========

            $message .= $passage_ligne . "--" . $boundary . $passage_ligne;

            //=====Ajout de la pièce jointe.
            $message .= "Content-Type: text/txt; name=\"" . $_SESSION['info']['prenom'] . '-' . date('d-m-Y') . ".txt\"" . $passage_ligne;
            $message .= "Content-Transfer-Encoding: base64" . $passage_ligne;
            $message .= "Content-Disposition: attachment; filename=\"" . $_SESSION['info']['prenom'] . '-' . date('d-m-Y') . ".txt\"" . $passage_ligne;
            $message .= $passage_ligne . $attachement . $passage_ligne . $passage_ligne;
            $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
            //==========
            //=====Envoi de l'e-mail.
            if (mail($mail, $sujet, $message, $header)) {
                $content = "[" . date('d-m-Y H:i:s') . "] - " . "Les réponses de " . $prenom . "ont bien étaient envoyées à " . $mail . PHP_EOL;
                file_put_contents("./logMail.txt", $content, FILE_APPEND);
            } else {
                $content = "[" . date('d-m-Y H:i:s') . "] - " . "Erreur lors de l'envoi des réponses de " . $prenom . " a " . $mail . PHP_EOL;
                file_put_contents("./logMail.txt", $content, FILE_APPEND);
            }
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
</head>

<body>
    <div class="container">
        <div class="row text-light bg-primary rounded-3 m-3 p-3">
            <div class="col-sm-9 text-light">
                <div class="row">
                    <div class="col">
                        <h1 style="font-weight: 700;">
                            DATA GAMES by SII
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <p>
                            Vous avez terminé le test. Vos résultats nous ont été envoyés et nous vous ferons un retour dans les prochains jours.
                        </p>
                        <div class="row">
                            <div class="col">
                                <h1>MERCI ET À BIENTÔT !</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <img src="./assets/img2.png" alt="Image de synthése" />
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>