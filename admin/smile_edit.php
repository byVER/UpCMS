<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$b = $con->query("SELECT * FROM `smiles` WHERE `id` = '".$id."'")->fetch_assoc();
$title = 'Редактирование смайлов';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();

if($user['admin_level']>=2){

if($b){

if(isset($_POST['add'])){

$name = filtr($_POST['name']);

if(mb_strlen($name) < '1' or mb_strlen($name) > '100') $err = 'Название либо менее 1 либо более 100 символов';
if($err){ 
err($err);
}else{
$con->query("UPDATE `smiles` SET `name` = '".$name."' WHERE `id` = '".$id."'");
header('Location: /admin/all_smile');
}
}

echo '<div class="link"><center>
<form action="" method="POST">Название :</br><input type="text" name="name" value="'.$b['name'].'"><br/><input type="submit" name="add" value="Изменить"></form></div>';


}else{

err('Ошибка');

}

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>