<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    echo("Non hai i permessi per accedere alla pagina");
    echo("<br>");
    echo("<form action = 'home.html' method = 'get'>");
    echo("<input type = 'submit' value = 'torna alla home'>");
    echo("</form>");
    exit;
}
// Collegati al database SQLite
$db = new SQLite3('MyDb.db');

$modello = $_POST["modello"];

// Comando SQL per cancellarei dati della tabella da un modello
$stmt = $db->prepare('DELETE FROM computer WHERE modello = :modello');
$stmt->bindValue(':modello', $modello, SQLITE3_TEXT);

// Esegui il comando
$result = $stmt->execute();

if ($result) {
    echo "Il modello " . $modello . " è stato cancellato correttamente";
} else {
    echo "Errore nella cancellazione dei dati: " . $db->lastErrorMsg();
}

$db->close();
?>
