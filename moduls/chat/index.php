<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Комнаты Чата';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();
echo '<div class="link"><center><b>Выберите комнату</b></center></div>';
$r = $con->query("SELECT * FROM `room_chat`");
$r2 = $con->query("SELECT * FROM `room_chat`")->fetch_assoc();
if($r2){

while($w = $r->fetch_assoc()){

echo '<div class="news"><a href="/chat'.$w['id'].'">'.$w['name'].' ('.$con->query('SELECT * FROM `msg_chat` WHERE `id_room` = "'.$w['id'].'"')->num_rows.')</br>
<small><b>Об комнате</b> : '.$w['info'].'</small></a></div>';
if($user['admin_level']>=2){
echo '<div class="link"><a href="/edit_room'.$w['id'].'">[Изменить]</a> <a href="/del_room'.$w['id'].'">[Удалить]</a></div>';
}
}

}else{

err('Комнат в чате еще нет');

}



include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>