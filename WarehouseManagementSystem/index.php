<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Система управления складом дистрибьюторской компании</title>
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
					<li><a href="warehouse_management.php">Управление складом</a></li>
					<li><a href="order_management.php">Управление заказами</a></li>
					<li><a href="shipment_requests.php">Формирование заявок на отгрузку продукции</a></li>
					<li><a href="reports.php">Отчеты</a></li>
					<li><a href="database_management.php">Управление базой данных</a></li>
					<a href="logout.php"><button class="login-button">Выход</button></a>
			<?php	
				} else {
			?>
					<li><a href="reports.php">Отчеты</a></li>
					<a href="login.html"><button class="login-button">Вход</button></a>
			<?php 
				}
			?>
        </ul>
    </nav>
    <main>
        <section>
            <h2>Основные функции</h2>
            <ul>
                <li>Просмотр продукции на складе</li>
                <li>Обработка и отслеживание заказов клиентов</li>
                <li>Формирование заявок на отгрузку продукции</li>
                <li>Генерация отчетов по движению продукции</li>
                <li>Управление данными в базе данных</li>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Дистрибьюторская компания. Все права защищены.</p>
    </footer>
</body>
</html>
