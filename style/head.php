<?php
function daily() { //функция определения времени суток
	$hour = date('H');
	if ($hour > 00 && $hour < 05) {
		echo '<div class="menu">Доброй ночи, ';
	}
		elseif ($hour >= 05 && $hour < 10) {
			echo '<div class="menu">Доброго утра, ';
		}
			elseif ($hour >= 10 && $hour < 18) {
				echo '<div class="menu">Доброго дня, ';
			}
				elseif ($hour >= 18 && $hour < 24) {
					echo '<div class="menu">Доброго вечера, ';
				}
}
###############################################################################
##                     Шапка с выводом ссылки на админ-панель                ##
###############################################################################
echo '
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru"><head><meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=UTF-8"/>
<title>'.$title.'</title>
<meta name="keywords" content="ключевые слова is here" />
<meta name="description" content="описание is here"/>
<link rel="stylesheet" type="text/css" href="http://yunusov.me/forKIT/style/style.css" />
<link rel="stylesheet" type="text/css" href="http://yunusov.me/forKIT/style/jstree/style.css" />
<link rel="stylesheet" type="text/css" href="http://yunusov.me/forKIT/style/main.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="http://yunusov.me/forKIT/style/img/favicon.ico"  type="image/ico" /> 
<script src="http://yunusov.me/forKIT/style/js/jquery.min.js"></script>
<script src="http://yunusov.me/forKIT/style/js/jstree.min.js"></script>
</head>
<body>
<div class="head">
<img src="http://yunusov.me/forKIT/style/img/logo16.png" alt="logo" />
</div>';
// если пользователь не авторизован
if (!isset($_SESSION['id']))
{
	// то проверяем его куки
	// вдруг там есть логин и пароль к нашему скрипту
	if (isset($_COOKIE['login']) && isset($_COOKIE['password']))
	{
		// если же такие имеются
		// то пробуем авторизовать пользователя по этим логину и паролю
		$login = mysqli_escape_string($mysqli, $_COOKIE['login']);
		$password = mysqli_escape_string($mysqli, $_COOKIE['password']);
		// и по аналогии с авторизацией через форму делаем запрос к БД
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
			// не забываем, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
		}
	}
}
if (isset($_SESSION['user_id']))
{
	$result1 = $mysqli->query("SELECT * FROM users WHERE id='{$_SESSION['user_id']}'");
	$row1 = $result1->fetch_assoc();
	echo''.daily().''.$row1['login'].'</div>';
	if ($row1['level'] == 2) {
	echo'<div class="rek">Ваш уровень - администратор. Вы можете войти в админ-панель</div>';
	}
	if ($row1['level'] == 0) {
	echo'<div class="rek">Вы находитесь в режиме просмотра (обычный пользователь)</div>';
	}
}
else {
	echo'<div class="menu">Вы находитесь в режиме просмотра (гость)</div>';
	echo'<div class="rek"><a href="http://yunusov.me/forKIT/user/join.php">Зарегистрируйтесь</a> или <a href="http://yunusov.me/forKIT/user/login.php">авторизуйтесь</a></div>';
}
?>
