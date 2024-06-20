<?php
// Nome del file database
$dbFile = 'MyDb.db';

// Crea (o apri) il database SQLite
$db = new SQLite3($dbFile);

// Crea la tabella per il contatore, se non esiste già
$db->exec("CREATE TABLE IF NOT EXISTS visit_counter (
    id INTEGER PRIMARY KEY,
    count INTEGER NOT NULL
)");

// Inserisci un valore iniziale se la tabella è vuota
$result = $db->query("SELECT count(*) as count FROM visit_counter");
$row = $result->fetchArray(SQLITE3_ASSOC);
if ($row['count'] == 0) {
    $db->exec("INSERT INTO visit_counter (count) VALUES (0)");
}

// Chiudi la connessione al database
$db->close();
?>
