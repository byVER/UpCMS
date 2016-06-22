<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Изменение цвета ника';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();
$cena = '100'; /////введите сколько фишек снимет за смену
if($user['money'] >=100 ){
if(isset($_POST['edit'])){
	$colornick = filtr($_POST['colornick']);		
	if(mb_strlen($colornick) < '3' or mb_strlen($colornick) > '7') $err = 'Логин либо менее 3 либо более 7 символов';
	if($err){ 
err($err);
}else{
	$con->query("UPDATE `user` SET `colornick` = '".$colornick."' WHERE `id` = '".$user['id']."'");
	$con->query("UPDATE `user` SET `money` = '".($user['money']-$cena)."' WHERE `id` = '$user[id]' LIMIT 1");
setcookie('colornick', $colornick, time()+86400*365, '/'); 
ok('Успешно');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
}

echo '<div class="link"><center><b><font color="green">Цена смены цвета ника 100 монет</font></b><br><br>
Введите код html цвета, пример 082965
<form action="" method="POST">Новый цвет :</br><input type="text" name="colornick" value=""></br><input type="submit" name="edit" value="Изменить"></form></div>';

}else{

err('У вас нет  100   монет, насобирайте и приходите');

}


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>