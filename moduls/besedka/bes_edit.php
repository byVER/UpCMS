<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Редактирование сообщения в беседке';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=1){


if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '9000') $err = 'Текст либо менее 1 либо более 9000 символов';
if($err){ 
err($err);
}else{
$con->query("UPDATE `besedka` SET `text` = '".$text."' WHERE `id` = '".$id."'");
header('Location: /besedka');
}
}

echo '<div class="main"><center>
<form action="" method="POST"><textarea name="text">'.$b['text'].'</textarea><br/><input type="submit" name="add" value="Изменить"></form></div>';



}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>