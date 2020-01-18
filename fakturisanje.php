<!DOCTYPE html>

<?php
require 'funkcije.php';

$greske = [];

if (isset($_POST['tip_posete'])) {
    $tip_posete = htmlspecialchars($_POST['tip_posete']);
}

if (isset($_POST['podaci_placanje'])) {
    $podaci_placanje = htmlspecialchars($_POST['podaci_placanje']);
}

if (isset($_POST['dijagnoza'])) {
    $dijagnoza = $_POST['dijagnoza'];
}
if (proveriSifruDijagnoze($dijagnoza) !== '0') {
    $greske[] = proveriSifruDijagnoze($dijagnoza);
}

if (isset($_POST['tip_dijagnoze'])) {
    $tip_dijagnoze = htmlspecialchars($_POST['tip_dijagnoze']);
}
if (!in_array($tip_dijagnoze, array('akutna', 'hronicna', 'radna', 'konacna'))) {
    $greske[] = 'Pogresan tip dijagnoze.';
}

if (sizeof($greske) == 0) {
    $data = [
        'tip_posete' => $tip_posete,
        'podaci_placanje' => $podaci_placanje,
        'dijagnoza' => $dijagnoza,
        'tip_dijagnoze' => $tip_dijagnoze
    ];
}

if (isset($_POST['terapija'])) {
    $terapija = htmlspecialchars($_POST['terapija']);
}

if (isset($_POST['lek'])) {
    $lek = htmlspecialchars($_POST['lek']);
}

if (isset($_POST['doziranje1']) && isset($_POST['doziranje2'])) {
    $doziranje = htmlspecialchars($_POST['doziranje1']) . "x"
            . htmlspecialchars($_POST['doziranje2']);
}


if ($terapija === "") {
    $terapija = "bez_terapije";
    $data['terapija'] = $terapija;
} else {
    $data['terapija'] = $terapija;
    $data['lek'] = $lek;
    $data['doziranje'] = $doziranje;    
}

if ($terapija == 'bez_terapije' && ($lek != "" || $doziranje != "x")) {
    $greske[] = "Zaboravili ste da unesete terapiju!";
}


if (sizeof($greske) == 0) {
    $imeFoldera = htmlspecialchars($_POST['jmbg']);
    $filename = "istorija.json";
    $file_path = "kartoni/$imeFoldera/$filename";

// ako ne postoji
    $fp = fopen($file_path, 'a');
    $podaci = file_get_contents($file_path, true);
    $json_data = json_decode($podaci, true);
    $json_data[] = $data;

    file_put_contents($file_path, json_encode($json_data));
    fclose($fp);

    echo "<div class=\"potvrda\"> 
                <p class=\"uspeh\">Faktura uspesno uneta.</p>
                <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
</div>";
} else {
    echo "<div class=\"greska\">";
    foreach ($greske as $greska) {
        echo "<p class=\"error\">" . $greska . "</p>";
    };
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