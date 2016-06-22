<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$b = $con->query("SELECT * FROM `room_chat` WHERE `id` = '".$id."'")->fetch_assoc();
$title = 'Редактирование комнаты чата '.$b['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();

if($user['admin_level']>=2){

if($b){

if(isset($_POST['add'])){
$info = filtr($_POST['info']);
$name = filtr($_POST['name']);
if(mb_strlen($info) < '1' or mb_strlen($info) > '400') $err = 'Информация либо менее 1 либо более 400 символов';
if(mb_strlen($name) < '1' or mb_strlen($name) > '100') $err = 'Название либо менее 1 либо более 100 символов';
if($err){ 
err($err);
}else{
$con->query("UPDATE `room_chat` SET `info` = '".$info."', `name` = '".$name."' WHERE `id` = '".$id."'");
header('Location: chat_rooms');
}
}

echo '<div class="link"><center>
<form action="" method="POST">Название :</br><input type="text" name="name" value="'.$b['name'].'"></br>Информация :</br><textarea name="info">'.$b['info'].'</textarea><br/><input type="submit" name="add" value="Изменить"></form></div>';


}else{

err('Комнат в чате еще нет');

}

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>