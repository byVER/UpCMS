<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Кабинет';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();
$coun_jor = $con->query('SELECT * FROM `journal` WHERE `id_user` = "'.$user['id'].'" and `read` = "0"')->num_rows;
echo '<div class="razdel"><center>Здраствуйте, <b>'.$user['login'].'</b> </center></div>';
echo '<div class="link"><a href="/user_'.$user['id'].'"><img src="/style/image/my_ank.png"> Моя анкета</a></div>';
echo '<div class="link"><a href="/paid"><img src="/style/image/money.png"> Платные услуги (У вас <b>'.$user['money'].'</b> монет)</a></div>';
echo '<div class="link"><a href="/edit_avatar"><img src="/style/image/avatar.png"> Изменение аватара</a></div>';
echo '<div class="link"><a href="/edit_pass"><img src="/style/image/pass.png"> Изменение пароля</a></div>';
echo '<div class="link"><a href="/mail"><img src="/style/image/index/mes.png"> Моя почта</a></div>';
if($coun_jor < 1){
echo '<div class="link"><a href="/journal"><img src="/style/image/index/journal.png"> Ваш журнал</a></div>';
}else{

echo '<div class="link"><a href="/journal"><img src="/style/image/index/journal.png"> Ваш журнал (<font color="red">'.$coun_jor.' новых</font>)</a></div>';

}
echo '<div class="link"><a href="/log_auth"><img src="/style/image/index/log_auth.png"> История авторизаций</a></div>';
if($user['admin_level']>=3){
echo '<div class="link"><a href="/admin"><img src="/style/image/index/adm_panel.png"> Админ-панель</a></div>';
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>