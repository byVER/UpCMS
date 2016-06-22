<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Удаление Раздела форума';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `forum_razdel` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_GET['yes'])){
$con->query("DELETE FROM `forum_razdel` WHERE `id` = '".$id."'");
$con->query("DELETE FROM `forum_podrazdel` WHERE `id_razdel` = '".$id."'");
header('Location: /forum');
}


echo '<div class="news"><center>Удалить раздел форума - <b>'.$b['name'].'</b> ?<br>
<a href=?yes>УДАЛИТЬ</a> / <a href="/forum">Назад</a></center></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>