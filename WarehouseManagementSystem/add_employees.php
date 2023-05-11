<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $login = mysqli_real_escape_string($conn, $_POST["login"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO employees (name, login, password) VALUES ('$name', '$login', '$password')";
    
    if ($conn->query($sql) === TRUE) {
		header("Location: database_management.php?success=Сотрудник успешно добавлен!"); 
    } else {
        $error = "Ошибка: " . $sql . "<br>" . $conn->error;
		header("Location: database_management.php?success=$error"); 
    }
}
exit;
?>