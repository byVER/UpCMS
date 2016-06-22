<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Правила сайта';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';


echo '<div class="link">'.text($sett['rules']).'</div>';
if($user['admin_level']>=2){
echo '<div class="link"><a href="/admin/rules">Редактировать правила</a></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>