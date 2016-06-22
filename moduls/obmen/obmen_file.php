<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Файл';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$b = $con->query("SELECT * FROM `obmen_file` WHERE `id` = '".$id."'")->fetch_assoc();
if($b){
echo '<div class="link"><b>Название</b> : '.format_file($b['format']).'  '.$b['name'].' ('.data($b['time']).')</div>';
echo '<div class="link"> <b>Описание</b> : '.text($b['text']).'</div>';
echo '<div class="link"><b>Скачиваний</b> : '.$b['downs'].'</div>';
echo '<div class="link"><b>Добавил</b> : '.user($b['id_user']).'</div>';
echo '<div class="link"> <center><a href="/obmen_download'.$b['id'].'">Скачать</a></center></div>';
if($user['admin_level']>=2){
echo '<div class="link"> <center><a href="/obmen_file_del'.$b['id'].'">[Удалить]</a> <a href="/obmen_file_edit'.$b['id'].'">[Изменить]</a></center></div>';
}
echo '<div class="link"><a href="obmen_komm'.$b['id'].'"><img src="/style/image/komm.png"> Комментарии ('.$con->query('SELECT * FROM `obmen_komm` WHERE `id_obmen` = "'.$id.'"')->num_rows.')</a></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>