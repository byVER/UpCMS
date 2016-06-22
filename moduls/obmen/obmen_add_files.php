<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Добавление файла';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();


$id = abs(intval($_GET['id'])); # ФИЛЬТР ГЕТ

$b = $con->query("SELECT * FROM `obmen_raz` WHERE `id` = '".$id."'")->fetch_assoc();
if($b){
if(isset($_POST['submit'])){

    $filename = strtolower($_FILES['userfile']['name']); // имя и формат файла в нижнем регистре
    $t = preg_replace('#.[^.]*$#', NULL, $filename); // имя файла
    $f = str_replace($t, '', $filename); // формат файла
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/moduls/obmen/file_obmen/';
$rand=rand(111111111, 999999999);
if($f=='.png' || $f=='.jpg' || $f=='.gif' || $f=='.jpeg' || $f=='.zip' || $f=='.rar'){
$t=$rand."_".basename($_FILES['userfile']['name']);

$uploadfile = $uploaddir . $rand.'_'. basename($_FILES['userfile']['name']);
}else{
    echo "<div class='err'>Неверный Формат!</div>";
}
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
$name = filtr($_POST['name']);
$text = filtr($_POST['text']);

$con->query("INSERT INTO `obmen_file` (`name`, `text`, `id_user`, `time`, `id_raz`, `down`, `format`) VALUES ('".$name."', '".$text."', '".$user['id']."', '".time()."', '".$id."', '".$t."', '".$f."')");  

header('Location: /obmen_files'.$id);
} else {
    err('Ошибка');
}
}

echo '
<div class="link"><center><form action="" method="post" enctype="multipart/form-data">
<b>Название :</b></br>
<input type="text" name="name" value=""><br/>
<b>Описание :</b></br>
<textarea name="text"></textarea></br></br>
<b>Выберите файл :</b></br>
 <input type="hidden" name="MAX_FILE_SIZE" value="9000000000">
<input type="file" name="userfile" id="userfile"><br />
<input type="submit" name="submit" value="Добавить" />
</form>
</center></div>';
}else{
err('Ошибка');
}
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>