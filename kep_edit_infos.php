<?php
include('config.php');
?>	
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>ΚΕΠ Job Finder - Επεξεργασία Δεδομένων ΚΕΠ </title>
       	<link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>		
	    <script src="https://templates.juliomarquez.co/social/assets/js/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.1/jquery.slimscroll.min.js"></script>
		
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

	<script type="text/javascript">

function fetch_select(val)
{
   $.ajax({
     type: 'post',
     url: 'fetch_edit_data.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("dimos").innerHTML=response; 
     }
   });
}

</script>


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
			                                                     <div class="panel-heading">
                                                                 <h3 class="panel-title"><strong>Επεξεργασία</strong> Προσωπικών Δεδομένων</h3>
                                                                 </div>
														</div>
									                    <div  class="panel-body">
                                                        <p>Στην Σελίδα αυτή έχετε την δυνατότητα να επεξεργασθείτε τα προσωπικά στοιχεία του λογαριασμού σας, ανάλογα με το πώς εσάς σας διευκολύνει...</p>
                                                        </div>
								                        <div style="text-align:center" class="panel-body">
			                                            <?php
                                                         //We check if the user is logged
                                                         if(isset($_SESSION['username']))
                                                         {
	                                                     //We check if the form has been sent
                                         if(isset($_POST['kep_user'],$_POST['kep_password'],$_POST['address'], $_POST['telephone'],$_POST['email'], $_POST['fax'], $_POST['passverif'] ) and $_POST['kep_user']!='')
	                                                         {
		                                                     //We remove slashes depending on the configuration
		                                                          if(get_magic_quotes_gpc())
		                                                          {
		                                    $_POST['kep_user'] = stripslashes($_POST['kep_user']);
		                                    $_POST['kep_password'] = stripslashes($_POST['kep_password']);
										    $_POST['address'] = stripslashes($_POST['address']);
										    $_POST['telephone'] = stripslashes($_POST['telephone']);
		                                    $_POST['email'] = stripslashes($_POST['email']);
		                                    $_POST['fax'] = stripslashes($_POST['fax']);
		                                    $_POST['passverif'] = stripslashes($_POST['passverif']);
		                                                           }
		                                                           //We check if the two passwords are identical
		                                                           if($_POST['kep_password']==$_POST['passverif'])
		                                                           {
			                                                       //We check if the password has 6 or more characters
			                                                             if(strlen($_POST['kep_password'])>=6)
			                                                             {
				                                                          //We check if the email form is valid
				                                                           if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
				                                                           {
					                                                        //We protect the variables	
				                                  $kep_user = mysql_real_escape_string($_POST['kep_user']);
				                                  $kep_password = mysql_real_escape_string($_POST['kep_password']);
				                                  $address = mysql_real_escape_string($_POST['address']);
				                                  $telephone = mysql_real_escape_string($_POST['telephone']);
				                                  $email = mysql_real_escape_string($_POST['email']);
				                                  $fax = mysql_real_escape_string($_POST['fax']);
				                                  $passverif = mysql_real_escape_string($_POST['passverif']);
				
					                                                        //We check if there is no other user using the same username
					                                                         $dn = mysql_fetch_array(mysql_query('select count(*) as nb from kep where kep_user="'.$kep_user.'"'));
					                                                          //We check if the username changed and if it is available
					                                                                if($dn['nb']==0 or $_POST['kep_user']==$_SESSION['username'])
					                                                                {
						                                                            //We edit the user informations
						                                                                 if(mysql_query('update kep set kep_user="'.$kep_user.'",kep_password="'.$kep_password.'",Address="'.$address.'",Telephone="'.$telephone.'", Email="'.$email.'", Fax="'.$fax.'" where kep_user="'.$_SESSION['username'].'"'))
						                                                                 {
							                                                              //We dont display the form
							                                                               $form = false;
							                                                               //We delete the old sessions so the user need to log again
							                                                                unset($_SESSION['username'], $_SESSION['userid']);
                                                                            ?>
                                                                            <div class="message">Τα δεδομένα σας έχουν ενημερωθεί επιτυχώς. Πρέπει ωστόσο να συνδεθείτε ξανά.<br />
                                                                            <a href="connexion.php">Σύνδεση</a></div>
                                                                            <?php
                                                                                                   }
                                                                                                   else
                                                                                                   {
                                                                                                   //Otherwise, we say that an error occured
                                                                                                   $form = true;
                                                                                                   $message = 'Ένα σφάλμα συνέβη καθώς τροποιήσατε τα προσωπικά σας δεδομένα';
                                                                                                   }
                                                                                                 }
                                                                                             else
                                                                                             {
                                                                                             //Otherwise, we say the username is not available
                                                                                             $form = true;
                                                                                             $message = 'Το Όνομα Χρήστη ΚΕΠ, το οποίο επιθυμείτε να χρησιμοποιήσετε δεν είναι διαθέσιμο.Παρακαλώ επίλεξτε κάτι άλλο.';
                                                                                             }
                                                                                         }
                                                                                         else
                                                                                         {
                                                                                         //Otherwise, we say the email is not valid
                                                                                         $form = true;
                                                                                         $message = 'Το e-mail που χρησιμοποιήσατε δεν είναι έγκυρο.';
                                                                                         }
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                    //Otherwise, we say the password is too short
                                                                                    $form = true;
                                                                                    $message = 'Ο κωδικός σας πρόσβασης πρέπει να αποτελείται από τουλάχιστον 6 χαρακτήρες.';
                                                                                    }
                                                                                }
                                                                                else
                                                                               {
                                                                               //Otherwise, we say the passwords are not identical
                                                                               $form = true;
                                                                               $message = 'Δεν έχετε καταχωρήσει σωστά τον κωδικό επιβεβαίωσης.';
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
                                                                        echo '<strong>'.$message.'</strong>';
                                                                        }
                                                                       //If the form has already been sent, we display the same values
                                         if(isset($_POST['kep_user'],$_POST['kep_password'],$_POST['address'], $_POST['telephone'],$_POST['email'], $_POST['fax'], $_POST['passverif'] ) and $_POST['kep_user']!='')
                                                                      {
                                                                      $kep_user = htmlentities($_POST['kep_user'], ENT_QUOTES, 'UTF-8');
                                                                            if($_POST['kep_password']==$_POST['passverif'])
                                                                            {
                                                                            $kep_password = htmlentities($_POST['kep_password'], ENT_QUOTES, 'UTF-8');
                                                                            }
                                                                            else
                                                                            {
                                                                            $kep_password = '';
                                                                            }
		                                                                    $email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
                                                                        }
                                                                        else
                                                                       {
                        //otherwise, we display the values of the database
                        $dnn = mysql_fetch_array(mysql_query('select * from kep where kep_user="'.$_SESSION['username'].'"'));
                        $kep_user = htmlentities($dnn['kep_user'], ENT_QUOTES, 'UTF-8');
						$kep_password = htmlentities($dnn['kep_password'], ENT_QUOTES, 'UTF-8');
						$address = htmlentities($dnn['Address'], ENT_QUOTES, 'UTF-8');
						$fax = htmlentities($dnn['Fax'], ENT_QUOTES, 'UTF-8');
						$telephone = htmlentities($dnn['Telephone'], ENT_QUOTES, 'UTF-8');
                        $email = htmlentities($dnn['Email'], ENT_QUOTES, 'UTF-8');
    }
    //We display the form
?>

   <form class="form-group" action="kep_edit_infos.php" method="post">
	   <div class="form-horizontal">
       	    <div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="kep user">Όνομασία Χρήστη ΚΕΠ</label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input type="text" name="kep_user" id="kep_user" value="<?php echo $kep_user; ?>" class="form-control" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
			<div class="form-group">
<label class="col-md-3 col-xs-12 control-label" for="address">Διεύθυνση</label>
					<div class="col-md-6 col-xs-12">
						<div class="input-group">
			<input type="text" name="address" id="address" value="<?php echo $address; ?>" class="form-control" />
						</div><!-- END: DIV.INPUT-GROUP -->
					</div><!-- END: DIV.col-md-6 col-xs-12 -->
			</div><!-- END: DIV.FORM-GROUP-->
            <div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="email">E-mail</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                  <div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="telephone">Τηλέφωνο Επικοινωνίας</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="telephone" class="form-control" value="<?php echo $telephone; ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                   <div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="fax">Fax Επικοινωνίας</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="fax" class="form-control" value="<?php echo $fax; ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												<div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="password">Κωδικός Πρόσβασης<span class="small">(6 χαρακτήρες τουλάχιστον)</span></label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input class="form-control" type="password" name="password" id="password" value="<?php echo $kep_password; ?>" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
            <div class="form-group">			
            <label class="col-md-3 col-xs-12 control-label" for="passverif">Κωδικός Πρόσβασης<span class="small">(επιβεβαίωση)</span></label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input class="form-control" type="password" name="passverif" id="passverif" value="<?php echo $kep_password; ?>" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
            
											 
		   </div><!-- END: DIV.FORM-HORIZONTAL --> 
			<br></br>
			<div class="panel-footer">
	        <input type="submit" value="Αποθήκευση" />
            </div><!-- END: DIV.PANEL-FOOTER--> 
              </div><!-- END: DIV.PANEL-BODY--> 
             </form>
            <?php
	        }
            }
            else
           {
           ?>
           <div class="message"><i>Για να έχετε πρόσβαση στην σελίδα αυτή θα πρέπει να είστε συνδεδεμένοι στον λογαριασμός σας.</i></div><br /><br />
           <a href="connexion.php" style="color:green">Σύνδεση τώρα</a>
           <?php
           }
           ?>
		    </div><!-- END: DIV.panel panel-default -->  	
		    </div><!-- END: DIV.FORM-HORIZONTAL -->   
            </div><!-- END: DIV.col-md-12 -->   
	        </div><!-- END: DIV.ROW -->  
        </div><!-- END: DIV.PAGE-CONTENT-WRAP -->  			
	</div><!-- END: DIV.PAGE-CONTENT -->  
</div><!-- END: DIV.PAGE-CONTAINER -->  
</body>
</html>
        