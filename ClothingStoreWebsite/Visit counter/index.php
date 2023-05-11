<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>Счетчик посещений</title>
	</head>
<?php
	include 'counter.php';
?>
<body>
	<center>
		<h1>Счетчик посещений</h1>
		<table border=2>
			<tr><td colspan=2 align=center>Посещаемость за <?php echo $date ?></td></tr>
			<tr><th align=center>Всего</th><th align=center>Сегодня</th></tr>
			<tr><td align=center><?php echo $total ?></td><td align=center><?php echo $today ?></td></tr>
			<tr><td colspan=2 align=center>Посетителей IP: <?php echo $ipkol?></td></tr>
		</table>
	</center>
</body>
</html>