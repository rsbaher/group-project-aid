<?php 
$link = mysql_connect('localhost','sec_user','Password123!'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
echo 'Connection OK'; mysql_close($link); 
?> 