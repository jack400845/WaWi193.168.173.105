<?php
// config.php – MySQL‑Verbindungsdaten
$host     = "expert-sagan-577.lima-db.de";
$port     = 3306;
$dbname   = "db_445211_1";
$username = "USER445211";
$password = "pobwod-0siqma-syMmur";

// Erstelle eine neue MySQLi-Verbindung
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Prüfe die Verbindung
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
