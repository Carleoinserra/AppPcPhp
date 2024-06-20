<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    echo("Non hai i permessi per accedere alla pagina");
    echo("<br>");
    echo("<form action = 'home.html' method = 'get'>");
    echo("<input type = 'submit' value = 'torna alla home'>");
    echo("</form>");
    exit;
}
// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal form
    $modello = $_POST['modello'];
    $qnt = $_POST['qnt'];

    // Collegati al database SQLite
    $db = new SQLite3('MyDb.db');

    

    // Aggiorna la mansione nella tabella dipendenti usando prepared statements
    $stmt = $db->prepare('UPDATE computer SET qnt = qnt + :qnt WHERE modello = :modello');
    $stmt->bindValue(':modello', $modello, SQLITE3_TEXT);
    $stmt->bindValue(':qnt', $qnt, SQLITE3_TEXT);

    // Esegui la query e controlla il risultato
    if ($stmt->execute()) {
        if ($db->changes() > 0) {
            echo "Pezzi aggiunti con successo.";
        } else {
            echo "Errore: nessun computer trovato con il nome specificato.";
        }
    } else {
        echo "Errore nell'aggiornamento dei pezzi: " . $db->lastErrorMsg();
    }

    // Chiudi la connessione al database
    $db->close();
}
?>
