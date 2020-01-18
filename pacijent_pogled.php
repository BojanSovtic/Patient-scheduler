<!DOCTYPE html>

<?php

require_once "Pacijent.php";

if (isset($_POST['pretraga'])) {
    $dir = htmlspecialchars($_POST['pretraga']);
} 

if ($dir !== "" && file_exists("kartoni/$dir")) {
    $jsonString = file_get_contents("kartoni/$dir/info.json");
    $json = json_decode($jsonString, true);
    
    $values = array_values($json);
    $pacijent = new Pacijent(...$values);
     
    // print_r($pacijent);
    
    $bmi = $pacijent->izracunajBMI();
    
    // echo $bmi;
    
    $pacijent->setBmi($bmi);
    
} else {
    echo "<div class=\"greska\"> 
               <p class=\"error\">Pacijent ne postoji u sistemu!</p>
               <a href=\"index.php\"><button class=\"btn btn-primary\">Nazad</button></a>
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
        <table class="table-sm table-bordered">
            <thead>
            <th scope="col">Ime</th>
            <th scope="col">Prezime</th>
            <th scope="col">Visina</th>
            <th scope="col">Tezina</th>
            <th scope="col">Datum</th>
            <th scope="col">Pol</th>
            <th scope="col">Adresa</th>
            <th scope="col">Telefon</th>
            <th scope="col">Email</th>
            <th scope="col">JMBG</th>
            <th scope="col">Osiguranje</th>
            <th scope="col">BMI</th>
            </thead>
            <tbody>
                <?php
                
                if (isset($pacijent)) {
                    foreach($pacijent as $value) {
                        echo "<td>" . $value . "</td>";
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
    <footer class="fixed-bottom">
       &copy; Copyright 2019 by Bojan Sovtic; 
    </footer>
</html>

 