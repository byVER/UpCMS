<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Изменение ника';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

if($user['money'] >= $sett['edit_nick']){

if(isset($_POST['edit'])){

$login = filtr($_POST['login']);		

if(mb_strlen($login) < '3' or mb_strlen($login) > '24') $err = 'Логин либо менее 3 либо более 24 символов';

if($err){ 
err($err);
}else{

$con->query("UPDATE `user` SET `login` = '".$login."' WHERE `id` = '".$user['id']."'");

setcookie('login', $login, time()+86400*365, '/'); 

ok('Успешно');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
}



	echo '<div class="link"><center><b><font color="green">Цена смены ника '.$sett['edit_nick'].' монет</font></b><br><br>
<form action="" method="POST">Новый ник :</br><input type="text" name="login" value=""></br><input type="submit" name="edit" value="Изменить"></form></div>';

}else{

err('У вас нет '.$sett['edit_nick'].' монет, насобирайте и приходите');

}


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>