<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Clothing store</title>
		<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<?php
		include "connect.php";
		include "funcitons.php";
		session_start();
		unset($_SESSION['mes']);
		if(isset($_GET['exit']))
		{
			session_destroy();
			header('Location: index.php');
		}
		if(!isset($_SESSION['id']))	
			header("Location: signin.php");
		if(isset($_POST['bay']))
		{
			foreach ($_SESSION['mass'] as $key => $value)
			{

				$add = "INSERT INTO `заказ` (`ID_заказа`, `ID_клиента`, `IDAS`, `дата`) VALUES (NULL, '".$_SESSION['id']."','".$value."','".date("y-m-d")."')"; 	
				$add = mysqli_query($conn,$add)or die("Add request error " . mysqli_error($conn));
		
			}
			unset($_SESSION['mass']);
			echo "<script>alert(\"Заказ оформлен\");</script>";
			header('Refresh: 0; URL = lk.php');
		}
		if(isset($_POST['delete']))
		{
			unset($_SESSION['mass']);
			echo "<script>alert(\"Корзина очищена\");</script>";
			header('Refresh: 0; URL = lk.php');
		}		
		if(isset($_POST['del']))
		{
			if(!empty($_POST['f']))
			{
				foreach ($_POST['f'] as $key => $value)
				{
					$add = "DELETE FROM `заказ` WHERE `заказ`.`ID_заказа` = ".$value; 	
					$add = mysqli_query($conn,$add)or die("Delete Request Error " . mysqli_error($conn));
				}
			}
			echo "<script>alert(\"Заказ удален\");</script>";
			header('Refresh: 0; URL = lk.php');
		}		
		if(isset($_POST['exactly']))
		{
			$add = "DELETE FROM `клиент` WHERE `клиент`.`ID_клиента` = ".$_SESSION['id']; 	
			$add = mysqli_query($conn,$add)or die("Delete Request Error " . mysqli_error($conn));
			echo "<script>alert(\"Ваш аккаунт удалён\");</script>";
			session_destroy();
			header('Location: index.php');
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
		<a href="lk.php"class="nav-link px-2 link-dark">Добро пожаловать, <?php echo $_SESSION['login']?> </a>

	
      </div>
    </header>
  <br> 
  <center>
  <div>
<?php
		echo $_SESSION['mes'];
				
		$quer = "SELECT * FROM `клиент` WHERE `ID_клиента` = ".$_SESSION['id'];
		$check = mysqli_query($conn,$quer)or die("Ошибка запроса поиска" . mysqli_error($conn));
		$row = mysqli_fetch_assoc($check);
    	echo "<table><tr><td>
    	Ваше ФИО:</td><td> ".$row['ФИО']."</td></tr><tr>
    	<td>Ваш логин:</td><td> ".$row['логин']."</td></tr><tr>
    	<td>Ваш e-mail:</td><td> ".$row['почта']."</td></tr></table>";
?>
	<form method="POST">
		<input type="submit" name="cart" class = "btn btn-outline-primary me-2" value="Корзина">
		<input type="submit" name="redact" class = "btn btn-outline-primary me-2" value="Редактировать">
		<input type="submit" name="orders" class = "btn btn-outline-primary me-2" value="Заказы">
		<input type="submit" name="delak" class = "btn btn-outline-primary me-2" value="Удалить свой аккаунт">
	</form>
<?php 
		if(isset($_POST['redact']))
		{
			include "connect.php";
			$quer = "SELECT * FROM `клиент` WHERE `ID_клиента` = ".$_SESSION['id'];
			$check = mysqli_query($conn,$quer)or die("Customer data selection error " . mysqli_error($conn));
			$row = mysqli_fetch_assoc($check);
?>
				<form method="POST">
					<table>
					<tr><td>Имя:</td><td><input type="text" name="name" value="<? echo $row['ФИО']; ?>" required="required"></td></tr>
					<tr><td>E-mail:</td><td><input type="email" name="contact" value="<? echo $row['почта'];?>" required="required"></td></tr>
					<tr><td>Логин:</td><td><input type="text" name="login" value="<? echo $row['логин']; ?>" required="required"></td></tr>	
					<tr><td>Новый пароль:</td><td><input type="password" name="passnew"></td></tr>			
					<tr><td>Старый пароль:</td><td><input type="password" name="pass" required="required"></td></tr>							
					</table>
					<input type="submit" class="btn btn-outline-primary me-2" name="update">
				</form>
<?php
		}
		if(isset($_POST['update']))
			updateall(mysqli_real_escape_string($conn, $_POST['name']),
					  mysqli_real_escape_string($conn, $_POST['contact']),
					  mysqli_real_escape_string($conn, $_POST['login']),
					  mysqli_real_escape_string($conn, $_POST['passnew']),
					  mysqli_real_escape_string($conn, $_POST['pass']));
					  

		if(isset($_POST['cart']))
		{
			if(!empty($_SESSION['mass']))
			{
?>
				<form method="POST">
					<input type="submit" name="bay" class="btn btn-outline-primary me-2" value="Купить всё">
					<input type="submit" name="delete" class="btn btn-outline-primary me-2" value="Отчистить корзину"><br>
					<input type="submit" name="buycheck" class="btn btn-outline-primary me-2" value="Купить выбранное">
					<input type="submit" name="delnum" class="btn btn-outline-primary me-2" value="Удалить выбранное"><br>
<?php

				$sum = 0;
				echo "<table border = \"1\" ><tr><th>Позиция</th><th>Цена</th></tr>";	
				$i=0;
				foreach ($_SESSION['mass'] as $key => $value) 
				{
					
					$quer = "SELECT * FROM `ассортимент` WHERE `IDAS` = '".$value."'";
					$res = mysqli_query($conn,$quer)or die("Product search request error " . mysqli_error($conn));
					$r = mysqli_fetch_assoc($res);

					echo "<td><center><b>".$r['Название']."</b><br>
							<img src = \"img/".$r['IDAS'].".jpg\" width=\"100\" height=\"100\"></center><br>
							Бренд: ".$r['Бренд']."</td>
							<td>".$r['Цена']." руб.</td>
							<td><input type=\"checkbox\" name=\"f1[]\" value = \"".$i."\"></td></tr>";
					$sum+=$r['Цена'];
					$i+=1;
				}
				echo "Сумма: ".$sum."руб.";
?>
				</table><br>
				</form>	
<?php
			}
			else echo "Корзина пуста";
		}
		
		if(isset($_POST['delnum']))
		{
			if(!empty($_POST['f1']))
			{
				$_SESSION['mass'] = array_values($_SESSION['mass']);
				foreach ($_SESSION['mass'] as $key => $value)
					foreach ($_POST['f1'] as $key1 => $value1)
						if($key ==  $value1) 
							unset($_SESSION['mass'][$key]);
				echo "<script>alert(\"Товар удален\");</script>";
			}
			else echo "<script>alert(\"Выберите товар, который хотите удалить\");</script>";
			
		}
		if(isset($_POST['buycheck']))
		{
			if(!empty($_POST['f1']))
			{
				$_SESSION['mass'] = array_values($_SESSION['mass']);
				foreach ($_SESSION['mass'] as $key => $value)
					foreach ($_POST['f1'] as $key1 => $value1)
						if($key ==  $value1) 
						{
							unset($_SESSION['mass'][$key]);
							$add = "INSERT INTO `заказ` (`ID_заказа`, `ID_клиента`, `IDAS`, `дата`) 
								VALUES (NULL, '".$_SESSION['id']."','".$value."','".date("y-m-d")."')"; 	
							$add = mysqli_query($conn,$add)or die("Add request error" . mysqli_error($conn));
						}
				echo "<script>alert(\"Заказ оформлен\");</script>";
			}
			else echo "<script>alert(\"Выберите товар, который хотите купить\");</script>";
			
		}
		if(isset($_POST['orders']))
		{
			$quer = "SELECT COUNT(*) FROM `заказ` WHERE `ID_клиента` ='".$_SESSION['id']."'";
			$res = mysqli_query($conn,$quer)or die("Search request error " . mysqli_error($conn));
			$r = mysqli_fetch_assoc($res);
			if($r['COUNT(*)'] > 0)
			{
?>
				<form method="POST">
					<input type="submit" name="del" class="btn btn-outline-primary me-2" value="Удалить заказ"><br>
				
<?php
				$quer = "SELECT *, `ассортимент`.* FROM `заказ` 
					INNER JOIN `ассортимент` ON (`заказ`.`IDAS` = `ассортимент`.`IDAS`) 
					WHERE `заказ`.`ID_клиента` ='".$_SESSION['id']."' 
					ORDER BY `заказ`.`дата` ASC";
				$res = mysqli_query($conn,$quer)or die("Order output error " . mysqli_error($conn));
				$sum = 0;
				echo "<table border = \"1\"><tr><th>Товар</th><th>Цена</th></tr>";	
				while ($r = mysqli_fetch_assoc($res))
				{
					if($cur != $r['дата'])
					{
						echo "<tr><th colspan=2><center>".$r['дата']."</center></th></tr>";
						$cur = $r['дата'];
					}
					echo "<tr><td><center><b>".$r['Название']."</b><br>
								<img src = \"img/".$r['IDAS'].".jpg\" width=\"100\" height=\"100\"></center><br>
								Бренд: ".$r['Бренд']."</td>
								<td>".$r['Цена']." руб.</td>
								<td><input type=\"checkbox\" name=\"f[]\" value = \"".$r['ID_заказа']."\"></td></tr>";
						$sum+=$r['Цена'];
					
				}
				echo "Сумма: ".$sum."руб.";
?>
				</form>
<?php
			}
			else echo "Заказов нет";
		}
		if(isset($_POST['delak']))
		{
?>
			<form method="POST">
				<input type="submit" name="exactly" class="btn btn-outline-primary me-2" value="Удалить">
				<input type="submit" class="btn btn-outline-primary me-2" value="Отмена">
			</form>
<?php
		}	
?>	
  </div>
  </center>
</body>
</html>