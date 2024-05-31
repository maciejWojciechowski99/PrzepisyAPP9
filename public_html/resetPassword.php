<?php
session_start();
include "config.php";
require_once "Database.php";

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Przypomnienie hasła</title>
</head>
<body>
    <main class="registration__body">
        <?php include "nav.php"; ?>
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["send_reset_email"])) {
                $email = htmlspecialchars(trim($_POST['email']));
                echo "<div class='container mt-4 alert alert-success'>Wysłano e-mail z instrukcjami do zmiany hasła.</div>";

            } else if (isset($_POST["change_password"])) {
                $resetPinFromForm = htmlspecialchars(trim($_POST['reset_pin']));
                $newPassword = htmlspecialchars(trim($_POST['new_password']));
                $confirmPassword = htmlspecialchars(trim($_POST['confirm_password']));

                $resetPinFromForm = htmlspecialchars(trim($_POST['reset_pin']));
                $resetPinFromSession = $_SESSION['reset_pin'] ?? null;
                $database = new Database();
                if ($resetPinFromSession !== null) {
                    $resetPinFromSession = $_SESSION['reset_pin'];
                    if ($resetPinFromForm === $resetPinFromSession) {
                        if ($newPassword === $confirmPassword) {
                            if (strlen($newPassword) >= 8 && preg_match('/[A-Z]/', $newPassword) && preg_match('/[!@#$%^&*(),.?":{}|<>]/', $newPassword)) {
                                if ($database->updatePasswordByResetPin($resetPinFromForm, $newPassword)) {
                                    echo "<div class='container mt-4 alert alert-success'>Hasło zostało pomyślnie zmienione.</div>";
                                } else {
                                    echo "<div class='container mt-4 alert alert-danger'>Błąd podczas aktualizacji hasła.</div>";
                                }
                            } else {
                                echo "<div class='container mt-4 alert alert-danger'>Nowe hasło musi mieć przynajmniej 8 znaków, zawierać przynajmniej jedną dużą literę i jeden znak specjalny.</div>";
                            }
                        } else {
                            echo "<div class='container mt-4 alert alert-danger'>Nowe hasło i potwierdzenie hasła są różne.</div>";
                        }
                    } else {
                        echo "<div class='container mt-4 alert alert-danger'>Błędny pin weryfikacyjny.</div>";
                    }
                } else {
                    echo "<div class='container mt-4 alert alert-danger'>Pin wygasł. Proszę ponownie rozpocząć proces resetowania hasła.</div>";
                }
                
            }
        }
        ?>
        <!-- Formularz przypominania hasła -->
        <section class="container mt-5 text-center">
            <form action="send_reset_email.php" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Adres e-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="">
                    <input type="submit" class="btn btn-primary" value="Wyślij e-mail z instrukcjami do zmiany hasła" style="display:block;margin: 20px auto;min-width:300px;" name="send_reset_email">
                </div>
            </form>
            
            <!-- Formularz zmiany hasła -->
            <form action="" method="post">
                <div class="mb-3">
                    <label for="reset_pin" class="form-label">Wpisz pin weryfikujący:</label>
                    <input type="text" class="form-control" id="reset_pin" name="reset_pin" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Nowe hasło:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                    <p class="text-muted">Nowe hasło musi zawierać przynajmniej 8 znaków, jeden znak specjalny, jedną cyfrę</p>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Powtórz hasło:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="">
                    <input type="submit" class="btn btn-primary" value="Zmień hasło" style="display:block;margin: 0 auto;width:300px;" name="change_password">
                </div>
            </form>
            
        </section>
    </main>
</body>
</html>
