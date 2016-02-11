<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ Job Finder-Εγγεγραμμένες Επιχειρήσεις</title>
  	<link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"/>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>		
	    <script src="https://templates.juliomarquez.co/social/assets/js/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.1/jquery.slimscroll.min.js"></script>
		<script src="https://templates.juliomarquez.co/social/assets/js/sidebar.js"></script>
		        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<style type="text/css" class="init">
	
	div.dataTables_wrapper {
		margin-bottom: 3em;
	}

	</style>

</head>

<body>
<script type="text/javascript" class="init">
	jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
$(document).ready(function() {
	$('table.display').DataTable();
} );

	</script>

	<script>

$(document).ready(function() {
	$(".x-navigation-control").click(function(){
        $(this).parents(".x-navigation").toggleClass("x-navigation-open");
        
        onresize();
        
        return false;
    });

})

</script>

<div class="page-container">
<div class="page-sidebar" style="position:fixed">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                    <a href="index.php">KEΠ Job Finder</a>
                    <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                    <div class="profile">
                        <div class="profile-image">
					    <!-- CONDITION FOR PROFILE IMAGE BY REGISTERED-UNREGISTERED USER -->
                              <?php if(!isset($_SESSION['username']))
							  {
							  echo "<img src='upload/default.png' title='Άγνωστος Χρήστης' alt='Άγνωστος Χρήστης'>";
							  } 
							  ?>
							  <?php if(isset($_SESSION['username']))
							  {
							  $user = $_SESSION['username'];
							  $sql = "SELECT image_src FROM users WHERE username='$user'";
                              $result = mysql_query($sql) or die ("Δεν επιτρέπεται η πρόσβαση στην Βάση Δεδομένων: " . mysql_error());
                                        while ($row = mysql_fetch_assoc($result))
							            {echo "<img src='" . $row['image_src'] . "' title='Άγνωστος Χρήστης' alt='Άγνωστος Χρήστης'>";}
						      } 
							  ?>
                        <!-- END:CONDITION FOR PROFILE IMAGE BY REGISTERED-UNREGISTERED USER -->                                
					    </div><!-- END: DIV.PROFILE-IMAGE -->  
                        <div class="profile-data">
                             <div class="profile-data-name">
					         <!-- CONDITION FOR DISPLAY NAME IF REGISTERED USER -->
					           <?php if(isset($_SESSION['username']))
					           {
					           echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');
							   } 
							   ?>
					         <!-- END:CONDITION FOR DISPLAY NAME IF REGISTERED USER -->
		                     </div><!-- END: DIV.PROFILE-DATA-NAME -->  
                             <div class="profile-data-title">
					         <!-- CONDITION FOR DISPLAY NAME IF UNREGISTERED USER -->
					           <?php if(!isset($_SESSION['username']))
                               {
							   ?>
						       Επισκέπτης / Άγνωστος Χρήστης 
							   <?php
                               }
                               ?> 
                          
                              <?php if(isset($_SESSION['username']))
							  {
							  $user = $_SESSION['username'];
							  $sql = "SELECT occupation FROM users WHERE username='$user'";
							  $sql2 = "SELECT Dimos FROM kep WHERE kep_user='$user'";
                              $result = mysql_query($sql) or die ("Could not access DB: " . mysql_error());
                              $result1 = mysql_query($sql2) or die ("Could not access DB: " . mysql_error());

                              while ($row = mysql_fetch_assoc($result))
							  {
							  echo $row['occupation'];
						      } 
							  while ($row1 = mysql_fetch_assoc($result1))
							  {
	                         echo "Δήμου".' '.$row1['Dimos'];
						      } 
							  }
							  ?>
					         <!-- END:CONDITION FOR DISPLAY OCCUPATION IF REGISTERED USER -->
                   
                             </div><!-- END: DIV.PROFILE-DATA-TITLE -->  
                        </div><!-- END: DIV.PROFILE-DATA -->            
                    </div> <!-- END: DIV.PROFILE -->                                                                         
                    </li>
					<!-- START SIDEBAR_MENU_BUTTONS -->
		     <li>
                    <a href="index.php"><span class="fa fa-home"></span> <span class="xn-text">Αρχική Σελίδα</span></a>                        
                    </li>
                    <!-- SIDEBAR_MENU_BUTTONS ONLY FOR REGISTERED USERS-->
					<?php if(isset($_SESSION['username']))
					{
                    ?>
                <li class="xn-title"><center><span class="fa fa-user"></span> Ενέργειες ΚΕΠ</center></li>                  	
               <li><a href="map_of_corporations.php"><span class="fa fa-map-marker"></span> <span class="xn-text">Χαρτογράφηση όλων των Επιχειρήσεων</span></a></li>
               <li><a href="map_of_users.php"><span class="fa fa-map-marker"></span> <span class="xn-text">Χαρτογράφηση όλων των Χρηστών</span></a></li>
               <li class="xn-title"><center><span class="fa fa-cog"></span> Ρυθμίσεις</center></li>
               <li><a href="kep_edit_infos.php"><span class="fa fa-check-square-o"></span> <span class="xn-text">Επεξεργασία Δεδομένων</span></a></li>
					<?php
					}
                    else
                    {
					?>
                   
					<li><a href="all_events.php"><span class="fa fa-archive"></span> <span class="xn-text">Επικοινωνία</span></a></li>
                   <?php
                    }
                    ?>                
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
<div class="page-content">
			<ul class="x-navigation x-navigation-horizontal x-navigation-panel"> <!-- TOGGLE NAVIGATION -->
 <?php
