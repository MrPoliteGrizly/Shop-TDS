<?php
$bd_host        =  'localhost';
$bd_user        =  'admin';
$bd_pass        =  '67gugitu';
$bd_database    =  'bd-shop';

$link = mysql_connect($bd_host,$bd_user,$bd_pass);

mysql_select_db($bd_database,$link) or die("Нет соединения с БД".mysql_error());
mysql_query("SET names cp1251");
?>