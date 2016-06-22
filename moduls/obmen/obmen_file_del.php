<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Удаление Загрузки';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `obmen_file` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_GET['yes'])){
$con->query("DELETE FROM `obmen_file` WHERE `id` = '".$id."'");
header('Location: /obmen');
}


echo '<div class="news"><center>Удалить файл <b>'.$b['name'].'</b> с загрузок ?<br>
<a href=?yes>УДАЛИТЬ</a> / <a href="/obmen_file'.$b['id'].'">Назад</a></center></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>