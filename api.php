<?php
header('Content-Type: application/json');
require_once 'config.php';

// Verbindung zur Datenbank herstellen
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Datenbankverbindung fehlgeschlagen: ' . $conn->connect_error]));
}

// Action-Parameter auslesen (GET oder POST)
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

switch ($action) {

    case 'login':
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'user' => $user]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Ungültige Anmeldedaten.']);
        }
        $stmt->close();
        break;

    case 'getProducts':
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        $products = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        echo json_encode(['status' => 'success', 'data' => $products]);
        break;

    case 'getCustomers':
        $sql = "SELECT * FROM customers";
        $result = $conn->query($sql);
        $customers = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $customers[] = $row;
            }
        }
        echo json_encode(['status' => 'success', 'data' => $customers]);
        break;

    case 'saveCustomer':
        $stmt = $conn->prepare("INSERT INTO customers (customerNumber, customerCompanyName, customerAddressZusatz, customerStreet, customerZip, customerCity, customerCountry, customerPhone1, customerPhone2, customerFax, customerEmail, customerWebsite, customerUstId, customerTaxCode, customerDiscount, customerExtraText) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $customerNumber = isset($_POST['customerNumber']) ? $_POST['customerNumber'] : '';
        $customerCompanyName = isset($_POST['customerCompanyName']) ? $_POST['customerCompanyName'] : '';
        $customerAddressZusatz = isset($_POST['customerAddressZusatz']) ? $_POST['customerAddressZusatz'] : '';
        $customerStreet = isset($_POST['customerStreet']) ? $_POST['customerStreet'] : '';
        $customerZip = isset($_POST['customerZip']) ? $_POST['customerZip'] : '';
        $customerCity = isset($_POST['customerCity']) ? $_POST['customerCity'] : '';
        $customerCountry = isset($_POST['customerCountry']) ? $_POST['customerCountry'] : '';
        $customerPhone1 = isset($_POST['customerPhone1']) ? $_POST['customerPhone1'] : '';
        $customerPhone2 = isset($_POST['customerPhone2']) ? $_POST['customerPhone2'] : '';
        $customerFax = isset($_POST['customerFax']) ? $_POST['customerFax'] : '';
        $customerEmail = isset($_POST['customerEmail']) ? $_POST['customerEmail'] : '';
        $customerWebsite = isset($_POST['customerWebsite']) ? $_POST['customerWebsite'] : '';
        $customerUstId = isset($_POST['customerUstId']) ? $_POST['customerUstId'] : '';
        $customerTaxCode = isset($_POST['customerTaxCode']) ? $_POST['customerTaxCode'] : '';
        $customerDiscount = isset($_POST['customerDiscount']) ? $_POST['customerDiscount'] : 0;
        $customerExtraText = isset($_POST['customerExtraText']) ? $_POST['customerExtraText'] : '';
        $stmt->bind_param("sssssssssssssdss", $customerNumber, $customerCompanyName, $customerAddressZusatz, $customerStreet, $customerZip, $customerCity, $customerCountry, $customerPhone1, $customerPhone2, $customerFax, $customerEmail, $customerWebsite, $customerUstId, $customerTaxCode, $customerDiscount, $customerExtraText);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Kunde erfolgreich gespeichert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'getSuppliers':
        $sql = "SELECT * FROM suppliers";
        $result = $conn->query($sql);
        $suppliers = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $suppliers[] = $row;
            }
        }
        echo json_encode(['status' => 'success', 'data' => $suppliers]);
        break;

    case 'saveSupplier':
        $stmt = $conn->prepare("INSERT INTO suppliers (supplierNumber, supplierCompanyName, supplierAddressZusatz, supplierStreet, supplierZip, supplierCity, supplierCountry, supplierPhone1, supplierPhone2, supplierFax, supplierEmail, supplierWebsite, supplierUstId, supplierTaxCode, supplierZusatztext, supplierOwnCustomerNumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $supplierNumber = isset($_POST['supplierNumber']) ? $_POST['supplierNumber'] : '';
        $supplierCompanyName = isset($_POST['supplierCompanyName']) ? $_POST['supplierCompanyName'] : '';
        $supplierAddressZusatz = isset($_POST['supplierAddressZusatz']) ? $_POST['supplierAddressZusatz'] : '';
        $supplierStreet = isset($_POST['supplierStreet']) ? $_POST['supplierStreet'] : '';
        $supplierZip = isset($_POST['supplierZip']) ? $_POST['supplierZip'] : '';
        $supplierCity = isset($_POST['supplierCity']) ? $_POST['supplierCity'] : '';
        $supplierCountry = isset($_POST['supplierCountry']) ? $_POST['supplierCountry'] : '';
        $supplierPhone1 = isset($_POST['supplierPhone1']) ? $_POST['supplierPhone1'] : '';
        $supplierPhone2 = isset($_POST['supplierPhone2']) ? $_POST['supplierPhone2'] : '';
        $supplierFax = isset($_POST['supplierFax']) ? $_POST['supplierFax'] : '';
        $supplierEmail = isset($_POST['supplierEmail']) ? $_POST['supplierEmail'] : '';
        $supplierWebsite = isset($_POST['supplierWebsite']) ? $_POST['supplierWebsite'] : '';
        $supplierUstId = isset($_POST['supplierUstId']) ? $_POST['supplierUstId'] : '';
        $supplierTaxCode = isset($_POST['supplierTaxCode']) ? $_POST['supplierTaxCode'] : '';
        $supplierZusatztext = isset($_POST['supplierZusatztext']) ? $_POST['supplierZusatztext'] : '';
        $supplierOwnCustomerNumber = isset($_POST['supplierOwnCustomerNumber']) ? $_POST['supplierOwnCustomerNumber'] : '';
        $stmt->bind_param("ssssssssssssssss", $supplierNumber, $supplierCompanyName, $supplierAddressZusatz, $supplierStreet, $supplierZip, $supplierCity, $supplierCountry, $supplierPhone1, $supplierPhone2, $supplierFax, $supplierEmail, $supplierWebsite, $supplierUstId, $supplierTaxCode, $supplierZusatztext, $supplierOwnCustomerNumber);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Lieferant erfolgreich gespeichert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'getCategories':
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);
        $categories = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        echo json_encode(['status' => 'success', 'data' => $categories]);
        break;

    case 'saveCategory':
        $stmt = $conn->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $stmt->bind_param("ss", $name, $description);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Kategorie erfolgreich gespeichert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'getBestellungen':
        $sql = "SELECT * FROM bestellungen";
        $result = $conn->query($sql);
        $orders = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        echo json_encode(['status' => 'success', 'data' => $orders]);
        break;

    case 'saveBestellung':
        $stmt = $conn->prepare("INSERT INTO bestellungen (number, date, supplierId, status, note, discount) VALUES (?, ?, ?, ?, ?, ?)");
        $number = isset($_POST['number']) ? $_POST['number'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $supplierId = isset($_POST['supplierId']) ? $_POST['supplierId'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $note = isset($_POST['note']) ? $_POST['note'] : '';
        $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
        $stmt->bind_param("ssissd", $number, $date, $supplierId, $status, $note, $discount);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Bestellung erfolgreich gespeichert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'getOrders':
        // Hier statt "auftraege" die Tabelle "orders" verwenden
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);
        $orders = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        echo json_encode(['status' => 'success', 'data' => $orders]);
        break;

    case 'saveOrder':
        // Tabelle "orders" (statt "auftraege") mit den Spalten: number, date, customerId, status, diffAddress, shipping, shippingCost, note, discount
        $stmt = $conn->prepare("INSERT INTO orders (number, date, customerId, status, diffAddress, shipping, shippingCost, note, discount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $number = isset($_POST['number']) ? $_POST['number'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $customerId = isset($_POST['customerId']) ? $_POST['customerId'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $diffAddress = isset($_POST['diffAddress']) ? $_POST['diffAddress'] : 0;
        $shipping = isset($_POST['shipping']) ? $_POST['shipping'] : '';
        $shippingCost = isset($_POST['shippingCost']) ? $_POST['shippingCost'] : 0;
        $note = isset($_POST['note']) ? $_POST['note'] : '';
        $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
        $stmt->bind_param("ssisssdsd", $number, $date, $customerId, $status, $diffAddress, $shipping, $shippingCost, $note, $discount);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Auftrag erfolgreich gespeichert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'getMasterdata':
        $sql = "SELECT * FROM masterdata LIMIT 1";
        $result = $conn->query($sql);
        $data = $result ? $result->fetch_assoc() : null;
        echo json_encode(['status' => 'success', 'data' => $data]);
        break;

    case 'saveMasterdata':
        $stmt = $conn->prepare("UPDATE masterdata SET companyName = ?, addressZusatz = ?, street = ?, zip = ?, city = ?, country = ?, phone1 = ?, phone2 = ?, fax = ?, email = ?, website = ?, ustId = ?, taxCode = ?, bankName = ?, iban = ?, bic = ?, kontoNummer = ?, kontoInhaber = ?, bankleitzahl = ?, referenz = ?");
        $companyName = isset($_POST['companyName']) ? $_POST['companyName'] : '';
        $addressZusatz = isset($_POST['addressZusatz']) ? $_POST['addressZusatz'] : '';
        $street = isset($_POST['street']) ? $_POST['street'] : '';
        $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $phone1 = isset($_POST['phone1']) ? $_POST['phone1'] : '';
        $phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : '';
        $fax = isset($_POST['fax']) ? $_POST['fax'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $website = isset($_POST['website']) ? $_POST['website'] : '';
        $ustId = isset($_POST['ustId']) ? $_POST['ustId'] : '';
        $taxCode = isset($_POST['taxCode']) ? $_POST['taxCode'] : '';
        $bankName = isset($_POST['bankName']) ? $_POST['bankName'] : '';
        $iban = isset($_POST['iban']) ? $_POST['iban'] : '';
        $bic = isset($_POST['bic']) ? $_POST['bic'] : '';
        $kontoNummer = isset($_POST['kontoNummer']) ? $_POST['kontoNummer'] : '';
        $kontoInhaber = isset($_POST['kontoInhaber']) ? $_POST['kontoInhaber'] : '';
        $bankleitzahl = isset($_POST['bankleitzahl']) ? $_POST['bankleitzahl'] : '';
        $referenz = isset($_POST['referenz']) ? $_POST['referenz'] : '';
        $stmt->bind_param("ssssssssssssssssssss", $companyName, $addressZusatz, $street, $zip, $city, $country, $phone1, $phone2, $fax, $email, $website, $ustId, $taxCode, $bankName, $iban, $bic, $kontoNummer, $kontoInhaber, $bankleitzahl, $referenz);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Stammdaten aktualisiert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'getReturns':
        // Statt "retoure" verwenden wir jetzt "returns"
        $sql = "SELECT * FROM returns";
        $result = $conn->query($sql);
        $returns = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $returns[] = $row;
            }
        }
        echo json_encode(['status' => 'success', 'data' => $returns]);
        break;

    case 'saveReturn':
        // Tabelle "returns" mit den Spalten: retoureNumber, retoureDate, retourePurchaseDate, retoureReason, discount
        $stmt = $conn->prepare("INSERT INTO returns (retoureNumber, retoureDate, retourePurchaseDate, retoureReason, discount) VALUES (?, ?, ?, ?, ?)");
        $retoureNumber = isset($_POST['retoureNumber']) ? $_POST['retoureNumber'] : '';
        $retoureDate = isset($_POST['retoureDate']) ? $_POST['retoureDate'] : '';
        $retourePurchaseDate = isset($_POST['retourePurchaseDate']) ? $_POST['retourePurchaseDate'] : '';
        $retoureReason = isset($_POST['retoureReason']) ? $_POST['retoureReason'] : '';
        $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
        $stmt->bind_param("ssssd", $retoureNumber, $retoureDate, $retourePurchaseDate, $retoureReason, $discount);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Return erfolgreich gespeichert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'createTagesabschluss':
        // Falls Du einen Tagesabschluss speichern möchtest – siehe unten auch den SQL-Code zur Erstellung der Tabelle
        $stmt = $conn->prepare("INSERT INTO tagesabschluss (abschlussDate, totalAuftrag, totalBestellung, totalRetoure, differenz) VALUES (NOW(), ?, ?, ?, ?)");
        $totalAuftrag = isset($_POST['totalAuftrag']) ? $_POST['totalAuftrag'] : 0;
        $totalBestellung = isset($_POST['totalBestellung']) ? $_POST['totalBestellung'] : 0;
        $totalRetoure = isset($_POST['totalRetoure']) ? $_POST['totalRetoure'] : 0;
        $differenz = isset($_POST['differenz']) ? $_POST['differenz'] : 0;
        $stmt->bind_param("ddds", $totalAuftrag, $totalBestellung, $totalRetoure, $differenz);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Tagesabschluss erstellt.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'getTransactions':
        $sql = "SELECT * FROM transactions";
        $result = $conn->query($sql);
        $transactions = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $transactions[] = $row;
            }
        }
        echo json_encode(['status' => 'success', 'data' => $transactions]);
        break;

    case 'search':
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $stmt = $conn->prepare("SELECT * FROM products WHERE title LIKE ? OR description LIKE ?");
        $likeQuery = '%' . $query . '%';
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = [];
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        echo json_encode(['status' => 'success', 'data' => $results]);
        $stmt->close();
        break;

    case 'generateReport':
        $reportFrom = isset($_GET['reportFrom']) ? $_GET['reportFrom'] : '';
        $reportTo = isset($_GET['reportTo']) ? $_GET['reportTo'] : '';
        $reportType = isset($_GET['reportType']) ? $_GET['reportType'] : '';
        $stmt = $conn->prepare("SELECT * FROM transactions WHERE (date BETWEEN ? AND ?) OR (retoureDate BETWEEN ? AND ?)");
        $stmt->bind_param("ssss", $reportFrom, $reportTo, $reportFrom, $reportTo);
        $stmt->execute();
        $result = $stmt->get_result();
        $reportData = [];
        while ($row = $result->fetch_assoc()) {
            $reportData[] = $row;
        }
        echo json_encode(['status' => 'success', 'data' => $reportData]);
        $stmt->close();
        break;

    case 'getUsers':
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $users = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        echo json_encode(['status' => 'success', 'data' => $users]);
        break;

    case 'saveUser':
        $stmt = $conn->prepare("INSERT INTO users (username, name, password, role) VALUES (?, ?, ?, ?)");
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $role = isset($_POST['role']) ? $_POST['role'] : '';
        $stmt->bind_param("ssss", $username, $name, $password, $role);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Benutzer erfolgreich gespeichert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Kein gültiger Action-Parameter angegeben.']);
        break;
}

$conn->close();
?>
