<?php
error_reporting(0);
session_start();
require "../config.php";
$title = 'forKIT | Редактор';
require "../style/head.php";
if (isset($_SESSION['user_id']))
{
	$result1 = $mysqli->query("SELECT * FROM users WHERE id='{$_SESSION['user_id']}'");
	$row1 = $result1->fetch_assoc();
	if ($row1['level'] != 2) {
		header("Location: http://yunusov.me/forKIT/error.php");
	}
}
else {
	header("Location: http://yunusov.me/forKIT/error.php");
}
echo'<div class="bordur">Панель управления</div><div class="main">';

$id = 0;
if(isset($_GET["id"]))
$id = mysqli_real_escape_string($mysqli, $_GET["id"]);

$sql1 = "SELECT * FROM categories WHERE id = {$id}";
$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_assoc();
	$result1 = $mysqli->query("SELECT * FROM categories WHERE id = {$id}");
	$row1 = $result1->fetch_assoc();
		echo'
		<form name="addform" method="POST" action="added.php?id='.$id.'">
		Введите имя новой категории: <br />
		<input name="category" type="text" value="" /> <br />
		<input name="parent_id" type="hidden" value="'.$id.'" /> <br />
		<input type="submit" name="enter" value="Добавить" />
		</form>
		';
$mysqli->close();

echo '</div>';
require "../style/foot.php";