<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/system/base.php';
$title = 'Пользователи онлайн';
include_once $_SERVER["DOCUMENT_ROOT"].'/style/head.php';


echo "<div class='razdel'>BB коды</div>";
echo '
  <div class="link"><div class="cit">Цитировать</div><br /><textarea>[cit]Текст цитаты[/cit]</textarea></div>
  <div class="link"><a href="'.$HOME.'">Ссылка</a><br /><textarea>[url='.$HOME.']Ссылка[/url]</textarea></div>
  <div class="link"><b>Жирный шрифт</b><br /><textarea>[b]Текст[/b]</textarea></div>
  <div class="link"><i>Курсив</i><br /><textarea>[i]Текст[/i]</textarea></div>
  <div class="link"><u>Подчеркнутый</u><br /><textarea>[u]Текст[/u]</textarea></div>
  <div class="link"><span style="color: red">Красный</span><br /><textarea>[red]Красный[/red]</textarea></div>
  <div class="link"><span style="color: green">Зеленый</span><br /><textarea>[green]Зеленый[/green]</textarea></div>
  <div class="link"><del>Зачеркнутый</del><br /><textarea>[del]Текст[/del]</textarea></div>';
  
  
include_once $_SERVER["DOCUMENT_ROOT"].'/style/foot.php';
?>