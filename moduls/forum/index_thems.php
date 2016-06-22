<?php
$k_post = $con->query('SELECT * FROM `forum_theme`')->num_rows;
	
$k_page = k_page($k_post,$sett['index_forum']);
	
$page = page($k_page);
	
$start = $sett['index_forum']*$page-$sett['index_forum'];

		$t = $con->query("SELECT * FROM `forum_theme` ORDER BY `up` DESC LIMIT $start, $sett[index_forum]");
if($k_post<1){ 
err('Тем на форуме нет');
}else{

  while($w = $t->fetch_assoc()){
  $status = array('open' => '<img src="/style/image/forum/open.png">', 'closed' => '<img src="/style/image/forum/closed.png">');
  echo '<div class="main"><a href="/them/'.$w['id'].'">'.$status{$w['status']}.' '.$w['name'].'  ( '.$count=$con->query('SELECT (`id`) FROM forum_msg WHERE id_theme = '.$w['id'].'')->num_rows.' )</a></div>';
  }
}
?>