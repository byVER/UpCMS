<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Беседка';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

if(isset($_POST['add'])){
$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '2400') $err = 'Текст либо менее 1 либо более 2400 символов';
$lasttime=$con->query('select `time` from besedka where id_user = '.$user['id'].' order by id desc limit 1')->fetch_assoc();
$lasttime=time()-$lasttime['time'];
$timespam=$con->query('select besedka from antispam where id=1')->fetch_assoc();
$timespam=$timespam['besedka'];
if($lasttime<$timespam){
err('Вы можете писать раз в '.$timespam.' секунд!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
if($err){ 
err($err);
}else{
$con->query("INSERT INTO `besedka` (`text`, `id_user`,  `time`) VALUES ('".$text."', '".$user['id']."', '".time()."')");
$con->query("UPDATE `user` SET `money` = `money`+'".$sett['money_besedka']."' WHERE `id` = '".$user['id']."'");	
header('Location: ?');
}
}

echo '<div class="other"><form action="" method="POST"><center><textarea name="text"></textarea><br/><input type="submit" name="add" value="Отправить"></form></center></div>';
echo '<div class="razdel"><a href="../user/bb.php">BB коды</a></div>';
$k_post = $con->query('SELECT * FROM `besedka`')->num_rows;
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;

		$c = $con->query("SELECT * FROM `besedka` ORDER BY `id` DESC LIMIT $start, 10");
if($k_post<1) err('Сообщений еще нет');

  while($w = $c->fetch_assoc()){
  	if($w['id_user'] != $user['id']){$ot = '<br><a href="/bes_otv'.$w['id'].'">[Ответить]</a>';}else{$ot = '';}
echo '<div class="link">'.user($w['id_user']).' <small>('.data($w['time']).')</small></br>
'.text($w['text']).' '.$ot.'';
if($user['admin_level']>=1){
echo '</br><a href="/edit_bes'.$w['id'].'">[Изменить]</a> <a href="/del_bes'.$w['id'].'">[Удалить]</a></div>';
}
	echo "</div>";
}

 if($k_post > '10') {  echo str('?',$k_page,$page.'');  }

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>