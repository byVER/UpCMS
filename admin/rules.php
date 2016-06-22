<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Изменение правил';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if($user['admin_level']>=3){ 

if(isset($_POST['add'])){
$rules = filtr($_POST['rules']);

if(mb_strlen($rules) < '1' or mb_strlen($rules) > '9900') $err = 'Правила либо менее 1 либо более 9900 символов';
if($err){ 
err($err);
}else{
$con->query("UPDATE `settings` SET `rules` = '".$rules."' WHERE `id` = '1'");

header('Location: /rules');

}
}


	echo '<div class="link"><center>
<form action="" method="POST">Текст :</br><textarea name="rules">'.$sett['rules'].'</textarea><br/><input type="submit" name="add" value="Сохранить"></form></div>';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>