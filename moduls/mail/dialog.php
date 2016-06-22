<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); 
$mess = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc(); 
$title = 'Диалог с '.$mess['login'];
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();






if(!isset($mess['id']) or $user['id'] == $mess['id']) {err('Ошибка!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}

$contact = $con->query("SELECT * FROM `message_c` WHERE `kogo` = '".$mess['id']."' and `kto` = '".$user['id']."' LIMIT 1")->num_rows;


if($contact == 0) { 
$con->query("INSERT INTO `message_c` SET `kto` = '".$user['id']."', `kogo` = '".$mess['id']."', `time` = '".time()."', `posl_time` = '".time()."'");
$con->query("INSERT INTO `message_c` SET `kto` = '".$mess['id']."', `kogo` = '".$user['id']."', `time` = '".time()."', `posl_time` = '".time()."'");

} 
$lasttime=$con->query('select `time` from message where kto = '.$user['id'].' order by id desc limit 1')->fetch_assoc();
$lasttime=time()-$lasttime['time'];
$timespam=$con->query('select message from antispam where id=1')->fetch_assoc();
$timespam=$timespam['message'];

if(isset($_POST['insert'])){

$msg = filtr($_POST['msg']);

    $filename = strtolower($_FILES['userfile']['name']); // имя и формат файла в нижнем регистре
    $t = preg_replace('#.[^.]*$#', NULL, $filename); // имя файла
    $f = str_replace($t, '', $filename); // формат файла
    if($filename!=NULL){
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/user/file_mail/';
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



$tim = $con->query("SELECT * FROM `message` WHERE `kto` = '".$user['id']."' ORDER BY `time` DESC")->fetch_assoc(); 

if(strlen($msg) < '2' or strlen($msg) > '500'){ err('Сообщение содержит меньше 2 или больше 500 символов');}

if((time()-$tim['time']) < 5) { err('Вы слишком часто пишите сообщения');}
if($lasttime<$timespam){
err('Вы можете писать раз в '.$timespam.' секунд!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}

else{

$con->query("UPDATE `message_c` SET `posl_time`='".time()."' WHERE `kogo` = '".$user['id']."' and `kto`='".$id."' limit 1"); 

$con->query("UPDATE `message_c` SET `posl_time`='".time()."' WHERE `kto` = '".$user['id']."' and `kogo`='".$id."' limit 1"); 

$con->query("INSERT INTO `message` SET `text` = '".$msg."', `kto` = '".$user['id']."', `komy` = '".$mess['id']."', `time` = '".time()."', `readlen` = '0', `file` = '".$t."'"); 

header('Location:?id='.$mess['id'].''); 

}


}


echo '
<div class="post">
<form action="" method="POST" enctype="multipart/form-data">
<b>Введите сообщение :</b> <br/>
<textarea name="msg"></textarea></br></br>
<b>Выберите файл :</b> <br>
 <input type="hidden" name="MAX_FILE_SIZE" value="9000000000">
<input type="file" name="userfile" id="userfile"><br />
<center><input type="submit" value="Отправить" name="insert" title="Сообщение" />  <input type="button" value="Обновить" onclick="location.reload();"/></center>
</form>
</div>
';

$k_post = $con->query("SELECT * FROM `message` WHERE `kto` = '".$user['id']."' and `komy` = '".$mess['id']."' or `kto` = '".$mess['id']."' and `komy` = '".$user['id']."'")->num_rows;

$k_page = k_page($k_post,10);

$page = page($k_page);

$start = 10*$page-10;

$msg  = $con->query("SELECT * FROM `message` WHERE `kto` = '".$user['id']."' and `komy` = '".$mess['id']."' or `kto` = '".$mess['id']."' and `komy` = '".$user['id']."' ORDER BY `time` DESC LIMIT $start, 10");
while($m = $msg->fetch_assoc()){

echo '<div class="link">';

echo ''.user($m['kto']).' <small>['.data($m['time']).']</small> <br/>'; 

echo ''.text($m['text']).'<br>';
echo ''.($m['file']!=''?'<img src="/style/image/file.png" width="12" height="17"> <a href="/user/file_mail/'.$m['file'].'">'.$m['file'].'</a><br>':'').'';

echo ($m['readlen']==0?'<font color="red">[Не прочитано]</font>':'<font color="green">Прочитано</font>');
echo '</div>';

if($user['id'] == $m['komy']) {
$con->query("UPDATE `message` SET `readlen` = '1' WHERE `id`='".$m['id']."' limit 1");
}
}

if($k_post < 1) err('Переписка с '.user($mess['id']).' еще не состоялась!');
if ($k_page > 1) echo str('?id='.$mess['id'].'&',$k_page,$page); // Вывод страниц

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>