<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчет</title>
    <link rel="stylesheet" href="styles.css">
	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Отчет о заказе</h1>
    </header>
	<div style="padding: 30px; text-align: right;">
		<button onclick="window.history.back();">Вернуться назад</button>
	</div>
    <main>
        <section>
            <?php
				include 'connect.php';

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					// Получаем OrderID из формы
					$orderID = mysqli_real_escape_string($conn, $_POST["orderID"]);

					// Запрашиваем информацию о заказе
					$sql = "SELECT o.OrderID, o.OrderDate, c.ClientName, p.ProductName, 
							od.Quantity, p.Price * od.Quantity AS TotalPrice, s.Status
							FROM Orders o
							JOIN OrderDetails od ON o.OrderID = od.OrderID
							JOIN Clients c ON o.ClientID = c.ClientID
							JOIN Products p ON od.ProductID = p.ProductID
							JOIN Statuses s ON o.StatusID = s.StatusID
							WHERE o.OrderID = $orderID";

					$orderResult = $conn->query($sql);

					if ($orderResult->num_rows > 0) {
						echo "<h2>Информация о заказе</h2>";
						echo "<table>";
						echo "<tr><th>Номер заказа</th><th>Дата заказа</th><th>Клиент</th><th>Продукт</th><th>Кол-во</th><th>Стоимость</th><th>Статус</th></tr>";
						while($row = $orderResult->fetch_assoc()) {
							echo "<tr><td>".$row["OrderID"]."</td><td>".$row["OrderDate"]."</td><td>".$row["ClientName"]."</td><td>".$row["ProductName"]."</td><td>".$row["Quantity"]."</td><td>".$row["TotalPrice"]."</td><td>".$row["Status"]."</td></tr>";
						}
						echo "</table>";
					} else {
						echo "No order found";
					}

					// Запрашиваем информацию об отгрузках по этому заказу
					$sql = "SELECT s.ShipmentDate, st.Status
							FROM Shipments s
							JOIN Statuses st ON s.StatusID = st.StatusID
							WHERE s.OrderID = $orderID
							ORDER BY s.ShipmentDate DESC";

					$shipmentResult = $conn->query($sql);

					if ($shipmentResult->num_rows > 0) {
						echo "<h2>Информация об отгрузках</h2>";
						echo "<table>";
						echo "<tr><th>Дата</th><th>Статус</th></tr>";
						while($row = $shipmentResult->fetch_assoc()) {
							echo "<tr><td>".$row["ShipmentDate"]."</td><td>".$row["Status"]."</td></tr>";
						}
						echo "</table>";
					} else {
						echo "Отгрузки не найдены";
					}
				}

				$conn->close();
			?>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Дистрибьюторская компания. Все права защищены.</p>
    </footer>
</body>
</html>
