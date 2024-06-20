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
// Iterare sui risultati e riempire gli array
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $modelloA[] = $row['modello'];
    $vendite[] = $row['vendite'];
    $prezzo[] = $row['prezzo'];
    $marca[] = $row['marca'];
    $qnt[] = $row['qnt'];
}
// Ottieni le chiavi dell'array
// Converti l'array associativo in un array numerico utilizzando array_values()
$modelloN = array_values($modelloA);
$modelloV = array_values($vendite);
$modelloP = array_values($prezzo);
$modelloM = array_values($marca);
$modelloQ = array_values($qnt);


// Convertire gli array in formato JSON
$modello = json_encode($modello);
$vendite = json_encode($vendite);
$prezzo = json_encode($prezzo);
$marca = json_encode($marca);
$qnt = json_encode($qnt);
$modello_array = json_decode($modello, true);




    ?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        
        var data = new google.visualization.DataTable();
        
       
    data.addColumn('string', 'modello');
    data.addColumn('string', 'marca');
    data.addColumn('number', 'pezzi in magazzino');
    data.addColumn('number', 'prodotti venduti');
    <?php


        $lunghezza = count($modelloN);
        for ($i = 0; $i < $lunghezza; $i++) {
            
            echo "data.addRows([
                ['$modelloN[$i]',  '$modelloM[$i]', $modelloQ[$i],$modelloV[$i]]
                
              ]);";
            
        } {
            
        }
    ?>
        

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
  </head>
  <body>
    <div id="table_div"></div>
  </body>
</html>