<?php
try {
    // Collegati a un nuovo database (verrà creato se non esiste)
    $db = new SQLite3('MyDb.db');

    // Crea una tabella
    $query = 'CREATE TABLE IF NOT EXISTS computer(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        modello TEXT NOT NULL,
        marca TEXT NOT NULL,
        prezzo NUMBER NOT NULL,
        img TEXT NOT NULL,
        qnt NUMBER NOT NULL,
        vendite NUMBER NOT NULL
    )';
    $db->exec($query);

    // Query per verificare l'esistenza della tabella dipendenti
    $query = "SELECT name FROM sqlite_master WHERE type='table' AND name='computer';";
    $result = $db->query($query);

    // Controlla il risultato
    if ($result->fetchArray()) {
        echo "La tabella 'computer' esiste.";
    } else {
        echo "La tabella 'computer' non esiste.";
    }
    
} catch (Exception $e) {
    echo "Errore: " . $e->getMessage();
} finally {
    // Chiudi la connessione al database
    $db->close();
}
?>
