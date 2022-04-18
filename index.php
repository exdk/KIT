<?php
session_start();
require 'config.php';
$title = 'forKIT | Тестовое задание КИТ';
require 'style/head.php';
$holiday=date('d');
$holimonth=date('m');
$holiyear=date('Y');
$file = file ("holidays.dat");
$blines = count ($file);
echo'<div class="bordur">А сегодня праздник:</div><div class="rek">';
for ($k=0; $k<$blines; $k++){
list ($b0, $b1, $b2,  $b3) = explode ("::",$file[$k]);
$array[$k] = array ($b0, $b1, $b2, $b3);
if ($b0==$holiday and $b1==$holimonth) {
if ($b2=='0000') {echo '- ';} else {echo '- В ',$b2,' году ';}
echo $b3;
echo ';<br />'; 
}
}
echo'</div><div class="menu">Меню:</div>
<div class="menu_1">';
if (isset($_SESSION['user_id']))
{
	$result1 = $mysqli->query("SELECT * FROM users WHERE id='{$_SESSION['user_id']}'");
	$row1 = $result1->fetch_assoc();
	if ($row1['level'] == 2) {
	echo'<div class="link"><a href="panel/"><img src="style/img/1.gif" alt="»" /> Войти в админ-панель</a><br/></div>';
	}
}
echo'<div class="link"><a href="data/"><img src="style/img/1.gif" alt="»" /> Просмотр данных</a><br/></div>';
echo'<div class="link"><a href="http://www.internet-clients.com" target="_blank"><img src="style/img/1.gif" alt="»" /> КИТ (Клиенты из Интернета)</a><br/></div>';
echo'<div class="link"><a href="https://spain-real.estate/" target="_blank"><img src="style/img/1.gif" alt="»" /> Spain Real</a><br/></div>';
echo'<div class="link"><a href="https://turk.estate" target="_blank"><img src="style/img/1.gif" alt="»" /> Turk Estate</a><br/></div>';
echo'<div class="link"><a href="https://emirates.estate" target="_blank"><img src="style/img/1.gif" alt="»" /> Emirates Estate</a><br/></div>';
echo'<div class="link"><a href="https://thailand-real.estate/" target="_blank"><img src="style/img/1.gif" alt="»" /> Thailand Real</a><br/></div>';
echo' </div>';

require 'style/foot.php';
?>