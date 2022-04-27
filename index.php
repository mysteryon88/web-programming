<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Clothing store</title>
		<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<?php
		include 'funcitons.php';
		session_start();
		unset($_SESSION['mes']);
		if(isset($_GET['exit']))
		{
			session_destroy();
			header('Location: index.php');
		}
		if (isset($_POST['send']))
			mail($_POST['email'], 'Ответ', 'Ответ направлен', 'From: mail@gmail.com');	
?>
	</head>
<body>
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="index.php" class="nav-link px-2 link-secondary">Главная страница</a></li>
        <li><a href="order.php" class="nav-link px-2 link-dark">Заказ доставки</a></li>
        <li><a href="lk.php" class="nav-link px-2 link-dark">Личный кабинет</a></li>
        <li><a href="review.php" class="nav-link px-2 link-dark">Отзывы</a></li>
      </ul>
<?php	
		if(isset($_SESSION['login']))
		{
?>
			<form metod = "get"><input type="submit" class="btn btn-outline-primary me-2" name="exit" value="Выход"></form>
<?php
		}
?>
      <div class="col-md-3 text-end">
<?php 
		if(isset($_SESSION['login']))
		{
?>
			<a href="lk.php"class="nav-link px-2 link-dark">Добро пожаловать, <?php echo $_SESSION['login']?> </a>
<?php 	
		}
		else
		{
?>
	        <a href="signin.php" class="btn btn-outline-primary me-2">Войти</a>
			<a href="signup.php" class="btn btn-primary">Регистрация</a>
<?php 	
		}
?>		
      </div>
    </header>
  <center>
  <div>
	<h5>На сайте вы можете заказать доставку, либо приехать к нам! Адрес на карте!</h5>
	<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A8e72bae369b91373a0b1fac09103015a34d419d29cf5441bbb02c12253a0541d&amp;width=539&amp;height=448&amp;lang=ru_RU&amp;scroll=true"></script>
	<h5>Если у вас есть вопросы, оставье свою почту и вы вам ответим!</h5>
	<form method="POST">
		<center><input type="email" name="email" required="required"></center>
		<br>
		<center><input type="submit" class="btn btn-outline-primary me-2" name="send" value="Отправить"></center>
	</form>
  </div>
  </center>
</body>
</html>