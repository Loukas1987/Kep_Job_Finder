<ul class="x-navigation x-navigation-horizontal x-navigation-panel"> 
    <?php if(isset($_SESSION['username']))
    {
    ?>
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