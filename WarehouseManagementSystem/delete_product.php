<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $productID = mysqli_real_escape_string($conn, $_POST["productID"]);
    $employee_id = $_SESSION["employee_id"];

    $updateSql = "UPDATE products SET employee_id = '$employee_id' WHERE ProductID = '$productID'";
    $conn->query($updateSql);

    $sql = "DELETE FROM products WHERE ProductID = '$productID'";

    if ($conn->query($sql) === TRUE) {
        header("Location: database_management.php?success=Продукт успешно удален!");
    } else {
        $error = "Ошибка: " . $sql . "<br>" . $conn->error;
        header("Location: database_management.php?success=$error");
    }
}
exit;
?>
