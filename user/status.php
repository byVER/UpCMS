<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Изменение статуса';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if(isset($_POST['edit'])){

$status = filtr($_POST['status']);		

if(mb_strlen($status) < '1' or mb_strlen($status) > '50') $err = 'Статус либо менее 1 либо более 50 символов';

if($err){ 
err($err);
}else{

$con->query("UPDATE `user` SET `status` = '".$status."' WHERE `id` = '".$user['id']."'");

ok('Успешно');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
}



	echo '<div class="link">
<form action="" method="POST">Новый cтатус :</br><input type="text" name="status" value="'.$user['status'].'"></br><input type="submit" name="edit" value="Изменить"></form></div>';


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>