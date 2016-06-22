<?php

require_once ('head.php');
$version='1.0 Beta'; //тут версию укажи
echo '<div class="razdel"><center>Мастер установки</center></div>';
$act = isset($_GET['act']) ? trim($_GET['act']) : null;
switch($act)
{
default:

echo '
<div class="link"><b>Установка UpCMS v 1.0 beta</b></div>
<div class="link"><b>Наши условия использования:</b>
<br /><b>1.</b> Запрещено продавать и распространять небольшие куски кода
<br /><b>2.</b> Вы обязаны сохранить все упоминания об авторах
<br /><b>3.</b> Запрещено снимать копирайт
<br /><b>4.</b> Запрещено выдавать UpCMS за свой, не имея тактовых авторских прав
<br /><b>5.</b> Запрещено любые несанкцанированые действия с Jab Engine которые могут вривести к уголовному наказанию<br />
<br /><b>Все права на принадлежат создателям движка: <br /> ediT, VeR, Aggressive</b><br/>
</div>
<div class="link"><form action="?act=s1" method="POST"><center><input type="submit" value="Я согласен" /></center></form></div>';
require_once ('foot.php');

break;
case 's1':

//-Ищем файл base.php-//
if(is_file('../system/conn.php')) {

if(isset($_REQUEST['next'])) {
unlink('../system/conn.php');
header('Location: index.php');
exit();
}

echo '
<div class="link">Обнаружен файл conn.php!
Что это значит?<br />
<b>1</b>.Вы уже установили UpCMS.<br />
<b>2</b>.Вы случайно создали файл base.php в папке system.</div>
<div class="link">Вы хотите переустановить UpCMS?<br /><center><form action="" method="POST"><input type="submit" name="next" value="Продолжить" /></form></center></div>';
require_once ('foot.php');
exit();
}

if(isset($_REQUEST['ok'])) {


function f($msg){
$msg = trim($msg);
return $msg;
}

$dbhost = f($_POST['dbhost']);
$dbpass = f($_POST['dbpass']);
$dbname = f($_POST['dbname']);
$dbuser = f($_POST['dbuser']);

$sql1 = @mysql_connect($dbhost, $dbuser, $dbpass);
$sql = @mysql_select_db($dbname);

if (!$sql) {
$sql = FALSE; 
echo ('Такой базы данных не существует!');
require_once ('foot.php');
exit();
}

if($sql == TRUE and $sql1 == TRUE) {
$cont = '<?php
$dbhost = "'.$dbhost.'";
$dbuser = "'.$dbuser.'";
$dbname = "'.$dbname.'";
$dbpass = "'.$dbpass.'";
?>';
@chmod('../system', 0777);

file_put_contents('../system/conn.php', $cont);
@chmod('../system/conn.php', 0664); 
mysql_query('SET NAMES `utf8`', $sql1);
$dbdampbaze = file_get_contents('mysql.sql'); 
$expl = explode('-----------------------------------', $dbdampbaze);
foreach($expl as $propot) {
mysql_query(trim($propot));
} 


@chmod('../system', 0744);
@chmod('../moduls/obmen/file_obmen', 0777);
@chmod('../user/avatar', 0777);
}

echo '<div class="razdel"><center>Установка прошла успешно!</center></div>
<div class="link">Вам осталось зарегистрировать администратора.
<br />
Не забудьте удалить папку /install
<br />
<b>../system</b> Установить права 755
<br />
<a href="reg.php"><input type="submit" value="Регистрация" /></a></div>';

require_once ('foot.php');
exit();
}
/*
* LICENSE 
*/
$api= 'http://upcms.ru/api/napi.php?versions='.urlencode($version).'&domain='.urlencode($_SERVER['HTTP_HOST']).'&srv='.$_SERVER['SERVER_ADDR'].'&sok=ok';
$key=file_get_contents($api);//получаем лицензию
#echo $api;
mkdir($_SERVER['DOCUMENT_ROOT'].'/license',0755);
$fp=fopen( $_SERVER['DOCUMENT_ROOT'].'/license/lic.key','w');
fwrite($fp,$key);
fclose($fp);
//-- END --//
echo '<div class="link">
<form action="" method="POST">
Сервер:<br /><input type="text" name="dbhost" value="localhost" /><br />
Имя пользователя:<br /><input type="text" name="dbuser" /><br />
Пароль:<br /><input type="text" name="dbpass" /><br />
База Данных:<br /><input type="text" name="dbname" /><br />
<input type="submit" name="ok" value="Продолжить" />
</form></div>';

require_once ('foot.php');
break;


}
?>