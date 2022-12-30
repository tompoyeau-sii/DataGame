<?php 
session_start();

$txt = PHP_EOL.
'Prenom : '.$_SESSION['info']['prenom'].PHP_EOL.
'Première partie : Jeu de données '.PHP_EOL.
'Réponse 1 : '.$_SESSION['info']['jd_q1'].PHP_EOL.
'Réponse 2 : '.$_SESSION['info']['jd_q2'].PHP_EOL.
'Réponse 3 : '.$_SESSION['info']['jd_q3'].PHP_EOL.
'Réponse 4 : '.$_SESSION['info']['jd_q4'].PHP_EOL.
'Réponse 5 : '.$_SESSION['info']['jd_q5'].PHP_EOL.PHP_EOL.
'Partie 2 : Talend '.PHP_EOL.
'Réponse 1 : '.$_SESSION['info']['tal_q1'].PHP_EOL.
'Réponse 2 : '.$_SESSION['info']['tal_q2'].PHP_EOL.
'Réponse 3 : '.$_SESSION['info']['tal_q3'].PHP_EOL.PHP_EOL.
'Partie 3 : SQL '.PHP_EOL.
'Réponse 1 : '.$_SESSION['info']['sql_q1'].PHP_EOL.
'Réponse 2 : '.$_SESSION['info']['sql_q2'].PHP_EOL.
'Réponse 3 : '.$_SESSION['info']['sql_q3'].PHP_EOL;

file_put_contents('./reponses/'.$_SESSION['info']['prenom'].'-'.date('d-m-Y'),$txt);

$to = 'tom.poyeau@sii.fr';
$subject ='Réponse questionnaire candidat data de '.$_SESSION['info']['prenom'];
$fichier = './reponses/'.$_SESSION['info']['prenom'].'-'.date('d-m-Y').".txt";
$boundary = md5(uniqid(rand(), true));
$entete = 'Content-Type: multipart/mixed;'."n".'boundary="'.$boundary.'"';

$body = 'This is a multi-part message in MIME format.'."n";
$body .= '--'.$boundary."n";
$body .= 'Content-Type: text/html; charset="UTF-8"'."n";
$body .= "n";
$body .= 'Bonjour, Voici ci-joint les résultats du test du dernier candidat.';
$body .= "n";
$body .= '--'.$boundary."n";
$body .= 'Content-Type: application/pdf; name="'.$fichier.'"'."n";
$body .= 'Content-Transfer-Encoding: base64'."n";
$body .= 'Content-Disposition: attachment; filename="'.$fichier.'"'."n";
$body .= "n";
$source = file_get_contents($fichier);
$source = base64_encode($source);
$source = chunk_split($source);
$body .= $source;
$body .= "n".'--'.$boundary.'--';

// tests
if(mail($to, $subject, $body, $entete)) 
    echo 'Mail envoyé a '. $to;
else 
echo "Erreur d'envoi";