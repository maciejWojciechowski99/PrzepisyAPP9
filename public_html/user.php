<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "config.php";
require_once "Logger.php";
include "nav.php";
require_once "PHPMailer.php";
require_once "SMTP.php";
require_once "Exception.php";

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$userLogin = $_SESSION['user'];
$userData = $database->getUserInfo($userLogin);
$userEmail = isset($userData['email']) ? $userData['email'] : ''; 
$numberOfRecipes = $database->getNumberOfRecipes($userLogin);
$sumOfFavRecipes = $database->getSumOfFavRecipes($userLogin);
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $currentPassword = $_POST["current_password"];
    $newPassword = $_POST["new_password"];
    $repeatNewPassword = $_POST["repeat_new_password"];
    $userData = $database->getUserInfo($userLogin);
    $storedPassword = $userData['haslo'];

    if (password_verify($currentPassword, $storedPassword)) {
        if ($newPassword == $repeatNewPassword) {
            if (strlen($newPassword) >= 8 && preg_match('/[!@#$%^&*(),.?":{}|<>]/', $newPassword)) {
                $database->updateUserPassword($userId, $newPassword, $currentPassword);
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host       = SMTP_HOST;
                    $mail->SMTPAuth   = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = SMTP_PORT;
                    $mail->Username   = SMTP_USERNAME;
                    $mail->Password   = SMTP_PASSWORD;

                    $mail->setFrom('kamilslimak199191@wp.pl', 'PrzepisyAPP');
                    $mail->addAddress($userEmail);
                    $mail->Subject = 'Zmiana hasła w aplikacji';
                    $mail->CharSet = 'UTF-8';
                    $mail->Body    = "Twoje hasło zostało pomyślnie zmienione w aplikacji.";
                    $mail->isHTML(true);
                    $mail->send();

                    echo "<div style='position: relative;padding: 1rem 1rem;margin-bottom: 1rem;border: 1px solid transparent;border-radius: 0.25rem;margin-top: 1.5rem!important; color: #0f5132; background-color: #d1e7dd; border-color: #badbcc; font-size: 1rem; font-weight: 400;'>Hasło zostało zmienione, wysłaliśmy powiadomienie mailowe, wróć <a href='konto-uzytkownika'> na podstronę użytkownika</a></div>";
                    exit();
                } catch (Exception $e) {
                    $error = "Wystąpił problem z wysłaniem maila.";
                }
            } else {
                $error = "Nowe hasło musi zawierać przynajmniej 8 znaków, jeden znak specjalny i jedną cyfrę.";
            }
        } else {
            $error = "Nowe hasło i jego powtórzenie nie są identyczne.";
        }
    } else {
        $error = "Wprowadzone aktualne hasło jest nieprawidłowe.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Profil użytkownika</title>
</head>
<body>
    <main class="user__profile">
        <section class="container mt-4">
            <h2>Twój Profil</h2>
            <p>Login: <?php echo $userLogin; ?></p>
            <p>E-mail: <?php echo $userEmail; ?></p>
            <p>Liczba dodanych przepisów: <?php echo $numberOfRecipes; ?></p>
            <p>Liczba ulubionych przepisów: <?php echo $sumOfFavRecipes; ?></p>
            <?php
            if ($userData['aktywowane'] == 1) {
                echo "<p>Status konta: Aktywne</p>";
            } else {
                echo "<p>Status konta: Nieaktywne. <a href='aktywacja-konta'>Aktywuj tutaj</a></p>";
            }
            ?>
            <?php
            if ($error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
            ?>
            <button id="changePasswordBtn" class="btn btn-primary">Zmień hasło</button>
            <!-- Formularz zmiany hasła-->
            <form id="changePasswordForm" style="display: none;" action="user.php" method="post">
                <div class="mb-3">
                    <label for="current_password" class="form-label">Wprowadź aktualne hasło</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Wprowadź nowe hasło</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                    <p class="text-muted">Nowe hasło musi zawierać przynajmniej 8 znaków, jeden znak specjalny, jedną cyfrę</p>
                </div>
                <div class="mb-3">
                    <label for="repeat_new_password" class="form-label">Powtórz nowe hasło</label>
                    <input type="password" class="form-control" id="repeat_new_password" name="repeat_new_password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="change_password">Ustaw nowe hasło</button>
            </form>
        </section>
        <script src="bootstrap.min.js"></script>
        <script src="popper.js"></script>
        <script>
            document.getElementById('changePasswordBtn').addEventListener('click', function() {
                document.getElementById('changePasswordForm').style.display = 'block';
            });
        </script>
    </main>
</body>

</html>
