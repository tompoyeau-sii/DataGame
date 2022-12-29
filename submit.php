<?php 
session_start();

echo "<pre>";
print_r($_SESSION['info']['prenom']);
echo "</pre>";

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

$to = 'tompoyeau@gmail.com';
$subject ='Réponse questionnaire candidat data';
$message = 'test';
$headers = "Content-Type: text/plain; charset=utf-8\r\n";
$headers = 'From : tompoyeau@gmail.com';

if(mail($to, $subject, $message)) 
    echo 'Mail envoyé a '. $to;
else 
echo "Erreur d'envoi";