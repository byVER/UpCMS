<?php

if(!is_file($_SERVER["DOCUMENT_ROOT"].'/system/conn.php')) {
header('Location: /install/');
}
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Главная';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

include_once $_SERVER["DOCUMENT_ROOT"].'/moduls/news/new_news.php'; // Последняя новость

echo "<div class='razdel'>Общее</div>"; // РАЗДЕЛ

echo "<div class='main'><a href='/users'><img src='/style/image/index/users.png'> Все пользователи (".$con->query('SELECT * FROM `user`')->num_rows." |<font color='green'>+".$con->query('SELECT * FROM `user` WHERE `data_reg`+86400 > "'.time().'"')->num_rows."</font>)</a></div>";
echo "<div class='main'><a href='/chat_rooms'><img src='/style/image/index/chat.png'> Чат (".$con->query('SELECT * FROM `msg_chat`')->num_rows."|<font color='green'>+".$con->query('SELECT * FROM `msg_chat` WHERE `time`+86400 > "'.time().'"')->num_rows."</font>)</a></div>";
echo "<div class='main'><a href='/besedka'><img src='/style/image/index/besedka.png'> Беседка (".$con->query('SELECT * FROM `besedka`')->num_rows."|<font color='green'>+".$con->query('SELECT * FROM `besedka` WHERE `time`+86400 > "'.time().'"')->num_rows."</font>)</a></div>";
echo "<div class='main'><a href='/obmen'><img src='/style/image/index/obmen.png'> Обменник файлов (".$con->query('SELECT * FROM `obmen_file`')->num_rows."|<font color='green'>+".$con->query('SELECT * FROM `obmen_file` WHERE `time`+86400 > "'.time().'"')->num_rows."</font>)</a></div>";

echo "<div class='razdel'><a href='/forum'>Форум</a></div>";

include_once $_SERVER["DOCUMENT_ROOT"].'/moduls/forum/index_thems.php'; // Темы форума

echo "<div class='razdel'>Разное</div>"; // РАЗДЕЛ
echo "<div class='main'><a href='/online'><img src='/style/image/index/online.png'> Онлайн (".$con->query('SELECT * FROM `user` WHERE `up_time`+1800 > "'.time().'"')->num_rows.")</a></div>";
echo "<div class='main'><a href='/admins'><img src='/style/image/index/users.png'> Администрация (".$con->query('SELECT * FROM `user` WHERE `admin_level` > 2')->num_rows.")</a></div>";
echo "<div class='main'><a href='/rules'><img src='/style/image/index/rules.png'> Правила сайта</a></div>";
echo "<div class='main'><a href='http://worldbyte.net'><img src='/style/image/index/journal.png'> Наш хостинг партнер - worldbyte.net </a></div>";

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';

?>