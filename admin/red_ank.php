<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Редактирование пользователя';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();
if($user['admin_level']>=3){ 
$us = filtr($_REQUEST['id']);
$use=null;
if(!empty($_REQUEST['id'])){

if(isset($_REQUEST['ok'])) {
$login = filtr($_POST['login']);
$pol = filtr($_POST['pol']);
$money = filtr($_POST['money']);
$status = filtr($_POST['status']);

$con->query("UPDATE `user` SET `login` =  '".$login."', `pol` =  '".$pol."', `money` = '".$money."', `status` = '".$status."' WHERE `id` = '".$us."'");
ok('Успешно!');
}
$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$us."'")->fetch_assoc();


}
if(empty($use['id'])){
echo '<div class="link"><center>
<form action="" method="POST">Укажите ID пользователя</br><input type="text" name="id" value=""></br><input type="submit" value="Найти"></form></div>';
}else{

echo '<div class="post"><form action="" method="POST">Данные пользователя:</br></br>
Логин:</br>
<input type="hidden" name="id" value="'.$us.'">
<input type="text" name="login" value="'.$use['login'].'"/><br />
Пол (1-муж, 0-жен):</br>
<input type="text" name="pol" value="'.$use['pol'].'"/><br />
Деньги:</br>
<input type="text" name="money" value="'.$use['money'].'"/><br />
Статус:</br>
<input type="text" name="status" value="'.$use['status'].'"/><br /><br />
<input type="submit" name="ok" value="Редактировать" />
</form></div>';
}
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>