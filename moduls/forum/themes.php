<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
	$id = abs(intval($_GET['id']));
	$c = $con->query("SELECT * FROM `forum_podrazdel` WHERE `id` =  '".$id."'")->fetch_assoc();
$title = 'Темы подраздела '.$c['name'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
if($c){
echo '<div class="link"><a href="/forum/add_them/'.$id.'"><img src="/style/image/forum/add_them.png"> Создать тему</a></div>';
$k_post = $con->query('SELECT * FROM `forum_theme` WHERE `id_podraz` = "'.$id.'"')->num_rows;
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;

		$t = $con->query("SELECT * FROM `forum_theme` WHERE `id_podraz` =  '".$id."' ORDER BY `id` DESC LIMIT $start, 10");
if($k_post<1) err('Тем в этом разделе еще нет');

  while($w = $t->fetch_assoc()){
  $status = array('open' => '<img src="/style/image/forum/open.png">', 'closed' => '<img src="/style/image/forum/closed.png">');
  echo '<div class="main"><a href="/them/'.$w['id'].'">'.$status{$w['status']}.' '.$w['name'].'</a></div>';
  }
  if($k_post > '10') {  echo str('?',$k_page,$page.'');  }
}else{
err('Ошибка');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>