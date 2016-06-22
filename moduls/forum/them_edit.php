<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$b = $con->query("SELECT * FROM `forum_theme` WHERE `id` = '".$id."'")->fetch_assoc();
$title = 'Редактирование темы форума '.$b['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();

if($user['admin_level']>=1){

if($b){

if(isset($_POST['add'])){

$name = filtr($_POST['name']);
$stat = filtr($_POST['stat']);
$text = filtr($_POST['text']);



if(mb_strlen($name) < '1' or mb_strlen($name) > '100') $err = 'Название либо менее 1 либо более 100 символов';
if(mb_strlen($text) < '1' or mb_strlen($text) > '5000') $err = 'Текст либо менее 1 либо более 5000 символов';
if($err){ 
err($err);
}else{
if($stat == 1){
$con->query("UPDATE `forum_theme` SET `name` = '".$name."', `text` = '".$text."' WHERE `id` = '".$id."'");
}else{
$con->query("UPDATE `forum_theme` SET `name` = '".$name."', `text` = '".$text."', `status` = '".$stat."' WHERE `id` = '".$id."'");
}
header('Location: /them/'.$id.'');
}
}

echo '<div class="link"><center>
<form action="" method="POST">Название :</br><input type="text" name="name" value="'.$b['name'].'"><br/>
Текст :<br><textarea name="text">'.$b['text'].'</textarea><br/>
<select name="stat"><option value="1">Не изменять</option><option value="open">Открыта</option><option value="closed">Закрыта</option></select>
</br><br><input type="submit" name="add" value="Изменить"></form></div>';


}else{

err('Ошибка');

}

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>