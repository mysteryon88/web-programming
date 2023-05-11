<?php
include 'connect.php';
session_start();

if (isset($_POST['orders'])) {

    $shipmentDate = date('Y-m-d H:i:s');
	$employee_id = $_SESSION['employee_id'];

    foreach ($_POST['orders'] as $orderID) {

        if (is_numeric($orderID)) {

            $sql = "INSERT INTO shipments (OrderID, ShipmentDate, StatusID, employee_id) VALUES ('$orderID', '$shipmentDate', '1', '$employee_id')";

            $conn->query($sql);
			
			$sql = "UPDATE Orders SET StatusID = '10', employee_id = employee_id WHERE OrderID = '$orderID'";
			
			$conn->query($sql);
        }
    }

    $conn->close();

    header("Location: shipment_requests.php?success=Отгрузка успешно добавлена!");
} else {
    header("Location: shipment_requests.php?success=Пустой список");
}
?>
