<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Создание раздела форума';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if($user['admin_level']>=2){ 

if(isset($_POST['add'])){
$info = filtr($_POST['info']);	
$name = filtr($_POST['name']);		

if(mb_strlen($name) < '1' or mb_strlen($name) > '100') $err = 'Название либо менее 1 либо более 100 символов';
if(mb_strlen($info) < '1' or mb_strlen($info) > '100') $err = 'Информация либо менее 1 либо более 100 символов';
if($err){ 
err($err);
}else{
$con->query("INSERT INTO `room_chat` (`name` , `info`) VALUES ('".$name."', '".$info."')");

ok('Успешно');

}
}


	echo '<div class="link"><center>
<form action="" method="POST">Название :</br><input type="text" name="name" value=""></br>Информация :</br><input type="text" name="info" value=""></br><input type="submit" name="add" value="Создать"></form></div>';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>