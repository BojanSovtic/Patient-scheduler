<!DOCTYPE html>

<?php
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

if (isset($_POST['doktor'])) {
    $doktor = htmlspecialchars($_POST['doktor']);
}

if (isset($_POST['datum'])) {
    $datum = htmlspecialchars($_POST['datum']);
}
if (proveriDatum($datum) !== '0') {
    $greske[] = proveriDatum($datum);
}
if (proveriDatumBuducnost($datum) !== '0') {
    $greske[] = proveriDatumBuducnost($datum);
}

if (isset($_POST['vreme'])) {
    $vreme = htmlspecialchars($_POST['vreme']);
}

if (isset($_POST['razlog'])) {
    $razlog = htmlspecialchars($_POST['razlog']);
}
if (!in_array($razlog, array('poseta', 'recepti', 'kontrola', 'hitno', 'vanredno'))) {
    $greske[] = "Pogresna vrednost za razlog!";
}


$termini = [];

if (file_exists("doktori/$doktor/termini.json")) {
    $file_path = "doktori/$doktor/termini.json";

    $fp = fopen($file_path, 'r');
    $podaci = file_get_contents($file_path, true);
    $termini = json_decode($podaci, true);

    fclose($fp);
} else {
    echo "<div class=\"greska\"> 
               <p class=\"error\">Termini doktora nisu pronadjeni.</p>
               <a href=\"fakturisanje_form.php\"><button class=\"btn btn-primary\">Nazad</button></a>
               <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
                </div>";
}

$data = [
    'ime_pacijenta' => $ime,
    'prezime_pacijenta' => $prezime,
    'doktor' => $doktor,
    'datum' => $datum,
    'vreme' => $vreme,
    'razlog' => $razlog
];

$slobodan = true;
$slobodnoMinuti = true;

foreach ($termini as $termin) {
    // echo $termin['datum'] . " " . $datum . " " . $termin['vreme'] . " " . $vreme . "<br>";
    if ($termin['datum'] === $datum) {
        if ($termin['vreme'] === $vreme) {
            $slobodan = false;
            break;
        }
        // echo proveriVreme($termin['vreme'], $vreme);
        if (proveriVreme($termin['vreme'], $vreme) < 15) {
            $slobodnoMinuti = false;
            break;
        }
    }
}

// echo "slobodan" . $slobodan . "slobodnoMinuti" . $slobodnoMinuti;

if (sizeof($greske) == 0) {
    if ($slobodan && $slobodnoMinuti) {

        $imeFoldera = $doktor;
        $filename = "termini.json";
        $file_path = "doktori/$imeFoldera/$filename";

        $fp = fopen($file_path, 'a');
        $podaci = file_get_contents($file_path, true);
        $json_data = json_decode($podaci, true);
        $json_data[] = $data;

        file_put_contents($file_path, json_encode($json_data));
        fclose($fp);
        
        echo "<div class=\"potvrda\"> 
                <p class=\"uspeh\">Termin uspesno unet.</p>
                <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
</div>";
    } else if (!$slobodan) {
        echo "<div class=\"greska\"> 
               <p class=\"error\">Termin je zauzet.</p>
               <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
                </div>";
    } else {
        echo "<div class=\"greska\"> 
               <p class=\"error\">Mora da prodje 15 minuta od poslednjeg termina.</p>
               <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
                </div>";
    }
} else {
    echo "<div class=\"greska\">";
    foreach ($greske as $greska) {
        echo "<p class=\"error\">" . $greska . "</p>";
    }
    echo
    "<a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
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

