<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "config.php";
require_once "Database.php";
require_once "PHPMailer.php";
require_once "SMTP.php";
require_once "Exception.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send_reset_email"])) {
    $email = htmlspecialchars(trim($_POST['email']));
    if ($database->isEmailTaken($email)) {
        $pin = $database->generateResetPinAndSave($email);
        $_SESSION['reset_pin'] = $pin;

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
            $mail->addAddress($email);
            $mail->Subject = 'Instrukcje do zmiany hasła';
            $mail->CharSet = 'UTF-8';
            $mail->Body    = "Pin jest ważny przez 5 minut i jest jednorazowy. Proszę wpisać pin weryfikujący, a następnie nadać nowe hasło. Twój pin do zmiany hasła: $pin";
            $mail->isHTML(true);
            $mail->send();

            echo "<div class='container mt-4 alert alert-success'>Wysłano maila z instrukcjami. <a href='resetPassword.php'>Kliknij tutaj</a>, aby wrócić do zmiany hasła.</div>";
            exit();
        } catch (Exception $e) {
            echo "<div class='container mt-4 alert alert-danger'>Wystąpił problem z wysłaniem maila. <a href='resetPassword.php'>Kliknij tutaj</a>, aby wrócić {$mail->ErrorInfo}</div>";
        }
    } else {
        echo "<div class='container mt-4 alert alert-danger'>Podany adres e-mail nie istnieje w bazie danych. <a href='resetPassword.php'>Kliknij tutaj</a>, aby wrócić</div>";
    }
}

?>
