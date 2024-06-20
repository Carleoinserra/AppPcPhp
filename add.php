<?php
$modello = $_POST["modello"];
$marca = $_POST["marca"];
$img = $_POST["img"];
$costo = $_POST["costo"];
$qnt = $_POST["qnt"];

$db = new SQLite3('MyDb.db');
// Inserisci dati nella tabella usando prepared statements
$stmt = $db->prepare('INSERT INTO computer (modello, marca, prezzo,img,  qnt, vendite) VALUES (:modello, :marca,:prezzo,:img, :qnt, :vendite   )');
$stmt->bindValue(':modello', $modello, SQLITE3_TEXT);
    $stmt->bindValue(':marca', $marca, SQLITE3_TEXT);
    $stmt->bindValue(':img', $img, SQLITE3_TEXT);
    $stmt->bindValue(':prezzo', $costo, SQLITE3_TEXT);
    $stmt->bindValue(':qnt', $qnt, SQLITE3_TEXT);
    $stmt->bindValue(':vendite', 0, SQLITE3_TEXT);
 // Esegui la query e controlla il risultato
 if ($stmt->execute()) {
    echo "Nuovo pc inserito con successo.";
} else {
    echo "Errore nell'inserimento del pc: " . $db->lastErrorMsg();
}   



?>