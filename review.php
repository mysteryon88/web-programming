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
		include "connect.php";
		session_start();
		unset($_SESSION['mes']);
		if(isset($_GET['exit']))
		{
			session_destroy();
			header('Location: index.php');
		}
		if($_POST['action']=="add")
		{
			if(isset($_SESSION['id']))
			{
				$quer = "INSERT INTO `отзывы` (`ID_отзыва`, `ID_клиента`, `Отзыв`, `Дата`) VALUES (NULL, '".$_SESSION['id']."', '".$_POST['msg']."', '".date('y-m-d')."')";
				$res = mysqli_query($conn,$quer) or die("Ошибка добавления отзыва". mysqli_error($conn));
				header("Location: review.php");
			}
			else
			{
?>
				<center><br><b>К сожалению вы не зарегистрированы <a href="signin.php">авторизуйтесь</a> или <a href="signup.php">зарегистрируйтесь</a> на сайте</b></center>
<?php
			}	
		}
		
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
			<a href="lk.php" class="nav-link px-2 link-dark">Добро пожаловать, <?php echo $_SESSION['login']?> </a>
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
  <br> 
  <center>
  <div>
  <form name="myForm" action="review.php" method="post" onSubmit="return splash();">
	<input type="hidden" name="action" value="add">
	<table border="0">
		<tr>
			<td width="160" valign="top">
				Отзыв:
			</td>
			<td>
				<textarea name="msg" style="width: 300px;"></textarea>
			</td>
		</tr>
		<tr>
			<td width="160">
				&nbsp;
			</td>
			<td>
				<input type="submit" class="btn btn-outline-primary me-2" value="Оставить отзыв"> 
			</td>
		</tr>
<script>
	function splash()
	{
		if(document.myForm.msg.value == '')
		{
			alert("Заполните поле отзыва!");
			return false;
		}
		return true;
	}
</script>
<?php 	
		$quer = 'SELECT *, `клиент`.`ФИО` FROM отзывы 
			INNER JOIN клиент ON (отзывы.ID_клиента = клиент.ID_клиента) 
			ORDER BY `ID_отзыва` DESC limit 5';
		$res = mysqli_query($conn,$quer) or die("Ошибка запроса". mysqli_error($conn));
		while ($row=mysqli_fetch_assoc($res))
		{
			if ($c & 1 == 1)
				$col="bgcolor='#f9f9f9'";
			else 
				$col="bgcolor='#f0f0f0'";
			$c+=1;	
?>	
			<table border="0" cellspacing="3" cellpadding="0" width="90%" <? echo $col?> style="margin: 10px 0px"> 
			<tr>
				<td width="150" style="color: #999999">Имя пользователя:</td>
				<td><?php echo $row['ФИО']?></td>
			</tr>
			<tr>
				<td width="150" style="color: #999999">Дата публицакии:</td>
				<td><?php echo $row['Дата']?></td>
			</tr>
			<tr>
				<td colspan="2" style="color: #999999">---------------------------------------------------------------------------------------------------------------------------------</td>
			</tr>
			<tr>
				<td colspan="2"><?php echo $row['Отзыв']?><br>
				</td>
			</tr>
			</table>
<?php
		}
		
?>
	</form>
  </div>
  </center>
</body>
</html>