<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Logowanie</title>
</head>
<body>
    <main class="registration__body">
        <?php include "config.php"; ?>
        <?php include "nav.php"; ?>

        <?php
require_once "Logger.php";
if (isset($_SESSION['user'])) {
    echo "<div class='container mt-4 alert alert-success'>Jesteś już zalogowany. Przejdź na <a href='strona-glowna'>stronę główną</a>.</div>";
    } else {
    if ($_POST) {
        $login = htmlspecialchars(trim($_POST['login']));
        $haslo = trim($_POST['haslo']);

        if (empty($login) || empty($haslo)) {
            // Info o błędnym logowaniu do logów
            $errorMessage = "podano puste pola przy próbie zalogowania";
            Logger::log('Error: ' . $errorMessage);
            echo "<div class='container mt-4 alert alert-danger'>Podano puste pola!</div>";
        } else {
            // Info o udanym logowaniu do logów
            $successMessage = "Użytkownik '$login' zalogował się.";
            Logger::log('Success: ' . $successMessage);

            $successMessage = "Użytkownik '$login' zalogował się.";
            Logger::logToDatabase('Success', $successMessage, '', $login);

            if ($database->verifyLogin($login, $haslo)) {
                // pobranie info o zalogowanym użytkowniku z bazy danych
                $userInfo = $database->getUserInfo($login);
                $_SESSION['user'] = $userInfo['login']; 
                $_SESSION['user_id'] = (int)$userInfo['id'];
                exit();
                
            } else {
                // Info o błędnym logowaniu do logów
                $errorMessage = "Błędny login lub hasło dla użytkownika '$login'.";
                Logger::log('Error: ' . $errorMessage);
                echo "<div class='container mt-4 alert alert-danger'>Błędny login lub hasło!</div>";
            }
        }
    }
?>
<!-- Formularz -->
<section class="container mt-5 text-center">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="login" class="form-label">Login:</label>
                    <input type="text" class="form-control" id="login" name="login">
                </div>
                <div class="mb-3">
                    <label for="haslo" class="form-label">Hasło:</label>
                    <input type="password" class="form-control" id="haslo" name="haslo">
                </div>
                <div class="">
                    <input type="submit" class="btn btn-primary " value="Zaloguj się" style="display:block;margin: 0 auto;width:200px;" />
                    <a href="reset-hasla" type="submit" class="btn btn-primary" style="display:block;margin: 0 auto;width:200px; margin-top:10px;">Zresetuj hasło</a>
                </div>
            </form>
            <section class="container mt-5 text-center">
                <form action="zarejestruj-sie" method="post">
                    <div class="mb-3">
                        <label for="haslo" class="form-label">Nie masz konta? Zarejestruj się!</label>
                        <input type="submit" class="btn btn-primary" value="Zarejestruj się" style="display:block;margin: 0 auto;width:200px;" />
                    </div>
                </form>
            </section>
        </section>
        <?php
        }
        ?>


        <script src="bootstrap.min.js"></script>
        <script src="popper.js"></script>
    </main>
</body>
</html>
