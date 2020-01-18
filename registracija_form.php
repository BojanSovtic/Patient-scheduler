<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistem za upravljanje pacijentima</title>
        <link rel="stylesheet" href="assets/main.css">
        <link rel="stylesheet" href="assets/bootstrap.min.css">
    </head>
    <body>
        <form action="registracija.php" method="post">
            <div class="form-row">
                <div class="col">
                    <label for="username">Username:</label> 
                    <input type="text" id="username" name="username" class="form-control"><br>

                    <label for="email">E-mail: </label>
                    <input type="email" id="email" name="email" class="form-control"><br>

                    <label for="emailConf">Confirm E-mail: </label>
                    <input type="email" id="emailConf" name="emailConf" class="form-control"><br>
                    <label for="password"> Password: </label>
                    <input type="password" id="password" name="password" class="form-control"><br>

                    <label for="passwordConf"> Confirm password: </label>
                    <input type="password" id="passwordConf" name="passwordConf" class="form-control"><br>
                </div>

                <div class="col">
                    <?php
                    $brojGenerisan = rand(100000, 10000000);
                    echo "<label for=\"brojGenerisan\">Generisan broj:</label>"
                    . "<input type='text' value='{$brojGenerisan}' id='brojGenerisan' name='brojGenerisan' class='form-control' readonly><br>";
                    ?>

                    <label for="broj">Potvrdite broj: </label>
                    <input type="number" id="broj" name="broj" class="form-control"><br>
                    <div class="text-right">
                        <input type="submit" value="Pošalji" class="btn btn-primary">
                    </div>
                </div>

            </div>
        </form>
    </body>
    <footer class="fixed-bottom">
        &copy; Copyright 2019 by Bojan Sovtic; 
    </footer>
</html>
