<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Удаление Темы форума';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=1){
$b = $con->query("SELECT * FROM `forum_theme` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_GET['yes'])){
$con->query("DELETE FROM `forum_theme` WHERE `id` = '".$id."'");
header('Location: /forum');
}


echo '<div class="news"><center>Удалить тему форума - <b>'.$b['name'].'</b> ?<br>
<a href=?yes>УДАЛИТЬ</a> / <a href="/forum">Назад</a></center></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>