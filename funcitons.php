<?php 
function authorization($login, $pass)
{
    include "connect.php";
    session_start();
    $login = mysqli_real_escape_string($conn,$login); 
    $pass = mysqli_real_escape_string($conn,$pass);    
    $login = clear($login); 
	$pass = clear($pass);
	$insert = "SELECT COUNT(*) FROM `клиент` WHERE `логин` = '".$login."' AND `пароль` = MD5('".$pass."')";
	$insert = mysqli_query($conn, $insert) or die("Authorization error (search) " . mysqli_error($conn));
	$r = mysqli_fetch_assoc($insert);
    if($r['COUNT(*)'] == 1)
	{
		$quer = "SELECT `ID_клиента` FROM `клиент` WHERE `логин` = '".$login."' AND `пароль` = MD5('".$pass."')";
		$quer = mysqli_query($conn, $quer)or die("Authorization error (ID_клиента) " . mysqli_error($conn));
		$row = mysqli_fetch_assoc($quer);
		
		$_SESSION['login'] = $login;
		$_SESSION['id'] = $row['ID_клиента'];
			
		unset($_SESSION['mes']);
		header('Refresh: 0.1; URL = lk.php');

    }
    else
        $_SESSION['mes'] = 'Ошибка в логине или пароле!';

}

function clear($string = "")
{
    $string = trim($string);   
    $string = stripslashes($string); 
    $string = strip_tags($string); 
    $string = htmlspecialchars($string);
    return $string;
}

function checkSize($string,$min,$max)
{
    $result = (mb_strlen($string) > $min && mb_strlen($string) <= $max);
    return $result;
}

function updateall($name, $mail, $login, $passnew, $pass)
{
	$name = clear($name);
	$mail = clear($mail);
	$login = clear($login);
	$pass = clear($pass);
	$passnew = clear($passnew);
	if ($name != NULL && $mail != NULL && $login != NULL && $pass != NULL)
	{
		include "connect.php";
		$insert = "SELECT COUNT(*) FROM клиент WHERE логин = '".$_SESSION['login']."' AND пароль = MD5('".$pass."')";
		$insert = mysqli_query($conn, $insert) or die("Data lookup error " . mysqli_error($conn));
		$r = mysqli_fetch_assoc($insert);
		
		if ($r['COUNT(*)'] == 1)
		{
			if($passnew != NULL)
				$quer = 'UPDATE `клиент` SET `ФИО` = \''.$name.'\', `почта` = \''.$mail.'\', `логин` =\''.$login.'\',`пароль` = MD5(\''.$passnew.'\') WHERE `ID_клиента` = '.$_SESSION['id'];
			else
				$quer = 'UPDATE `клиент` SET `ФИО` = \''.$name.'\', `почта` = \''.$mail.'\', `логин` =\''.$login.'\',`пароль` = MD5(\''.$pass.'\') WHERE `ID_клиента` = '.$_SESSION['id'];
				
			$result = mysqli_query($conn,$quer)or die("data update error " . mysqli_error($conn));
			echo "<script>alert(\"Данные изменены!\");</script>";
			header('Refresh: 2; URL = lk.php');
		}
		else echo "<script>alert(\"Неверный пароль!\");</script>";
	}
	else echo "<script>alert(\"Вы оставили пустые поля!\");</script>";
}

function registration($name, $mail, $login, $pass)
{
	$name = clear($name);
	$mail = clear($mail);
	$login = clear($login);
	$pass = clear($pass);
	include "connect.php" ;
	$insert = "SELECT COUNT(*) FROM клиент WHERE логин = '".$login."' OR почта = '".$mail."'";
	$insert = mysqli_query($conn, $insert) or die("registration error (search) " . mysqli_error($conn));
	$r = mysqli_fetch_assoc($insert);
	if ($r['COUNT(*)'] == 0)
	{
		$insert = "INSERT INTO `клиент` (`ID_клиента`, `ФИО`, `почта`, `логин`, `пароль`) VALUES (NULL,'".$name."', '".$mail."', '".$login."', MD5('".$pass."'))";
		$insert = mysqli_query($conn, $insert) or die("registration error " . mysqli_error($conn));
		$_SESSION['mes'] = 'Спасибо за регистрацию!';
		mail($mail, 'Регистрация', 'Cпасибо за регистрацию!', 'From: mail@gmail.com');
		header('Refresh: 2; URL = index.php');
	} 
	else $_SESSION['mes'] = 'Пользователь с такой почтой или логином существует!';
}
?>

