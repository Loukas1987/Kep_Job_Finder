<?php
   
           
   if(isset($_POST['get_option']))
   {
     $host = 'localhost';
     $user = 'root';
     $pass = '';
    
  $con = mysql_connect($host, $user, $pass);
  mysql_select_db("kep_new", $con) or die(mysql_error());
  mysql_query("SET NAMES 'utf8'", $con);	
  mysql_connect($host, $user, $pass);
     
     $nomos = $_POST['get_option'];
     $find=mysql_query("select dimos from dimoi_ellados where nomos='$nomos'");
     while($row=mysql_fetch_array($find))
     {
	 ?>
	 <option value="<?php  echo $row['dimos']; ?>"><?php  echo $row['dimos']; ?></option>
     <?php
	 }
     exit;
   }

?>