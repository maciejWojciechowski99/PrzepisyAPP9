<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "config.php";
require_once "Logger.php";
require_once "PHPMailer.php";
require_once "SMTP.php";
require_once "Exception.php";

$database = new Database();
$login = isset($_SESSION['user']) ? $_SESSION['user'] : "";
$userData = $database->getUserInfo($login);
$userEmail = isset($userData['email']) ? $userData['email'] : '';

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Aktywacja konta</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php 
    
if ($_POST) {
    $activationCode = isset($_POST['activation_key']) ? htmlspecialchars(trim($_POST['activation_key']), ENT_QUOTES, 'UTF-8') : "";

    if (!empty($activationCode)) {
        $login = isset($_SESSION['user']) ? $_SESSION['user'] : "";

        if (!empty($login)) {
            if ($database->checkActivationCode($login, $activationCode)) {
                $database->activateUser($login);
                
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
                    $mail->Subject = 'PrzepisyAPP - Pomyślna aktywacja konta';
                    $mail->CharSet = 'UTF-8';
                    $mail->Body    = "Twoje konto zostało pomyślnie aktywowane.";

                    $mail->isHTML(true);
                    $mail->send();

                    echo "<div class='container mt-4 alert alert-success'>Twoje konto zostało pomyślnie aktywowane. Zostało wysłane potwierdzenie mailowe.</div>";
                } catch (Exception $e) {
                    echo "<div class='container mt-4 alert alert-danger'>Konto zostało aktywowane, ale wystąpił problem z wysłaniem powiadomienia emailowego.</div>";
                }
            } else {
                echo "<div class='container mt-4 alert alert-danger'>Podany kod aktywacyjny jest niepoprawny.</div>";
            }
        } else {
            echo "<div class='container mt-4 alert alert-danger'>Brak zalogowanego użytkownika.</div>";
        }
    } else {
        echo "<div class='container mt-4 alert alert-danger'>Wprowadź kod aktywacyjny.</div>";
    }
}
    ?>
    <main class="activate__body">
        <section class="container mt-5 text-center">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="activation_key" class="form-label">Kod aktywacyjny:</label>
                    <input type="text" class="form-control" id="activation_key" name="activation_key" required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Aktywuj konto">
                </div>
            </form>
        </section>

        <script src="bootstrap.min.js"></script>
        <script src="popper.js"></script>
    </main>
</body>
</html>
