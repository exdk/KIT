<?php
session_start();
require '../config.php';
$title = 'Попытка авторизации';
require '../style/head.php';

	$login = mysqli_real_escape_string($mysqli, $_GET['login']);
	$password = mysqli_real_escape_string($mysqli, $_GET['password']);
	$result = $mysqli->query("SELECT * FROM `users` WHERE `login`='$login' LIMIT 1");
	$row = mysqli_fetch_assoc($result);
	if ($row['login'] == $login)
	{
		// итак, вот она соль, соответствующая этому логину:
		$salt = $row['salt'];
		// теперь хешируем введенный пароль как надо и повторям шаги, которые были описаны выше:
		$password = md5(md5($_GET['password']));
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
require '../style/foot.php';
