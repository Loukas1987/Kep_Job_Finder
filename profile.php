<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ Job Finder-Προφίλ Χρήστη</title>

        <link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
		
<style type="text/css">


.portlet {
margin-bottom: 15px;
border: none;
background: #fff;
width: 100%;
}
.col-lg-8.col-md-8.col-sm-6.col-xs-12 {
width: 100%;
}

</style>
</head>


<body>

<script>

$(document).ready(function() {
	$(".x-navigation-control").click(function(){
        $(this).parents(".x-navigation").toggleClass("x-navigation-open");
        
        onresize();
        
        return false;
    });

})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

</script>

<div class="page-container">
    <div class="page-sidebar">
                <!-- START LT_SIDEBAR -->
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
                             <!-- END:CONDITION FOR DISPLAY NAME IF UNREGISTERED USER -->	
					         <!-- CONDITION FOR DISPLAY OCCUPATION IF REGISTERED USER -->
                              <?php if(isset($_SESSION['username']))
							  {
							  $user = $_SESSION['username'];
							  $sql = "SELECT occupation FROM users WHERE username='$user'";
                              $result = mysql_query($sql) or die ("Could not access DB: " . mysql_error());
                              while ($row = mysql_fetch_assoc($result))
							  {echo $row['occupation'];}
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
                    <li class="xn-title"><center><span class="fa fa-user"></span> Ενέργειες Χρήστη</center></li>
                    <li><a href="edit_infos.php"><span class="fa fa-pencil"></span> <span class="xn-text">Επεξεργασία Προσωπικών Δεδομένων</span></a></li>
                     <li class="xn-title"><center><span class="fa fa-info-circle"></span>     Πληροφόρηση κάθε Επισκέπτη</center></li>                   
					<li><a href="all_events.php"><span class="fa fa-archive"></span> <span class="xn-text">Αρχείο Καταχωρήσεων</span></a></li>
                    <?php
					}
                    else
                    {
					?>
                   
					<li><a href="all_events.php"><span class="fa fa-archive"></span> <span class="xn-text">Αρχείο Καταχωρήσεων</span></a></li>
                                        <?php
                    }
                    ?>                
                </ul>
                <!-- END LT_SIDEBAR -->
    </div><!-- END: DIV.PAGE-SIDEBAR -->  
    <div class="page-content">
	<ul class="x-navigation x-navigation-horizontal x-navigation-panel"> 
	<!-- LOGIN-SIGNUP PANEL -->
 <?php if(isset($_SESSION['username']))
    {
    ?>
	<!-- PANEL IF LOGGED USER -->
    <li class="xn-icon-button pull-right last" style="width: 100px;"><a href="connexion.php">Αποσύνδεση</a></li>

	<?php if(isset($_SESSION['username']))
					{
				    $user = $_SESSION['username'];
					$users_feed = mysql_query("SELECT * FROM users WHERE username='$user'");
					$corporations_feed = mysql_query("SELECT corporation_id FROM corporations WHERE corporation_username='$user'");
					$kep_feed = mysql_query("SELECT * FROM kep WHERE kep_user='$user'");
					$check12 = mysql_fetch_array($corporations_feed);
					$check22 = mysql_fetch_array($kep_feed);
					$google2= $check22['Dimos'];

					$google= $check12['corporation_id'];
					$corporation_notifications = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
					$req3 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, all_members.id as userid, all_members.username from pm as m1, pm as m2,all_members where ((m1.user1="'.$google.'" and m1.user1read="no" and all_members.id=m1.user2) or (m1.user2="'.$google.'" and m1.user2read="no" and all_members.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');

                    $req4 = mysql_query("SELECT * FROM users WHERE activated=0 and dimos='$google2'");
                    $req2 = mysql_query("SELECT corporation_name,corporation_afm,corporation_image,unix_timestamp(time_req) FROM notifications WHERE seen=0 AND username='$user'");

					
					
					if(mysql_num_rows($kep_feed) == 1){
					?>
	<li class="xn-icon-button pull-right">
<a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="0" class="dropdown-toggle" aria-expanded="true">
<span class="badge"><?php echo intval(mysql_num_rows($req4)); ?></span><i class="fa fa-users"></i>
</a>
<ul class="dropdown-menu">
 <div class="popover" id="popover" style="left: -101.859px; display: block;">
 <h3 class="popover-title">Έχεις <strong><?php echo intval(mysql_num_rows($req4)); ?></strong> νέες αιτήσεις</h3>
<div class="popover-content">
<div style="width:320px">
<?php
                                     							
while($dn1= mysql_fetch_array($req4))
{
$dimos = $dn1['dimos'];
$user = $dn1['username'];

if(isset($_POST[$user])){
mysql_query("UPDATE users SET activated=1 WHERE Dimos='$dimos' AND username='$user'") or die(mysql_error());
}
?>
<div class="notification-messages info">
<div class="user-profile">
<img src="<?php echo $dn1['image_src']; ?>" alt="" data-src="<?php echo $dn1['image_src']; ?>" width="35" height="35">
</div>
<div class="message-wrapper">
<div class="heading">
Aίτηση εγγραφής του χρήστη <?php echo $dn1['name']; ?>
</div>
<br></br>
<div class="description" style="text-align:center">

<form action='' method='POST'> 
  <input type="hidden" name="<?php echo $dn1['username']; ?>" value="<?php echo $dn1['username']; ?>" />
  <input type='submit' name='submit' />  
 </form>

 <br>
 <a href="profile.php?id=<?php echo $dn1['id']; ?>" class="button">Στοιχεία Αιτούντος</a>
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
<li class="xn-icon-button pull-right" style="width:100">
	<a><i class="fa fa-sign-in"></i>
    <?php 
    $user = $_SESSION['username'];
	$check = mysql_query("SELECT name FROM users WHERE username='$user'");
	$check1 = mysql_query("SELECT * FROM corporations WHERE corporation_username='$user'");
    $check2 = mysql_query("SELECT * FROM kep WHERE kep_user='$user'");

     while ($row = mysql_fetch_assoc($check))
     {
	 echo "Καλως ήλθες,".' '.$row['name'];
	 } 
	 while ($row = mysql_fetch_assoc($check1))
     {
	 echo "Καλως ήλθες,".' '.$row['corporation_name'];
	 } 
	 while ($row = mysql_fetch_assoc($check2))
     {
	 echo "Καλως ήλθες,".' '.$row['kep_user'];
	 } 
    ?>
	</a>
	</li>
   
<?php 
} 
else if(mysql_num_rows($users_feed) == 1){
?>
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
<img src="<?php echo $dn1['corporation_image']; ?>" alt="" data-src="<?php echo $dn1['corporation_image']; ?>" width="35" height="35">
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
                                     							
while($dn1= mysql_fetch_array($req3))
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
	
<li class="xn-icon-button pull-right" style="width:100">
	<a><i class="fa fa-sign-in"></i>
    <?php 
    $user = $_SESSION['username'];
	$check = mysql_query("SELECT name FROM users WHERE username='$user'");
	$check1 = mysql_query("SELECT * FROM corporations WHERE corporation_username='$user'");
    $check2 = mysql_query("SELECT * FROM kep WHERE kep_user='$user'");

     while ($row = mysql_fetch_assoc($check))
     {
	 echo "Καλως ήλθες,".' '.$row['name'];
	 } 
	 while ($row = mysql_fetch_assoc($check1))
     {
	 echo "Καλως ήλθες,".' '.$row['corporation_name'];
	 } 
	 while ($row = mysql_fetch_assoc($check2))
     {
	 echo "Καλως ήλθες,".' '.$row['kep_user'];
	 } 
    ?>
	</a>
	</li>
   	
<?php 
}
else if(mysql_num_rows($corporations_feed) == 1){
?>
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
<img src="<?php echo $dn1['corporation_image']; ?>" alt="" data-src="<?php echo $dn1['corporation_image']; ?>" width="35" height="35">
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
                                     							
while($dn1= mysql_fetch_array($corporation_notifications))
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
	
<li class="xn-icon-button pull-right" style="width:100">
	<a><i class="fa fa-sign-in"></i>
    <?php 
    $user = $_SESSION['username'];
	$check = mysql_query("SELECT name FROM users WHERE username='$user'");
	$check1 = mysql_query("SELECT * FROM corporations WHERE corporation_username='$user'");
    $check2 = mysql_query("SELECT * FROM kep WHERE kep_user='$user'");

     while ($row = mysql_fetch_assoc($check))
     {
	 echo "Καλως ήλθες,".' '.$row['name'];
	 } 
	 while ($row = mysql_fetch_assoc($check1))
     {
	 echo "Καλως ήλθες,".' '.$row['corporation_name'];
	 } 
	 while ($row = mysql_fetch_assoc($check2))
     {
	 echo "Καλως ήλθες,".' '.$row['kep_user'];
	 } 
    ?>
	</a>
	</li>
 <?php 
}}
	?> 
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
			                         <div class="panel-heading">
                                     <?php
                                      //We check if the users ID is defined
                                      if(isset($_GET['id']))
                                     {
	                                 $id = intval($_GET['id']);
	                                 //We check if the user exists
                                     //CONDITION TO COUNT VIEWS WHEN PAGE LOAD
	                                 $dn = mysql_query('select * from users where id="'.$id.'"');
	                                       if(mysql_num_rows($dn)>0)
	                                       {
		                                   $dnn = mysql_fetch_array($dn);
		                                   //We display the user datas
								     ?>
                                    <h3 class="panel-title"><strong> 
									<?php if ($dnn['activated']==0) { ?>
                                     Mη εγγεγραμμένος<?php }else{?> Εγγεγραμμένος<?php }?> </strong> Χρήστης - <?php echo htmlentities($dnn['username']); ?></h3>
                                    </div><!-- END: DIV.PANEL-HEADING -->
								</div><!-- END: DIV.PANEL-BODY -->
								<div class="panel-body">
                                     <div class="col-lg-3 col-md-3">
									      <div class="well well-sm white">
										        <div class="profile-pic">
										        <?php
                                                if($dnn['image_src']!='')
                                                {
	                                            echo '<img src="'.htmlentities($dnn['image_src'], ENT_QUOTES, 'UTF-8').'" class="img-responsive" alt="Avatar" />';
                                                }
                                                else
                                                {
	                                            echo '<img src="upload/default.png" class="img-responsive" alt="Avatar" />';
                                                }
                                                ?>
										        </div><!-- END: DIV.PROFILE-PIC -->
									        </div><!-- END: DIV.well well-sm white -->
								     </div><!-- END: DIV.col-lg-3 col-md-3 -->
                                     <div class="col-lg-9 col-md-9">
									       <div class="tc-tabs">
										    <ul class="nav nav-tabs tab-lg-button tab-color-dark background-dark white">
											<li class="active"><a href="#p1" data-toggle="tab"><i class="fa fa-desktop bigger-130"></i> Στοιχεία Χρήστη</a></li>
											</ul>
										        <div class="tab-content">
											           <div class="tab-pane fade in active" id="p1">
												              <div class="row">													
													               <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
														                   <div class="portlet no-border">
															                     <div class="portlet-heading">
																                      <div class="portlet-title">
																	                  <h2><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></h2>
																                      </div><!-- END: DIV.PORTLET-TITLE -->
																                      <div class="clearfix"></div>
															                     </div><!-- END: DIV.PORTLET-HEADING -->
															                     <div class="portlet-body">
																                      <div class="editable editable-click" id="profile">
																	                  <?php
                                                                                      if($dnn['bio']!='')
                                                                                      {
	                                                                                  echo htmlentities($dnn['bio'], ENT_QUOTES, 'UTF-8');
                                                                                      }
                                                                                      else
                                                                                      {
	                                                                                  echo "Ο Χρήστης δεν έχει καταθέσει βιογραφικό...";
                                                                                      }
                                                                                      ?>
                                                                    	              </div><!-- END: DIV.editable editable-click -->
																                      <br /><br />
																                      <address>
																	                  E-mail: <a href="mailto:#" id="email" class="editable editable-click"><?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></a>
																                      </address>
																                      <ul class="list-inline well well-sm">
																	                  <li><i class="fa fa-calendar bigger-110" alt="Ημερομηνία Εγγραφής" title="Ημερομηνία Εγγραφής"></i> <?php echo date('d/m/Y',$dnn['signup_date']); ?></li>
																	                  <li><i class="fa fa-male" alt="Επαγγελμα" title="Επαγγελμα"></i> <?php echo htmlentities($dnn['occupation'], ENT_QUOTES, 'UTF-8'); ?></li>
																	                  <li><i class="fa fa-graduation-cap" alt="Εκπαίδευση" title="Εκπαίδευση"></i> <?php echo htmlentities($dnn['education'], ENT_QUOTES, 'UTF-8'); ?></li>
																                      </ul>
															                     </div><!-- END: DIV.PORTLET-BODY -->
														                    </div><!-- END: DIV.PORTLET-NO-BORDER -->
													                 </div><!-- END: DIV.col-lg-8 col-md-8 col-sm-6 col-xs-12 -->
												              </div><!-- END: DIV.ROW -->
										                 </div><!-- END: DIV.tab-pane fade in active -->
									            </div><!-- END: DIV.tab-content -->
									        </div><!-- END: DIV.tc-tabs -->
								       </div><!-- END: DIV.col-lg-9 col-md-9 -->
                                       <?php
	                                   }
	                                   else
	                                   {
		                               echo 'O Χρήστης αυτός δεν υπάρχει.';
	                                   }
                                    }
                                    else
                                    {
	                                echo 'Δεν προσδιορίσθηκε το ID του Χρήστη.';
                                    }
                                    ?>
		                       </div><!-- END: DIV.PANEL-BODY -->
						</div><!-- END: DIV.PANEL-PANEL DEFAULT-->
                     </div><!-- END: DIV.FORM HORIZONTAL-->
			     </div><!-- END: DIV.col-md-12-->
			</div><!-- END: DIV.ROW-->
	     </div><!-- END: DIV.PAGE-CONTENT WRAP-->
	</div><!-- END: DIV.PAGE-CONTENT-->
</div><!-- END: DIV.PAGE-CONTAINER-->
</body>
</html>
		