<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Удаление сообщения с беседки';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=1){
$b = $con->query("SELECT * FROM `besedka` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_GET['yes'])){
$con->query("DELETE FROM `besedka` WHERE `id` = '".$id."'");

header('Location: /besedka');
}


echo '<div class="news"><center>Удалить комментарий в беседке  <b>'.$b['text'].'</b> ?<br>
<a href=?yes>УДАЛИТЬ</a> / <a href="/besedka">Назад</a></center></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>