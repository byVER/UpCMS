<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Журнал';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

$k_post = $con->query('SELECT * FROM `journal` WHERE `id_user` = "'.$user['id'].'"')->num_rows;

if($k_post == 0) err('Журнал пуст');
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;
	
	$ms = $con->query("SELECT * FROM `journal` WHERE `id_user` = '".$user['id']."' ORDER BY `id` DESC LIMIT $start, 10");

	  while($w = $ms->fetch_assoc()){
  
  echo '<div class="link">'.text($w['text']).' ('.data($w['time']).')</div>';
  if($w['read'] == 0){

$con->query("UPDATE `journal` SET `read` = '1' WHERE `id` = '".$w['id']."'");

  }

  }

  if($k_post > '10') {  echo str('?',$k_page,$page.'');  }


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>