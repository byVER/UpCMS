<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Редактирование комнаты';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
if($user['admin_level']>=2){
$b = $con->query("SELECT * FROM `msg_chat` WHERE `id` = '".$id."'")->fetch_assoc();
if($b){

if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '9000') $err = 'Текст либо менее 1 либо более 9000 символов';
if($err){ 
err($err);
}else{
$con->query("UPDATE `msg_chat` SET `text` = '".$text."' WHERE `id` = '".$id."'");
header('Location: chat'.$b['id_room']);
}
}

echo '<div class="link"><center>
<form action="" method="POST"><textarea name="text">'.$b['text'].'</textarea><br/><input type="submit" name="add" value="Изменить"></form></div>';


}else{

err('Комнат в чате еще нет');

}

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>