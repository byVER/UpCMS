<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Антиспам';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';


if($user['admin_level']>=3){ 
if(isset($_REQUEST['ok'])) {

$message = filtr($_POST['message']);
$news = filtr($_POST['news']);
$besedka = filtr($_POST['besedka']);
$room_chat = filtr($_POST['room_chat']);
$forum_theme = filtr($_POST['forum_theme']);
$forum_msg = filtr($_POST['forum_msg']);


/* Сообщения */
if(empty($message)) {
err('Вы не ввели время антиспама в сообщениях');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}

if(!is_numeric($message)) {
err('Вводить можно только цифры!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
/* Сообщения */


/* Новости комментарии */
if(empty($news)) {
err('Вы не ввели время антиспама в комментариях новостях!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}

if(!is_numeric($news)) {
err('Вводить можно только цифры!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
/* Новости комментарии */



/* Сообщения в чате */
if(empty($room_chat)) {
err('Вы не ввели время антиспама в чате!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}

if(!is_numeric($room_chat)) {
err('Вводить можно только цифры!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
/* Сообщения в чате */

/* Сообщения в беседке */
if(empty($besedka)) {
err('Вы не ввели время антиспама в беседке!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}

if(!is_numeric($besedka)) {
err('Вводить можно только цифры!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
/* Сообщения в беседке */

/* Форум создание темы */
if(empty($forum_theme)) {
err('Вы не ввели время антиспама создания темы!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}

if(!is_numeric($forum_theme)) {
err('Вводить можно только цифры!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
/* Форум создание темы */

/* Форум написание поста */
if(empty($forum_msg)) {
err('Вы не ввели время антиспама написания сообщений в теме!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}

if(!is_numeric($forum_msg)) {
err('Вводить можно только цифры!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
/* Форум написание поста */


$con->query("UPDATE `antispam` SET `news` =  '".$news."', `besedka` =  '".$besedka."', `forum_theme` = '".$forum_theme."', `forum_msg` = '".$forum_msg."', `message` = '".$message."', `room_chat` = '".$room_chat."' WHERE `id` = '1'");
ok('Успешно!');
}


$a = $con->query("SELECT * FROM `antispam` ")->fetch_assoc();


echo '<div class="link"><form action="" method="POST">
Писать в новостях комментарии можно раз в:<br />
<input type="text" name="news" value="'.$a['news'].'"/> сек.<br />
Оставлять в чате сообщения можно раз в:<br />
<input type="text" name="room_chat" value="'.$a['room_chat'].'"/> сек.<br />
Оставлять в беседке сообщения можно раз в:<br />
<input type="text" name="besedka" value="'.$a['besedka'].'"/> сек.<br />
Создавать темы в форуме можно раз в:<br />
<input type="text" name="forum_theme" value="'.$a['forum_theme'].'"/> сек.<br />
Писать сообщения в теме можно раз в:<br />
<input type="text" name="forum_msg" value="'.$a['forum_msg'].'"/> сек.<br />
Писать сообщения можно раз в:<br />
<input type="text" name="message" value="'.$a['message'].'"/> сек.<br />
<input type="submit" name="ok" value="Установить" />
</form></div>';
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>