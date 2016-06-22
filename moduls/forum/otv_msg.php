<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Ответить на комментарий в форуме';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ




$b = $con->query("SELECT * FROM `forum_msg` WHERE `id` = '".$id."'")->fetch_assoc();
$b_nick = $con->query("SELECT * FROM `user` WHERE `id` = '".$b['id_user']."'")->fetch_assoc();
if($b){

	if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '5000') $err = 'Текст либо менее 1 либо более 5000 символов';
$lasttime=$con->query('select `time` from forum_msg where id_user = '.$user['id'].' order by id desc limit 1')->fetch_assoc();
$lasttime=time()-$lasttime['time'];
$timespam=$con->query('select forum_msg from antispam where id=1')->fetch_assoc();
$timespam=$timespam['forum_msg'];
if($lasttime<$timespam){
err('Вы можете писать раз в '.$timespam.' секунд!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
if($err){ 
err($err);
}else{
$con->query("INSERT INTO `forum_msg` (`text`, `id_user`, `time`, `id_theme`) VALUES ('[b]".$b_nick['login']."[/b], ".$text."', '".$user['id']."', '".time()."', '".$b['id_theme']."')");	
$con->query("UPDATE `user` SET `money` = `money`+'".$sett['money_f_msg']."' WHERE `id` = '".$user['id']."'");
$con->query("INSERT INTO `journal` SET `text` = '".$user['login']." прокомментировал вашу запись [url=".$SITE."/them/".$b['id_theme']."]на форуме[/url]',`time` = '".time()."', `id_user` = '".$b_nick['id']."'");
header('Location: /them/'.$b['id_theme'].'');
}
	}

echo '<div class="cit">'.user($b['id_user']).'</br>
'.smiles(bb_code($b['text'])).'
</div>';
echo '<div class="link"></br><center>Ваш ответ : </br></br>
<form action="" method="POST"><textarea name="text"></textarea><br/><input type="submit" name="add" value="Отправить"></form></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>