<?php
$host = 'geldmaschine123.database.windows.net';
$dbname = 'php_aufgabe';
$user = 'admins';
$pass = 'Administrator10!'; 


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}

?>
