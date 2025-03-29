<?php
// api.php
header('Content-Type: application/json');
require_once 'config.php';

// Verbindung zur Datenbank herstellen
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error
    ]));
}

// Überprüfe, ob ein "action"-Parameter gesetzt ist (GET oder POST)
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

// Beispielendpunkte
switch ($action) {
    case 'test':
        // Test-Endpunkt, um die Verbindung zu prüfen
        echo json_encode([
            'status' => 'success',
            'message' => 'Datenbankverbindung erfolgreich.'
        ]);
        break;

    case 'login':
        // Beispiel: Login-Endpunkt
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        // Verwende vorbereitete Statements, um SQL-Injection zu vermeiden
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            echo json_encode([
                'status' => 'success',
                'user' => $user
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Ungültige Anmeldedaten.'
            ]);
        }
        $stmt->close();
        break;

    case 'getProducts':
        // Beispiel-Endpunkt: Alle Produkte aus der Tabelle "products" abrufen
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        $products = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        echo json_encode([
            'status' => 'success',
            'data' => $products
        ]);
        break;

    default:
        echo json_encode([
            'status' => 'error',
            'message' => 'Kein gültiger Action-Parameter angegeben.'
        ]);
        break;
}

// Verbindung schließen
$conn->close();
?>