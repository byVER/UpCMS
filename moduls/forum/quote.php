<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
	$id = abs(intval($_GET['id']));
	$c = $con->query("SELECT * FROM `forum_msg` WHERE `id` =  '".$id."'")->fetch_assoc();
$title = 'Цитирование поста #'.$c['id'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
if($c){

$b = $con->query("SELECT * FROM `forum_msg` WHERE `id` = '".$id."'")->fetch_assoc();
$b_nick = $con->query("SELECT * FROM `user` WHERE `id` = '".$c['id_user']."'")->fetch_assoc();

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
$con->query("INSERT INTO `forum_msg` (`text`, `id_user`, `time`, `id_theme`) VALUES ('[cit]".$c['text']."[/cit][b]".$b_nick['login']."[/b], ".$text."', '".$user['id']."', '".time()."', '".$c['id_theme']."')");	
$con->query("UPDATE `user` SET `money` = `money`+'".$sett['money_f_msg']."' WHERE `id` = '".$user['id']."'");
$con->query("INSERT INTO `journal` SET `text` = '".$user['login']." прокомментировал вашу запись [url=".$SITE."/them/".$c['id_theme']."]на форуме[/url]',`time` = '".time()."', `id_user` = '".$b_nick['id']."'");
header('Location: /them/'.$c['id_theme'].'');
}

	}


echo '<div class="cit">'.user($c['id_user']).'</br>
'.smiles(bb_code($c['text'])).'
</div>';

echo '<div class="link"></br><center>Цитирование поста : </br></br>
<form action="" method="POST"><textarea name="text"></textarea><br/><input type="submit" name="add" value="Отправить"></form></div>';

}else{
err('Ошибка');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>