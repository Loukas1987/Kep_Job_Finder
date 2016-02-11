<?php
include('config.php');
?>
<!DOCTYPE html>

<html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>ΚΕΠ Job Finder - Λίστα Προσωπικών Μηνυμάτων </title>
       	<link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
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

 
</head>

<body>


<div class="page-container">
 <div class="page-sidebar">
                <!-- START LT_SIDEBAR -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                    <a href="index.php">ΚΕΠ Job Finder</a>
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
							  $check = mysql_query("SELECT * FROM users WHERE username='$user'");
				           	  $check1 = mysql_query("SELECT * FROM corporations WHERE corporation_username='$user'");
                                        while ($row = mysql_fetch_assoc($check))
							            {echo "<img src='" . $row['image_src'] . "' title='Άγνωστος Χρήστης' alt='Άγνωστος Χρήστης'>";}
                                        while ($row = mysql_fetch_assoc($check1))
							            {echo "<img src='" . $row['corporation_image_src'] . "' title='Άγνωστος Χρήστης' alt=''>";}
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
                             <!-- END:CONDITION FOR DISPLAY NAME IF UNREGISTERED USER -->	
					         <!-- CONDITION FOR DISPLAY OCCUPATION IF REGISTERED USER -->
                            <?php if(isset($_SESSION['username']))
							  {
							  $user = $_SESSION['username'];
							  $check = mysql_query("SELECT occupation FROM users WHERE username='$user'");
							  $check1 = mysql_query("SELECT * FROM corporations WHERE corporation_username='$user'");
                              while ($row = mysql_fetch_assoc($check))
							  {
							  echo $row['occupation'];
						      } 
							  while ($row = mysql_fetch_assoc($check1))
							  {
							  echo "Α.Φ.Μ.:".$row['corporation_afm'];
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
				    $user = $_SESSION['username'];
					$check = mysql_query("SELECT * FROM users WHERE username='$user'");
					$check1 = mysql_query("SELECT corporation_id FROM corporations WHERE corporation_username='$user'");
					$check12 = mysql_fetch_array($check1);
					$google= $check12['corporation_id'];
					$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
					$req3 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, all_members.id as userid, all_members.username from pm as m1, pm as m2,all_members where ((m1.user1="'.$google.'" and m1.user1read="no" and all_members.id=m1.user2) or (m1.user2="'.$google.'" and m1.user2read="no" and all_members.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
                    $req2 = mysql_query("SELECT corporation_name,corporation_afm,corporation_image_src,unix_timestamp(time_req) FROM notifications WHERE seen=0 AND username='$user'");

					if(mysql_num_rows($check) == 1){
					?>
                    <li class="xn-title"><center><span class="fa fa-user"></span> Διαχείριση Μηνυμάτων</center></li>
                    <li><a href="new_pm.php"><span class="fa fa-pencil"></span> <span class="xn-text">Σύνθεση Νέου Μηνύματος</span></a></li>
					<?php
					}
                    else if (mysql_num_rows($check1) == 1){
					?>					
                    <li class="xn-title"><center><span class="fa fa-user"></span> Διαχείριση Μηνυμάτων</center></li>
                    <li><a href="new_pm.php"><span class="fa fa-pencil"></span> <span class="xn-text">Σύνθεση Νέου Μηνύματος</span></a></li>
					<?php
                    }}
					else
					{
					?>
					<li class="xn-title"><center><span class="fa fa-user"></span> Ενέργειες Επισκέπτη</center></li>
                    <li><a href="corporation_edit_infos.php"><span class="fa fa-pencil"></span> <span class="xn-text"> Επεξεργασία Προσωπικών Δεδομένων</span></a></li>
					<?php
					}
                    ?>      
    </div><!-- END: DIV.PAGE-SIDEBAR --> 
    <div class="page-content">
			<ul class="x-navigation x-navigation-horizontal x-navigation-panel"> 
	<!-- LOGIN-SIGNUP PANEL -->
    <?php if(isset($_SESSION['username']))
    {
    ?>
	<!-- PANEL IF LOGGED USER -->
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
	$check1 = mysql_query("SELECT * FROM corporations WHERE corporation_username='$user'");
     while ($row = mysql_fetch_assoc($check))
     {
	 echo "Καλως ήλθες,".' '.$row['name'];
	 } 
	 while ($row = mysql_fetch_assoc($check1))
     {
	 echo "Καλως ήλθες,".' '.$row['corporation_name'];
	 } 
    ?>
	</a>
	</li>
    
	<?php
    }
    else
    {
    ?>
	<!-- PANEL IF NON-LOGGED USER -->
    <li><a href="select_type.php">Εγγραφή Μέλους</a></li>
    <li><a href="connexion.php">Σύνδεση</a></li>
    <?php
    }
    ?>                       
    </ul>      
	
		<div class="page-content-wrap">
            <div class="row">
				<div class="col-md-12">
							  <div class="form-horizontal">
			                   <div class="panel panel-default">
							     <div class="panel-body">

                                                                      <?php
//We check if the user is logged
if(isset($_SESSION['username']))
{
//We list his messages in a table
//Two queries are executes, one for the unread messages and another for read messages
$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$req2 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="yes" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="yes" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');


$check = mysql_query("SELECT * FROM users WHERE username='$user'");
$check1 = mysql_query("SELECT corporation_id FROM corporations WHERE corporation_username='$user'");
$check12 = mysql_fetch_array($check1);
$google= $check12['corporation_id'];
$req3 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$req4 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, all_members.id as userid, all_members.username from pm as m1, pm as m2,all_members where ((m1.user1="'.$google.'" and m1.user1read="no" and all_members.id=m1.user2) or (m1.user2="'.$google.'" and m1.user2read="no" and all_members.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$req5 = mysql_query("SELECT corporation_name,corporation_afm,corporation_image_src,unix_timestamp(time_req) FROM notifications WHERE seen=0 AND username='$user'");

?>
<h3>Μη διαβασμένα Μηνύματα (<?php echo intval(mysql_num_rows($req3)); ?>):</h3>

<?php
//We display the list of unread messages
while($dn1 = mysql_fetch_array($req3))
{
?>
	<a href="#" class="list-group-item" style="background-color:#f5f5f5">
 <span class="glyphicon glyphicon-user"></span> <span class="name" style="min-width: 120px; display: inline-block;"><?php echo htmlentities($dn2['username'], ENT_QUOTES, 'UTF-8'); ?></span> <span class=""><?php echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="text-muted" style="font-size: 11px;">- Hi hello how r u ?</span> <span class="badge"><?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></span> <span class="pull-right"></span></a>

<?php
}
?>
<div class="list-group">
<?php
//We display the list of read messages
while($dn2 = mysql_fetch_array($req4))
{
?>
<a href="#" class="list-group-item" style="background-color:#f5f5f5">
 <span class="glyphicon glyphicon-user"></span><span class="name" style="min-width: 120px; display: inline-block;"><?php echo htmlentities($dn2['username'], ENT_QUOTES, 'UTF-8'); ?></span> <span class=""><?php echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="text-muted" style="font-size: 11px;">- Hi hello how r u ?</span> <span class="badge"><?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></span> <span class="pull-right"></span></a>
								<?php
}
//If there is no read message we notice it
if(intval(mysql_num_rows($req4))==0)
{
?>
	<tr>
    	<td colspan="4" class="center">Κανένα διαβασμένο μήνυμα στα εισερχόμενα.</td>
    </tr>
<?php
}
?>
<?php
}
else
{
	echo 'Θα πρέπει να συνδεθείτε στον λογαριασμό σας για να έχετε πρόσβαση σε αυτήν την σελίδα.';
}
?>

																		</div><!-- END: DIV.PANEL PANEL-DEFAULT --> 
                                                                          
                                                                          </div><!-- END: DIV.PANEL-BODY --> 
																		  </div><!-- END: DIV.col-md-12 --> 
																		  </div><!-- END: DIV.ROW -->  
			
    </div><!-- END: DIV.PAGE-CONTENT -->  
<div class="footer">
		     <div class="footer-inner">
	               <div class="footer-content">
                   <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">
			       <img alt="Άδεια Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png" />
				   </a>
				   <br />
				   Το έργο με τίτλο <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">ΚΕΠ Social</span> από τον δημιουργό<span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Λουκά Τριανταφυλλόπουλο</span> διατίθεται με την άδεια <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Αναφορά Δημιουργού-Μη Εμπορική Χρήση-Όχι Παράγωγα Έργα 4.0 Διεθνές 
				   </a>.
		           </div><!-- END: DIV.FOOTER-CONTENT -->  
			 </div><!-- END: DIV.FOOTER-INNER -->  
		</div><!-- END: DIV.FOOTER -->  
</div><!-- END: DIV.PAGE-CONTAINER -->  
</body>
</html>
            	
