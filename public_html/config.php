<?php

include 'Database.php';

$database = new Database();
$database->connection();


define('SMTP_HOST', 'smtp.wp.pl');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'kamilslimak199191@wp.pl');
define('SMTP_PASSWORD', 'Krotoszyn1234!');
