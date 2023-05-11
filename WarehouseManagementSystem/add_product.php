<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["employee_id"])) {
    // Обработка загруженного файла
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
        $productName = mysqli_real_escape_string($conn, $_POST["productName"]);
        $productPrice = mysqli_real_escape_string($conn, $_POST["productPrice"]);
        $supplierID = mysqli_real_escape_string($conn, $_POST["supplierID"]);
        $productImage = mysqli_real_escape_string($conn, $target_file);
		$employee_id = $_SESSION['employee_id'];

        $sql = "INSERT INTO products (ProductName, Price, SupplierID, employee_id, ProductImage) VALUES ('$productName', '$productPrice', '$supplierID', '$employee_id','$productImage')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: database_management.php?success=Продукт успешно добавлен!");
        } else {
            $error = "Ошибка: " . $sql . "<br>" . $conn->error;
            header("Location: database_management.php?success=$error");
        }
    } else {
        header("Location: database_management.php?error=Ошибка загрузки изображения");
    }
} else {
    header("Location: database_management.php?error=Ошибка доступа");
}
exit;
?>
