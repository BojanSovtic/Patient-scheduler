<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistem za upravljanje pacijentima</title>
        <link rel="stylesheet" href="assets/main.css">
        <link rel="stylesheet" href="assets/bootstrap.min.css">
    </head>
    <body>
        <form action="novi_pacijent.php" method="post">
            <div class="form-row">
                <div class="col">
                    <label for="ime">Ime:</label>
                    <input type="text" id ="ime" name="ime" class="form-control" required><br>

                    <label for="prezime">Prezime:</label>
                    <input type="text" id="prezime" name="prezime" class="form-control" required><br>

                    <label for="visina">Visina:</label>
                    <input type="text" id="visina" name="visina" class="form-control" required><br>

                    <label for="tezina">Težina:</label>
                    <input type="text" id="tezina" name="tezina" class="form-control" required><br>

                    <label for="datum">Datum rodjenja:</label>
                    <input type="date" id="datum" name="datum" class="form-control" required><br>
                    <label for="muski" class="form-check-label">Pol:</label><br>
                    <div class="form-check form-check-inline">      
                        <input type="radio" id="muski" name="pol" value="muski" class="form-check-input"required>
                        <label for="muski" class="form-check-label">Muški</label>
                    </div>
                    <div class="form-check form-check-inline">  
                        <input type="radio" id="zenski" name="pol" value="zenski" class="form-check-input">
                        <label for="zenski" class="form-check-label">Ženski</label>
                    </div>
                </div>
                <div class="col">
                    <label for="adresa">Adresa:</label>
                    <input type="text" id="adresa" name="adresa" class="form-control" required><br>

                    <label for="telefon">Telefon:</label>
                    <input type="tel" id="telefon" name="telefon" class="form-control" required><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control"><br>

                    <label for="jmbg">JMBG:</label>
                    <input type="number" id="jmbg" name="jmbg" class="form-control" required><br>

                    <label for="osiguranje">Tip osiguranja:</label>
                    <select name="osiguranje" id="osiguranje" class="form-control" required>
                        <option value="nema">Nema zdravstveno osiguranje</option>
                        <option value="dobrovoljno">Dobrovoljno zdravstveno osigranje</option>
                        <option value="obavezno">Obavezno osiguranje zdravstvenog fonda RZZO</option>
                        <option value="privatno">Privatno osiguranje</option>
                    </select><br>
                </div>
            </div>
            <div class="text-right">
                <button type="submit"  class="btn btn-primary">
                    Kliknite ovde da kreirate novi karton
                </button>
            </div>
        </form>
    </body>
    <footer>
        &copy; Copyright 2019 by Bojan Sovtic; 
    </footer>
</html>