<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
	$id = abs(intval($_GET['id']));

			$c = $con->query("SELECT * FROM `forum_theme` WHERE `id` = '".$id."'")->fetch_assoc();


$title = 'Тема форума '.$c['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
if($c){

if(isset($_POST['add'])){


    $filename = strtolower($_FILES['userfile']['name']); // имя и формат файла в нижнем регистре
    $t = preg_replace('#.[^.]*$#', NULL, $filename); // имя файла
    $f = str_replace($t, '', $filename); // формат файла
    if($filename!=NULL){
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/user/file_forum/';
$rand=rand(111111111, 999999999);
if($f=='.png' || $f=='.jpg' || $f=='.gif' || $f=='.jpeg' || $f=='.zip' || $f=='.rar' || $f=='.exe' || $f=='.txt'){
$t=$rand."_".basename($_FILES['userfile']['name']);

$uploadfile = $uploaddir . $rand.'_'. basename($_FILES['userfile']['name']);
}else{
    err("Неверный Формат! ");
    include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  } else {
    err('Ошибка выгрузки файла');
        include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
}


$text = filtr($_POST['text']);
if(mb_strlen($text) < '1' or mb_strlen($text) > '5400') $err = 'Текст либо менее 1 либо более 5400 символов';

if($err){ 
err($err);
}else{
   if($c['status'] == 'open'){
$lasttime=$con->query('select `time` from forum_msg where id_user = '.$user['id'].' order by id desc limit 1')->fetch_assoc();//мой код
$lasttime=time()-$lasttime['time'];
$timespam=$con->query('select forum_msg from antispam where id=1')->fetch_assoc();//мой код
$timespam=$timespam['forum_msg'];
if($lasttime<$timespam){
err('Вы можете писать раз в '.$timespam.' секунд!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
else {
$con->query("UPDATE `forum_theme` SET `up` = '".time()."' WHERE `id` = '".$id."'");
$con->query("INSERT INTO `forum_msg` (`text`, `id_theme`, `id_user`, `time`, `file`) VALUES ('".$text."', '".$id."', '".$user['id']."', '".time()."', '".$t."')");	
$con->query("UPDATE `user` SET `money` = `money`+'".$sett['money_f_msg']."' WHERE `id` = '".$user['id']."'");
}

header('Location: ?');
}elseif($c['status'] == 'closed' and $user['admin_level']>=1){
$con->query("UPDATE `forum_theme` SET `up` = '".time()."' WHERE `id` = '".$id."'");
$con->query("INSERT INTO `forum_msg` (`text`, `id_theme`, `id_user`, `time`, `file`) VALUES ('".$text."', '".$id."', '".$user['id']."', '".time()."', '".$t."')");	
$con->query("UPDATE `user` SET `money` = `money`+'".$sett['money_f_msg']."' WHERE `id` = '".$user['id']."'");
header('Location: ?');
}
}
}
if($user['admin_level']>=1){$admin = '<a href="/forum/del_them/'.$c['id'].'">[Уд]</a> <a href="/forum/edit_them/'.$c['id'].'">[Изм]</a>';}else{$admin ='';}

echo '<div class="razdel"><b>Название</b> : '.$c['name'].' ('.data($c['time']).') '.$admin.'</div>';
echo '<div class="forum_text">'.text($c['text']).'</div>';
echo '<div class="link"><b>Автор</b> : '.user($c['id_user']).' </div>';


# НИЖЕ ВЫВОД СООБЩЕНИЙ

$k_post = $con->query('SELECT * FROM `forum_msg` WHERE `id_theme` = "'.$id.'"')->num_rows;
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;

		$c2 = $con->query("SELECT * FROM `forum_msg` WHERE `id_theme` = '".$id."' ORDER BY `id` DESC LIMIT $start, 10");
if($k_post<1) err('Сообщений еще нет');

  while($w = $c2->fetch_assoc()){
    	if($w['id_user'] != $user['id']){$ot = '<br><a href="/forum/otvet/'.$w['id'].'">[Ответить]</a>';$quote = '<a href="/forum/quote/'.$w['id'].'">[Цитировать]</a>';}else{$ot = '';}
  if($user['admin_level']>=1){$madmin = '<a href="/forum/del_msg/'.$w['id'].'">[Уд]</a> <a href="/forum/edit_msg/'.$w['id'].'">[Изм]</a>';}else{$madmin ='';}
  echo '<div class="post">'.user($w['id_user']).' <small>('.data($w['time']).')</small><br>
  '.text($w['text']).'<br>';
echo ''.($w['file']!=NULL?'<img src="/style/image/file.png" width="12" height="17"> <a href="/user/file_forum/'.$w['file'].'">'.$w['file'].'</a><br>':'').'';
  echo''.$ot.' '.$quote.' '.$madmin.'</div>';
  
  }
  if($k_post > '10') {  echo str('?',$k_page,$page.'');  }
   # ФОРМА ВВОДА

   if($c['status'] != 'closed'){


    
   echo '<div class="razdel"><a href="../user/smiles.php">Смайлы</a> | <a href="../user/bb.php">BB коды</a></div>';
  echo '<div class="other"><form action="" method="POST" enctype="multipart/form-data"><center><textarea name="text"></textarea><br/>';
echo '<b>Выберите файл :</b> <br>
 <input type="hidden" name="MAX_FILE_SIZE" value="9000000000">
<input type="file" name="userfile" id="userfile"><br />';
  echo '<input type="submit" name="add" value="Отправить"></form></center></div>';

  }else{
err('Тема закрыта');
if($user['admin_level']>=1){
   echo '<div class="razdel"><a href="../user/smiles.php">Смайлы</a> | <a href="../user/bb.php">BB коды</a></div>';
  echo '<div class="other"><form action="" method="POST" enctype="multipart/form-data"><center><textarea name="text"></textarea><br/>';
echo '<b>Выберите файл :</b> <br>
 <input type="hidden" name="MAX_FILE_SIZE" value="9000000000">
<input type="file" name="userfile" id="userfile"><br />';
  echo '<input type="submit" name="add" value="Отправить"></form></center></div>';
}
}
}else{
err('Ошибка');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>