<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>ΚΕΠ Job Finder - Αρχική Σελίδα </title>
       	<link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>		
	    <script src="https://templates.juliomarquez.co/social/assets/js/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.1/jquery.slimscroll.min.js"></script>
		<script src="https://templates.juliomarquez.co/social/assets/js/sidebar.js"></script>


		<?php
		echo "<script>\n"; 
		echo "\n"; 
		echo "$(document).ready(function() {\n"; 
		echo "	$(\".x-navigation-control\").click(function(){\n"; 
		echo "        $(this).parents(\".x-navigation\").toggleClass(\"x-navigation-open\");\n"; 
		echo "        \n";      
		echo "    });\n"; 
		echo "\n"; 
		echo "})\n"; 
		echo "\n"; 

		echo "</script>\n";
		?>

 <style>
.panel-default>.panel-heading {
color: white;
background-color: #33414e;
border-color: #ddd;
}
.panel .panel-title {
color: white;
}
.notification-messages .user-profile {
    border-radius: 100px 100px 100px 100px;
    display: inline-block;
    float: left;
    height: 35px;
    overflow: hidden;
    width: 35px;
    margin-right: 10px;
    margin-top: 2px;
}
.notification-messages {
    font-family: 'Arial';
    background-color: #eef9f8;
    padding: 15px 18px 10px;
    display: block;
    color: #8b91a0;
    margin-bottom: 10px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.notification-messages.info {
    background-color: #edf7fc;
}
.user-profile img {
    border-radius: 100px 100px 100px 100px;
}
.notification-messages .message-wrapper .heading {
    display: block;
    float: left;
    text-align: left;
    color: #1b1e24;
    font-size: 13px;
    white-space: nowrap;
    width: 100%;
    margin: 0;
    line-height: 19px;
    font-weight: 600;
}
.notification-messages .message-wrapper .description {
    display: flex;
    float: left;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: break-all;
    font-size: 11px;
    width: 100%;
    line-height: 19px;
}
.popover {
    border-radius: 3px;
    border: none;
    -webkit-box-shadow: 0px 0px 5px rgba(86,96,117,0.15);
    -moz-box-shadow: 0px 0px 5px rgba(86,96,117,0.15);
    box-shadow: 0px 0px 5px rgba(86,96,117,0.15);
    max-width: 350px;
}

.popover-content {
    padding: 9px 14px;
    font-size:13px;
	}
	.header .popover-title {
    border-bottom: 0px;
    padding-top: 14px;
}
.popover-content .notification-messages {
    padding: 15px 18px 15px;
}
.notification-messages .message-wrapper {
    display: inline-block;
    width: 81%;
    height: 61px;
    float: left;
}
input[type=submit],a.button {
-webkit-appearance: button;
cursor: pointer;
background-color: #33414e;
border-color: #33414e;
font-size: 12px;
padding: 4px 15px;
line-height: 20px;
font-weight: 400;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
-webkit-transition: all 200ms ease;
-moz-transition: all 200ms ease;
-ms-transition: all 200ms ease;
-o-transition: all 200ms ease;
transition: all 200ms ease;
color: white;
margin-left: 6px;

}
.page-container .page-content .page-content-wrap {
    padding: 60px 15px;
}
</style>
</head>

<body>


<div class="page-container">
<?php include 'left_sidebar.php'; ?>
 <div class="page-content">
	<?php include 'top_sidebar.php'; ?>		  
		<div class="page-content-wrap">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
				<?php	
                    if(isset($_SESSION['username'])){
					$user = $_SESSION['username'];
					$check2 = mysql_query("SELECT kep_user FROM kep WHERE kep_user='$user'");
					 while ($row=mysql_fetch_assoc($check2))
                    {
					?>
				    <a href="users_list.php" class="tile-button btn btn-primary">
					<div class="tile-content-wrapper">
		                <i class="fa fa-users"></i>
					    <div class="tile-content">
						<?php 
                         $servername = "localhost";   
                        $username = "root";  
                        $password = "";   
                        $dbname = "kep_new";
 
                        $conn = mysqli_connect($servername, $username, $password,$dbname);
                                               
						$sql = "SELECT COUNT(*) FROM users";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result)>0)
						{
                            while($row = mysqli_fetch_assoc($result))
							{
							echo $row['COUNT(*)'];
							}
					    }
                        mysqli_close($conn);
                        ?>
					    </div><!-- END: DIV.TITLE-CONTENT --> 
						<small>Εγγεγραμμένοι Πολίτες</small>
					</div><!-- END: DIV.TITLE-CONTENT-WRAPPER --> 
					</a>
<?php
}
                    $check = mysql_query("SELECT * FROM users WHERE username='$user'");
					$check1 = mysql_query("SELECT corporation_id FROM corporations WHERE corporation_username='$user'");
					
