<?php
session_start();
// Funkcja generująca token CSRF
function generateCsrfToken() : string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

$csrfToken = generateCsrfToken();

// Funkcja sprawdzająca poprawność tokenu CSRF
function validateCsrfToken(string $token) : bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}


?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Dodaj przepis</title>
    <style>
        .char-counter {
            margin-top: 5px;
            color: #888;
        }

        .char-limit-exceeded {
            color: red;
        }
    </style>
    <script>
        var csrfToken = "<?php echo $csrfToken; ?>";
    </script>
</head>
<body>
    <main class="sing__body">
        <?php include "config.php"; ?>
        <?php require_once "Logger.php"; ?>
        <?php include "nav.php"; ?>

        <?php
        if (!isset($_SESSION['user'])) {
            echo "<div class='container mt-4 alert alert-danger'>Musisz być zalogowany, aby dodać przepis!</div>";
        } else {
            if ($_POST) {
                $tytul = isset($_POST['tytul']) ? htmlspecialchars(trim($_POST['tytul']), ENT_QUOTES, 'UTF-8') : "";
                $tresc_przepisu = isset($_POST['tresc_przepisu']) ? htmlspecialchars(trim($_POST['tresc_przepisu']), ENT_QUOTES, 'UTF-8') : "";
                $csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : "";

                if (!validateCsrfToken($csrf_token)) {
                    $errorMessage = "Błąd tokenu CSRF! Proszę odświeżyć stronę i spróbować ponownie.";
                    Logger::log('Error: ' . $errorMessage);
                    echo "<div class='container mt-4 alert alert-danger'>$errorMessage</div>";
                    exit; 
                }

                if ("" == $tytul || "" == $tresc_przepisu) {
                    $errorMessage = "Podano puste pola!";
                    Logger::log('Error: ' . $errorMessage);
                    echo "<div class='container mt-4 alert alert-danger'>$errorMessage</div>";
                } else {
                    try {
                        // Sprawdzanie długości tytułu i opisu
                        if (strlen($tytul) > 64) {
                            throw new Exception("Tytuł przepisu jest zbyt długi (maksymalnie 64 znaki).");
                        }
                        
                        if (strlen($tresc_przepisu) > 1024) {
                            throw new Exception("Opis przepisu jest zbyt długi (maksymalnie 1024 znaków).");
                        }

                        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

                        if ($database->addRecipe($tytul, $tresc_przepisu, $_SESSION['user_id'], $csrf_token)) {
                            $successMessage = "Dodano nowy przepis";
                            Logger::log('Success: ' . $successMessage, $tytul, $_SESSION['user']);
                            echo "<div class='container mt-4 alert alert-success'>$successMessage</div>";
                        } else {
                            $errorMessage = "Wystąpił nieoczekiwany problem!";
                            Logger::log('Error: ' . $errorMessage, $tytul, $_SESSION['user']);
                            echo "<div class='container mt-4 alert alert-danger'>$errorMessage</div>";
                        }
                    } catch (Exception $e) {
                        // Wyświetlenie komunikatu o błędzie zbyt długiego opisu
                        $errorMessage = $e->getMessage();
                        Logger::log('Error: ' . $errorMessage, $tytul, $_SESSION['user']);
                        echo "<div class='container mt-4 alert alert-danger'>$errorMessage</div>";
                    }
                }
            }

            // Formularz do dodawania przepisu
            echo '
            <section class="container mt-5">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="tytul" class="form-label">Tytuł:</label>
                        <input type="text" class="form-control" id="tytul" name="tytul">
                    </div>
                    <div class="mb-3">
                        <label for="tresc_przepisu" class="form-label">Treść przepisu:</label>
                        <textarea class="form-control desctription" id="tresc_przepisu" name="tresc_przepisu" rows="3" placeholder="Składniki: &#10; Treść przepisu:" oninput="countChars(this)"></textarea>
                        <div id="charCounter" class="char-counter">Limit: 1024 znaków</div>
                        <div id="charLimitExceeded" class="char-limit-exceeded" style="display: none;">Przekroczono limit znaków! Przepis zostanie dodany, ale zostanie on ucięty i będzie mieć maksymalnie 1024 znaki.</div>
                    </div>
                    <input type="hidden" name="csrf_token" value="">
                    <div class="">
                        <input type="submit" class="btn btn-primary" value="Dodaj Przepis" style="display:block;margin: 0 auto;width:200px;" />
                    </div>
                </form>
            </section>';
        }
        ?>

        <script src="bootstrap.min.js"></script>
        <script src="popper.js"></script>
        <script>
            function countChars(textarea) {
                var charCounter = document.getElementById('charCounter');
                var charLimitExceeded = document.getElementById('charLimitExceeded');
                var charLimit = 1024;

                var remainingChars = charLimit - textarea.value.length;
                charCounter.textContent = 'Pozostało: ' + remainingChars + ' znaków';

                if (remainingChars < 0) {
                    charLimitExceeded.style.display = 'block';
                } else {
                    charLimitExceeded.style.display = 'none';
                }
            }
        </script>
        <script>
            document.querySelector('input[name="csrf_token"]').value = csrfToken;
        </script>
    </main>
</body>
</html>

