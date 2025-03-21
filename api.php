<?php
// api.php – Backend-Endpunkt für AJAX-Aufrufe
header("Content-Type: application/json");

// Konfiguration einbinden
require_once 'config.php';

// Lese den Parameter "action" aus der URL (z. B. ?action=saveProduct)
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'saveProduct':
        // Produkt speichern (Beispiel)
        $title              = $_POST['title'];
        $description        = $_POST['description'];
        $ean                = $_POST['ean'];
        $sku                = $_POST['sku'];
        $unit               = $_POST['unit'];
        $color              = $_POST['color'];
        $size               = $_POST['size'];
        $category           = $_POST['category'];
        $storageLocation    = $_POST['storageLocation'];
        $expiryDate         = $_POST['expiryDate'];
        $supplierId         = $_POST['supplierId'];
        $extraText          = $_POST['extraText'];
        $purchasePrice      = $_POST['purchasePrice'];
        $salePrice          = $_POST['salePrice'];
        $taxRate            = $_POST['taxRate'];
        $minStock           = $_POST['minStock'];
        $minOrderQty        = $_POST['minOrderQty'];
        $stock              = $_POST['stock'];
        $status             = $_POST['status'];
        $cashView           = $_POST['cashView'];
        $promotionPrice     = $_POST['promotionPrice'];
        $promotionStartDate = $_POST['promotionStartDate'];
        $promotionEndDate   = $_POST['promotionEndDate'];

        $stmt = $conn->prepare("INSERT INTO products 
            (title, description, ean, sku, unit, color, size, category, storageLocation, expiryDate, supplierId, extraText, purchasePrice, salePrice, taxRate, minStock, minOrderQty, stock, status, cashView, promotionPrice, promotionStartDate, promotionEndDate)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            $title, $description, $ean, $sku, $unit, $color, $size, $category, $storageLocation, $expiryDate,
            $supplierId, $extraText, $purchasePrice, $salePrice, $taxRate, $minStock, $minOrderQty, $stock, $status, $cashView,
            $promotionPrice, $promotionStartDate, $promotionEndDate
        );
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "id" => $stmt->insert_id]);
        } else {
            echo json_encode(["status" => "error", "message" => $stmt->error]);
        }
        break;

    case 'getProducts':
        // Alle Produkte abrufen
        $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        echo json_encode(["status" => "success", "data" => $products]);
        break;

    // =====================================================================
    // Hier können weitere Endpunkte implementiert werden – analog zu saveProduct/getProducts
    // Beispielsweise: saveCustomer, getCustomers, saveCategory, getCategories, saveSupplier, getSuppliers,
    // saveAuftrag, getAuftraege, saveBestellung, getBestellungen, bookRetoure, getTransaktionen, saveMasterdata, getMasterdata, saveUser, getUsers usw.
    // =====================================================================

    // Beispiel: Kunde speichern
    case 'saveCustomer':
        $customerNumber        = $_POST['customerNumber'];
        $customerCompanyName   = $_POST['customerCompanyName'];
        $customerAddressZusatz = $_POST['customerAddressZusatz'];
        $customerStreet        = $_POST['customerStreet'];
        $customerZip           = $_POST['customerZip'];
        $customerCity          = $_POST['customerCity'];
        $customerCountry       = $_POST['customerCountry'];
        $customerPhone1        = $_POST['customerPhone1'];
        $customerPhone2        = $_POST['customerPhone2'];
        $customerFax           = $_POST['customerFax'];
        $customerEmail         = $_POST['customerEmail'];
        $customerWebsite       = $_POST['customerWebsite'];
        $customerUstId         = $_POST['customerUstId'];
        $customerTaxCode       = $_POST['customerTaxCode'];
        $customerDiscount      = $_POST['customerDiscount'];
        $customerExtraText     = $_POST['customerExtraText'];

        $stmt = $conn->prepare("INSERT INTO customers 
        (customerNumber, customerCompanyName, customerAddressZusatz, customerStreet, customerZip, customerCity, customerCountry, customerPhone1, customerPhone2, customerFax, customerEmail, customerWebsite, customerUstId, customerTaxCode, customerDiscount, customerExtraText)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssssdss",
            $customerNumber, $customerCompanyName, $customerAddressZusatz, $customerStreet, $customerZip,
            $customerCity, $customerCountry, $customerPhone1, $customerPhone2, $customerFax, $customerEmail,
            $customerWebsite, $customerUstId, $customerTaxCode, $customerDiscount, $customerExtraText
        );
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "id" => $stmt->insert_id]);
        } else {
            echo json_encode(["status" => "error", "message" => $stmt->error]);
        }
        break;

    // Weitere Endpunkte hier hinzufügen...

    default:
        echo json_encode(["status" => "error", "message" => "Kein gültiger Action-Parameter"]);
        break;
}

$conn->close();
?>