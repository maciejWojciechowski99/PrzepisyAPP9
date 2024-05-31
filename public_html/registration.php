<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "Logger.php"; 

function checkPasswordRequirements($password, $repeatPassword) {
    $requirements = [
        'valid' => true,
        'message' => ''
    ];

    // Czy hasło ma przynajmniej 8 znaków
    if (strlen($password) < 8) {
        $requirements['valid'] = false;
        $requirements['message'] .= "Hasło musi mieć przynajmniej 8 znaków. ";
    }

    // Czy hasło zawiera przynajmniej jedną dużą literę
    if (!preg_match('/[A-Z]/', $password)) {
        $requirements['valid'] = false;
        $requirements['message'] .= "Hasło musi zawierać przynajmniej jedną dużą literę. ";
    }

    // Czy hasło zawiera przynajmniej jeden znak specjalny
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        $requirements['valid'] = false;
        $requirements['message'] .= "Hasło musi zawierać przynajmniej jeden znak specjalny. ";
    }

    // Czy hasła są identyczne
    if ($password !== $repeatPassword) {
        $requirements['valid'] = false;
        $requirements['message'] .= "Wpisane hasła są niepoprawne. ";
    }

    return $requirements;
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Rejestracja</title>
</head>
<body>
    <main class="registration__body">
        <?php include "config.php"; ?>
        <?php include "nav.php"; ?>
        <?php require "PHPMailer.php"; ?>
        <?php require "SMTP.php"; ?>
        <?php require "Exception.php"; ?>
        <?php require_once 'config.php'; ?>


        <?php
        if(isset($_SESSION['user_id'])) {
            echo "<div class='container mt-4 alert alert-warning'>Wyloguj się, aby zarejestrować nowego użytkownika.</div>";
        } else {
            if ($_POST) {
                $login = isset($_POST['login']) ? htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8') : "";
                $password = isset($_POST['haslo']) ? htmlspecialchars(trim($_POST['haslo']), ENT_QUOTES, 'UTF-8') : "";
                $passwordRepeat = isset($_POST['haslo_powtorz']) ? htmlspecialchars(trim($_POST['haslo_powtorz']), ENT_QUOTES, 'UTF-8') : "";
                $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8') : "";
                
            
                if (empty($login) || empty($password) || empty($passwordRepeat) || empty($email)) {
                    $errorMessage = "Próba rejestracji użytkownika z pustymi polami.";
                    Logger::log('Error: ' . $errorMessage);
                    echo "<div class='container mt-4 alert alert-danger'>Podano puste pola!</div>";
                } else {
                    if (strlen($login) < 64 && strlen($password) < 3000 && strlen($email) < 64) {
                        $isLoginTaken = $database->isLoginTaken($login);
                        $isEmailTaken = $database->isEmailTaken($email);
                        
                        if ($isLoginTaken && $isEmailTaken) {
                            $errorMessage = "Próba rejestracji użytkownika o loginie '$login' i adresie e-mail '$email' nieudana - login i adres e-mail są już zajęte.";
                            Logger::log('Error: ' . $errorMessage);
                            echo "<div class='container mt-4 alert alert-danger'>Login i adres email są zajęte!</div>";
                        } elseif ($isLoginTaken) {
                            $errorMessage = "Próba rejestracji użytkownika o loginie '$login' nieudana - login jest już zajęty.";
                            Logger::log('Error: ' . $errorMessage);
                            echo "<div class='container mt-4 alert alert-danger'>Login jest już zajęty!</div>";
                        } elseif ($isEmailTaken) {
                            $errorMessage = "Próba rejestracji użytkownika o loginie '$login' i adresie e-mail '$email' nieudana - adres e-mail jest już zajęty.";
                            Logger::log('Error: ' . $errorMessage);
                            echo "<div class='container mt-4 alert alert-danger'>Adres email jest już zajęty!</div>";
                        } else {
                            $passwordRequirements = checkPasswordRequirements($password, $passwordRepeat);

                            if ($passwordRequirements['valid']) {
                                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                                $kod_aktywacyjny = mt_rand(100000, 999999);
                            
                                if ($database->addUser($login, $hashedPassword, $email, $kod_aktywacyjny)) {
                                    $successMessage = "Rejestracja przebiegła pomyślnie i wysłano powitalnego maila z kodem aktywacyjnym na $email. Można teraz się zalogować klikając &quot;Zaloguj się&quot;.";
                                    Logger::log('Success: ' . $successMessage);
                            
                                    // Dodanie powiadomienia mailowego po rejestracji
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
                                        $mail->addAddress($email, $login);
                                        $mail->Subject = 'Potwierdzenie rejestracji';
                                        $mail->Body = $mail->Body = "Dziękujemy za rejestrację! Twój login to: $login. Aktywuj swoje konto używając kodu: $kod_aktywacyjny na podstronie 'konto użytkownika'.";
                                        $mail->isHTML(true);
                                        $mail->send();
                            
                                        echo "<div class='container mt-4 alert alert-success'>$successMessage</div>";
                                    } catch (Exception $e) {
                                        echo "<div class='container mt-4 alert alert-danger'>Wystąpił problem z wysłaniem powiadomienia mailowego. {$mail->ErrorInfo}</div>";
                                    }
                                } else {
                                    $errorMessage = "Wystąpił nieoczekiwany problem podczas rejestracji użytkownika: $login";
                                    Logger::log('Error: ' . $errorMessage);
                                    echo "<div class='container mt-4 alert alert-danger'>$errorMessage</div>";
                                }
                            } else {
                                echo "<div class='container mt-4 alert alert-danger'>{$passwordRequirements['message']}</div>";
                            }
                        }
                    } else {
                        echo "<div class='container mt-4 alert alert-danger'>Wystąpił nieoczekiwany problem!</div>";
                    }
                }
            }
            ?>
            <section class="container mt-5">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login:</label>
                        <input type="text" class="form-control" id="login" name="login">
                    </div>
                    <div class="mb-3">
                        <label for="haslo" class="form-label">Hasło:</label>
                        <input type="password" class="form-control" id="haslo" name="haslo">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Hasło musi mieć przynajmniej 8 znaków, zawierać przynajmniej jedną dużą literę i jeden znak specjalny.
                        </small>
                    </div>
                    <div class="mb-3">
                        <label for="haslo_powtorz" class="form-label">Wpisz ponownie hasło:</label>
                        <input type="password" class="form-control" id="haslo_powtorz" name="haslo_powtorz">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Adres email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="">
                        <input type="submit" class="btn btn-primary" value="Zarejestruj się" style="display:block;margin: 0 auto;width:200px;" />
                    </div>
                </form>
            </section>
            <?php
        }
        ?>
        
        <section class="container mt-4">
            <p>Aby się zarejestrować potrzeba:</p>
            <ul style="list-style-type: decimal">
                <li>Wpisać login, który musi być unikalny, w momencie gdy zostanie znaleziony taki sam login zostaniesz poproszony o wprowadzenie innego loginu.</li>
                <li>Za względu bezpieczeństwa hasło musi mieć przynajmniej 8 znaków, zawierać przynajmniej jedną dużą literę i jeden znak specjalny.</li>
                <li>W celach weryfikacji hasła proszę o wprowadzenie go ponownie.</li>
                <li>Po udanej rejestracji na adres mailowy zostanie przesłany mail powitalny.</li>
            </ul>
        </section>
        <script src="bootstrap.min.js"></script>
        <script src="popper.js"></script>
    </main>
</body>
</html>
