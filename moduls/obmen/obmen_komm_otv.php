<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Ответить на комментарий';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ




$b = $con->query("SELECT * FROM `obmen_komm` WHERE `id` = '".$id."'")->fetch_assoc();
$b_nick = $con->query("SELECT * FROM `user` WHERE `id` = '".$b['id_user']."'")->fetch_assoc();
if($b){

	if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '6400') $err = 'Текст либо менее 1 либо более 6400 символов';

if($err){ 
err($err);
}else{
$con->query("INSERT INTO `obmen_komm` (`text`, `id_obmen`, `id_user`, `time`) VALUES ('[b]".$b_nick['login']."[/b], ".$text."','".$b['id_obmen']."', '".$user['id']."', '".time()."')");	
$con->query("INSERT INTO `journal` SET `text` = '".$user['login']." прокомментировал вашу запись [url=".$SITE."/obmen_komm".$b['id_obmen']."]в обменнике[/url]',`time` = '".time()."', `id_user` = '".$b_nick['id']."'");
header('Location: /obmen_komm'.$b['id_obmen']);
}
	}

echo '<div class="cit">'.user($b['id_user']).'</br>
'.text($b['text']).'
</div>';
echo '<div class="link"></br><center>Ваш ответ : </br></br>
<form action="" method="POST"><textarea name="text"></textarea><br/><input type="submit" name="add" value="Отправить"></form></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>