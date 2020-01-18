<!DOCTYPE html>

<?php
if (isset($_POST['pretraga'])) {
    $dir = htmlspecialchars($_POST['pretraga']);
}

if ($dir !== "" && file_exists("kartoni/$dir")) {
    $jsonString = file_get_contents("kartoni/$dir/info.json");
    $json = json_decode($jsonString);

    $ime = $json->ime;
    $prezime = $json->prezime;
    $jmbg = $json->jmbg;
    $osiguranje = $json->osiguranje;

    $prikaz = $ime . " " . $prezime;
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
        <?php if (isset($prikaz)) : ?>
            <form action = "fakturisanje.php" method = "post">
                <div class="form-row">
                    <div class="col">
                        <?php
                        echo "<label for='pacijent_prikaz'>Pacijent:</label>"
                        . "<input type='text' value='{$prikaz}' id='pacijent_prikaz' class='form-control' readonly>";
                        ?>

                        <label for="tip_posete">Tip posete:</label>
                        <select id="tip_posete" name="tip_posete" class="form-control">
                            <option value="prva_poseta">Prva poseta u ambulanti</option>
                            <option value="kontrolni_pregled">Kontrolni pregled</option>
                            <option value="obavezno">Sistematski pregled</option>
                            <option value="ostalo">Ostalo</option>
                        </select><br>

                        <label for="placanje">Podaci o placanju:</label>
                        <select id="placanje" name="podaci_placanje" class="form-control">
                            <?php
                            switch ($osiguranje) {
                                case 'nema':
                                    echo "<option value=\"placa\">Placa participaciju</option>";
                                    break;
                                case 'dobrovoljno':
                                    echo "<option value=\"dobrovoljno\">Placa participaciju</option>";
                                    break;
                                case 'obavezno':
                                    echo "<option value=\"obavezno\">Placa potpuno</option>";
                                    break;
                                case 'privatno':
                                    echo "<option value=\"privatno\">Placa potpuno</option>";
                                    break;
                            }
                            ?>
                            <option value="oslobodjen">Oslobodjen</option>
                        </select><br>

                        <label for="dijagnoza">Šifra dijagnoze:</label>
                        <select id="dijagnoza" name ="dijagnoza" class="form-control">
                            <?php
                            for ($j = 65; $j <= 90; $j++) {
                                for ($i = 1; $i <= 120; $i++) {
                                    $value = chr($j) . $i;
                                    echo "<option value='$value'>" . $value . "</option>";
                                }
                            }
                            ?>
                        </select><br>

                        <label for="tip_dijagnoze">Tip dijagnoze:</label>
                        <select name="tip_dijagnoze" class="form-control">
                            <option value="akutna">Akutna</option>
                            <option value="hronicna">Hronična</option>
                            <option value="radna">Radna</option>
                            <option value="konacna">Konačna</option>
                        </select><br>
                    </div>

                    <div class="col">
                        <?php
                        echo "<label for='jmbg_prikaz'>JMBG</label>:"
                        . "<input type='text' value='{$jmbg}' name='jmbg' id='jmbg_prikaz' class='form-control' readonly>";
                        ?>

                        <label for = "terapija">Unesite terapiju:</label>
                        <input type = "text" id = "terapija" name = "terapija" class="form-control"><br>


                        <label for = "lek">Unesite lek:</label>
                        <input type = "text" id = "lek" name = "lek" class="form-control"><br>

                        <label for="doziranje1">Doziranje:</label>
                        <div class="text-center">
                            <input type="number" id="doziranje1" name="doziranje1" class="form-control-sm">x 
                            <input type="number" id="doziranje2" name="doziranje2" class="form-control-sm">
                        </div>
                        <div class="text-center">
                            <button type = "submit" class="btn btn-primary">
                                Kliknite da unesete fakturu
                            </button>
                        </div>
                    </div>

                </div>


            </form>
        <?php endif; ?>
    </body>
    <footer class="fixed-bottom">>
        &copy; Copyright 2019 by Bojan Sovtic; 
    </footer>
</html>
