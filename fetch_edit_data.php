<?php
   
           
   if(isset($_POST['get_option']))
   {
     $host = 'localhost';
     $user = 'root';
     $pass = '';
           
     mysql_connect($host, $user, $pass);

     mysql_select_db('kep_new');
      

     $nomos = $_POST['get_option'];
     $find=mysql_query("select dimos from dimoi_ellados where nomos='$nomos'");
	 
     while($row=mysql_fetch_array($find))
     {
	 ?>
	 <option <?php if ($row['dimos'] == "Tinos" ) echo 'selected' ; ?>  value="<?php  echo $row['dimos']; ?>"><?php  echo $row['dimos']; ?></option>
     <?php
	 }
     exit;
   }

?>