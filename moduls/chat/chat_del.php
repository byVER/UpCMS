<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Удаление Комнаты чата';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=1){
$b = $con->query("SELECT * FROM `msg_chat` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_GET['yes'])){
$con->query("DELETE FROM `msg_chat` WHERE `id` = '".$id."'");

header('Location: /chat'.$b['id_room']);
}


echo '<div class="news"><center>Удалить комментарий в чате  <b>'.$b['text'].'</b> ?<br>
<a href=?yes>УДАЛИТЬ</a> / <a href="/chat"'.$b['id_room'].'">Назад</a></center></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>