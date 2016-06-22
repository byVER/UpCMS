<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Добавление смайлов';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';

aut();

if($user['admin_level']>=3){ 

if(isset($_POST['submit'])){

    $filename = strtolower($_FILES['userfile']['name']); // имя и формат файла в нижнем регистре
    $t = preg_replace('#.[^.]*$#', NULL, $filename); // имя файла
    $f = str_replace($t, '', $filename); // формат файла
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/user/smiles/';
$rand=rand(111111111, 999999999);
if($f=='.png' || $f=='.jpg' || $f=='.gif' || $f=='.jpeg'){
$t=$rand."_".basename($_FILES['userfile']['name']);

$uploadfile = $uploaddir . $rand.'_'. basename($_FILES['userfile']['name']);
}else{
    echo "<div class='err'>Неверный Формат!</div>";
}
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
$name = filtr($_POST['name']);

$con->query("INSERT INTO `smiles` (`name`, `img`) VALUES ('".$name."', '".$t."')");  

ok('Смайл добавлен');
} else {
    err('Ошибка');
}
}

echo '
<div class="link"><center><form action="" method="post" enctype="multipart/form-data">
<b>Обозначение (Например ":D") :</b></br>
<input type="text" name="name" value=""><br/>
<b>Выберите картинку :</b></br>
 <input type="hidden" name="MAX_FILE_SIZE" value="9000000000">
<input type="file" name="userfile" id="userfile"><br />
<input type="submit" name="submit" value="Добавить" />
</form>
</center></div>';

}

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>