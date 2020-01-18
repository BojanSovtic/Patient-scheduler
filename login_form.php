<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistem za upravljanje pacijentima</title>
        <link rel="stylesheet" href="assets/main.css">
        <link rel="stylesheet" href="assets/bootstrap.min.css">
    </head>
    <body>
        <form action="login.php" method="post">
            <div class="container">
                <div class="form-row col-md-6 form-centrirano">
                    <label for="username">Username : </label>
                    <input type="text" id="username" name="username" class="form-control" required><br>
                    <label for="password">Password : </label>
                    <input type="password" id="password" name="password" class="form-control" required><br>
                    <input type="submit" class="btn btn-primary" value="Pošalji">
                </div>
            </div>
        </form>
    </body>
    <footer class="fixed-bottom">
        &copy; Copyright 2019 by Bojan Sovtic; 
    </footer>
</html>
