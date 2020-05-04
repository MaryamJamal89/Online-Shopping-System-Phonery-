<?php
define ('user','root');
define ('pass','');
define ('host','localhost:3307');
define ('name','phonery');

$dbc=mysqli_connect(host,user,pass) or die ('can not connect to the database');
mysqli_select_db($dbc,name);
mysqli_set_charset($dbc,'utf8');
?>
