<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
        $stmt = $conn->prepare("INSERT INTO customers (customer_number, customer_company_name, address_zusatz, street, zip, city, country, phone1, phone2, fax, email, website, ust_id, tax_code, discount, extra_text) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $customer_number = isset($_POST['customer_number']) ? $_POST['customer_number'] : '';
        $customer_company_name = isset($_POST['customer_company_name']) ? $_POST['customer_company_name'] : '';
        $address_zusatz = isset($_POST['address_zusatz']) ? $_POST['address_zusatz'] : '';
        $street = isset($_POST['street']) ? $_POST['street'] : '';
        $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $phone1 = isset($_POST['phone1']) ? $_POST['phone1'] : '';
        $phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : '';
        $fax = isset($_POST['fax']) ? $_POST['fax'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $website = isset($_POST['website']) ? $_POST['website'] : '';
        $ust_id = isset($_POST['ust_id']) ? $_POST['ust_id'] : '';
        $tax_code = isset($_POST['tax_code']) ? $_POST['tax_code'] : '';
        $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
        $extra_text = isset($_POST['extra_text']) ? $_POST['extra_text'] : '';
        $stmt->bind_param("sssssssssssssdss", $customer_number, $customer_company_name, $address_zusatz, $street, $zip, $city, $country, $phone1, $phone2, $fax, $email, $website, $ust_id, $tax_code, $discount, $extra_text);
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
        $stmt = $conn->prepare("INSERT INTO suppliers (supplier_number, supplier_company_name, address_zusatz, street, zip, city, country, phone1, phone2, fax, email, website, ust_id, tax_code, extra_text, own_customer_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $supplier_number = isset($_POST['supplier_number']) ? $_POST['supplier_number'] : '';
        $supplier_company_name = isset($_POST['supplier_company_name']) ? $_POST['supplier_company_name'] : '';
        $address_zusatz = isset($_POST['address_zusatz']) ? $_POST['address_zusatz'] : '';
        $street = isset($_POST['street']) ? $_POST['street'] : '';
        $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $phone1 = isset($_POST['phone1']) ? $_POST['phone1'] : '';
        $phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : '';
        $fax = isset($_POST['fax']) ? $_POST['fax'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $website = isset($_POST['website']) ? $_POST['website'] : '';
        $ust_id = isset($_POST['ust_id']) ? $_POST['ust_id'] : '';
        $tax_code = isset($_POST['tax_code']) ? $_POST['tax_code'] : '';
        $extra_text = isset($_POST['extra_text']) ? $_POST['extra_text'] : '';
        $own_customer_number = isset($_POST['own_customer_number']) ? $_POST['own_customer_number'] : '';
        $stmt->bind_param("ssssssssssssssss", $supplier_number, $supplier_company_name, $address_zusatz, $street, $zip, $city, $country, $phone1, $phone2, $fax, $email, $website, $ust_id, $tax_code, $extra_text, $own_customer_number);
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
        $stmt = $conn->prepare("INSERT INTO bestellungen (number, order_date, supplier_id, status, note, discount) VALUES (?, ?, ?, ?, ?, ?)");
        $number = isset($_POST['number']) ? $_POST['number'] : '';
        $order_date = isset($_POST['order_date']) ? $_POST['order_date'] : '';
        $supplier_id = isset($_POST['supplier_id']) ? $_POST['supplier_id'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $note = isset($_POST['note']) ? $_POST['note'] : '';
        $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
        $stmt->bind_param("ssissd", $number, $order_date, $supplier_id, $status, $note, $discount);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Bestellung erfolgreich gespeichert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'getOrders':
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
        $stmt = $conn->prepare("INSERT INTO orders (number, order_date, customer_id, status, diff_address, shipping, shipping_cost, note, discount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $number = isset($_POST['number']) ? $_POST['number'] : '';
        $order_date = isset($_POST['order_date']) ? $_POST['order_date'] : '';
        $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : null;
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $diff_address = isset($_POST['diff_address']) ? $_POST['diff_address'] : 0;
        $shipping = isset($_POST['shipping']) ? $_POST['shipping'] : '';
        $shipping_cost = isset($_POST['shipping_cost']) ? $_POST['shipping_cost'] : 0;
        $note = isset($_POST['note']) ? $_POST['note'] : '';
        $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
        $stmt->bind_param("ssisssdsd", $number, $order_date, $customer_id, $status, $diff_address, $shipping, $shipping_cost, $note, $discount);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Order (Auftrag) erfolgreich gespeichert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'getMasterdata':
        $sql = "SELECT * FROM master_data LIMIT 1";
        $result = $conn->query($sql);
        $data = $result ? $result->fetch_assoc() : null;
        echo json_encode(['status' => 'success', 'data' => $data]);
        break;

    case 'saveMasterdata':
        $stmt = $conn->prepare("UPDATE master_data SET company_name = ?, address_zusatz = ?, street = ?, zip = ?, city = ?, country = ?, phone1 = ?, phone2 = ?, fax = ?, email = ?, website = ?, ust_id = ?, tax_code = ?, bank_name = ?, iban = ?, bic = ?, account_number = ?, account_holder = ?, bankleitzahl = ?, referenz = ?");
        $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : '';
        $address_zusatz = isset($_POST['address_zusatz']) ? $_POST['address_zusatz'] : '';
        $street = isset($_POST['street']) ? $_POST['street'] : '';
        $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $country = isset($_POST['country']) ? $_POST['country'] : '';
        $phone1 = isset($_POST['phone1']) ? $_POST['phone1'] : '';
        $phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : '';
        $fax = isset($_POST['fax']) ? $_POST['fax'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $website = isset($_POST['website']) ? $_POST['website'] : '';
        $ust_id = isset($_POST['ust_id']) ? $_POST['ust_id'] : '';
        $tax_code = isset($_POST['tax_code']) ? $_POST['tax_code'] : '';
        $bank_name = isset($_POST['bank_name']) ? $_POST['bank_name'] : '';
        $iban = isset($_POST['iban']) ? $_POST['iban'] : '';
        $bic = isset($_POST['bic']) ? $_POST['bic'] : '';
        $account_number = isset($_POST['account_number']) ? $_POST['account_number'] : '';
        $account_holder = isset($_POST['account_holder']) ? $_POST['account_holder'] : '';
        $bankleitzahl = isset($_POST['bankleitzahl']) ? $_POST['bankleitzahl'] : '';
        $referenz = isset($_POST['referenz']) ? $_POST['referenz'] : '';
        $stmt->bind_param("ssssssssssssssssssss", $company_name, $address_zusatz, $street, $zip, $city, $country, $phone1, $phone2, $fax, $email, $website, $ust_id, $tax_code, $bank_name, $iban, $bic, $account_number, $account_holder, $bankleitzahl, $referenz);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Stammdaten aktualisiert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'getReturns':
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
        $stmt = $conn->prepare("INSERT INTO returns (return_number, return_date, purchase_date, return_reason, discount, customer_id, order_id, additional_info) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $return_number = isset($_POST['return_number']) ? $_POST['return_number'] : '';
        $return_date = isset($_POST['return_date']) ? $_POST['return_date'] : '';
        $purchase_date = isset($_POST['purchase_date']) ? $_POST['purchase_date'] : '';
        $return_reason = isset($_POST['return_reason']) ? $_POST['return_reason'] : '';
        $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
        $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : null;
        $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;
        $additional_info = isset($_POST['additional_info']) ? $_POST['additional_info'] : '';
        $stmt->bind_param("ssssdsiis", $return_number, $return_date, $purchase_date, $return_reason, $discount, $customer_id, $order_id, $additional_info);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Return erfolgreich gespeichert.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
        break;

    case 'createTagesabschluss':
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
