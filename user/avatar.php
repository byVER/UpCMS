<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Изменение аватара';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';
aut();

if(isset($_POST['submit'])){

    $filename = strtolower($_FILES['userfile']['name']); // имя и формат файла в нижнем регистре
    $t = preg_replace('#.[^.]*$#', NULL, $filename); // имя файла
    $f = str_replace($t, '', $filename); // формат файла
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/user/avatar/';
$rand=rand(111111111, 999999999);
if($f=='.png' || $f=='.jpg' || $f=='.gif' || $f=='.jpeg'){
$t=$rand."_".basename($_FILES['userfile']['name']);

$uploadfile = $uploaddir . $rand.'_'.$user['id'].'_'.basename($_FILES['userfile']['name']);
}else{
    echo "<div class='err'>Неверный Формат!</div>";
}
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

$con->query("UPDATE `user` SET `avatar` = '/user/avatar/".$rand.'_'.$user['id'].'_'.basename($_FILES['userfile']['name'])."' WHERE `id` = '".$user['id']."'");

header('Location: ?');
} else {
    err('Ошибка');
}
}
echo '<div class="link"><center><img src="'.$user['avatar'].'" alt="Мой аватар" width = "75%"></center></div>';
echo '
<div class="link"><center><form action="" method="post" enctype="multipart/form-data">
<b>Выберите файл :</b></br>
 <input type="hidden" name="MAX_FILE_SIZE" value="9000000000">
<input type="file" name="userfile" id="userfile"><br />
<input type="submit" name="submit" value="Добавить" />
</form>
</center></div>';

include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>