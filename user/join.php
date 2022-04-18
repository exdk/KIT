<?php
error_reporting(0);
session_start();
require '../config.php';
$title = 'Yunusov.me | Регистрация';
require '../style/head.php';
echo'<div class="bordur"><a href="http://yunusov.me/forKIT">forKIT</a> | Регистрация</div><div class="main">';

/*
** Функция для генерации соли, используемоей в хешировании пароля
** возращает 3 случайных символа
*/

function GenerateSalt($n=3)
{
	$key = '';
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
	$counter = strlen($pattern)-1;
	for($i=0; $i<$n; $i++)
	{
		$key .= $pattern{rand(0,$counter)};
	}
	return $key;
}

if (empty($_POST))
{
$rand = rand(1000, 9999);
$_SESSION['rand'] = "$rand";
$_SESSION['protect'] = rand(1111, 9999);
echo"Длина логина или пароля должна быть от 4 до 20 символов.</div>
<div class='main'>
<form action='join.php' method='post'>
Логин:<br/>
<input type='text' name='login' /><br/>
Пароль:<br/>
<input type='password' name='password' /><br/>
<b>Введите число:</b> <font color=\"red\">$rand</font><br/><input size=\"5\" maxlength=\"5\" name=\"imgrand\" value=\"\" /><br/>
<input type='submit' value='Зарегистрироваться' /></form></div>";
}
else
{
	// обрабатываем пришедшие данные функцией mysql_real_escape_string перед вставкой в таблицу БД
$login = (isset($_POST['login'])) ? mysqli_real_escape_string($mysqli, $_POST['login']) : '';
$password = (isset($_POST['password'])) ? mysqli_real_escape_string($mysqli, $_POST['password']) : '';
$imgrand = (isset($_POST['imgrand'])) ? mysqli_real_escape_string($mysqli, $_POST['imgrand']) : '';
	
	// проверяем на наличие ошибок (например, длина логина и пароля)
	$error = false;
	$errort = '';
	
	if (strlen($_POST['login']) < 4)
	{
		$error = true;
		$errort .= 'Длина логина должна быть не менее 4 символов.<br />';
	}
	if (strlen($password) < 4)
	{
		$error = true;
		$errort .= 'Длина пароля должна быть не менее 4 символов.<br />';
	}
        if(empty($imgrand))
        {
                $error = true;
                $errort = 'Вы не ввели проверочное число</br>';
        }
        if(!empty($imgrand))
        {
           if($_POST['imgrand'] != $_SESSION['rand'])
           {
               $error = true;
               $errort = 'Проверочное число не верно</br>';
           }
        }  
		
	$result = $mysqli->query("SELECT `id` FROM `users` WHERE `login`='{$login}' LIMIT 1");
	$row = $result->fetch_assoc();
	// проверяем, если юзер в таблице с таким же логином
	if (mysqli_num_rows($row)==1)
	{
		$error = true;
		$errort .= 'Пользователь с таким логином уже существует в базе данных, введите другой.<br />';
	}
	

	// если ошибок нет, то добавляем юзера в таблицу
	if (!$error)
	{
		// генерируем соль и пароль
		$salt = GenerateSalt();
		$hashed_password = md5(md5($password));
		$mysqli->query("INSERT INTO users VALUES ('', '$login', '$hashed_password', '0', '$salt')");
		print '<font color="green"><img border="0" src="http://yunusov.me/forKIT/style/img/ok.gif"  alt="!">Поздравляем, Вы успешно зарегистрированы!</font><br/>
		<a href="input.php?login='.$login.'&password='.$password.'&remember=1">Авторизоваться</a>';
	}
	else
	{
		print '<font color="red"><img border="0" src="http://yunusov.me/forKIT/style/img/error.gif" alt="!">Возникли следующие ошибки:</font><br/>' . $errort;
		echo'<a href="join.php?">Назад</a>';	
	}
}

echo"</div>";
require '../style/foot.php';
?>
