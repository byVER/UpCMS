<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Редактирование Файла из Обменника';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `obmen_file` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
if(isset($_POST['add'])){
$text = filtr($_POST['text']);
$name = filtr($_POST['name']);
$downs = abs(intval($_POST['downs']));
if(mb_strlen($text) < '1' or mb_strlen($text) > '9900') $err = 'Текст либо менее 1 либо более 9900 символов';

if($err){ 
err($err);
}else{
$con->query("UPDATE `obmen_file` SET `text` = '".$text."', `name` = '".$name."', `downs` = '".$downs."' WHERE `id` = '".$id."'");
header('Location: /obmen_file'.$b['id']);
}
}

echo '<div class="link"><center>
<form action="" method="POST">Название : </br><input type="text" name="name" value="'.$b['name'].'"><br/>Описание : </br><textarea name="text">'.$b['text'].'</textarea><br/>Кол-во загрузок :</br><input type="text" name="downs" value="'.$b['downs'].'"><br/><input type="submit" name="add" value="Изменить"></form></div>';

}else{

	err('Ошибка');
}
}else{
	err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>