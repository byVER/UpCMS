<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Пользователи онлайн';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';


echo "<div class='razdel'>Смайлы</div>";
$k_post = $con->query('SELECT * FROM `smiles`')->num_rows;

if($k_post == 0) err('Смайлов еще нет');
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;
	
	$ms = $con->query("SELECT * FROM `smiles` ORDER BY `id` DESC LIMIT $start, 10");
	

  while($w = $ms->fetch_assoc()){

echo '<div class="news"><b>Обозначение :</b> '.$w['name'].'<br>
Картинка : <img src="/user/smiles/'.$w[img].'" name="'.$w[img].'"></div>';
  
  }

if($k_post > '10') {  echo str('?',$k_page,$page.'');  }
  
  
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>