//If the user is logged, we display links to edit his infos, to see his pms and to log out
if (isset($_SESSION['username'])) {
                    $user = $_SESSION['username'];
					$check = mysql_query("SELECT * FROM users WHERE username='$user'");
					$check1 = mysql_query("SELECT corporation_id FROM corporations WHERE corporation_username='$user'");
					$check12 = mysql_fetch_array($check1);
					$google= $check12['corporation_id'];
					$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
					$req3 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, all_members.id as userid, all_members.username from pm as m1, pm as m2,all_members where ((m1.user1="'.$google.'" and m1.user1read="no" and all_members.id=m1.user2) or (m1.user2="'.$google.'" and m1.user2read="no" and all_members.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
                    $req2 = mysql_query("SELECT corporation_name,corporation_afm,corporation_image_src,unix_timestamp(time_req) FROM notifications WHERE seen=0 AND username='$user'");

?>
 <li class="xn-icon-button pull-right last" style="width: 100px;"><a href="connexion.php">Αποσύνδεση</a></li>

	<li class="xn-icon-button pull-right">
<a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="0" class="dropdown-toggle" aria-expanded="true">
<span class="badge"><?php echo intval(mysql_num_rows($req3)); ?></span><i class="fa fa-envelope fa-lg"></i>
</a>

<ul class="dropdown-menu">
 <div class="popover" id="popover" style="left: -101.859px; display: block;">
<h3 class="popover-title">Έχεις <strong><?php echo intval(mysql_num_rows($req3)); ?></strong> νέα μηνύματα</h3>
 
<div class="popover-content">
<div style="width:300px">
<?php
                                     							
while($dn1= mysql_fetch_array($req2))
{

?>
<div class="notification-messages info">
<div class="user-profile">
<img src="<?php echo $dn1['corporation_image_src']; ?>" alt="" data-src="<?php echo $dn1['corporation_image_src']; ?>" width="35" height="35">
</div>
<div class="message-wrapper">
<div class="heading">
Aπό την επιχείρηση <?php echo $dn1['corporation_name']; ?> - Θέση Εργασίας
</div>
<div class="description">

</div>

</div>
<div class="clearfix"></div>
</div>
<?php
}
?>
</div>  				
</div>

 
<div class="notification-messages info">
<a tabindex="-1" href="list_pm.php">Δείτε όλα τα μηνύματά σας</a>
</div>
 </div>
</ul>
 
</li>
	
	<li class="xn-icon-button pull-right">
 
<a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="0" class="dropdown-toggle" aria-expanded="true">
<span class="badge"><?php echo intval(mysql_num_rows($req1)); ?></span><i class="fa fa-list"></i>
</a>
                    
<ul class="dropdown-menu">
 <div class="popover" id="popover" style="left: -101.859px; display: block;">
<h3 class="popover-title">Έχεις <strong><?php echo intval(mysql_num_rows($req2)); ?></strong> νέες ειδοποιήσεις</h3>

<div class="popover-content">
<div style="width:300px">
<?php
                                     function time_elapsed_B($secs){
                                     $bit = array(
                                     ' χρόνια'        => $secs / 31556926 % 12,
                                     ' εβδομάδες'     => $secs / 604800 % 52,
                                     ' ημέρες'        => $secs / 86400 % 7,
                                     ' ώρες'          => $secs / 3600 % 24,
                                     ' λεπτα'         => $secs / 60 % 60,
                                     ' δευτερόλεπτα'  => $secs % 60
                                     );
									foreach($bit as $k => $v){
                                    if($v > 1)$ret[] = $v . $k ;
                                    if($v == 1)$ret[] = $v . $k;
                                                             }
                                    array_splice($ret, count($ret)-1, 0, 'πριν');
                                    $ret[] = 'πριν.';
                                    return join($ret,' ');
                                    }    
                                    $nowtime = time();
									 
while($dn1 = mysql_fetch_array($req2))
{

?>
<div class="notification-messages info">
<div class="user-profile">
<img src="<?php echo $dn1['corporation_image_src']; ?>" alt="" data-src="<?php echo $dn1['corporation_image_src']; ?>" width="35" height="35">
</div>
<div class="message-wrapper">
<div class="heading">
Aπό την επιχείρηση <?php echo $dn1['corporation_name']; ?> - Θέση Εργασίας
</div>
<div class="description">
Καταχώρηση Αίτησης: <?php echo time_elapsed_B($nowtime-$dn1["unix_timestamp(time_req)"]); ?>
</div>

</div>
<div class="clearfix"></div>
</div>
<?php
}
?>
</div>  				
</div>
 
<div class="notification-messages info">
<a tabindex="-1" style='text-align:center'  href="notifications.php">Δείτε όλες τις ειδοποιήσεις σας</a>
</div>
 </div>

</ul>
 
</li>	
	<li class="xn-icon-button pull-right" style="width:100">
	<a><i class="fa fa-sign-in"></i>
    <?php 
    $user = $_SESSION['username'];
	$check = mysql_query("SELECT name FROM users WHERE username='$user'");
    $check1 = mysql_query("SELECT * FROM kep WHERE kep_user='$user'");

     while ($row = mysql_fetch_assoc($check))
     {
	 echo "Καλως ήλθες,".' '.$row['name'];
	 } 
	 while ($row = mysql_fetch_assoc($check1))
     {
	 echo "Καλως ήλθες,".' '.$row['kep_user'];
	 } 
    ?>
	</a>
	</li>
    
   <?php
} else {
    //Otherwise, we display a link to log in and to Sign up
?>
<li><a href="sign_up.php">Εγγραφή Μέλους</a></li>
<li><a href="connexion.php">Σύνδεση</a></li>
<?php
}
?>                       
                    
                    <!-- END POWER OFF -->                    
                   
                   </ul>
			                     
                   
                   </ul>
			  
			  <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
						<div class="form-horizontal">
			  <div class="panel panel-default">
			  <div class="panel-body">
			  <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Όλες οι καταχωρημένες </strong> Επιχειρήσεις</h3>
                                    </div>
									<div class="panel-body">
                                    <p>Στην Σελίδα αυτή έχετε την δυνατότητα να δείτε όλες τις επιχειρήσεις που είναι εγγεγραμμένες...</p>
									</p>
                                </div>
								<div class="panel-body">
								  <?php	
                    if(isset($_SESSION['username'])){
					$user = $_SESSION['username'];
					$check1 = mysql_query("SELECT * FROM kep WHERE kep_user='$user'");
					$check2 = mysql_query("SELECT * FROM corporations");
					if(mysql_fetch_assoc($check1)>0)
					{
					?>
  <table id="users_list" class="display">
    <thead>
      <tr>
        <th>ID</th>
        <th>IMG</th>
        <th>ΟΝΟΜΑ</th>
        <th>ΤΗΛΕΦΩΝΟ ΕΔΡΑΣ</th>
        <th>ΑΦΜ ΕΠΙΧΕΙΡΗΣΗΣ</th>

		</tr>
    </thead>
	 <tbody>
								<?php
//We display the list of unread messages
while($dn = mysql_fetch_array($check2))
{
?>
 
 <tr class="clickable-row" data-href="profile?id=<?php echo htmlentities($dn['id'], ENT_QUOTES, 'UTF-8'); ?>">
 <td><span class="name" style="min-width: 20px; display: inline-block;">
 <?php echo htmlentities($dn['corporation_id'], ENT_QUOTES, 'UTF-8'); ?></span></td>
 <td><img src="<?php echo htmlentities($dn['corporation_image'], ENT_QUOTES, 'UTF-8'); ?>" width="50px" height="50px" class="glyphicon glyphicon-user"/></td> 
 <td><span class="name" style="min-width: 160px; display: inline-block;"><?php echo htmlentities($dn['corporation_username'], ENT_QUOTES, 'UTF-8'); ?></span></td>
 <td><span class=""><?php echo htmlentities($dn['corporation_telephone'], ENT_QUOTES, 'UTF-8'); ?></span></td>
 <td><span class="badge"><?php echo htmlentities($dn['corporation_afm'], ENT_QUOTES, 'UTF-8'); ?></span><td> 
</tr>
<?php
}
?>
</tbody>
</table>
								<?php 
								}
								else 
								{
								if(mysql_fetch_assoc($check2)==0)
								{
								echo "<center><b>Δεν έχετε πρόσβαση σε αυτήν την σελίδα!</b></center>";
								}
								else 
								{
							    echo "<center><b>Δεν έχετε πρόσβαση σε αυτήν την σελίδα!</b></center>";

								}
								}
								}
								else
								{ 
								 ?>
								<center><b>Δεν έχετε πρόσβαση σε αυτήν την σελίδα!</b></center>
								<?php
								}
								 ?>
								</div>
	</div></div></div>
	</body>
	
</html>

		