<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Загрузка';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$b = $con->query("SELECT * FROM `obmen_file` WHERE `id` = '".$id."'")->fetch_assoc();

if($b){
$con->query("UPDATE `obmen_file` SET `downs` = `downs`+'1' WHERE `id` = '".$id."'");
header('Location: /moduls/obmen/file_obmen/'.$b['down'].'');
}else{
header('Location: /obmen');
}


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>