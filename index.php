<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistem za upravljanje pacijentima</title>
        <link rel="stylesheet" href="assets/main.css">
        <link rel="stylesheet" href="assets/bootstrap.min.css">
    </head>
    <body>
        <form action="pacijent_pogled.php" method="post">
            <div class="form-row">
                <div class="col">
                    <label for="pretraga">Unesite JMBG pacijenta</label> 
                    <input type="text" id="pretraga" class="form-control" name="pretraga"><br>
                    <input type="submit" class="btn btn-primary" formaction="pacijent_pogled.php" value="Pogledaj podatke">
                    <input type="submit" class="btn btn-primary" formaction="novi_pacijent_form.php" value="Kreiraj novog pacijenta">
                    <input type="submit" class="btn btn-primary" formaction="fakturisanje_form.php" value="Fakturisanje usluga">
                </div>
                <div class="col">
                    <label for="doktor">Odaberite doktora</label> 
                    <?php
                    $doktori = array_diff(scandir('doktori'), array('.', '..'));
                    ?>
                    <select id="doktor" class="form-control" name="doktor">
                        <?php
                        foreach ($doktori as $doktor) {
                            echo "<option value=\"$doktor\">" . $doktor . "</option>";
                        }
                        ?>
                    </select><br>
                    <input type="submit" class="btn btn-primary" formaction="zakazivanje_form.php" value="Zakazivanje">
                </div>
            </div>

        </form>
        <div class="text-center" id="index-buttons">
            <a href="login_form.php"><button class="btn btn-primary">Logout</button></a>
            <a href="registracija_form.php"><button class="btn btn-primary">Registracija</button></a>

        </div>
    </body>
    <footer class="fixed-bottom">
        &copy; Copyright 2019 by Bojan Sovtic; 
    </footer>
</html>
