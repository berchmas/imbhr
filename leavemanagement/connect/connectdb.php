<?php
   //$server="127.0.0.1";
	$server="localhost";

	$user="root";
	$pass="Imana567891";
	$db="human_resources";
	$link=mysql_connect($server,$user,$pass)or die ("Connection Failed");
        $condb=mysql_select_db($db,$link) or die ("connection to the data base failed");        
?>
