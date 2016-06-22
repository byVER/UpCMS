<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Форум';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
echo '<div class="link"><center>Форум общения</center></div>';
echo '<div class="post"><center><b>Статистика форума</b><br>
<b>Тем всего :</b> '.$con->query("SELECT * FROM `forum_theme`")->num_rows.'<br>
<b>Постов всего :</b> '.$con->query("SELECT * FROM `forum_msg`")->num_rows.'</center></div>';
$k_post = $con->query('SELECT * FROM `forum_razdel`')->num_rows;
		$c = $con->query("SELECT * FROM `forum_razdel`");
		
if($k_post<1) err('Разделов еще нет');
if($user['admin_level']>=2){$admin = '<a href="/forum/del_razdel/'.$w['id'].'">[Уд]</a> <a href="/forum/edit_razdel/'.$w['id'].'">[Изм]</a>';}else{$admin ='';}
if($user['admin_level']>=2){$padmin = '<a href="/forum/del_podrazdel/'.$w2['id'].'">[Уд]</a> <a href="/forum/edit_podrazdel/'.$w2['id'].'">[Изм]</a>';}else{$padmin ='';}
  while($w = $c->fetch_assoc()){
  if($user['admin_level']>=2){$admin = '<a href="/forum/del_razdel/'.$w['id'].'">[Уд]</a> <a href="/forum/edit_razdel/'.$w['id'].'">[Изм]</a>';}else{$admin ='';}
  echo '<div class="razdel">'.$w['name'].' '.$admin.'</div>';
  $k_post2 = $con->query('SELECT * FROM `forum_podrazdel` WHERE `id_razdel` = "'.$w['id'].'"')->num_rows;
		$c2 = $con->query("SELECT * FROM `forum_podrazdel` WHERE `id_razdel` = '".$w['id']."'");
if($k_post2<1) err('Подразделов еще нет');
 while($w2 = $c2->fetch_assoc()){
 if($user['admin_level']>=2){$padmin = '<a href="/forum/del_podrazdel/'.$w2['id'].'">[Уд]</a> <a href="/forum/edit_podrazdel/'.$w2['id'].'">[Изм]</a>';}else{$padmin ='';}
  echo '<div class="link"><a href="/forum/'.$w2['id'].'/">'.$w2['name'].'</a>  '.$padmin.'</div>';
 }
  }

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>