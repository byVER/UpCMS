<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
	$id = abs(intval($_GET['id']));

			$chat = $con->query("SELECT * FROM `room_chat` WHERE `id` = '".$id."'")->fetch_assoc();
$title = 'Комната чата '.$chat['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

			if($chat){
if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '2400') $err = 'Текст либо менее 1 либо более 2400 символов';
$lasttime=$con->query('select `time` from msg_chat where id_user = '.$user['id'].' order by id desc limit 1')->fetch_assoc();
$lasttime=time()-$lasttime['time'];
$timespam=$con->query('select room_chat from antispam where id=1')->fetch_assoc();
$timespam=$timespam['room_chat'];
if($lasttime<$timespam){
err('Вы можете писать раз в '.$timespam.' секунд!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
if($err){ 
err($err);
}else{
$con->query("INSERT INTO `msg_chat` (`text`, `id_room`, `id_user`, `time`) VALUES ('".$text."', '".$id."', '".$user['id']."', '".time()."')");	
$con->query("UPDATE `user` SET `money` = `money`+'".$sett['money_chat']."' WHERE `id` = '".$user['id']."'");
header('Location: ?');
}
}

echo '<div class="other"><form action="" method="POST"><center><textarea name="text"></textarea><br/><input type="submit" name="add" value="Отправить"></form></center></div>';

echo '<div class="razdel"><a href="../user/bb.php">BB коды</a></div>';

$k_post = $con->query('SELECT * FROM `msg_chat` WHERE `id_room` = "'.$id.'"')->num_rows;
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;

		$c = $con->query("SELECT * FROM `msg_chat` WHERE `id_room` = '".$id."' ORDER BY `id` DESC LIMIT $start, 10");
if($k_post<1) err('Сообщений еще нет');

  while($w = $c->fetch_assoc()){
  	if($w['id_user'] != $user['id']){$ot = '<br><a href="/chat_otv'.$w['id'].'">[Ответить]</a>';}else{$ot = '';}
echo '<div class="link">'.user($w['id_user']).' <small>('.data($w['time']).')</small></br>
'.text($w['text']).' '.$ot.'';
if($user['admin_level']>=2){
echo '</br><a href="/edit_chat'.$w['id'].'">[Изменить]</a> <a href="/del_chat'.$w['id'].'">[Удалить]</a></div>';
}
	echo "</div>";
}

  if($k_post > '10') {  echo str('?',$k_page,$page.'');  }
}else{

	err('Ошибка');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>