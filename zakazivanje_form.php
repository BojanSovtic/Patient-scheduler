<!DOCTYPE html>

<?php
$pacijent = $_POST['pretraga'];

if (isset($_POST['pretraga'])) {
    $dir = htmlspecialchars($_POST['pretraga']);
} else {
    echo $_POST['pretraga'];
}
if ($dir !== "" && file_exists("kartoni/$dir")) {
    $jsonString = file_get_contents("kartoni/$dir/info.json");
    $json = json_decode($jsonString);

    $ime = $json->ime;
    $prezime = $json->prezime;
    $jmbg = $json->jmbg;
} else {
    echo "<div class=\"greska\"> 
                <p class=\"error\">Pacijent ne postoji u sistemu!</p>
                <a href=\"index.php\"><button class=\"btn btn-primary\">Nazad</button></a>
                <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
        </div>";
}

if (isset($_POST['doktor'])) {
    $dirDoktora = htmlspecialchars($_POST['doktor']);
} else {
    echo "<div class=\"greska\"> 
                <p class=\"error\">Doktor ne postoji u sistemu!</p>
                <a href=\"index.php\"><button class=\"btn btn-primary\">Nazad</button></a>
                <a href=\"index.php\"><button class=\"btn btn-primary\">Home</button></a>
              </div>";
}


if (file_exists("doktori/$dirDoktora")) {
    $doktor = $dirDoktora;
}

$termini = [];

if (file_exists("doktori/$dirDoktora/termini.json")) {
    $file_path = "doktori/$dirDoktora/termini.json";

    $fp = fopen($file_path, 'r');
    $podaci = file_get_contents($file_path, true);
    $termini = json_decode($podaci, true);

    fclose($fp);
} else {
    echo "<div class=\"greska\"> 
                <p class=\"error\">Termini doktora su nedostupni.</p>
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
        <?php if (isset($ime)) : ?>
            <div class="col-12">
                <table class="table-sm table-bordered table-striped table-hover">
                    <thead>
                    <th scope="col">Ime</th>
                    <th scope="col">Prezime</th>
                    <th scope="col">Doktor</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Vreme</th>
                    <th scope="col">Razlog</th>
                    </thead>

                    <?php
                    if ($termini != null) {
                        array_multisort(array_column($termini, 'datum'), SORT_ASC, array_column($termini, 'vreme'), SORT_ASC, $termini);

                        $brojac = 0;
                        // print_r($termini);
                        if (isset($termini)) {
                            foreach ($termini as $termin) {
                                echo "<tr>";
                                foreach ($termin as $value) {
                                    echo "<td>" . $value . "</td>";

                                    $brojac++;
                                }

                                if ($brojac == 10) {
                                    echo "</tr>";
                                    break;
                                }
                            }
                        }
                    }
                    ?>
                </table>
            </div>

            <form action="zakazivanje.php" method="post">
                <div class="form-row">
                    <div class="col">

                        <?php
                        echo "<label>Doktor:</label><input type='text' value='{$doktor}' name='doktor' class='form-control' readonly><br>";
                        echo "<label>Ime pacijenta:</label>" . "<input type='text' value='{$ime}' name='ime' class='form-control' readonly><br>";
                        echo "<label>Prezime pacijenta:</label>" . "<input type='text' value='{$prezime}' name='prezime' class='form-control' readonly><br>";
                        ?>
                    </div>
                    <div class="col">
                        <label for="datum">Odaberite datum: </label>
                        <input type="date" id="datum" name="datum" class="form-control"><br>

                        <label for="vreme">Odaberite vreme:</label> 
                        <input type="time" id= "vreme" name="vreme" min="7:00" max="19:00" class="form-control"><br>

                        <label for="razlog">Odaberite razlog:</label>
                        <select id="razlog" name="razlog" class="form-control">
                            <option value="poseta">Poseta</option>
                            <option value="recepti">Recepti</option>
                            <option value="kontrola">Kontrola</option>
                            <option value="hitno">HITNO</option>
                            <option value="vanredno">Vanredno</option>
                        </select>

                        <div class="text-center">
                            <button type = "submit" class="btn btn-primary">
                                Kliknite da unesete novi termin
                            </button>
                        </div>

                    </div>
                </div>
            </form>
<?php endif; ?>
        <div class="text-center">
            &copy; Copyright 2019 by Bojan Sovtic; 
        </div>
    </body>
</html>
