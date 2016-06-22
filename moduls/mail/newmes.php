<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); 
$mess = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc(); 
$title = 'Написать сообщение для '.$mess['login'];
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();





if(isset($mess['id']) or $user['id'] != $mess['id']) {

$contact = $con->query("SELECT * FROM `message_c` WHERE `kogo` = '".$mess['id']."' and `kto` = '".$user['id']."' LIMIT 1")->num_rows;

if($contact == 0) { 
$con->query("INSERT INTO `message_c` SET `kto` = '".$user['id']."', `kogo` = '".$mess['id']."', `time` = '".time()."', `posl_time` = '".time()."'");
$con->query("INSERT INTO `message_c` SET `kto` = '".$mess['id']."', `kogo` = '".$user['id']."', `time` = '".time()."', `posl_time` = '".time()."'");


} 

if(isset($_POST['insert'])){

$msg = filtr($_POST['msg']);

$tim = $con->query("SELECT * FROM `message` WHERE `kto` = '".$user['id']."' ORDER BY `time` DESC")->fetch_assoc(); 

if(strlen($msg) < '3' or strlen($msg) > '500'){ err('Сообщение содержит меньше 3 или больше 500 символов');}

elseif((time()-$tim['time']) < 5) { err('Вы слишком часто пишите сообщения');}

else{

$con->query("UPDATE `message_c` SET `posl_time`='".time()."' WHERE `kogo` = '".$user['id']."' and `kto`='".$id."' limit 1"); 

$con->query("UPDATE `message_c` SET `posl_time`='".time()."' WHERE `kto` = '".$user['id']."' and `kogo`='".$id."' limit 1"); 

$con->query("INSERT INTO `message` SET `text` = '".$msg."', `kto` = '".$user['id']."', `komy` = '".$mess['id']."', `time` = '".time()."', `readlen` = '0'"); 

header('Location: dialog.php?id='.$mess['id'].''); 

}
}

echo '
<div class="post">
<form action="" method="POST">Введите сообщение: <br/>
<textarea name="msg"></textarea>
<center><input type="submit" value="Отправить" name="insert" title="Сообщение" /> </center>
</form>
</div>';


}else{

err('Произошла ошибка');
}


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>