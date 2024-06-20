<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <title>Talentform store</title>
    <style>
    img {
        width: 200px !important;
        height: 200px !important;
    }
    </style>
  </head>

<?php
// Collegati a un nuovo database (verrà creato se non esiste)
$db = new SQLite3('MyDb.db');



// Seleziona dati dalla tabella
$query = 'SELECT * FROM computer';
$result = $db->query($query);
echo("<form action ='compra.php' method = 'post'>");
echo ("<div class='card-group'>");


while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo ("<div class='card'>");
    echo("<img class='card-img-top' src='" . $row['img'] . "' alt='Card image cap'>");
    echo("<div class='card-body'>");
    echo("<h5 class='card-title'>". $row['modello'] . "</h5>");
    echo("<p class='card-text'>". "- Marca: " . $row['marca'] . "<br>" . 
    " - Prezzo: " . $row['prezzo'] . "<br>" . 
    " - Quantità: " . $row['qnt'] . "<br>" . 
     "Modello: " . $row['modello'] . "<br>");
     echo("</div>"); 
     echo("<input type='hidden' id='vehicle1' value = '" . $row['modello'] . "' name='" . $row['modello'] . "'>");
     echo("<input type = 'number' value = '0' name = '" . $row['id'] . "'> ");
     echo("</div>");
    
    

}


echo("</div>");
echo("<input type='submit' value = 'acquista'>");
echo("</form>");

// Chiudi la connessione al database
$db->close();
$dbFile = 'MyDb.db';

// Funzione per aggiornare il contatore
function updateCounter($dbFile) {
    // Crea (o apri) il database SQLite
    $db = new SQLite3($dbFile);

    // Ottieni il valore corrente del contatore
    $result = $db->query("SELECT count FROM visit_counter WHERE id = 1");
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $count = $row['count'];

    // Incrementa il conteggio
    $count++;

    // Aggiorna il valore nel database
    $db->exec("UPDATE visit_counter SET count = $count WHERE id = 1");

    // Chiudi la connessione al database
    $db->close();

    return $count;
}

// Aggiorna il contatore e ottieni il nuovo conteggio
$visitCount = updateCounter($dbFile);
?>

<p>Questo sito è stato visitato <?php echo $visitCount; ?> volte.</p>




