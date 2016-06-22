<?php

# Включаем сессии
ob_start();
session_start();


if(!is_file($_SERVER["DOCUMENT_ROOT"].'/system/base.php')) {
header('Location: /install/');
}

echo '
<head><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=UTF-8" />
<meta name="description" content="Создай свой сайт на UpCMS.Ru "> 
<meta name="Keywords" content="cms, upcms, движок, создать сайт, php, mysql, движок для сайта"> 
<meta name="viewport" content="width=device-width; initial-scale=1.">
<link rel="shortcut icon" href="/style/favicon.ico">
<link rel="stylesheet" href="/style/style.css" type="text/css"/>
</head>
';



include_once $_SERVER["DOCUMENT_ROOT"].'/system/system.php';





// ВРЕМЯ ГЕНЕРАЦИИ СКРИПТА

$start_time = microtime();



$start_array = explode(" ",$start_time);


$start_time = $start_array[1] + $start_array[0]; 



if(!$title) $title = 'UpCMS';
echo '<title>UpCMS.Ru | '.$title.'</title>';

echo '<a href="/"><div class="head"><img src="/style/image/logo.png"></div>';
echo '<div class="title">UpCMS.Ru | '.$title.'</div></a>';

if($user){

 echo '<table style="width:100%" cellspacing="0" cellpadding="0"><tr>
<td style= width:50%;><center><div class="head_p"><a href="/kabinet"><center>Кабинет</div></center></a></td>
<td style= width:50%;><div class="head_p2"><a href="/exit"><center>Выход</div></center></a></td> </tr></table>';
}else{

 echo '<table style="width:100%" cellspacing="0" cellpadding="0"><tr>
<td style= width:50%;><center><div class="head_p"><a href="/auth"><center>Авторизация</div></center></a></td>
<td style= width:50%;><div class="head_p2"><a href="/reg"><center>Регистрация</div></center></a></td> </tr></table>';
}

if($user){

	$mes = $con->query("SELECT * FROM `message` WHERE `komy` = '".$user['id']."' and `readlen` = '0'")->num_rows;

if($mes > '0'){ echo '<div class="link"><a href="/mail"><img src="/style/image/index/mes.png"> Новые сообщения :  '.$mes.'</a></div>';}



	$coun_jorn = $con->query('SELECT * FROM `journal` WHERE `id_user` = "'.$user['id'].'" and `read` = "0"')->num_rows;
if($coun_jorn > 0){
echo '<div class="link"><a href="/journal"><img src="/style/image/index/journal.png"> Журнал : '.$coun_jorn.'</a></div>';
}
}

if(!is_file($_SERVER["DOCUMENT_ROOT"].'/system/base.php')) {
header('Location: /install/');
}
if($user){
	$coun_ban = $con->query('SELECT * FROM `ban_list` WHERE `id_user` = "'.$user['id'].'" and `time` > "'.time().'"')->num_rows;
	
if($coun_ban > 0){
$ban = $con->query("SELECT * FROM `ban_list` WHERE `id_user` = '".$user['id']."'")->fetch_assoc();
echo '<div class="link"><center><b>Ошибка!</b></center><b>Вас забанил</b> : '.user($ban['id_adm']).'<br><b>Причина</b> : '.$ban['text'].'<br><b>Осталось</b> : '.data2($ban['time']-time()).'</div>';
exit();
}

}

?>
