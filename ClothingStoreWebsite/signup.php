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
		include "connect.php" ;
		session_start();
		unset($_SESSION['mes']);
		if(isset($_GET['exit']))
		{
			session_destroy();
			header('Location: index.php');
		}
		if (isset($_POST['registration'])) 
			registration(mysqli_real_escape_string($conn, $_POST['name']), 
						 mysqli_real_escape_string($conn, $_POST['email']),
						 mysqli_real_escape_string($conn, $_POST['login']),
						 mysqli_real_escape_string($conn, $_POST['pass']));
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
	  <div class="col-md-3 text-end">
		<center>
			 <a href="signin.php" class="btn btn-outline-primary me-2">Вход</a>
		</center>
	  </div>
    </header>
  <center>
<?php
	echo $_SESSION['mes'];
?>
  <div>
	<center>
	<h2 align="center">Регистрация</h2>
    <form method="post" name="register">
        <table align=center>
				<tr><td>Имя:</td><td><input type="text" name="name" required="required"></td></tr>
                <tr><td>Email:</td><td><input type="email" name="email" required="required"></td></tr>
                <tr><td>Логин:</td><td><input type="text" name="login" required="required"></td></tr>
                <tr><td>Пароль:</td><td><input type="password" name="pass" required="required"></td></tr>
                <tr><td colspan="2" align=center>
					<input type="submit" name="registration" class="btn btn-outline-primary me-2" value="Зарегистрироватся">
				</td></tr>

		</table> 
	</form>
	</center>
  </div>
</body>
</html>