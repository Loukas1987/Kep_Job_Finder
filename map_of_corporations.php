<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>ΚΕΠ Job Finder - Χαρτογράφηση Χρηστών συστήματος</title>
      <link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"/>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>

	  <style type="text/css">
    #map_canvas {
    width: 100%;
    height: 500px;
}
  </style>

 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&.js"></script>




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
    <div class="page-sidebar" style="position:fixed">
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
				    $user = $_SESSION['username'];
					$check = mysql_query("SELECT * FROM users WHERE username='$user'");
					$check1 = mysql_query("SELECT corporation_id FROM corporations WHERE corporation_username='$user'");
		            $check2 = mysql_query("SELECT * FROM kep WHERE kep_user='$user'");

					$check12 = mysql_fetch_array($check1);
					$google= $check12['corporation_id'];
					$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
					$req3 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, all_members.id as userid, all_members.username from pm as m1, pm as m2,all_members where ((m1.user1="'.$google.'" and m1.user1read="no" and all_members.id=m1.user2) or (m1.user2="'.$google.'" and m1.user2read="no" and all_members.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
                    $req2 = mysql_query("SELECT corporation_name,corporation_afm,corporation_image,unix_timestamp(time_req) FROM notifications WHERE seen=0 AND username='$user'");

					
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
                    }
					else if (mysql_num_rows($check2) == 1){
					?>
               <li class="xn-title"><center><span class="fa fa-user"></span> Ενέργειες ΚΕΠ</center></li>                  	
               <li><a href="map_of_corporations.php"><span class="fa fa-map-marker"></span> <span class="xn-text">Χαρτογράφηση όλων των Επιχειρήσεων</span></a></li>
               <li><a href="map_of_users.php"><span class="fa fa-map-marker"></span> <span class="xn-text">Χαρτογράφηση όλων των Χρηστών</span></a></li>
               <li class="xn-title"><center><span class="fa fa-cog"></span> Ρυθμίσεις</center></li>
               <li><a href="kep_edit_infos.php"><span class="fa fa-check-square-o"></span> <span class="xn-text">Επεξεργασία Δεδομένων</span></a></li>
         <?php 
      		 }
			}
					else
					{
					?>
                    <li><a href="contact.php"><span class="fa fa-pencil"></span> <span class="xn-text">Επικοινωνία</span></a></li>
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
	                $user = $_SESSION['username'];
					$check = mysql_query("SELECT * FROM users WHERE username='$user'");
					$check1 = mysql_query("SELECT corporation_id FROM corporations WHERE corporation_username='$user'");
					$check12 = mysql_fetch_array($check1);
					$google= $check12['corporation_id'];
					$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
					$req3 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, all_members.id as userid, all_members.username from pm as m1, pm as m2,all_members where ((m1.user1="'.$google.'" and m1.user1read="no" and all_members.id=m1.user2) or (m1.user2="'.$google.'" and m1.user2read="no" and all_members.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
                    $req2 = mysql_query("SELECT corporation_name,corporation_afm,corporation_image_src,unix_timestamp(time_req) FROM notifications WHERE seen=0 AND username='$user'");

?>
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
    }
    else
    {
    ?>
	<!-- PANEL IF NON-LOGGED USER -->
    <li><a href="sign_up.php">Εγγραφή Μέλους</a></li>
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
  
<div id="mymap" style="width: 100%; height: 350px;"></div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>

<script src="http://www.mediwales.com/mapping/wp-content/themes/default/markerclusterer.js" type="text/javascript"></script>

<script type="text/javascript">
//<![CDATA[
    var infos = [];

    var addresses = [ 
<?php
    mysql_connect('localhost','root','') or die(mysql_error());
   mysql_select_db('kep_new') or die(mysql_error());    
   $result = mysql_query('SELECT * FROM corporations') or die(mysql_error());
   $count = 0;
   $row = mysql_fetch_array($result);
	while($row = mysql_fetch_array($result))
							   {
                               ?>	
          ['<?php  echo $row['corporation_address']; ?>'],
<?php 
							    }
								?>
		  ];

    var map = new google.maps.Map(document.getElementById('mymap'), {
      zoom: 4,
      center: new google.maps.LatLng(39.183608, -96.571669),
      scrollwheel: false,
      scaleControl: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var iconBase = 'http://vbarbershop.com/wp-content/themes/vbarbershop/library/images/';

        var gmarkers = [];
		
		for (var x = 0; x < addresses.length; x++) {
        $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]+'&sensor=false', null, function (data) {
            var p = data.results[0].geometry.location;
            var latlng = new google.maps.LatLng(p.lat, p.lng);			 
			
            var marker = new google.maps.Marker({
                position: latlng,
				icon: iconBase + 'ico-marker.png',
                map: map
			   
            });
						   gmarkers.push(marker);   

      
	   					 

		       });


		}
		
		var markerCluster = new MarkerClusterer(map, gmarkers);

		//]]> 

</script>
	<div class="footer">
							             <div class="footer-inner">
								              <div class="footer-content">
                                              <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">
											  <img alt="Άδεια Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png" />
											  </a>
											  <br />
											  Το έργο με τίτλο <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Like Today</span> από τον δημιουργό<span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Λουκά Τριανταφυλλόπουλο</span> διατίθεται με την άδεια <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Αναφορά Δημιουργού-Μη Εμπορική Χρήση-Όχι Παράγωγα Έργα 4.0 Διεθνές 
											  </a>.
								              </div><!-- END: DIV.FOOTER-CONTENT -->  	
								         </div><!-- END: DIV.FOOTER-INNER -->  
						     </div><!-- END: DIV.FOOTER -->  	
                        </div><!-- END: DIV.panel panel-default -->  	
				    </div><!-- END: DIV.FORM-HORIZONTAL -->  
				</div><!-- END: DIV.col-md-12 -->   
	        </div><!-- END: DIV.ROW -->  
        </div><!-- END: DIV.PAGE-CONTENT-WRAP -->  			
	</div><!-- END: DIV.PAGE-CONTENT -->  
</div><!-- END: DIV.PAGE-CONTAINER -->  
		
</body>
</html>
        