<?php 
$host = "YOUR_HOST";
$user = "USERNAME";
$pass = "PASSWORD";
$dbname = "DBNAME";
$connect = mysql_connect($host, $user, $pass) or die('Could not connect to mysql server.' );	
$dbselect = mysql_select_db($dbname, $connect) or die('Could not select database.');
?>