while ($row = mysql_fetch_assoc($check) OR $row = mysql_fetch_assoc($check1))
     {
	 ?> 
	 <a href="#" class="tile-button btn btn-primary">
     <div class="tile-content-wrapper">
		                <i class="fa fa-users"></i>
					    <div class="tile-content">
						<?php 
                         $servername = "localhost";   
                        $username = "root";  
                        $password = "";   
                        $dbname = "kep_new";
 
                        $conn = mysqli_connect($servername, $username, $password,$dbname);
                                               
						$sql = "SELECT COUNT(*) FROM users";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result)>0)
						{
                            while($row = mysqli_fetch_assoc($result))
							{
							echo $row['COUNT(*)'];
							}
					    }
                        mysqli_close($conn);
                        ?>
					    </div><!-- END: DIV.TITLE-CONTENT --> 
						<small>Εγγεγραμμένοι Πολίτες</small>
					</div><!-- END: DIV.TITLE-CONTENT-WRAPPER --> 
					</a>
					<?php
}}
else {

?>
<a href="#" class="tile-button btn btn-primary">
					<div class="tile-content-wrapper">
		                <i class="fa fa-users"></i>
					    <div class="tile-content">
						<?php 
                         $servername = "localhost";   
                        $username = "root";  
                        $password = "";   
                        $dbname = "kep_new";
 
                        $conn = mysqli_connect($servername, $username, $password,$dbname);
                                               
						$sql = "SELECT COUNT(*) FROM users";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result)>0)
						{
                            while($row = mysqli_fetch_assoc($result))
							{
							echo $row['COUNT(*)'];
							}
					    }
                        mysqli_close($conn);
                        ?>
					    </div><!-- END: DIV.TITLE-CONTENT --> 
						<small>Εγγεγραμμένοι Πολίτες</small>
					</div><!-- END: DIV.TITLE-CONTENT-WRAPPER --> 
					</a>
					
<?php 
}
?> 
					
				</div><!-- END: DIV.col-lg-4 col-sm-4 --> 
                <div class="col-lg-4 col-sm-4">
				<?php	
                    if(isset($_SESSION['username'])){
					$user = $_SESSION['username'];
					$check2 = mysql_query("SELECT kep_user FROM kep WHERE kep_user='$user'");
					 while ($row=mysql_fetch_assoc($check2))
                    {
					?>
			        <a href="corporations_list.php" class="tile-button btn btn-primary">
					<div class="tile-content-wrapper">
                        <i class="fa fa-university"></i>
						<div class="tile-content">
						<?php 
                        $servername = "localhost";   
                        $username = "root";  
                        $password = "";   
                        $dbname = "kep_new";
 
                        $conn = mysqli_connect($servername, $username, $password,$dbname);
                        $sql = "SELECT COUNT(*) FROM corporations";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result)>0)
						{
                            while($row = mysqli_fetch_assoc($result))
							{
							echo $row['COUNT(*)'];
							}
					    }
                        mysqli_close($conn);
                        ?>
					    </div><!-- END: DIV.TITLE-CONTENT --> 
						<small>Εγγεγραμμένες Επιχειρήσεις</small>
				    </div><!-- END: DIV.TITLE-CONTENT-WRAPPER --> 
				    </a>												
				<?php
}
                    $check = mysql_query("SELECT * FROM users WHERE username='$user'");
					$check1 = mysql_query("SELECT corporation_id FROM corporations WHERE corporation_username='$user'");
					
while ($row = mysql_fetch_assoc($check) OR $row = mysql_fetch_assoc($check1))
     {
	 ?>   
	   <a href="#" class="tile-button btn btn-primary">
					<div class="tile-content-wrapper">
                        <i class="fa fa-university"></i>
						<div class="tile-content">
						<?php 
                        $servername = "localhost";   
                        $username = "root";  
                        $password = "";   
                        $dbname = "kep_new";
 
                        $conn = mysqli_connect($servername, $username, $password,$dbname);
                        $sql = "SELECT COUNT(*) FROM corporations";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result)>0)
						{
                            while($row = mysqli_fetch_assoc($result))
							{
							echo $row['COUNT(*)'];
							}
					    }
                        mysqli_close($conn);
                        ?>
					    </div><!-- END: DIV.TITLE-CONTENT --> 
						<small>Εγγεγραμμένες Επιχειρήσεις</small>
				    </div><!-- END: DIV.TITLE-CONTENT-WRAPPER --> 
				    </a>												
							<?php
}}
else {

?>
   <a href="#" class="tile-button btn btn-primary">
					<div class="tile-content-wrapper">
                        <i class="fa fa-university"></i>
						<div class="tile-content">
						<?php 
                        $servername = "localhost";   
                        $username = "root";  
                        $password = "";   
                        $dbname = "kep_new";
 
                        $conn = mysqli_connect($servername, $username, $password,$dbname);
                        $sql = "SELECT COUNT(*) FROM corporations";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result)>0)
						{
                            while($row = mysqli_fetch_assoc($result))
							{
							echo $row['COUNT(*)'];
							}
					    }
                        mysqli_close($conn);
                        ?>
					    </div><!-- END: DIV.TITLE-CONTENT --> 
						<small>Εγγεγραμμένες Επιχειρήσεις</small>
				    </div><!-- END: DIV.TITLE-CONTENT-WRAPPER --> 
				    </a>												
								
