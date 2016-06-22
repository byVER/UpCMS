<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ
$k_post_ban = $con->query('SELECT * FROM `ban_list` WHERE `id_user` = "'.$id.'"')->num_rows;
$use = $con->query("SELECT * FROM `user` WHERE `id` = '".$id."'")->fetch_assoc();
$ban_list = $con->query("SELECT * FROM `ban_list` WHERE `id_user` = '".$id."' and `time` > '".time()."'")->fetch_assoc();

$title = 'Анкета '.$use['login'].'';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

$arr_pol = array('1' => 'Мужской', '2' => 'Женский');
$arr_adm = array('0' => 'Пользователь', '1' => 'Партнер', '2' => 'Модератор', '3' => 'Администратор', '4' => '<font color="red">Создатель</font>');
aut();


if($ban_list){
echo '<div class="link"><center><b>Пользователь забанен!</b></center><b>Забанил</b> : '.user($ban_list['id_adm']).'<br><b>Причина</b> : '.$ban_list['text'].'<br><b>Осталось</b> : '.data2($ban_list['time']-time()).'<br><br>';
if($user['admin_level']>=3){
echo '<a href="/admin/razban_user_'.$id.'"><b>РАЗБАНИТЬ</b></a></div>';
}
}

if($use){
echo '<center><table cellspacing="0" style="width:100%" cellpadding="0"><tr>';
echo '<div class="link"><img src="'.$use['avatar'].'" alt ="Аватар" width = "50%"> <br><br> <div class="info_anketa"><b>Статус :</b> '.$use['status'].' '.(($user['id']==$id) ? "[<a href='/edit_status'>Изменить</a>]" : "" ). '</div></div>';
echo '</table></center>';
echo '<div class="link"><b>Ник</b> : '.$use['login'].'</div>';
echo '<div class="link"><b>ID</b> : '.$use['id'].'</div>';
echo '<div class="link"><b>Пол</b> : '.$arr_pol{$use['pol']}.'</div>';
echo '<div class="link"><b>Дата регистрации</b> : '.data($use['data_reg']).'</div>';
echo '<div class="link"><b>Должность</b> : '.$arr_adm{$use['admin_level']}.'</div>';
if($user['admin_level']>=1) echo '<div class="link"><b>IP</b> : '.$use['ip'].'</div>';
echo '<div class="link"><b>Последняя активность</b> : '.data($use['up_time']).'</div>';
echo '<div class="link"><a href="/log_bans_'.$id.'">История банов ('.$k_post_ban.')</a></div>';
if($user['admin_level']>=1) echo '<div class="link"><a href="/admin/ban_user_'.$id.'">Забанить</a></div>';
if($user['admin_level']>=3 and $user['admin_level']>$use['admin_level']) echo '<div class="link"><a href="/admin/edit_admin_level_'.$id.'">Изменить должность</a></div>';
if($user['admin_level']>=3 and $user['admin_level']>$use['admin_level']) echo '<div class="link"><a href="/admin/red_ank_'.$id.'">Редактировать пользователя</a></div>';
if($user['id']!=$id) echo '<div class="link"><a href="/moduls/mail/newmes.php?id='.$id.'"><img src="/style/image/index/mes.png"> Написать сообщение</a></div>';

}else{
err('Ошибка');
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>