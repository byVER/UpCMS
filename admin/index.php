<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Админ-панель';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

if($user['admin_level']>=1){
if($user['admin_level']>=3) echo "<div class='link'><a href='/admin/rules'>Редактирование правил</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/admin/red_ank.php'>Редактирование пользователя</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/admin/paid'>Управление платными услугами</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/admin_money'>Управление монетами</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/add_razdel_f'>Создать раздел форума</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/add_podrazdel_f'>Создать подраздел форума</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/admin_settings'>Настройки сайта</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/add_journal'>Создать рассылку по журналам</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/add_room'>Создать комнату чата</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/add_news'>Создать новость</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/add_obmen_raz'>Создать раздел обменника</a></div>";
if($user['admin_level']>=3) echo "<div class='link'><a href='/admin/antispam.php'>Антиспам</a></div>";
if($user['admin_level']>=2) echo "<div class='link'><a href='/admin/add_smiles'>Добавить смайлы</a></div>";
if($user['admin_level']>=2) echo "<div class='link'><a href='/admin/all_smiles'>Список смайлов</a></div>";
}else{

err('Ошибка доступа');

}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>