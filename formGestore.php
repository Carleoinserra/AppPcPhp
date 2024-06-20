<?php
session_start();
$user = $_POST["user"];
$pass = $_POST["pass"];
if ($user == 'Rossi' && $pass == '1234') {
    $_SESSION['loggedin'] = true;
echo "
<form action='add.php' method='post'>
    Inserisci il modello: <input type='text' name='modello'> <br>
    Inserisci la marca: <input type='text' name='marca'> <br>
    Inserisci l'immagine: <input type='text' name='img'> <br>
    Inserisci il costo: <input type='number' name='costo'> <br>
    Inserisci la quantità: <input type='number' name='qnt'> <br>
    <input type='submit' value='Aggiungi'>
</form>

<hr>
<hr>
<form action='visualizza.php'>
    <input type='submit' value='Visualizza'>
</form>

<hr>
<hr>
<form action='visualizzaS.php'>
    <input type='submit' value='Visualizza Statistiche'>
</form>

<hr>
<hr>
Aggiungi un numero di pezzi a un prodotto <br>
<form action='addPezzi.php' method='post'>
    Inserisci il modello: <input type='text' name='modello'><br>
    Inserisci la quantità: <input type='number' name='qnt'> <br>
    <input type='submit' value='Aggiungi pezzi'>
</form>

<hr>
<hr>
Rimuovi un prodotto da un modello <br>
<form action='deleteProd.php' method='post'>
    Inserisci il modello: <input type='text' name='modello'><br>
    <input type='submit' value='Rimuovi prodotto'>
</form>
";}
else {
    echo("Non hai i permessi per accedere alla pagina");
    
        echo("<br>");
        echo("<form action = 'home.html' method = 'get'>");
        echo("<input type = 'submit' value = 'torna alla home'>");
        echo("</form>");
        exit;
    
}
?>





