<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$b = $con->query("SELECT * FROM `room_chat` WHERE `id` = '".$id."'")->fetch_assoc();

$title = 'Удаление Комнаты чата '.$b['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();

if($user['admin_level']>=2){


if($b){
if(isset($_GET['yes'])){
$con->query("DELETE FROM `room_chat` WHERE `id` = '".$id."'");

header('Location: /chat_rooms');
}


echo '<div class="news"><center>Удалить комнату чата - <b>'.$b['name'].'</b> ?<br>
<a href=?yes>УДАЛИТЬ</a> / <a href="/chat_rooms">Назад</a></center></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>