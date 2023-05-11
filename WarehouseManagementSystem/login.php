<?php
session_start();

include 'connect.php';

$login = mysqli_real_escape_string($conn, $_POST['login']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = "SELECT * FROM employees WHERE login = '$login'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $employee = mysqli_fetch_assoc($result);

    if (password_verify($password, $employee['password'])) {
        
        $_SESSION['employee_id'] = $employee['id'];
        $_SESSION['employee_login'] = $employee['login'];

        header("Location: index.php");
        exit;
    } else {
        header("Location: login.html?error=wrong_password");
        exit;
    }
} else {
    header("Location: login.html?error=not_found");
    exit;
}

mysqli_close($conn);
?>
