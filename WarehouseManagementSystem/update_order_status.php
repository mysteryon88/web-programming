<?php
include 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderID = mysqli_real_escape_string($conn, $_POST["orderID"]);
    $StatusID = mysqli_real_escape_string($conn, $_POST["StatusID"]);
	$employee_id = $_SESSION['employee_id'];

    $sql = "UPDATE Orders SET StatusID = '$StatusID', employee_id = employee_id WHERE OrderID = '$orderID'";

    if ($conn->query($sql) === TRUE) {
        header("Location: order_management.php?success=Информация о заказе успешно обновлена!");
    } else {
        $error = "Ошибка: " . $sql . "<br>" . $conn->error;
        header("Location: order_management.php?success=$error");
    }
}
$conn->close();
?>
