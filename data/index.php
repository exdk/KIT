<?php
session_start();
require '../config.php';
$title = 'forKIT | Просмотр данных';
require '../style/head.php';
echo'<div class="bordur">Просмотр данных</div><div class="main">
    <div class="container">
        <div id="categories" class="column categories">
            <img src="http://yunusov.me/forKIT/style/img/loading.gif" />
        </div>
        <div id="goods" class="column">
            Список животных
        </div>
    </div>
<script src="http://yunusov.me/forKIT/style/js/main.js" type="text/javascript"></script>
</div>';
if (isset($_SESSION['user_id']))
{
	$result1 = $mysqli->query("SELECT * FROM users WHERE id='{$_SESSION['user_id']}'");
	$row1 = $result1->fetch_assoc();
	if ($row1['level'] == 2) {
		echo'<div class="menu"><a href="http://yunusov.me/forKIT/panel/see.php?act"><img src="http://yunusov.me/forKIT/style/img/1.gif" alt="»" /> Режим редактирования</a></div>';
echo'</div>';
	}
}
require "../style/foot.php";
?>
