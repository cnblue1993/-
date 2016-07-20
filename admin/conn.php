<?php
$conn = mysql_connect("localhost", "root", "root") or die(mysql_error());
mysql_select_db("db_community", $conn);
mysql_query("set names 'utf-8'");
?>