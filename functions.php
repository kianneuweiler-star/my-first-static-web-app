<?php

function verbindeDB() {
    $host = 'localhost';
    $dbname = 'php_aufgabe';
    $user = 'root';
    $pass = '';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Verbindung fehlgeschlagen: " . $e->getMessage());
    }
}

function speichereEintrag($pdo, $name, $nachricht, $brief) {
    $sql = "INSERT INTO formular_daten (name, nachricht, bestaetigungsbrief) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$name, $nachricht, $brief]);
}

function holeDaten($pdo, $filter = 'alle') {
    if ($filter === 'nur_brief') {
        $sql = "SELECT * FROM formular_daten WHERE bestaetigungsbrief = 1";
    } else {
        $sql = "SELECT * FROM formular_daten";
    }
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function schliesseDB(&$pdo) {
    $pdo = null;
}
?>