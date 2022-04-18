<?php
//подключаемся к БД
$mysqli = new mysqli('mysql-174554.srv.hoster.ru', 'srv174554_aa59', 'bcs2d.,y', 'srv174554_b63cb');
$mysqli->query("SET NAMES 'utf8'"); 
$mysqli->query("SET CHARACTER SET 'utf8'");
$mysqli->query("SET SESSION collation_connection = 'utf8_general_ci'");
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
