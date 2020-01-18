<!DOCTYPE html>

<?php
require_once 'Korisnik.php';
require "funkcije.php";

$greske = [];

if (isset($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
}
if (proveriUsername($username) !== '0') {
    $greske[] = proveriUsername($username);
}

if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
}
if (proveriEmail($email) !== '0') {
    $greske[] = proveriEmail($email);
}

if (isset($_POST['emailConf'])) {
    $emailConf = htmlspecialchars($_POST['emailConf']);
}
if ($email !== $emailConf) {
    $greske[] = "Potvrdite email ponovo!";
}

if (isset($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
}
if (proveriLozinku($password) !== '0') {
    $greske[] = proveriLozinku($password);
}

$jsonString = file_get_contents("data/korisnici.json");
$json = json_decode($jsonString);

$uUpotrebi = false;
foreach($json as $korisnik) {
    if ($password == $korisnik->password) {
        $uUpotrebi = true;;
    }
}

if (isset($_POST['passwordConf'])) {
    $passwordConf = htmlspecialchars($_POST['passwordConf']);
}

if ($password !== $passwordConf) {
    $greske[] = "Potvrdite sifru ponovo!";
}

if (isset($_POST['brojGenerisan'])) {
    $brojGenerisan = htmlspecialchars($_POST['brojGenerisan']);
}
if (isset($_POST['broj'])) {
    $broj = htmlspecialchars($_POST['broj']);
}
if (!is_numeric($broj)) {
    $greske[] = "Morate uneti broj.";
}

if ($brojGenerisan !== $broj) {
    $greske[] = "Niste dobro uneli broj!";
}


if (sizeof($greske) == 0 && !$uUpotrebi) {
    $korisnik = new Korisnik($username, $password, $email);
    // print_r($korisnik);

    $jsonString = file_get_contents("data/korisnici.json");
    $json = json_decode($jsonString);

    array_push($json, $korisnik);
    $final_data = json_encode($json);

    // print_r($final_data);

    file_put_contents("data/korisnici.json", $final_data);
    
    echo "<div class=\"potvrda\"> 
                <p class=\"uspeh\">Uspesno ste se registrovali!</p>
                <a href=\"login_form.php\"><button class=\"btn btn-primary\">Home</button></a>
        </div>";
} else if ($uUpotrebi) {
    echo "<div class=\"greska\"> 
                <p class=\"error\">Lozinka je vec u upotrebi</p>
                <a href=\"registracija_form.php\"><button class=\"btn btn-primary\">Nazad</button></a>
                <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
              </div>";
}else {
    echo "<div class=\"greska\">";
    foreach ($greske as $greska) {
        echo "<p class=\"error\">" . $greska . "</p>";
    };
    echo
               "<a href=\"registracija_form.php\"><button class=\"btn btn-primary\">Nazad</button></a>
    </div>";
}
?>

<html>
    <head>
        <meta charset=""utf-8">
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