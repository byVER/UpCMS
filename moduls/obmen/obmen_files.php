<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Папка обменника';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

echo '<div class="link"><a href="/obmen_add_file'.$id.'"><img src="/style/image/down.png"> Добавить файл</a></div>';

$k_post = $con->query('SELECT * FROM `obmen_file` WHERE `id_raz` = "'.$id.'"')->num_rows;
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;
		$ms = $con->query("SELECT * FROM `obmen_file` WHERE `id_raz` = '".$id."' ORDER BY `id` DESC LIMIT $start, 10");

if($k_post  < 1) err('В папке еще нет файлов');

while($w = $ms->fetch_assoc()){
echo '<div class="link"><a href="/obmen_file'.$w['id'].'">'.format_file($w['format']).' '.$w['name'].'</a></div>';
}

if($k_post > '10') {  echo str('?',$k_page,$page.'');  }


include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>