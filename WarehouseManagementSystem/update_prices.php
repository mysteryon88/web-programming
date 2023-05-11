<?php
include 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productID = mysqli_real_escape_string($conn, $_POST["productID"]);
    $newPrice = mysqli_real_escape_string($conn, $_POST["newPrice"]);
	$employee_id = $_SESSION['employee_id'];
	
    $sql = "UPDATE products SET Price = '$newPrice', employee_id = '$employee_id' WHERE ProductID = '$productID'";

    if ($conn->query($sql) === TRUE) {
		header("Location: database_management.php?success=Цена продукта успешно обновлена!"); 
    } else {
        $error = "Ошибка: " . $sql . "<br>" . $conn->error;
		header("Location: database_management.php?success=$error"); 
    }
}
exit;
?>
