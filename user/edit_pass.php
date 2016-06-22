<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Изменение пароля';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if(isset($_POST['edit'])){

$pass = filtr($_POST['pass']);		
$pass2 = filtr($_POST['pass2']);	
$pass3 = filtr($_POST['pass3']);	

if(mb_strlen($pass2) < '4')  $err = 'Новый Пароль должен быть не менее 4 символов';
if(md5($pass) != $user['pass']) $err = 'Старый пароль указан не верно';
if($pass2 != $pass3) $err = 'Новые пароли не совпадают';

if($err){ 
err($err);
}else{

$con->query("UPDATE `user` SET `pass` = '".md5($pass2)."' WHERE `id` = '".$user['id']."'");

setcookie('pass', md5($pass2), time()+86400*365, '/'); 

ok('Успешно');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
}



	echo '<div class="link"><center>
<form action="" method="POST">Старый пароль :</br><input type="text" name="pass" value=""><br>Новый пароль :<br><input type="text" name="pass2" value=""><br>Новый пароль (еще раз) :</br><input type="text" name="pass3" value=""></br></br><input type="submit" name="edit" value="Изменить"></form></div>';




include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>