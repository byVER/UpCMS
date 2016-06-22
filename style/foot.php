<?php



if ($_SERVER['PHP_SELF'] != '/index.php') {
echo '<div class="home"><a href="/">На главную</a></div>';
}



$end_time = microtime();

$end_array = explode(" ",$end_time);

$end_time = $end_array[1] + $end_array[0];



$time = $end_time - $start_time;



echo '
<div class="foot">
<center><a href="http://upcms.ru">© UpCMS.Ru</a> </br>';
printf("PGen :  %f sec</center>",$time); 



?>
<!-- Lic::UPCMS EndLic->
