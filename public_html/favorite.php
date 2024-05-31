<?php
session_start();  // Rozpocznij lub wznow sesję
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Ulubione przepisy</title>
</head>
<body>
<?php include "config.php"; ?>

<?php include "nav.php"; ?>


<h2 class="display-5 header">Twoje ulubione przepisy</h2>

<section class="przepisy">
    <?php
    if (!isset($_SESSION['user'])) {
        echo "<p>Musisz być zalogowany, aby zobaczyć przepisy.</p>";
    } else {
        if ($_POST && isset($_POST['submit_usun'])) {
            $id = trim($_POST['usun']);
            $tytul = $database->getTitleById($id);
            if ($database->deleteEntry($id)) {
                echo "<p style='color:red;'>Usunięto:</span> <strong>"  . " " . $tytul . "</strong></p>";
            } else {
                echo "Wystąpił błąd podczas usuwania wpisu o ID: $id";
            }
        }
        
        if ($_POST && isset($_POST['submit_ulubione'])) {
            $recipeIdToRemoveFromFavorites = $_POST['usun_z_ulubionych'];
            if ($database->removeFromFavorites($recipeIdToRemoveFromFavorites)) {
                echo "<p style='color:green;'>Usunięto przepis z ulubionych.</p>";
            } else {
                echo "Wystąpił błąd podczas usuwania przepisu z ulubionych.";
            }
        }

        // pobieranie ulubionych przepisów
        if ($database->getFavoriteEntries()) {
            foreach ($database->getFavoriteEntries() as $entry) {
    ?>
                <div class="przepisy__tytul">
                    <p>Tytuł: <strong><?php echo $entry['tytul']; ?></strong> </p>
                    <p> Przepis: <br> <strong><?php echo nl2br(htmlspecialchars($entry['opis'])); ?></p></strong>
                    <!-- Formularz do usuwania z ulubionych -->
                    <form method="post">
                        <input type="hidden" name="usun_z_ulubionych" value="<?php echo $entry['id']; ?>">
                        <input class="btn btn-danger" type="submit" value="Usuń z ulubionych" name="submit_ulubione">
                    </form>
                </div>
<?php
            }
        } else {
            echo "<p class=\"lead pt-4\">Obecnie brak ulubionych przepisów...</p>";
        }
    }
    ?>
</section>
