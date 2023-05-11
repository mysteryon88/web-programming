<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление базой данных</title>
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
            <li><a href="shipment_requests.php">Формирование заявок на отгрузку продукции</a></li>
            <li><a href="reports.php">Отчеты</a></li>
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
            <h2>Добавление данных</h2>
            <p>Здесь вы можете управлять загруженными данными.</p>
            
            <h3>Добавление нового сотрудника</h3>
            <form action="add_employees.php" method="post">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="login">Логин:</label>
                <input type="text" id="login" name="login" required><br>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required><br>
                <button type="submit">Добавить сотрудника</button>
            </form>

			<h3>Добавление нового поставщика</h3>
			<form action="add_supplier.php" method="post">
				<label for="supplierName">Название поставщика:</label>
				<input type="text" id="supplierName" name="supplierName" required><br>
				<label for="contactInfo">Контактная информация:</label>
				<input type="text" id="contactInfo" name="contactInfo" required><br>
				<button type="submit">Добавить поставщика</button>
			</form>
			
			<h3>Добавление новой продукции</h3>
			<form action="add_product.php" method="post" enctype="multipart/form-data">
				<label for="productName">Название продукта:</label>
				<input type="text" id="productName" name="productName" required><br>
				<label for="productPrice">Цена продукта:</label>
				<input type="number" id="productPrice" name="productPrice" step="0.01" min="0" required><br>
				<label for="supplierID">Поставщик:</label>
				<select id="supplierID" name="supplierID" required>
					<?php
								include 'connect.php';
								$sql = "SELECT SupplierID, SupplierName FROM suppliers";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										echo "<option value='" . $row["SupplierID"] . "'>" . $row["SupplierName"] . "</option>";
									}
								} else {
									echo "<option value=''>Нет доступных поставщиков</option>";
								}
								?>
				</select><br>
				<label for="productImage">Изображение продукта:</label>
				<input type="file" id="productImage" name="productImage" accept="image/*" required><br>
				<button type="submit">Добавить продукт</button>
			</form>

			<h2>Обновление данных</h2>
			
            <h3>Обновление цен на продукцию</h3>
			<form action="update_prices.php" method="post">
				<label for="product">Продукт:</label>
				<select id="product" name="productID" required>
					<?php
					include 'connect.php';
					$sql = "SELECT products.ProductID, products.ProductName, products.Price, suppliers.SupplierName FROM products INNER JOIN suppliers ON products.SupplierID = suppliers.SupplierID";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<option value='" . $row["ProductID"] . "'>" . $row["ProductName"] . " (" . $row["SupplierName"] . ") - " . $row["Price"] . "</option>";
						}
					} else {
						echo "<option value=''>Нет доступных продуктов</option>";
					}
					?>
				</select><br>
				<label for="newPrice">Новая цена:</label>
				<input type="number" id="newPrice" name="newPrice" step="0.01" min="0" required><br>
				<button type="submit">Обновить цены</button>
			</form>

            <h2>Удаление данных</h2>

			<h3>Удаление продукта</h3>
			<form action="delete_product.php" method="post">
				<label for="productToDelete">Продукт для удаления:</label>
				<select id="productToDelete" name="productID" required>
					<?php
					include 'connect.php';
					$sql = "SELECT products.ProductID, products.ProductName, products.Price, suppliers.SupplierName FROM products INNER JOIN suppliers ON products.SupplierID = suppliers.SupplierID";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<option value='" . $row["ProductID"] . "'>" . $row["ProductName"] . " (" . $row["SupplierName"] . ") - " . $row["Price"] . "</option>";
						}
					} else {
						echo "<option value=''>Нет доступных продуктов</option>";
					}
					?>
				</select><br>
				<button type="submit" onclick="return confirm('Вы уверены, что хотите удалить этот продукт?')">Удалить продукт</button>
			</form>

        </section>
    </main>
    <footer>
        <p>&copy; 2023 Дистрибьюторская компания. Все права защищены.</p>
    </footer>
</body>
</html>	