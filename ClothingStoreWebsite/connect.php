<?php 
	$host = 'localhost';
	$database = 'clothes';
	$username = 'root';
	$password = '';
	$conn = mysqli_connect($host, $username, $password, $database);
	if(!$conn) die("Database connection error ". mysqli_connect_error());
?>