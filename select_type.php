<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ Job Finder- Επιλογή Τύπου Χρήστη προς Εγγραφή</title>

        <link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

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
<script language="javascript">
function SelectRedirect(){
// ON selection of section this function will work
//alert( document.getElementById('s1').value);

switch(document.getElementById('category').value)
{
case "kep":
window.location="sign_up_kep.php";
break;

case "corporation":
window.location="sign_up_corporation.php";
break;

case "citizen":
window.location="sign_up_citizen.php";
break;

/// Can be extended to other different selections of SubCategory //////
default:
window.location=""; // if no selection matches then not redirected to any page
break;
}// end of switch 
}
////////////////// 
</script>
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
								<?php if(!isset($_SESSION['username']))
                               {
							   ?>
								<b>Σε ποια κατηγορία μέλους ανήκετε;</b><br></br>
                      <div class='timeline-tab-content' id='Events' style='display: block;'>
						    <form class="form-signin" method="get" id='signin' name="signin">
                            <div class="form-group">
							 <select class="form-control" name="category" id="category" onChange="SelectRedirect();"> 
                             <option selected="">Επιλέξτε κατηγορία</option>
							 <option value="kep"> Κρατικός Φορέας - ΚΕΠ</option>
							 <option value="corporation">Επιχείρηση</option>
							 <option value="citizen">Πολίτης</option>
							 </select>
                             <span class="help-block"></span>
                            </div>
                            <br>
                        </form>
						</div>
						<?php
					}
                    else
                    {
					?>
					Δεν μπορείτε να πραγματοποιήσετε εκ νέου εγγραφή ενός είστε συνδεδεμένος στον λογαριασμό σας!
					 <?php
                    }
                    ?>   
		                        </div><!-- END: DIV.PANEL-BODY--> 
                         </div><!-- END: DIV.panel panel-default -->  
				</div><!-- END: DIV.FORM-HORIZONTAL -->  
		    </div><!-- END: DIV.col-md-12 -->   
	    </div><!-- END: DIV.ROW -->  
      </div><!-- END: DIV.PAGE-CONTENT-WRAP -->  			
   
   
	</div><!-- END: DIV.PAGE-CONTENT-->
</div><!-- END: DIV.PAGE-CONTAINER-->
</body>
</html>