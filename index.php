<?php 
require_once 'functions.php'; 
$pdo = verbindeDB();
$meldung = "";


if (isset($_POST['speichern'])) {
    if (speichereEintrag($pdo, $_POST['name'], $_POST['nachricht'], isset($_POST['brief']) ? 1 : 0)) {
        $meldung = "Erfolgreich gespeichert!";
    }
}


$filter = $_GET['filter'] ?? 'alle';
$daten = holeDaten($pdo, $filter);
?>

<!DOCTYPE html>
<html lang="de">
<body>
    <h1>Aufgabe 3</h1>
    
    <h3>Neuer Eintrag</h3>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required><br>
        <textarea name="nachricht" placeholder="Nachricht"></textarea><br>
        <label><input type="checkbox" name="brief"> Brief erwünscht</label><br>
        <button type="submit" name="speichern">Speichern</button>
    </form>
    <p><?php echo $meldung; ?></p>

    <hr>

    <h3>Daten filtern</h3>
    <form method="GET">
        <select name="filter">
            <option value="alle" <?php if($filter=='alle') echo 'selected'; ?>>Alle</option>
            <option value="nur_brief" <?php if($filter=='nur_brief') echo 'selected'; ?>>Nur Briefe</option>
        </select>
        <button type="submit">Filter anwenden</button>
    </form>

    <table border="1">
        <tr><th>Name</th><th>Nachricht</th><th>Brief?</th></tr>
        <?php foreach ($daten as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['nachricht']) ?></td>
                <td><?= $row['bestaetigungsbrief'] ? 'Ja' : 'Nein' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php schliesseDB($pdo); ?>
</body>
</html>