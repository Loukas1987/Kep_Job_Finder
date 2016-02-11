<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ Job Finder-Αίτηση Προσωπικού</title>
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
                                            <h3 class="panel-title"><strong>Αίτηση </strong> Προσωπικού! </h3>
                                            </div><!-- END: DIV.PANEL-HEADING -->
                                        </div> <!-- END: DIV.PANEL-BODY -->  											
									    <div class="panel-body">
                                        <p>
										<!-- START FORM TO REGISTER NEW MEMBER -->  
									     <?php
                                         //WE CHECK IF THE FORM HAS BEEN SENT
                             if(isset($_POST['workers_number'],$_POST['corporation_doy'],$_POST['occupation'],$_POST['education']))
                                        {
	                         //WE SAVE THE INFORMATIONS TO THE DATABASE 
   $dnn = mysql_fetch_array(mysql_query('select * from corporations where corporation_username="'.$_SESSION['username'].'"'));
  $corporation_afm = htmlentities($dnn['corporation_afm'], ENT_QUOTES, 'UTF-8');

	mysql_query('insert into corporations_request(corporation_name,corporation_afm,workers_number,corporation_doy,education,occupation,time_submit) values ("'.$_SESSION['username'].'","'.$corporation_afm.'","'.$_POST['workers_number'].'","'.$_POST['corporation_doy'].'","'.$_POST['education'].'","'.$_POST['occupation'].'",now())');
	
	$form = false;
   $dnn = mysql_fetch_array(mysql_query('select * from corporations_request where corporation_name="'.$_SESSION['username'].'" order by corp_id_request DESC'));
   $corp_id_request = htmlentities($dnn['corp_id_request'], ENT_QUOTES, 'UTF-8');

   	mysql_query('insert into notifications(username,corporation_name,corporation_afm,corporation_image,corp_id_request,time_req) select f1.username,f2.corporation_username,f2.corporation_afm,f2.corporation_image,f3.corp_id_request,f3.time_submit from (select username from users where occupation="'.$_POST['occupation'].'" and education="'.$_POST['education'].'") as f1 cross join (select corporation_username,corporation_afm,corporation_image from corporations where corporation_afm="'.$corporation_afm.'") as f2 cross join (select corp_id_request,time_submit from corporations_request where corp_id_request="'.$corp_id_request.'") as f3');

	
											?>
                                                 <div class="message">To αίτημά σας έχει καταχωρηθεί επιτυχώς με αριθμό καταχώρησης #<?php echo $corp_id_request; ?><br />
												 </div><!-- END: DIV.MESSAGE -->
                                            <?php
					                    }
					                        else
					                                 {
						                              //OTHERWISE,WE SAY THAT AN ERROR OCCURED
						                              $form = true;
	}				                                                                  
                                     if($form)
                                     {                   
										$dnn = mysql_fetch_array(mysql_query('select * from corporations where corporation_username="'.$_SESSION['username'].'"'));
										$corporation_name = htmlentities($dnn['corporation_name'], ENT_QUOTES, 'UTF-8');
										$corporation_afm = htmlentities($dnn['corporation_afm'], ENT_QUOTES, 'UTF-8');
																			 
                                     ?>
                                     <form action="workers_request.php" method="post">
                                      Εισάγετε τα χαρακτηριστικά του προσωπικού που επιθυμείτε στην επιχείρησή σας:<br /><br />
                                          <div class="form-horizontal">
	                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="corporation_name">Επωνυμία Εταιρείας</label>
			                                           <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
									                    <input type="text" disabled name="corporation_name" id="corporation_name" value="<?php echo $corporation_name; ?>" class="form-control" />
														</div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="afm">Αριθμός Φορολογικού Μητρώου (ΑΦΜ) </label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
									                    <input type="text" name="corporation_afm" disabled id="corporation_afm" value="<?php echo $corporation_afm; ?>" class="form-control" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
													<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="workers_number">Αριθμός Ατόμων για πρόσληψη</label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
															<input type="text" name="workers_number" class="form-control" value="<?php if(isset($_POST['workers_number'])){echo htmlentities($_POST['workers_number'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												<div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="corporation_doy">Αρμόδια Δ.Ο.Υ.</label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
                                                            <input type="text" name="corporation_doy" class="form-control" value="<?php if(isset($_POST['corporation_doy'])){echo htmlentities($_POST['corporation_doy'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												 <div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="education">Απαιτούμενη Εκπαίδευση</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="education" class="form-control" value="<?php if(isset($_POST['education'])){echo htmlentities($_POST['education'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP--> 
												<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="occupation">Εργασιακή Κατάσταση</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="occupation" class="form-control" value="<?php if(isset($_POST['occupation'])){echo htmlentities($_POST['occupation'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP -->
	                                            <div class="panel-footer">
			                                    <input type="submit" value="Αποστολή Αιτήματος" />
                                                </div><!-- END: DIV.PANEL-FOOTER-->
           		                          </div><!-- END: DIV.FORM-HORIZONTAL-->
										</form>
									  </div><!-- END: DIV.PANEL-BODY-->
	                            </div><!-- END: DIV.PANEL-PANEL DEFAULT-->
                                <?php
                                }
                                ?>
                                </p>
						</div><!-- END: DIV.FORM HORIZONTAL-->
					</div><!-- END: DIV.col-md-12-->
				  </div><!-- END: DIV.ROW-->
			</div><!-- END: DIV.PAGE-CONTENT WRAP-->
	</div><!-- END: DIV.PAGE-CONTENT-->
</div><!-- END: DIV.PAGE-CONTAINER-->
</body>
</html>