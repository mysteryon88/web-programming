<?php
include 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shipmentID = mysqli_real_escape_string($conn, $_POST["shipmentID"]);
    $StatusID = mysqli_real_escape_string($conn, $_POST["StatusID"]);
    $employee_id = $_SESSION['employee_id'];

    $sql = "SELECT * FROM `shipments` WHERE `ShipmentID` = '$shipmentID'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $shipment = $result->fetch_assoc();
        $OrderID = $shipment['OrderID'];
        $ShipmentDate = date("Y-m-d H:i:s");
        
        $sql = "INSERT INTO `shipments` (`ShipmentID`, `OrderID`, `ShipmentDate`, `StatusID`, `employee_id`) VALUES 
                (NULL, '$OrderID', '$ShipmentDate', '$StatusID', '$employee_id')";

        if ($conn->query($sql) === TRUE) {
            header("Location: shipment_requests.php?success=Информация об отгрузке успешно обновлена!");
        } else {
            $error = "Ошибка: " . $sql . "<br>" . $conn->error;
            header("Location: shipment_requests.php?success=$error");
        }
    } else {
        header("Location: shipment_requests.php?success=Отгрузка не найдена");
    }
}
$conn->close();
?>
