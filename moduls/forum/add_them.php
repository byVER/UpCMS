<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
	$id = abs(intval($_GET['id']));
	$c = $con->query("SELECT * FROM `forum_podrazdel` WHERE `id` =  '".$id."'")->fetch_assoc();
$title = 'Создание темы';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

$antispam = $con->query("SELECT * FROM `antispam` ")->fetch_assoc();
if($c){




if(isset($_POST['add'])){
$name = filtr($_POST['name']);
$text = filtr($_POST['text']);

if(mb_strlen($name) < '2' or mb_strlen($name) > '35') $err = 'Название темы либо менее 2 либо более 35 символов';
if(mb_strlen($text) < '2' or mb_strlen($text) > '5000') $err = 'Текст либо менее 2 либо более 5000 символов';
$lasttime=$con->query('select `time` from forum_theme where id_user = '.$user['id'].' order by id desc limit 1')->fetch_assoc();
$lasttime=time()-$lasttime['time'];
$timespam=$con->query('select forum_theme from antispam where id=1')->fetch_assoc();
$timespam=$timespam['forum_theme'];
if($lasttime<$timespam){
err('Вы можете создавать темы раз в '.$timespam.' секунд!');
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
if($err){

err($err);

}else{

$con->query("INSERT INTO `forum_theme` (`id_podraz`, `up`, `name`, `id_user`, `text`, `time`, `status`) VALUES ('".$id."', '".time()."', '".$name."', '".$user['id']."', '".$text."', '".time()."', 'open')");
$con->query("UPDATE `user` SET `money` = `money`+'".$sett['money_f_them']."' WHERE `id` = '".$user['id']."'");
$id_them = mysqli_insert_id($con);
ok('Тема успешно создана!');
}

}


echo'<center><div class="other"><form action="" method="POST">Название:<br/>
<input type="text" name="name" value=""><br/>Текст : <br>
<textarea name="text"></textarea></br>
<input type="submit" name="add" value="Создать"><br/></form></div> </center>';


}else{

err('Подраздел не найден');

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>