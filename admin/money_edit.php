<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Управление монетами';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

if($user['admin_level']>=3){ 

if(isset($_POST['edit'])){

$money_f_msg = abs(intval($_POST['money_f_msg'])); 
$money_f_them = abs(intval($_POST['money_f_them'])); 
$money_besedka = abs(intval($_POST['money_besedka'])); 
$money_chat = abs(intval($_POST['money_chat'])); 

$con->query("UPDATE `settings` SET `money_f_msg` =  '".$money_f_msg."', `money_f_them` =  '".$money_f_them."', `money_besedka` = '".$money_besedka."', `money_chat` = '".$money_chat."' WHERE `id` = '1'");
header('Location: /admin');
}


	echo '<div class="link"><center>
<form action="" method="POST">Сколько давать монет...<br><br>за пост на форуме :</br>
<input type="text" name="money_f_msg" value="'.$sett['money_f_msg'].'"></br>
за тему на форуме :</br><input type="text" name="money_f_them" value="'.$sett['money_f_them'].'"></br>
за сообщение в беседке :</br><input type="text" name="money_besedka" value="'.$sett['money_besedka'].'"></br>
за сообщение в чате :</br><input type="text" name="money_chat" value="'.$sett['money_chat'].'"></br>';
echo '<input type="submit" name="edit" value="Создать"></form></div>';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>