<?php
// Nome del file database
$dbFile = 'MyDb.db';

// Connettersi al database SQLite
$db = new SQLite3($dbFile);

// Recuperare i dati dalla tabella 'computers'
$result = $db->query('SELECT modello, vendite FROM computer');

// Inizializzare gli array per i dati
$labels = [];
$data = [];

// Iterare sui risultati e riempire gli array
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $labels[] = $row['modello'];
    $data[] = $row['vendite'];
}

// Convertire gli array in formato JSON
$labels = json_encode($labels);
$data = json_encode($data);

// Chiudere la connessione al database
$db->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grafico delle Vendite dei Computer</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 300px; /* Regola questa dimensione per ridimensionare i grafici */
            height: 200px; /* Regola questa dimensione per ridimensionare i grafici */
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h2>Grafico a Barre delle Vendite dei Computer</h2>
<div class="chart-container">
    <canvas id="barChart"></canvas>
</div>

<h2>Grafico a Torta delle Vendite dei Computer</h2>
<div class="chart-container">
    <canvas id="pieChart"></canvas>
</div>

<script>
var barCtx = document.getElementById('barChart').getContext('2d');
var barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: <?php echo $labels; ?>,
        datasets: [{
            label: 'Vendite dei Computer',
            data: <?php echo $data; ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var pieCtx = document.getElementById('pieChart').getContext('2d');
var pieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: <?php echo $labels; ?>,
        datasets: [{
            data: <?php echo $data; ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(199, 199, 199, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(199, 199, 199, 1)'
            ],
            borderWidth: 1
        }]
    }
});
</script>

</body>
</html>