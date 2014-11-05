<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_comicsdb = "localhost";
$database_comicsdb = "comics";
$username_comicsdb = "root";
$password_comicsdb = "supermio";
$comicsdb = mysql_pconnect($hostname_comicsdb, $username_comicsdb, $password_comicsdb) or trigger_error(mysql_error(),E_USER_ERROR); 
?>