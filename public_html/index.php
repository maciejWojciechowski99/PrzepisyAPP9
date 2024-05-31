<?php session_start(); ?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Strona główna</title>
</head>
<body>
    <!-- Pobranie modułów -->
    
    <?php include "Logger.php"; ?>

    <?php include 'config.php'; ?>

    <?php include "nav.php"; ?>

    <?php include "body.php"; ?>

    <?php include "entries.php"; ?>

    <?php include "footer.php"; ?>

    <script src="bootstrap.min.js"></script>
    <script src="popper.js"></script>
    <script src="script.js"></script>
    <script src="rate.js"></script>
</body>
</html>
