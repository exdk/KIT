<?php
error_reporting(0);
session_start();
require '../config.php';
$title = 'forKIT | Авторизация';
require '../style/head.php';
if (isset($_GET['logout']))
{
	if (isset($_SESSION['user_id']))
		unset($_SESSION['user_id']);
	setcookie('login', '', 0, "/");
	setcookie('password', '', 0, "/");
	// и переносим его на главную
	header('Location: ../index.php');
	exit;
}
if (isset($_SESSION['user_id']))
{
	// юзер уже залогинен, перекидываем его отсюда
	header('Location: ../index.php');
	exit;
}

if (!empty($_POST))
{
	$login = mysqli_real_escape_string($mysqli, $_POST['login']);
	$password = mysqli_real_escape_string($mysqli, $_POST['password']);
	$result = $mysqli->query("SELECT * FROM `users` WHERE `login`='$login' LIMIT 1");
	$row = mysqli_fetch_assoc($result);
	if ($row['login'] == $login)
	{
		// итак, вот она соль, соответствующая этому логину:
		$salt = $row['salt'];
		// теперь хешируем введенный пароль как надо и повторям шаги, которые были описаны выше:
		$password = md5(md5($_POST['password']));
		// делаем запрос к БД
		// и ищем юзера с таким логином и паролем
		$result = $mysqli->query("SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password' LIMIT 1");
		$row = $result->fetch_assoc();
		// проверяем, если юзер в таблице с таким же логином
		// если такой пользователь нашелся
		if ($row['login'] == $login)
		{
			// то мы ставим об этом метку в сессии (допустим мы будем ставить ID пользователя)
			$result = $mysqli->query("SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password' LIMIT 1");
			$row = $result->fetch_assoc();
			$_SESSION['user_id'] = $row['id'];
			// если пользователь решил "запомнить себя"
			// то ставим ему в куку логин с хешем пароля
			///$time = 86400; // ставим куку на 24 часа
			
			if (isset($_GET['remember']))
			{
				setcookie('login', $login, time()+3600*24*365, "/");
				setcookie('password', $password, time()+3600*24*365, "/");
			}
			
                        // и перекидываем его на закрытую страницу
			header('Location: ../index.php');
			exit;
                        
			// не забываем, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
		}
		else
		{
			die("<div class='menu'>Извините, введённый вами логин или пароль неверный.</div><div class='copy'><a href='login.php?'>Назад</a></div>");
		}
	}
	else
	{
		die("<div class='menu'>Извините, введённый вами логин или пароль неверный.</div><div class='copy'><a href='login.php?'>Назад</a></div>");
	}
}
echo'
<div class="bordur"><a href="http://yunusov.me/forKIT/">forKIT</a> | Авторизация</div>
<div class="main"><form action="login.php" method="post">
Логин:<br/>
<input type="text" name="login" /><br/>
Пароль:<br/>
<input type="password" name="password" /><br/>
Запомнить:
<input type="checkbox" name="remember" value="1" checked="checked" /><br/>
<input type="submit" value="Авторизоваться" /></form>
</div>';
require '../style/foot.php';
?>
