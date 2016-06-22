<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc();
$title = 'Изменение должности '.$use['login'];
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();


if($user['admin_level']>=3){ 

if(!$use){
err('Ошибка');
}else{
if($id == $user['id']){
err('Изменять должность себе - нельзя');
}else{
if(isset($_POST['edit'])){
$lvl = abs(intval($_POST['lvl'])); 
$con->query("UPDATE `user` SET `admin_level` =  '".$lvl."' WHERE `id` = '".$id."'");
}
if($user['admin_level']==3){
echo '<div class="link"><center>
<form action="" method="POST">Вы хотите именить должность '.user($use['id']).'<br><br>';
echo '<b>Выберите новую должность </b>:<br><select name="lvl">';


echo '<option value="0">Пользователь</option>';
echo '<option value="1">Смотрящий</option>';
echo '<option value="2">Модератор</option>';


echo '</select><br><br>';
echo '<input type="submit" name="edit" value="Изменить"></form></div>';
}
if($user['admin_level']==4){
echo '<div class="link"><center>
<form action="" method="POST">Вы хотите именить должность '.user($use['id']).'<br><br>';
echo '<b>Выберите новую должность </b>:<br><select name="lvl">';


echo '<option value="0">Пользователь</option>';
echo '<option value="1">Смотрящий</option>';
echo '<option value="2">Модератор</option>';
echo '<option value="3">Администратор</option>';

echo '</select><br><br>';
echo '<input type="submit" name="edit" value="Изменить"></form></div>';
}

}
}

}else{
err('Ошибка доступа');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>