<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc();
	$banned = $con->query('SELECT * FROM `ban_list` WHERE `id_user` = "'.$id.'" and `time` > "'.time().'"')->num_rows;
$title = 'Бан '.$use['login'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

if($use){
if($banned < 1){
if($user['admin_level']>=1){ 

if($use['admin_level']<$user['admin_level']){

if(isset($_POST['ban'])){

$text = filtr($_POST['text']);
$time = abs(intval($_POST['time']));
$time2 = abs(intval($_POST['time2']));
$time_ban = $time*$time2; // Вычисляем на сколько баним
if($time_ban > '622080000') $err = 'Максимальный срок бана 20 лет';
if(mb_strlen($text) < '1' or mb_strlen($text) > '10000') $err = 'Причина либо менее 1 либо более 10000 символов';
if($user['admin_level'] == '1' and $time_ban > '84600') $err = 'Вы можете забанить максимум на 24 часов';
if($err) {
err($err);
}
else 
{
$con->query("INSERT INTO `ban_list` (`id_user`, `id_adm`, `time`, `text`) VALUES ('".$id."', '".$user['id']."', '".(time()+$time_ban)."', '".$text."')");
header('Location: /user_'.$id.'');
}
}

echo '<center>';

echo '<div class="link"><form action="" method="POST">Вы хотите забанить '.user($use['id']).'<br><b>Причина :</b><br>
<textarea name="text"></textarea><br><b>На сколько</b> :<br><input type="text" name="time" value=""> <select name="time2"><option value="60">минут</option><option value="3600">часов</option><option value="84600">дней</option><option value="3600">часов</option><option value="2592000">месяцев</option><option value="31104000">лет</option></select>
<br><br><input type="submit" name="ban" value="Забанить"></form></div>';

echo '</center>';

}else{
err('Недостаточно прав');
}
}else{
err('Недостаточо прав');
}
}else{
err('Этот пользователь уже забанен');
}
}else{
err('Пользователь не найден');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>