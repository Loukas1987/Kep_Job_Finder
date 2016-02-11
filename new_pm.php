<?php
include('config.php');
?>
<!DOCTYPE html>

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>ΚΕΠ Job Finder - Σύνθεση νέου μηνύματος </title>
       	<link rel="stylesheet" type="text/css" href="css/theme.css"/>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>

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
.form-horizontal .form-group {
    margin-right: 0;
    margin-left: 0;
}
</style>

</style>
</head>

<body>


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
                                 <?php
                                 //We check if the user is logged
								if(isset($_SESSION['username']))
								{
								$form = true;
								$otitle = '';
								$orecip = '';
								$omessage = '';
                                //We check if the form has been sent
                                 if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
                                {
								$otitle = $_POST['title'];
								$orecip = $_POST['recip'];
								$omessage = $_POST['message'];
	                              //We remove slashes depending on the configuration
	                            if(get_magic_quotes_gpc())
								{
									$otitle = stripslashes($otitle);
									$orecip = stripslashes($orecip);
									$omessage = stripslashes($omessage);
								}
	                            //We check if all the fields are filled
	                           if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
	                          {
								//We protect the variables
								$title = mysql_real_escape_string($otitle);
								$recip = mysql_real_escape_string($orecip);
								$message = mysql_real_escape_string(nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
								//We check if the recipient exists
		$dn2 = mysql_fetch_array(mysql_query('select count(id) as recip, id as recipid, (select count(*) from pm) as npm from all_members where username="'.$recip.'"'));
		$user = $_SESSION['username'];
		$userid = mysql_query('select corporation_id from corporations where corporation_username="'.$user.'"');
		$useridd = mysql_fetch_array($userid);
		$user_id = htmlentities($useridd['corporation_id'], ENT_QUOTES, 'UTF-8');


		if($dn2['recip']==1)
		{
			//We check if the recipient is not the actual user
			if($dn2['recipid']!= $user_id )
			{
				$id = $dn2['npm']+1 ;
                $recipid = $dn2['recipid'];
				
				//We send the message
				if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$user_id.'", "'.$recipid.'", "'.$message.'", "'.time().'", "yes", "no")'))
				{
				
?>
<div class="message">To μήνυμα απεστάλη επιτυχώς.<br />
<a href="list_pm.php" class="submit">Λίστα Προσωπικών Μηνυμάτων</a></div>
<?php
					$form = false;
				}
				else
				{
					//Otherwise, we say that an error occured
					$error = 'Σφάλμα κατά την αποστολή του μηνύματος!';
				}
			}
			else
			{
				//Otherwise, we say the user cannot send a message to himself
				$error = 'Λάθος καταχώρηση Παραλήπτη - Δεν επιτρέπεται η αυτοαποστολή!';
			}
		}
		else
		{
			//Otherwise, we say the recipient does not exists
			$error = 'Ο παραλήπτης δεν υπάρχει...';
		}
	}
	else
	{
		//Otherwise, we say a field is empty
		$error = 'Κενό πεδίο. Παρακαλώ συμπληρώστε όλα τα απαιτούμενα πεδία...';
	}
}
else if(isset($_GET['recip']))
{
	//We get the username for the recipient if available
	$orecip = $_GET['recip'];
}
if($form)
{
//We display a message if necessary
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
//We display the form
?>
<div class="panel-heading">
	<h3 class="panel-title"> Σύνταξη νέου μηνύματος...</h3></div>
	</div>
	<div class="panel-body">
	 <?php
						//WE CHECK IF THE EVENT ID IS DEFINED
						if(isset($_GET['to']))
						{
						$to = $_GET['to'];
						$user = $_SESSION['username'];
						//WE CHECK IF THE USER EXISTS
						$dn = mysql_query('select * from stakeholders where username="'.$to.'"');
						$userid = mysql_query('select * from corporations where corporation_username="'.$user.'"');
						$useridd = mysql_fetch_array($userid);
						$dnn = mysql_fetch_array($dn);
						$username = htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8');
						$user_id = htmlentities($useridd['corporation_id'], ENT_QUOTES, 'UTF-8');

						if(mysql_num_rows($dn)>0)
						{
						?>	
    <form action="new_pm.php?to=<?php echo $username; ?>" method="post">
	<?php
						}
						}
						else
						{
						?>
    <form action="new_pm.php" method="post">	
	<?php
						}
						?>	
			   <div class="form-horizontal">
       	    <div class="form-group">
		Παρακαλώ συμπληρώστε παρακάτω το προς αποστολή μήνυμα...<br /><br />
        <label for="col-md-12 col-xs-12 control-label">Τίτλος Θέματος</label>
		<div class="col-md-12 col-xs-12">
			<div class="input-group">
		<input type="text" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" id="title" class="form-control" name="title" />
		</div></div></div>
		 <div class="form-group">
		<label for="col-md-12 col-xs-12 control-label">Παραλήπτης<span class="small">(ΑΡΜΟΔΙΟ ΚΕΠ)</span></label>
		<div class="col-md-12 col-xs-12">
			<div class="input-group">	
                        <?php
						//WE CHECK IF THE EVENT ID IS DEFINED
						if(isset($_GET['to']))
						{
						$to = $_GET['to'];
						$user = $_SESSION['username'];
						$userid = mysql_query('select * from corporations where corporation_username="'.$user.'"');
						$useridd = mysql_fetch_array($userid);
						
						//WE CHECK IF THE USER EXISTS
						$dn = mysql_query('select * from stakeholders where username="'.$to.'"');
						$dnn = mysql_fetch_array($dn);
						$username = htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8');
					    $user_id = htmlentities($useridd['corporation_username'], ENT_QUOTES, 'UTF-8');
						if(mysql_num_rows($userid)>0)
						{
						?>				
		                <input type="text" name="recip" id="recip" value="<?php echo $username; ?>" class="form-control" />
						<?php
						}
						else
						{
						?>
					<input type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" id="recip" class="form-control" name="recip" />                                       
		             <?php
				    }} else {
					?>
					<input type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" id="recip" class="form-control" name="recip" />                                       
						 <?php
				    }
					?>	
		</div>
		</div>
		</div>
		 <div class="form-group">
		 <label for="col-md-12 col-xs-12 control-label">Μήνυμα</label>
		 <div class="col-md-12 col-xs-12">
			<div class="input-group">
		 <textarea cols="40" rows="5" id="message" name="message"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea><br />
        </div>
		</div>
		</div>
		</div>
		<br></br>
			<div class="panel-footer">
		<input type="submit" value="Αποστολή" />
		 </div><!-- END: DIV.PANEL-FOOTER--> 
              </div><!-- END: DIV.PANEL-BODY--> 
    </form>
<?php
}
}
else
{
	echo '<div class="message">Πρέπει να είστε συνδεδεμένοι στον λογαριασμό σας για να έχετε πρόσβαση σε αυτήν την σελίδα.</div>';
}
?>
		<div class="foot"><a href="list_pm.php">Επιστροφή στα προσωπικά μου μηνύματα</a></div>


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
				   Το έργο με τίτλο <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Like Today</span> από τον δημιουργό<span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Λουκά Τριανταφυλλόπουλο</span> διατίθεται με την άδεια <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Αναφορά Δημιουργού-Μη Εμπορική Χρήση-Όχι Παράγωγα Έργα 4.0 Διεθνές 
				   </a>.
		           </div><!-- END: DIV.FOOTER-CONTENT -->  
			 </div><!-- END: DIV.FOOTER-INNER -->  
		</div><!-- END: DIV.FOOTER -->  
</div><!-- END: DIV.PAGE-CONTAINER -->  
</body>
</html>
            	
