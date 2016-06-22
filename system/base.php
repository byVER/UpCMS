<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/system/conn.php';

/* Подключение к серверу MySQL */ 
$con = mysqli_connect( 
            $dbhost,  /* Хост, к которому мы подключаемся */ 
            $dbuser,       /* Имя пользователя */ 
            $dbpass,   /* Используемый пароль */ 
            $dbname);     /* База данных для запросов по умолчанию */ 

if (!$con) { 
   printf("
<!-- Lic::UPCMS EndLic->
   Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
} 


/* utf8 */
if (!$con->set_charset("utf8")) {
    printf("
<!-- Lic::UPCMS EndLic-> Ошибка при загрузке набора символов utf8: %s\n", $con->error);
}

?>