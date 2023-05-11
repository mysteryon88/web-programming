<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчеты</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Система управления складом дистрибьюторской компании</h1>
    </header>
    <nav>
        <ul>
			<?php
				session_start();
				if (isset($_SESSION['employee_id'])) {
			?>
					<li><a href="index.php">Начальная страница</a></li>
					<li><a href="warehouse_management.php">Управление складом</a></li>
					<li><a href="order_management.php">Управление заказами</a></li>
					<li><a href="shipment_requests.php">Формирование заявок на отгрузку продукции</a></li>
					<li><a href="database_management.php">Управление базой данных</a></li>
					<a href="logout.php"><button class="login-button">Выход</button></a>
			<?php	
				} else { 
			?>
					<li><a href="index.php">Начальная страница</a></li>
					<a href="login.html"><button class="login-button">Вход</button></a>
			<?php 
				}
			?>
        </ul>
    </nav>
    <main>
        <section>
            <h2>Отчеты</h2>
            <form action="get_report.php" method="post">
                <label for="orderID">Выберите заказ:</label>
                <select id="orderID" name="orderID" required>
                    <?php
                    include 'connect.php';
                    $sql = "
						SELECT *, p.Price * od.Quantity AS price FROM Orders o
						JOIN Clients c ON o.ClientID = c.ClientID
						JOIN Statuses s ON o.StatusID = s.StatusID
						JOIN OrderDetails od ON o.OrderID = od.OrderID
						JOIN Products p ON od.ProductID = p.ProductID
						ORDER BY o.OrderID";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='".$row['OrderID']."'>
								Заказ #".$row['OrderID'].", ".$row["OrderDate"].", ".$row["ProductName"].
								", Клиент:".$row["ClientName"].", Кол-во:".$row["Quantity"].", Стоимость:".$row["price"].
								"</option>";
                        }
                    }
                    $conn->close();
                    ?>
                </select>
                <button type="submit">Получить отчет</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Дистрибьюторская компания. Все права защищены.</p>
    </footer>
</body>
</html>
