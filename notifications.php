<?php
include('config.php');
?>
<?php
$user = $_SESSION['username'];
$sql = "SELECT * FROM notifications WHERE username='$user'";
$result = mysql_query($sql) or die ("Δεν επιτρέπεται η πρόσβαση στην Βάση Δεδομένων: " . mysql_error());
$row = mysql_fetch_assoc($result);
$corporation_name=$row['corporation_name'];
$request_id=$row['corp_id_request']; 
$user = $_SESSION['username'];
if ( isset($_POST['submit-'.$request_id]) == true) 
{    
	mysql_query("UPDATE corporations_request SET stakeholders=stakeholders+1 where corporation_name='$corporation_name' AND corp_id_request='$request_id'");
   	mysql_query("insert into stakeholders(corp_id_request,username) select corp_id_request,username from notifications where corp_id_request='$request_id' AND username='$user'");	
}
?>		
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>ΚΕΠ Job Finder - Σελίδα Ειδοποιήσεων</title>

        <link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>		
	    <script src="https://templates.juliomarquez.co/social/assets/js/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.1/jquery.slimscroll.min.js"></script>
		<script src="https://templates.juliomarquez.co/social/assets/js/sidebar.js"></script>
		
<style type="text/css"> 
input[type=submit] {
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
float: right;
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
        <?php include 'left_sidebar.php'; ?>

	  <div class="page-content">
        <?php include 'top_sidebar.php'; ?>
        <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
						       <div class="form-horizontal">
			                            <div class="panel panel-default">
			                                            <div class="panel-body">
			                                                     <div class="panel-heading">
                                                                 <h3 class="panel-title"><strong>Οι ειδοποιήσεις μου</strong></h3>
                                                                 </div>
														</div>
									                    <div  class="panel-body">
                                                        <p>Στην Σελίδα αυτή έχετε την δυνατότητα να επεξεργασθείτε τα προσωπικά στοιχεία του λογαριασμού σας, ανάλογα με το πώς εσάς σας διευκολύνει...</p>
                                                        </div>
								                        <div style="text-align:center" class="panel-body">
			                                            
<ul class="player_gallery clearfix">    
<?php
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

	$sql = "SELECT * FROM notifications WHERE username='$user'";
    $result = mysql_query($sql) or die ("Δεν επιτρέπεται η πρόσβαση στην Βάση Δεδομένων: " . mysql_error());
	 while ($row = mysql_fetch_assoc($result))
{
$corporation_name=$row['corporation_name'];
$request_id=$row['corp_id_request'];
?>
<div class="row" style="text-align:center">
<div class="col-md-8">
Αίτηση με αριθμ. Πρωτ. <?php echo $row['corp_id_request']; ?>: Η επιχείρηση <?php echo $row['corporation_name']; ?> με Α.Φ.Μ. <?php echo $row['corporation_afm']; ?> αναζητάει εργατικό δυναμικό 
με τα δικά σου χαρακτηριστικά.
</div>
<div class="col-md-3">
<?php
$user = $_SESSION['username'];
$sql2 = "SELECT * FROM stakeholders WHERE username='$user' AND corp_id_request='$request_id'";
$result2 = mysql_query($sql2);
if (mysql_fetch_assoc($result2)>0) {
?>
<input type="submit" name="submit" disabled value="Επιτυχής Δήλωση Ενδιαφέροντος!" /> 
<?php
}
else{
?>
<form method="post" name="update" action="notifications.php" /> 
<input type="submit" name="submit-<?php echo $row['corp_id_request']; ?>" value="Εκδήλωση Ενδιαφέροντος" /> 
</form>
</div>
<?php
$request_id=$row['corp_id_request']; 
$user = $_SESSION['username'];
if ( isset($_POST['submit-'.$request_id]) == true) 
{    
	mysql_query("UPDATE corporations_request SET stakeholders=stakeholders+1 where corporation_name='$corporation_name' AND corp_id_request='$request_id'");
   	mysql_query("insert into stakeholders(corp_id_request,username,time_applicant) select corp_id_request,username,now() from notifications where corp_id_request='$request_id' AND username='$user'");	
}  
}
?>
</div>
<?php 
}
mysql_query("UPDATE notifications SET seen='1' WHERE username='$user'");
?>
</ul>
</div>    
</div>
		    </div><!-- END: DIV.panel panel-default -->  	
		    </div><!-- END: DIV.FORM-HORIZONTAL -->   
            </div><!-- END: DIV.col-md-12 -->   
	        </div><!-- END: DIV.ROW -->  
        </div><!-- END: DIV.PAGE-CONTENT-WRAP -->  			
	</div><!-- END: DIV.PAGE-CONTENT -->  
</div><!-- END: DIV.PAGE-CONTAINER -->  

</body>
</html>
        