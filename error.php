<?php
session_start();
require 'config.php';
$title = 'forKIT | Ошибка!';
require 'style/head.php';
print "<div class='bordur'><img border='0' src='http://yunusov.me/forKIT/style/img/error.gif'  alt='!' />Страница не найдена</div>
<div class='main'><center><img border='0' src='http://yunusov.me/forKIT/style/img/404.png'  alt='!' /></center><br/>
<font color='red'>
Данная ошибка возникла потому, что, Вы обратились к странице которой нет на сайте.<br/>
Вероятные причины ошибки:
<ul>
<li>Вы ошиблись при вводе адреса</li>
<li>Вам дали неверную ссылку</li>
<li>Страница по какой-то причине была удалена или перенесена администратором сайта</li>
</ul>
</font></div>";
require 'style/foot.php';
?>
