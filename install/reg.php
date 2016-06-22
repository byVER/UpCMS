<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Мастер установки (Регистрация администратора)';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';


if(isset($_POST['reg'])){
$login = filtr($_POST['login']);
$pass2 = filtr($_POST['pass2']);
$pass = filtr($_POST['pass']);
$pol = intval($_POST['pol']);
if($pass != $pass2) $err = 'Пароли не совпадают';
if(mb_strlen($login) < '3' or mb_strlen($login) > '24') $err = 'Логин либо менее 3 либо более 24 символов';
if(mb_strlen($pass) < '4')  $err = 'Пароль должен быть более 4 символов';
$login_c = $con->query("SELECT * FROM `user` WHERE `login` = '".$login."'")->num_rows;
if($login_c > 0) {$err = 'Пользователь с таким логином уже существует, попробуйте другой логин'; }
if($err){
err($err);
}elseif(!$err){
ok('Регистрация успешна');
$con->query("INSERT INTO `user` (`login`, `pass`, `pol`, `data_reg`, `admin_level`) VALUES ('".$login."', '".md5($pass)."', '".$pol."', '".time()."', '4')");
setcookie('login', $login, time()+86400*365, '/'); 
setcookie('pass',md5($pass), time()+86400*365, '/');
echo '<div class="other"><b>Ваши данные для входа :</b></br>
Пароль : '.$pass.'</br>
Логин : '.$login.'</br>
<a href="/">[ На сайт ]</a></div>'; 
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
}

echo'<center><div class="other"><form action="" method="POST">Логин:<br/>
<input type="text" name="login" value=""><br/>
Пароль:<br/>
<input type="password" name="pass" value=""><br/>
Подтвердите пароль:<br/>
<input type="password" name="pass2" value=""><br/>
Пол:<br/>
<select name="pol">
<option value="1">Мужской</option>
<option value="2">Женский</option>
</select>
<br/><br/>
<input type="submit" name="reg" value="Регистрация"><br/></form></div> </center>';

require_once ('foot.php');

?>