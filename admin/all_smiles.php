<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Список смайлов';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

if($user['admin_level']>=2){ 

echo "<div class='main'><a href='/admin/add_smiles'> Добавить смайлы</a></div>";


$k_post = $con->query('SELECT * FROM `smiles`')->num_rows;

if($k_post == 0) err('Смайлов еще нет');
	
$k_page = k_page($k_post,10);
	
$page = page($k_page);
	
$start = 10*$page-10;
	
	$ms = $con->query("SELECT * FROM `smiles` ORDER BY `id` DESC LIMIT $start, 10");
	

  while($w = $ms->fetch_assoc()){

echo '<div class="news"><b>Обозначение :</b> '.$w['name'].' <a href="/admin/smile_del_'.$w[id].'">[Уд]</a> <a href="/admin/smile_edit_'.$w[id].'">[Изм]</a><br>
Картинка : <img src="/user/smiles/'.$w[img].'" name="'.$w[img].'"></div>';
  
  }

if($k_post > '10') {  echo str('?',$k_page,$page.'');  }



}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>