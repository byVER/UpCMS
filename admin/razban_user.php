<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc();
	$banned = $con->query('SELECT * FROM `ban_list` WHERE `id_user` = "'.$id.'" and `time` > "'.time().'"')->num_rows;
$title = 'Разбан '.$use['login'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

if($use){
if($banned > 0){
if($user['admin_level']>=1){ 

$con->query("DELETE FROM `ban_list` WHERE `id_user` = '".$id."' and `time` > '".time()."'");

header('Location: /user_'.$id.'');
}else{
err('Недостаточо прав');
}
}else{
err('Этот пользователь НЕ забанен');
}
}else{
err('Пользователь не найден');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>