<?php
require_once "Logger.php";
require_once "Database.php";

session_start();

// wylogowanie usera

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    $successMessage = "Użytkownik '$username' został wylogowany.";
    
    $database = new Database(); 
    $pdo = $database->connection(); 

    Logger::logOut($pdo, 'Success', $successMessage, '', $username);
}

session_destroy();

exit();
?>

