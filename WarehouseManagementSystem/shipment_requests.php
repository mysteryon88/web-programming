<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Формирование заявок на отгрузку продукции</title>
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
            <li><a href="order_management.php">Управление заказами</a></li>
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
            <h2>Формирование заявок на отгрузку продукции</h2>
            <p>Выберите завершенные заказы для формирования заявки на отгрузку продукции со склада клиентам.</p>			
				<?php
					include 'connect.php';
					$sql = "SELECT o.OrderID, o.OrderDate, c.ClientName, p.ProductName,
							p.Price * od.Quantity AS price, od.Quantity, s.Status
						FROM Orders o
						JOIN Clients c ON o.ClientID = c.ClientID
						JOIN Statuses s ON o.StatusID = s.StatusID
						JOIN OrderDetails od ON o.OrderID = od.OrderID
						JOIN Products p ON od.ProductID = p.ProductID
						WHERE s.Status = 'Завершено'
						ORDER BY o.OrderID";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
				?>
					<form action="create_shipment_request.php" method="post">
						<table>
							<thead>
								<tr>
									<th></th>
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
						echo "<td class=center><input type='checkbox' name='orders[]' value='" . $row["OrderID"] . "'></td>";
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
					echo "<tr><td colspan='8' class=center>Нет заказов</td></tr>";
				}
				?>
							</tbody>
						</table>
						<br>
						<button type="submit">Отправить на отгрузку</button>
					</form>
        </section>
		<section>
			<h2>Таблица пути</h2>
			<?php
				include 'connect.php';
				$sql = "SELECT o.OrderID, o.OrderDate, c.ClientName, p.ProductName, 
							p.Price * od.Quantity AS price, od.Quantity, s.Status, sh.ShipmentDate AS LatestShipmentDate, sh.ShipmentID
						FROM Orders o
						JOIN Clients c ON o.ClientID = c.ClientID
						JOIN OrderDetails od ON o.OrderID = od.OrderID
						JOIN Products p ON od.ProductID = p.ProductID
						JOIN Shipments sh ON o.OrderID = sh.OrderID
						JOIN Statuses s ON sh.StatusID = s.StatusID
						JOIN (
						  SELECT OrderID, MAX(ShipmentDate) AS MaxShipmentDate
						  FROM Shipments
						  GROUP BY OrderID
						) latest_shipment ON sh.OrderID = latest_shipment.OrderID AND sh.ShipmentDate = latest_shipment.MaxShipmentDate
						ORDER BY o.OrderID;";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
			?>
					<table>
						<thead>
							<tr>
								<th>Номер отгрузки</th>
								<th>Номер заказа</th>
								<th>Дата и время</th>
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
						echo "<td class=center>" . $row["ShipmentID"] . "</td>";
						echo "<td class=center>" . $row["OrderID"] . "</td>";
						echo "<td class=center>" . $row["LatestShipmentDate"] . "</td>";
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
            <h2>Обновление информации об отгрузкe</h2>
            
            <form action="update_shipment_status.php" method="post">
				<label for="shipmentID">Выберите отгрузку:</label>
				<select id="shipmentID" name="shipmentID" required>
					<?php
					
					$sql = "SELECT sh.ShipmentID
						FROM Orders o
						JOIN Shipments sh ON o.OrderID = sh.OrderID
						JOIN (
						  SELECT OrderID, MAX(ShipmentDate) AS MaxShipmentDate
						  FROM Shipments
						  GROUP BY OrderID
						) latest_shipment ON sh.OrderID = latest_shipment.OrderID AND sh.ShipmentDate = latest_shipment.MaxShipmentDate
						ORDER BY o.OrderID;";
					$result = $conn->query($sql);
					
					while ($row = $result->fetch_assoc()) {
						echo "<option value='" . $row["ShipmentID"] . "'>Отгрузка #" . $row["ShipmentID"] . "</option>";
					}

					?>
				</select><br>
				<label for="StatusID">Статус отгрузки:</label>
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
                <button type="submit">Обновить статус отгрузки</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Дистрибьюторская компания. Все права защищены.</p>
    </footer>
</body>
</html>
