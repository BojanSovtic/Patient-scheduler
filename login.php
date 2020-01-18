<!DOCTYPE html>

<?php
if (isset($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
}

if (isset($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
}

$jsonString = file_get_contents("data/korisnici.json");
$json = json_decode($jsonString);

foreach ($json as $korisnik) {
    if ($username == $korisnik->username && $password == $korisnik->password) {
        header('Location:index.php');
    } else if ($username == $korisnik->username && $password != $korisnik->password) {
        echo "<div class=\"greska\"> 
                <p class=\"error\">Pogresno ste uneli lozinku!</p>
                <a href=\"login_form.php\"><button class=\"btn btn-primary\">Nazad</button></a>
                <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
              </div>";
        break;
    }
}

if ($username != $korisnik->username) {
    echo "<div class=\"greska\"> 
               <p class=\"error\">Ne postoji korisnik!</p>
               <a href=\"login_form.php\"><button class=\"btn btn-primary\">Nazad</button></a>
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