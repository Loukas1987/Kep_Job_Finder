<?php
//We start sessions
session_start();

/******************************************************
------------------Required Configuration---------------
Please edit the following variables so the members area
can work correctly.
******************************************************/

//We log to the DataBase
             $host = 'localhost';
             $user = 'root';
             $pass = '';

             $con = mysql_connect($host, $user, $pass);
             mysql_select_db("kep_new", $con) or die(mysql_error());
			 mysql_query("SET NAMES 'utf8'", $con);

//Webmaster Email
$mail_webmaster = 'triantafillopoulos.loukas@gmail.com';

//Top site root URL
$url_root = 'http://ellaksrv.datacenter.uoc.gr/~user305/like_today_project/index.php';

/******************************************************
-----------------Optional Configuration----------------
******************************************************/

//Home page file name
$url_home = 'index.php';

//Design Name
$design = 'default';
?>