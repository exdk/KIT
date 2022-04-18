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

$act = 0;
if(isset($_GET["act"]))
$act = mysqli_real_escape_string($mysqli, $_GET["act"]);
switch($act)
{
case see:
$sql = "SELECT * FROM categories WHERE parent_id = {$_GET['see']}";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='link'><a href='see.php?see=".$row["id"]."'><img src='http://yunusov.me/forKIT/style/img/1.gif' alt='»' /> " . $row["category"]. "</a> <a href='editor.php?id=".$row["id"]."'><img src='http://yunusov.me/forKIT/style/img/add.png' alt='Отредактировать' /></a> <a href='delete.php?id=".$row["id"]."'><img src='http://yunusov.me/forKIT/style/img/error.gif' alt='Удалить' /></a></div>";  
	}
	$result1 = $mysqli->query("SELECT * FROM categories WHERE id = {$_GET['see']}");
	$row1 = $result1->fetch_assoc();
	echo '</div><div class="bordur"><a href="see.php?see='.$row1["parent_id"].'"><img src="http://yunusov.me/forKIT/style/img/2.gif" alt="»" /> Вернуться</a></div>';
}
else {
	$result1 = $mysqli->query("SELECT * FROM categories WHERE id = {$_GET['see']}");
	$row1 = $result1->fetch_assoc();
	echo'</div><div class="menu">В этой категории никаких данных пока что нет</div><div class="bordur"><a href="?see='.$row1["parent_id"].'"><img src="http://yunusov.me/forKIT/style/img/2.gif" alt="»" /> Вернуться</a></div>';
}
$mysqli->close();
break;

default:
$sql = "SELECT * FROM categories WHERE parent_id = 0";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='link'><a href='see.php?see=".$row["id"]."'><img src='http://yunusov.me/forKIT/style/img/1.gif' alt='»' /> " . $row["category"]. "</a> <a href='editor.php?id=".$row["id"]."'><img src='http://yunusov.me/forKIT/style/img/add.png' alt='Отредактировать' /></a> <a href='delete.php?id=".$row["id"]."'><img src='http://yunusov.me/forKIT/style/img/error.gif' alt='Удалить' /></a></div>";  
	}
}
$mysqli->close();
break;

}
echo '</div>';
require "../style/foot.php";