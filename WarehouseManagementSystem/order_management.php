<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление заказами</title>
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
            <li><a href="warehouse_management.php">Управление складом</a></li>
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
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				const searchParams = new URLSearchParams(window.location.search);
				const success = searchParams.get("success");
				if (success)
					alert(success);
			});
		</script>
        <section>
            <h2>Заказы</h2>
			<?php
				include 'connect.php';
				$sql = "SELECT o.OrderID, o.OrderDate, c.ClientName, p.ProductName, 
							p.Price * od.Quantity AS price , od.Quantity, s.Status
						FROM Orders o
						JOIN Clients c ON o.ClientID = c.ClientID
						JOIN Statuses s ON o.StatusID = s.StatusID
						JOIN OrderDetails od ON o.OrderID = od.OrderID
						JOIN Products p ON od.ProductID = p.ProductID
						ORDER BY o.OrderID";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
			?>
					<table>
						<thead>
							<tr>
								<th>Номер заказа</th>
								<th>Дата заказа</th>
								<th>Клиент</th>
								<th>Продукт</th>
								<th>Количество</th>
								<th>Стоимость</th>
								<th>Статус</th>
							</tr>
						</thead>
						<tbody>
			<?php
					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td class=center>" . $row["OrderID"] . "</td>";
						echo "<td class=center>" . $row["OrderDate"] . "</td>";
						echo "<td class=center>" . $row["ClientName"] . "</td>";
						echo "<td class=center>" . $row["ProductName"] . "</td>";
						echo "<td class=center>" . $row["Quantity"] . "</td>";
						echo "<td class=center>" . $row["price"] . "</td>";
						echo "<td class=center>" . $row["Status"] . "</td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='5' class=center>Нет заказов</td></tr>";
				}
			?>
						</tbody>
					</table>
		</section>
		<section>
			<h2>Обновление информации о заказе</h2>
			<form action="update_order_status.php" method="post">
				<label for="orderID">Выберите заказ:</label>
				<select id="orderID" name="orderID" required>
					<?php
					$sql = "SELECT OrderID FROM Orders WHERE StatusID != 10";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<option value='" . $row["OrderID"] . "'>Заказ #" . $row["OrderID"] . "</option>";
						}
					} else {
						echo "<option value=''>Нет доступных заказов</option>";
					}
					?>
				</select><br>
				<label for="StatusID">Статус заказа:</label>
				<select id="StatusID" name="StatusID" required>
				<?php
					$sql = "SELECT * FROM statuses";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<option value='" . $row["StatusID"] . "'>" . $row["Status"] . "</option>";
						}
					} 
					?>
				</select><br>
				<button type="submit">Обновить информацию о заказе</button>
			</form>
		</section>

	</main>
    <footer>
        <p>&copy; 2023 Дистрибьюторская компания. Все права защищены.</p>
    </footer>
</body>
</html>
