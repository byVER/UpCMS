<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Обменник';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

echo '<div class="link"><center>Обменник файлов сайта</center></div>';
$b = $con->query("SELECT * FROM `obmen_raz`");
$ab = $con->query("SELECT * FROM `obmen_raz`")->fetch_assoc();
if(!$ab) err('Папок еще нет');
while($w = $b->fetch_assoc()){
echo '<div class="news"><a href="/obmen_files'.$w['id'].'">'.$w['name'].' ('.$con->query('SELECT * FROM `obmen_file` WHERE `id_raz` = "'.$w['id'].'"')->num_rows.')</br>
<small><b>Об папке</b> : '.$w['info'].'</small></a></div>';
if($user['admin_level']>=2){
echo '<div class="link"><a href="/obmen_raz_edit'.$w['id'].'">[Изменить]</a> <a href="/obmen_raz_del'.$w['id'].'">[Удалить]</a></div>';
}
}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>