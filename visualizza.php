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
// Collegati a un nuovo database (verrà creato se non esiste)
$db = new SQLite3('MyDb.db');



// Seleziona dati dalla tabella
$query = 'SELECT * FROM computer';
$result = $db->query($query);

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "ID: " . $row['id'] . " - Modello: " . $row['modello'] . "<br>" . 
    " - Marca: " . $row['marca'] . "<br>" . 
    " - Prezzo: " . $row['prezzo'] . "<br>" . 
    " - Quantità: " . $row['qnt'] . "<br>" . 
    " - Vendite: " . $row['vendite'] . "<br>" . 
    " - Immagine: <img src='" . $row['img'] . "' alt='Immagine del prodotto'><br>";

}

// Chiudi la connessione al database
$db->close();
?>
<style>
    img {
        width: 300px;
    }
    </style>