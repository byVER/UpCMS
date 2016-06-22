<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Управление платными услугами';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

if($user['admin_level']>=3){ 

if(isset($_POST['edit'])){

$edit_nick = abs(intval($_POST['edit_nick'])); 

$con->query("UPDATE `settings` SET `money_f_msg` =  '".$money_f_msg."', `money_f_them` =  '".$money_f_them."', `money_besedka` = '".$money_besedka."', `money_chat` = '".$money_chat."' WHERE `id` = '1'");

header('Location: /admin');
}


	echo '<div class="link"><center>
<form action="" method="POST">
Цена смены ника :</br><input type="text" name="edit_nick" value="'.$sett['edit_nick'].'"></br>';
echo '<input type="submit" name="edit" value="Изменить"></form></div>';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>