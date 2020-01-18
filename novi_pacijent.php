<!DOCTYPE html>

<?php
require_once "Pacijent.php";
require "funkcije.php";

$greske = [];

if (isset($_POST['ime'])) {
    $ime = htmlspecialchars($_POST['ime']);
}
if (proveriIme($ime) !== '0') {
    $greske[] = proveriIme($ime);
}

if (isset($_POST['prezime'])) {
    $prezime = htmlspecialchars($_POST['prezime']);
}
if (proveriPrezime($prezime) !== '0') {
    $greske[] = proveriPrezime($prezime);
}

if (isset($_POST['visina'])) {
    $visina = htmlspecialchars($_POST['visina']);
}
if (!is_numeric($visina) || $visina < 40 || $visina > 250) {
    $greske[] = "Pogresno uneta vrednost visine (od 40 do 250)";
}

if (isset($_POST['tezina'])) {
    $tezina = htmlspecialchars($_POST['tezina']);
}
if (!is_numeric($tezina) || $tezina < 5 || $tezina > 250) {
    $greske[] = "Pogresno uneta vrednost tezine (od 5 do 250)";
}

if (isset($_POST['datum'])) {
    $datum = htmlspecialchars($_POST['datum']);
}
if (proveriDatum($datum) !== '0') {
    $greske[] = "Pogresno unet datum";
}

if (isset($_POST['pol'])) {
    $pol = htmlspecialchars($_POST['pol']);
}
if (!in_array($pol, array('muski', 'zenski'))) {
    $greske[] = "Pogresna vrednost za pol.";
}

if (isset($_POST['adresa'])) {
    $adresa = htmlspecialchars($_POST['adresa']);
}

if (isset($_POST['telefon'])) {
    $telefon = htmlspecialchars($_POST['telefon']);
}
if (!is_numeric($telefon)) {
    $greske[] = 'Pogresna vrednost za telefon.';
}

if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
}
if (proveriEmail($email) !== '0') {
    $greske[] = proverEmail($email);
}

if (isset($_POST['jmbg'])) {
    $jmbg = htmlspecialchars($_POST['jmbg']);
}
if (!is_numeric($jmbg) || strlen($jmbg) != 13) {
    $greske[] = "Pogresna vrednost za jmbg";
}

if (isset($_POST['osiguranje'])) {
    $osiguranje = htmlspecialchars($_POST['osiguranje']);
}
if (!in_array($osiguranje, array('nema', 'dobrovoljno', 'obavezno', 'privatno'))) {
    $greske[] = "Pogresna vrednost za osiguranje";
}

if (sizeof($greske) == 0) {
    $pacijent = new Pacijent($ime, $prezime, $visina, $tezina, $datum, $pol, $adresa, $telefon, $email, $jmbg, $osiguranje);


    $imeFoldera = $jmbg;
    if (!file_exists("kartoni/$imeFoldera")) {
        mkdir("kartoni/$imeFoldera");
    } else {
        echo "<div class=\"greska\"> 
               <p class=\"error\">Pacijent vec ima karton!</p>
               <a href=\"novi_pacijent_form.php\"><button class=\"btn btn-primary\">Nazad</button></a>
               <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
                </div>";
    }

    $filename = "info.json";
    $fp = fopen("kartoni/$imeFoldera/$filename", 'w');
    fwrite($fp, json_encode($pacijent));
    fclose($fp);

    echo "<div class=\"potvrda\"> 
                <p class=\"uspeh\">Karton uspesno kreiran!</p>
                <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
</div>";
} else {
    echo "<div class=\"greska\">";
    foreach ($greske as $greska) {
        echo "<p class=\"error\">" . $greska . "</p>";
    };
    echo
    "<a href=\"novi_pacijent_form.php\"><button class=\"btn btn-primary\">Nazad</button></a>
    <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
    </div>";
}
?>


<html>
    <head>
        <meta charset="utf-8">
        <title>Sistem za upravljanje pacijentima</title>
        <link rel="stylesheet" href="assets/main.css">
        <link rel="stylesheet" href="assets/bootstrap.min.css">
    </head>
    <body>
    </body>
    <footer class="fixed-bottom">
        &copy; Copyright 2019 by Bojan Sovtic; 
    </footer>
</html>