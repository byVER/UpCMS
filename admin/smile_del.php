<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Удаление сообщения форума';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `smiles` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_GET['yes'])){
$con->query("DELETE FROM `smiles` WHERE `id` = '".$id."'");
header('Location: /admin/all_smiles');
}


echo '<div class="news"><center>Удалить смайл - <b>'.$b['name'].' (<img src="/user/smiles/'.$b[img].'" name="'.$b[img].'">)</b> ?<br>
<a href=?yes>УДАЛИТЬ</a> / <a href="/admin/all_smiles">Назад</a></center></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>