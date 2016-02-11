<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ Job Finder-Εξέλιξη αιτήσεων επιχείρησης</title>
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
                                            <h3 class="panel-title"><strong>Εξέλιξη</strong> Υποβληθέντων Αιτήσεων! </h3>
                                            </div><!-- END: DIV.PANEL-HEADING -->
                                        </div> <!-- END: DIV.PANEL-BODY -->  
			                           <div class="panel-body">
                                     <ul class="player_gallery clearfix">   
<?php
$user = $_SESSION['username'];
$get = mysql_query("SELECT * FROM corporations_request WHERE corporation_name='$user'");
$option = '';
if (mysql_num_rows($get) == 0)
{ 
echo 'Δεν υπάρχει καμία αίτηση σε εκρεμμότητα!';
}
else if (mysql_num_rows($get) > 0)
{
while($row = mysql_fetch_assoc($get))
{
  $option .= '<option value = "'.$row['corp_id_request'].'">Αίτηση #'.$row['corp_id_request'].'</option>';
}
?>									 
									 <div class="panel-body">
		
								<b>Επιλέξτε μια αίτηση για να δείτε σχετικές πληροφορίες</b><br></br>
                      <div class='timeline-tab-content' id='Events' style='display: block;'>
						    <form class="form-signin" method="get" id='signin' name="signin" action="workers_request_analytics.php">
                            <div class="form-group">
							 <select class="form-control" name="id" id="id" onchange="this.form.submit()"> 
<?php echo $option; 
?>
</select>
                               
                                <span class="help-block"></span>
                            </div>

                            <br>
                            <button class="btn btn-success btn-block" style="background-color:#33414e!important" type="submit">
                                Αναλυτικά Στοιχεία
                            </button>
                        </form>
						<?php 
						} 
						?>

						</div>
		                        </div>
								
</ul>
									   </div>										
									    </p>
						</div><!-- END: DIV.FORM HORIZONTAL-->
					</div><!-- END: DIV.col-md-12-->
				  </div><!-- END: DIV.ROW-->
			</div><!-- END: DIV.PAGE-CONTENT WRAP-->
	</div><!-- END: DIV.PAGE-CONTENT-->
</div><!-- END: DIV.PAGE-CONTAINER-->
</body>
</html>