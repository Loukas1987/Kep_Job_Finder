<?php
include('config.php');

if($_POST)
{
$name=$_POST['name'];
mysql_query("UPDATE users SET activated=1 WHERE username='$name'");
}

?>