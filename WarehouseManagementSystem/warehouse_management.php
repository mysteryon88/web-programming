<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление складом</title>
    <link rel="stylesheet" href="styles.css">
	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Система управления складом дистрибьюторской компании</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Начальная страница</a></li>
            <li><a href="order_management.php">Управление заказами</a></li>
            <li><a href="shipment_requests.php">Формирование заявок на отгрузку продукции</a></li>
            <li><a href="reports.php">Отчеты</a></li>
            <li><a href="database_management.php">Управление базой данных</a></li>
			<?php
				session_start();
				if (isset($_SESSION['employee_id'])) {
			?>
					<a href="logout.php"><button class="login-button">Выход</button></a>
			<?php	
				} else {
			?>
					<a href="login.html"><button class="login-button">Вход</button></a>
			<?php 
				}
			?>
        </ul>
    </nav>
    <main>
        <section>
			<?php
				include 'connect.php';
				$sql = "SELECT * FROM products INNER JOIN suppliers ON products.SupplierID = suppliers.SupplierID";
				$result = $conn->query($sql);
			?>
            <h2>Загруженная продукция</h2>
			<table>
				<thead>
					<tr>
						<th>Номер продукта</th>
						<th>Название продукта</th>
						<th>Цена продукта</th>
						<th>Поставщик</th>
						<th>Изображение продукта</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . $row["ProductID"] . "</td>";
								echo "<td>" . $row["ProductName"] . "</td>";
								echo "<td>" . $row["Price"] . "</td>";
								echo "<td>" . $row["SupplierName"] . "</td>";
								echo "<td><img src='" . $row["ProductImage"] . "' alt='" . $row["ProductName"] . "' style='width: 100px; height: auto;'></td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='4'>Нет загруженной продукции</td></tr>";
						}
					?>
				</tbody>
			</table>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Дистрибьюторская компания. Все права защищены.</p>
    </footer>
</body>
</html>
