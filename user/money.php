<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Платные услуги';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


echo '<div class="razdel"><center>У вас <b>'.$user['money'].'</b> монет </center></div>';

echo '<div class="link"><a href="/edit_nick"><img src="/style/image/money/nick.png"> Изменить ник (Цена : <b>'.$sett['edit_nick'].'</b> монет)</a></div>';
echo '<div class="link"><a href="/edit_color"><img src="/style/image/money/nick.png"> Изменить цвет ника (Цена : <b>'.$sett['edit_color'].'</b> монет)</a></div>';

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>