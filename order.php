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
  <br> 
  <center>
  <div>
	<form method="GET">
			<label for="filtr">Фильтр: </label>
				<select name = "filtr">
					<option value="">Без Фильтра</option>
					<option value="ORDER BY `Название` ASC">По афлавиту</option>		
					<option value="ORDER BY `Цена` DESC">Сначала дорогие</option>
					<option value="ORDER BY `Цена` ASC">Сначала дешевые</option>
				<optgroup label="Бренды">
					<option value="WHERE `Бренд` = 'H&M'">H&M </option>
					<option value="WHERE `Бренд` = 'Bershka'">Bershka</option>						
					<option value="WHERE `Бренд` = 'Guchi'">Guchi</option>
				</optgroup>
				</select> 
			<input type="submit" name="ok" class="btn btn-outline-primary me-2" value = "Применить">
	</form>
<?php
	$q = "SELECT * FROM `ассортимент` ".$_GET['filtr'];
    $res = mysqli_query($conn,$q) or die("Product output request error ". mysqli_error($conn));
    session_start();
	if(!empty($_GET['add']))
	{
		if(!empty($_GET['f']))
		{
			if(isset($_SESSION['id']))
			{
				if(!empty($_SESSION['mass']))
				{
					foreach ($_GET['f'] as $key => $value) 
						array_push($_SESSION['mass'], $value);
				}
				else $_SESSION['mass'] = $_GET['f'];
				echo "<br><b>Добавлено</b>";
			}
			else
				echo "<br><b>К сожалению вы не зарегистрированы <a href=\"signin.php\">авторизуйтесь</a> или <a href=\"signup.php\">зарегистрируйтесь</a> на сайте и возвращайтесь";
		}
        else echo "<br><b>Ничего не выбрано :(</b>";
	}
    echo "<form metod = \"GET\">";
	echo "<input type=\"submit\" name=\"add\" class=\"btn btn-outline-primary me-2\" value=\"Добавить в корзину\">";	
    if($res)
	{
        echo "<br><b>Чтобы вещь в корзину - поставьте рядом с нужной позицией галочку</b><br>
		<table border = \"1\" bordercolor\"red\"><tr>
		<th>Товар</th><th>Цена</th><th></th><th>Товар</th><th>Цена</th><th></th></tr><br>";
        $i = 0;
		while ($r = mysqli_fetch_assoc($res))
		{	
			if(($i % 2) == 0)echo "<tr>";
            echo "<td><center><b>".$r['Название']."</b><br>
				<img src = \"img/".$r['IDAS'].".jpg\" width=\"100\" height=\"100\"></center><br>
							
					Бренд: ".$r['Бренд']."</td>
					<td>".$r['Цена']." руб.</td>
					<td><input type=\"checkbox\" name=\"f[]\" value = \"".$r['IDAS']."\"></td>";
			if(($i % 2) == 1)echo "</tr>";
			$i +=1;
		}
        echo "</table><br><br></form>";              
    }
?>
  </div>
  </center>
</body>
</html>