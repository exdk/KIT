<?php
if (isset($_SESSION['user_id'])) {
	echo'<div class="bordur"><a href="http://yunusov.me/forKIT/user/login.php?logout">Выйти из аккаунта</a><br/></div>';
}
else {
	echo'<div class="bordur">Вы находитесь в режиме просмотра (гость)</div>';
}
if ($_SERVER['PHP_SELF'] != '/index.php')
{
	echo "<div class='news'><a href='http://yunusov.me/forKIT'><img src='http://yunusov.me/forKIT/style/img/home.gif' alt='' /> На главную</a></div>";
}
echo'</div></body></html>';
?>
