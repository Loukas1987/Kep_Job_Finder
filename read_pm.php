<?php
include('config.php');
?>
<!DOCTYPE html>

<h
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>ΚΕΠ Job Finder - Ανάγνωση Μηνυμάτων </title>
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

</style>
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
					$check1 = mysql_query("SELECT * FROM corporations WHERE corporation_username='$user'");
					$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
                    $req2 = mysql_query("SELECT corporation_name,corporation_afm,corporation_image_src,unix_timestamp(time_req) FROM notifications WHERE seen=0 AND username='$user'");
					if(mysql_num_rows($check) == 1){
					?>
                    <li class="xn-title"><center><span class="fa fa-user"></span> Ενέργειες Χρήστη</center></li>
                    <li><a href="citizen_edit_infos.php"><span class="fa fa-pencil"></span> <span class="xn-text">Επεξεργασία Προσωπικών Δεδομένων</span></a></li>
					<?php
					}
                    else if (mysql_num_rows($check1) == 1){
					?>
                    <li class="xn-title"><center><span class="fa fa-user"></span> Ενέργειες Επιχείρησης</center></li>
                    <li><a href="corporation_edit_infos.php"><span class="fa fa-pencil"></span> <span class="xn-text">Επεξεργασία Προσωπικών Δεδομένων</span></a></li>
					<li><a href="workers_request.php"><span class="fa fa-users"></span> <span class="xn-text">Αίτηση Προσωπικού</span></a></li>					
					<li><a href="workers_request_state.php"><span class="fa fa-spinner"></span> <span class="xn-text">Εξέλιξη αιτήσεων</span></a></li>										
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
<span class="badge"><?php echo intval(mysql_num_rows($req1)); ?></span><i class="fa fa-envelope fa-lg"></i>
</a>
                    
<ul class="dropdown-menu">
 
<li class="nav-messages-header">
<a tabindex="-1" href="#">Έχεις <strong><?php echo intval(mysql_num_rows($req1)); ?></strong> νέα μηνύματα </a>
</li>
 
 
<li class="nav-messages-body">
<?php
//We display the list of unread messages
while($dn1 = mysql_fetch_array($req1))
{
?>
<a href="read_pm.php?id=<?php echo $dn1['id']; ?>">
<img src="../../assets/img/avatars/user1_55.jpg" alt="User" class="avatar">
<div class="title">
<small class="pull-right"><?php echo date('Y/m/d' ,$dn1['timestamp']); ?></small><strong><?php echo htmlentities($dn1['username'], ENT_QUOTES, 'UTF-8'); ?></strong>
</div>
<div class="message">Lorem ipsum dolor sit amet, consectetur...</div>
</a>
<?php
                    }
                    ?>  
</li>
 
<li class="nav-messages-footer">
<a tabindex="-1" href="list_pm.php">Δείτε όλα τα μηνύματα</a>
</li>
 
</ul>
 
</li>
	<li class="xn-icon-button pull-right">
 
<a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="0" class="dropdown-toggle" aria-expanded="true">
<span class="badge"><?php echo intval(mysql_num_rows($req2)); ?></span><i class="fa fa-list"></i>
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
<a tabindex="-1" href="notifications.php">Δείτε όλες τις ειδοποιήσεις σας</a>
</div>
 </div>

</ul>
 
</li>
	
	<li class="xn-icon-button pull-right" style="width: 210px;">
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
//We check if the ID of the discussion is defined
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
//We get the title and the narators of the discussion
$req1 = mysql_query('select title, user1, user2 from pm where id="'.$id.'" and id2="1"');
$dn1 = mysql_fetch_array($req1);
//We check if the discussion exists
if(mysql_num_rows($req1)==1)
{
//We check if the user have the right to read this discussion
if($dn1['user1']==$_SESSION['userid'] or $dn1['user2']==$_SESSION['userid'])
{
//The discussion will be placed in read messages
if($dn1['user1']==$_SESSION['userid'])
{
	mysql_query('update pm set user1read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 2;
}
else
{
	mysql_query('update pm set user2read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 1;
}
//We get the list of the messages
$req2 = mysql_query('select pm.timestamp, pm.message, users.id as userid, corporations.corporation_id as userid, users.username, users.avatar,corporations.corporation_username from pm,users,corporations where pm.id="'.$id.'", users.id=pm.user1 and corporations.corporation_id=pm.user1 order by pm.id2');
//We check if the form has been sent
if(isset($_POST['message']) and $_POST['message']!='')
{
	$message = $_POST['message'];
	//We remove slashes depending on the configuration
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	//We protect the variables
	$message = mysql_real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
	//We send the message and we change the status of the discussion to unread for the recipient
	if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysql_num_rows($req2))+1).'", "", "'.$_SESSION['userid'].'", "", "'.$message.'", "'.time().'", "", "")') and mysql_query('update pm set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
	{
?>
<div class="message">To μήνυμά σας έχει αποσταλλεί επιτυχώς.<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Go to the discussion</a></div>
<?php
	}
	else
	{
?>
<div class="message">An error occurred while sending the message.<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Go to the discussion</a></div>
<?php
	}
}
else
{
//We display the messages
?>
<div class="content">
<h1><?php echo $dn1['title']; ?></h1>
<table class="messages_table">
	<tr>
    	<th class="author">User</th>
        <th>Message</th>
    </tr>
<?php
while($dn2 = mysql_fetch_array($req2))
{
?>
	<tr>
    	<td class="author center"><?php
if($dn2['avatar']!='')
{
	echo '<img src="'.htmlentities($dn2['avatar']).'" alt="Image Perso" style="max-width:100px;max-height:100px;" />';
}
?><br /><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo $dn2['username']; ?></a></td>
    	<td class="left"><div class="date">Sent: <?php echo date('m/d/Y H:i:s' ,$dn2['timestamp']); ?></div>
    	<?php echo $dn2['message']; ?></td>
    </tr>
<?php
}
//We display the reply form
?>
</table><br />
<h2>Reply</h2>
<div class="center">
    <form action="read_pm.php?id=<?php echo $id; ?>" method="post">
    	<label for="message" class="center">Message</label><br />
        <textarea cols="40" rows="5" name="message" id="message"></textarea><br />
        <input type="submit" value="Send" />
    </form>
</div>
</div>
<?php
}
}
else
{
	echo '<div class="message">Δεν έχετε δικαιώματα πρόσβαση σε αυτήν την σελίδα.</div>';
}
}
else
{
	echo '<div class="message">This discussion does not exists.</div>';
}
}
else
{
	echo '<div class="message">The discussion ID is not defined.</div>';
}
}
else
{
	echo '<div class="message">You must be logged to access this page.</div>';
}
?>
		<div class="foot"><a href="list_pm.php">Go to my personnal messages</a></div>
	
                                                                      
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
            	
