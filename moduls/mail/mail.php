<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Моя Почта';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();



$k_post = $con->query("SELECT * FROM `message_c` WHERE `kto` = '".$user['id']."'")->num_rows;


$k_page = k_page($k_post,10); 

$page = page($k_page); 

$start = 10*$page-10; 

$dialog = $con->query("SELECT * FROM `message_c` WHERE `kto` = '".$user['id']."' ORDER BY `posl_time` DESC LIMIT $start, 10");

while($d = $dialog->fetch_assoc()){

echo '<div class="link">'.user($d['kogo']).' (Добавлен в: '.data($d['time']).')'; 

$count = $con->query("SELECT * FROM `message` WHERE `kto` = '".$user['id']."' and `komy` = '".$d['kogo']."' or `kto` = '".$d['kogo']."' and `komy` = '".$user['id']."'")->num_rows; 

$list = $con->query("SELECT * FROM `message` WHERE `kto` = '".$user['id']."' and `komy` = '".$d['kogo']."' or `kto` = '".$d['kogo']."' and `komy` = '".$user['id']."' ORDER BY `time` DESC LIMIT 1")->fetch_assoc(); 

if($count) { 

echo '<br/>'.cutStr(text($list['text']), 300).''; 

} else { 

echo '<br/><b>Переписка еще не происходила!</b>'; 

} 
if(!empty($list['id']) and $user['id'] != $list['kto'] and $list['readlen'] == 0) echo ' <b><font color="red"> NEW </font></b>';


echo '<br /><a href="/moduls/mail/dialog.php?id='.$d['kogo'].'"><b>Перейти в диалог</b></a></div>'; 

}

echo '</div></div>'; 


if($k_post < 1) err('Список контактов пуст!'); 

if($k_page > 10) echo str('?',$k_page,$page); // Вывод страниц 



include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>