<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc();
$ban_l = $con->query("SELECT * FROM `ban_list` WHERE `id_user` = '".$id."'")->fetch_assoc();
$title = 'История банов '.$use['login'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();
if($use){
$k_post = $con->query('SELECT * FROM `ban_list` WHERE `id_user` = "'.$id.'"')->num_rows;

if($k_post == 0) err('История пуста');
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;
	
	$ms = $con->query("SELECT * FROM `ban_list` WHERE `id_user` = '".$id."' ORDER BY `id` DESC LIMIT $start, 10");

	  while($w = $ms->fetch_assoc()){
  if($ban_l['time']>time()){ $time_ban = data2($ban_l['time']-time()); }else{ $time_ban = '<font color="green">Не активен</font>'; }
  echo '<div class="link"><b>Забанил</b> : '.user($ban_l['id_adm']).'<br><b>Причина</b> : '.$ban_l['text'].'<br><b>Осталось</b> : '.$time_ban.'</div>';

  }

  if($k_post > '10') {  echo str('?',$k_page,$page.'');  }
}else{
err('Пользователь не найден');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>