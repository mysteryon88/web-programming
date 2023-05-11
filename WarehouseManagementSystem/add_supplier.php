<?php
include 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplierName = mysqli_real_escape_string($conn, $_POST["supplierName"]);
    $contactInfo = mysqli_real_escape_string($conn, $_POST["contactInfo"]);
    $employee_id = $_SESSION['employee_id'];
    
    $sql = "INSERT INTO suppliers (SupplierName, ContactInfo, employee_id) VALUES ('$supplierName', '$contactInfo', '$employee_id')";
    
    if ($conn->query($sql) === TRUE) {
		header("Location: database_management.php?success=Поставщик успешно добавлен!"); 
    } else {
        $error = "Ошибка: " . $sql . "<br>" . $conn->error;
		header("Location: database_management.php?success=$error"); 
    }
}
exit;
?>
