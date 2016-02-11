<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ Job Finder</title>
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
		a.submit {
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
                                                              <h3 class="panel-title"><strong>Σύνδεση </strong> μέλους</h3>
                                                              </div><!-- END: DIV.PANEL-HEADINNG -->            															  
									                  </div><!-- END: DIV.PANEL-BODY --> 
								                     <div class="panel-body">			
					                                 <?php
                                                     //If the user is logged, we log him out
                                                     if(isset($_SESSION['username']))
                                                     {
	                                                 //We log him out by deleting the username and userid sessions
	                                                 unset($_SESSION['username'], $_SESSION['userid']);
                                                     ?>
                                                     <div class="message">
													 <div style="text-align:center;color:red">Είστε σίγουροι ότι θέλετε να γίνει αποσύνδεση από τον λογαριασμό σας.Αν ναι πατήστε στο κουμπί <i>Αποσύνδεση</i></div><br />
                                                     <div style="text-align:center;color:red"><a class="submit" href="<?php echo $url_home; ?>">Αποσύνδεση</a></div>
                                                     <?php
                                                     }
                                                     else
                                                     {
	                                                 $ousername = '';
	//We check if the form has been sent
	if(isset($_POST['username'], $_POST['password']))
	{
		//We remove slashes depending on the configuration
		if(get_magic_quotes_gpc())
		{
			$ousername = stripslashes($_POST['username']);
			$username = mysql_real_escape_string(stripslashes($_POST['username']));
			$password = stripslashes($_POST['password']);
		}
		else
		{
			$username = mysql_real_escape_string($_POST['username']);
			$password = $_POST['password'];
		}
		//We get the password of the user
		$req = mysql_query('select password,id,activated from users where username="'.$username.'"');
	    $req1 = mysql_query('select corporation_password,corporation_id,activated from corporations where corporation_username="'.$username.'"');
	    $req2 = mysql_query('select kep_password,id,activated from kep where kep_user="'.$username.'"');

		
		$dn = mysql_fetch_array($req);
		$dn1 = mysql_fetch_array($req1);
		$dn2 = mysql_fetch_array($req2);

		//We compare the submited password and the real one, and we check if the user exists
		if(($dn['password']==$password and mysql_num_rows($req)>0 and $dn['activated']==1 )or($dn1['corporation_password']==$password and mysql_num_rows($req1)>0 and $dn1['activated']==1)or($dn2['kep_password']==$password and mysql_num_rows($req2)>0 and $dn2['activated']==1))
		{
			//If the password is good, we dont show the form
			$form = false;
			//We save the user name in the session username and the user Id in the session userid
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['userid'] = $dn['id'];
            
            
?>
<div class="message">
<b><div style="color:green;text-align:center">Έχετε καταχωρήσει επιτυχώς τα στοιχεία του  λογαριασμού σας.</b>
</div>
<br />
<div style="text-align:center"><a class="submit" href="<?php echo $url_home; ?>">Είσοδος</a></div></div>
<?php
		}
		else if(($dn['password']==$password and mysql_num_rows($req)>0 and $dn['activated']==0 )or($dn1['corporation_password']==$password and mysql_num_rows($req1)>0 and $dn1['activated']==0)or($dn2['kep_password']==$password and mysql_num_rows($req2)>0 and $dn2['activated']==0))
		{
			//Otherwise, we say the password is incorrect.
			$form = true;
			$message = '<b><div style="color:red;text-align:center">O λογαριασμός σας δεν έχει ενεργοποιηθεί από την υπηρεσία ...</div></b><br>';
		}
		else
		{
			//Otherwise, we say the password is incorrect.
			$form = true;
			$message = '<b><div style="color:red;text-align:center">Ο συνδυασμός Όνομα Χρήστη και Κωδικού δεν είναι σωστός...</div></b><br>';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
		//We display a message if necessary
	if(isset($message))
	{
		echo '<div class="message">'.$message.'</div>';
	}
	//We display the form
?>
<p>Παρακαλώ εισάγετε τα στοιχεία σας για να συνδεθείτε...</p>
                                <br></br>
<form action="connexion.php" method="post">
<div class="form-horizontal">
	    <div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="name">Όνομα Χρήστη</label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input type="text"  size="20" required="" name="username" id="username" value="<?php echo htmlentities($ousername, ENT_QUOTES, 'UTF-8'); ?>"  class="form-control" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
			<div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="name">Κωδικός Πρόσβασης</label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input type="password" name="password" id="password" size="20" required="" class="form-control" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
			</div><!-- END: DIV.FORM-HORIZONTAL --> 
			<br></br>
			<div class="panel-footer">
			<input type="submit" value="Σύνδεση στο Λογαριασμό σας" />
            </div></div><!-- END: DIV.PANEL-FOOTER --> 
			</form>
            <?php
	           }
             }
            ?>


				   </div><!-- END: DIV.PANEL-BODY--> 
				   </div><!-- END: DIV.panel panel-default -->  	
		    </div><!-- END: DIV.FORM-HORIZONTAL -->   
            </div><!-- END: DIV.col-md-12 -->   
	        </div><!-- END: DIV.ROW -->  
        </div><!-- END: DIV.PAGE-CONTENT-WRAP -->  			
	</div><!-- END: DIV.PAGE-CONTENT -->  
</div><!-- END: DIV.PAGE-CONTAINER -->  
</body>
</html>