<?php 
}
?> 
				</div><!-- END: DIV.col-lg-4 col-sm-4 --> 
                  <div class="col-lg-4 col-sm-4">
				  <?php	
                    if(isset($_SESSION['username'])){
					$user = $_SESSION['username'];
					$check2 = mysql_query("SELECT kep_user FROM kep WHERE kep_user='$user'");
					 while ($row=mysql_fetch_assoc($check2))
                    {
					?>
			        <a href="kep_list.php" class="tile-button btn btn-primary">
					<div class="tile-content-wrapper">
                        <i class="fa fa-info-circle"></i>
						<div class="tile-content">
						<?php 
                        $servername = "localhost";   
                        $username = "root";  
                        $password = "";   
                        $dbname = "kep_new";
 
                        $conn = mysqli_connect($servername, $username, $password,$dbname);
                        $sql = "SELECT COUNT(*) FROM kep";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result)>0)
						{
                            while($row = mysqli_fetch_assoc($result))
							{
							echo $row['COUNT(*)'];
							}
					    }
                        mysqli_close($conn);
                        ?>
					    </div><!-- END: DIV.TITLE-CONTENT --> 
						<small>Συμβεβλημένα ΚΕΠ</small>
				    </div><!-- END: DIV.TITLE-CONTENT-WRAPPER --> 
				    </a>												
				<?php
}
                    $check = mysql_query("SELECT * FROM users WHERE username='$user'");
					$check1 = mysql_query("SELECT corporation_id FROM corporations WHERE corporation_username='$user'");
					
while ($row = mysql_fetch_assoc($check) OR $row = mysql_fetch_assoc($check1))
     {
	 ?>   
	   <a href="#" class="tile-button btn btn-primary">
					<div class="tile-content-wrapper">
                        <i class="fa fa-info-circle"></i>
						<div class="tile-content">
						<?php 
                        $servername = "localhost";   
                        $username = "root";  
                        $password = "";   
                        $dbname = "kep_new";
 
                        $conn = mysqli_connect($servername, $username, $password,$dbname);
                        $sql = "SELECT COUNT(*) FROM kep";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result)>0)
						{
                            while($row = mysqli_fetch_assoc($result))
							{
							echo $row['COUNT(*)'];
							}
					    }
                        mysqli_close($conn);
                        ?>
					    </div><!-- END: DIV.TITLE-CONTENT --> 
						<small>Συμβεβλημένα ΚΕΠ</small>
				    </div><!-- END: DIV.TITLE-CONTENT-WRAPPER --> 
				    </a>												
	<?php
}}
else {

?>		
 <a href="#" class="tile-button btn btn-primary">
					<div class="tile-content-wrapper">
                        <i class="fa fa-info-circle"></i>
						<div class="tile-content">
						<?php 
                        $servername = "localhost";   
                        $username = "root";  
                        $password = "";   
                        $dbname = "kep_new";
 
                        $conn = mysqli_connect($servername, $username, $password,$dbname);
                        $sql = "SELECT COUNT(*) FROM kep";
                        $result = mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result)>0)
						{
                            while($row = mysqli_fetch_assoc($result))
							{
							echo $row['COUNT(*)'];
							}
					    }
                        mysqli_close($conn);
                        ?>
					    </div><!-- END: DIV.TITLE-CONTENT --> 
						<small>Συμβεβλημένα ΚΕΠ</small>
				    </div><!-- END: DIV.TITLE-CONTENT-WRAPPER --> 
				    </a>												
	
<?php 
}
?> 	
				</div><!-- END: DIV.col-lg-4 col-sm-4 --> 
				  <?php	
                    if(isset($_SESSION['username'])){
					$user = $_SESSION['username'];
					$check2 = mysql_query("SELECT kep_user FROM kep WHERE kep_user='$user'");
					 while ($row=mysql_fetch_assoc($check2))
                    {
					?>
					<?php }} ?>
				
				
                              </div><!-- END: DIV.ROW -->
        	
    </div><!-- END: DIV.PAGE-CONTENT -->  
<div class="footer">
		     <div class="footer-inner">
	               <div class="footer-content">
                   <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">
			       <img alt="Άδεια Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png" />
				   </a>
				   <br />
				   Το έργο με τίτλο <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">ΚΕΠ Job Finder</span> από τον δημιουργό<span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Λουκά Τριανταφυλλόπουλο</span> διατίθεται με την άδεια <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Αναφορά Δημιουργού-Μη Εμπορική Χρήση-Όχι Παράγωγα Έργα 4.0 Διεθνές 
				   </a>.
		           </div><!-- END: DIV.FOOTER-CONTENT -->  
			 </div><!-- END: DIV.FOOTER-INNER -->  
		</div><!-- END: DIV.FOOTER -->  
</div><!-- END: DIV.PAGE-CONTAINER -->  
</body>
</html>
        