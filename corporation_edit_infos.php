<?php
include('config.php');
?>	
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<title>ΚΕΠ Job Finder - Λίστα Προσωπικών Μηνυμάτων </title>
       	<link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
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
	                                                         if(isset($_POST['name'],$_POST['lastname'],$_POST['education'],$_POST['occupation'],$_POST['bio'],$_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'],$_POST['image_src']))
	                                                         {
		                                                     //We remove slashes depending on the configuration
		                                                          if(get_magic_quotes_gpc())
		                                                          {
		                                                           $_POST['name'] = stripslashes($_POST['name']);
		                                                           $_POST['lastname'] = stripslashes($_POST['lastname']);
																   $_POST['education'] = stripslashes($_POST['education']);
		                                                           $_POST['occupation'] = stripslashes($_POST['occupation']);
		                                                           $_POST['bio'] = stripslashes($_POST['bio']);
		                                                           $_POST['username'] = stripslashes($_POST['username']);
		                                                           $_POST['password'] = stripslashes($_POST['password']);
		                                                           $_POST['passverif'] = stripslashes($_POST['passverif']);
		                                                           $_POST['email'] = stripslashes($_POST['email']);
		                                                           $_POST['image_src'] = stripslashes($_POST['image_src']);
		                                                           }
		                                                           //We check if the two passwords are identical
		                                                           if($_POST['password']==$_POST['passverif'])
		                                                           {
			                                                       //We check if the password has 6 or more characters
			                                                             if(strlen($_POST['password'])>=6)
			                                                             {
				                                                          //We check if the email form is valid
				                                                           if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
				                                                           {
					                                                        //We protect the variables	
				                                                             $name = mysql_real_escape_string($_POST['name']);
				                                                             $lastname = mysql_real_escape_string($_POST['lastname']);
																	         $education = mysql_real_escape_string($_POST['education']);
				                                                             $occupation = mysql_real_escape_string($_POST['occupation']);
				                                                             $bio = mysql_real_escape_string($_POST['bio']);
				                                                             $username = mysql_real_escape_string($_POST['username']);
				                                                             $password = mysql_real_escape_string($_POST['password']);
				                                                             $email = mysql_real_escape_string($_POST['email']);
			                                                                 $image_src = mysql_real_escape_string($_POST['image_src']);
				
					                                                        //We check if there is no other user using the same username
					                                                         $dn = mysql_fetch_array(mysql_query('select count(*) as nb from users where username="'.$username.'"'));
					                                                          //We check if the username changed and if it is available
					                                                                if($dn['nb']==0 or $_POST['username']==$_SESSION['username'])
					                                                                {
						                                                            //We edit the user informations
						                                                                 if(mysql_query('update users set name="'.$name.'",lastname="'.$lastname.'",education="'.$education.'",occupation="'.$occupation.'",bio="'.$bio.'",username="'.$username.'", password="'.$password.'", email="'.$email.'", image_src="'.$image_src.'" where username="'.$_SESSION['username'].'"'))
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
                                                                                             $message = 'Το Όνομα Χρήστη, το οποίο επιθυμείτε να χρησιμοποιήσετε δεν είναι διαθέσιμο.Παρακαλώ επίλεξτε κάτι άλλο.';
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
                                                                       if(isset($_POST['name'],$_POST['lastname'],$_POST['education'],$_POST['occupation'],$_POST['bio'],$_POST['username'],$_POST['password'],$_POST['email'],$_POST['image_src']))
                                                                      {
                                                                      $username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
                                                                            if($_POST['password']==$_POST['passverif'])
                                                                            {
                                                                            $password = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');
                                                                            }
                                                                            else
                                                                            {
                                                                            $password = '';
                                                                            }
		                                                                    $email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
                                                                        }
                                                                        else
                                                                       {
                        //otherwise, we display the values of the database
                        $dnn = mysql_fetch_array(mysql_query('select * from users where username="'.$_SESSION['username'].'"'));
                        $name = htmlentities($dnn['name'], ENT_QUOTES, 'UTF-8');
						$lastname = htmlentities($dnn['lastname'], ENT_QUOTES, 'UTF-8');
						$education = htmlentities($dnn['education'], ENT_QUOTES, 'UTF-8');
						$occupation = htmlentities($dnn['occupation'], ENT_QUOTES, 'UTF-8');
						$bio = htmlentities($dnn['bio'], ENT_QUOTES, 'UTF-8');
						$username = htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8');
                        $password = htmlentities($dnn['password'], ENT_QUOTES, 'UTF-8');
                        $email = htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8');
						$image_src = htmlentities($dnn['image_src'], ENT_QUOTES, 'UTF-8');
    }
    //We display the form
?>

   <form class="form-group" action="citizen_edit_infos.php" method="post">
	   <div class="form-horizontal">
       	    <div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="name">Όνομα</label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input type="text" name="name" id="name" value="<?php echo $name; ?>" class="form-control" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
			<div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="lastname">Επώνυμο</label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" class="form-control" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
			<div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="education">Εκπαίδευση</label>
			<div class="col-md-6 col-xs-12">
			 <div class="input-group">
			<select name="education">
			<option <?php if ($education == "1" ) echo 'selected' ; ?>  value="1">Απολυτήριο Δημοτικού</option>
			<option <?php if ($education == "2" ) echo 'selected' ; ?> value="2">Απολυτήριο Λυκείου</option>
			<option <?php if ($education == "3" ) echo 'selected' ; ?> value="3">Φοιτητής</option>
			<option <?php if ($education == "4" ) echo 'selected' ; ?> value="4">Πτυχιούχος ΠΕ</option>
			<option <?php if ($education == "5" ) echo 'selected' ; ?> value="5">Πτυχιούχος ΤΕ</option>
			 <option <?php if ($education == "6" ) echo 'selected' ; ?> value="6">Κάτοχος Μεταπτυχιακού</option>                                                             
			 <option <?php if ($education == "7" ) echo 'selected' ; ?> value="7">Κάτοχος Διδακτορικού</option>
			 </select>
			</div>
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
			<div class="form-group">
			<label class="col-md-3 col-xs-12 control-label" for="occupation">Επαγγελματική Κατάσταση</label>
					<div class="col-md-6 col-xs-12">
						<div class="input-group">
						<select name="occupation">
						<option <?php if ($occupation == "1" ) echo 'selected' ; ?> value="1">Άνεργος</option>
						<option <?php if ($occupation == "2" ) echo 'selected' ; ?> value="2">Μισθωτός</option>
						<option <?php if ($occupation == "3" ) echo 'selected' ; ?> value="3">Ελεύθερος Επαγγελματίας</option>
						 <option <?php if ($occupation == "4" ) echo 'selected' ; ?> value="4"> Συνταξιούχος</option>
						 </select>
						</div><!-- END: DIV.INPUT-GROUP -->
					</div><!-- END: DIV.col-md-6 col-xs-12 -->
			</div><!-- END: DIV.FORM-GROUP-->
			<div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="bio">Βιογραφικό</label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
		    <textarea name="bio" id="bio" rows="5" cols="40"><?php echo $bio; ?></textarea>
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
			 <div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="username">Όνομα Χρήστη</label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input type="text" name="username" id="username" value="<?php echo $username; ?>" class="form-control" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
			<div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="password">Κωδικός Πρόσβασης<span class="small">(6 χαρακτήρες τουλάχιστον)</span></label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input class="form-control" type="password" name="password" id="password" value="<?php echo $password; ?>" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
            <div class="form-group">			
            <label class="col-md-3 col-xs-12 control-label" for="passverif">Κωδικός Πρόσβασης<span class="small">(επιβεβαίωση)</span></label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input class="form-control" type="password" name="passverif" id="passverif" value="<?php echo $password; ?>" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
            <div class="form-group">
			<label class="col-md-3 col-xs-12 control-label" for="email">Email</label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
           <div class="form-group">
            <label class="col-md-3 col-xs-12 control-label" for="image_src">Εικόνα Προφίλ</label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
            <input type="text" class="form-control" name="image_src" id="file" value="<?php echo $image_src; ?>" />
			</div><!-- END: DIV.FORM-GROUP --> 
			</div><!-- END: DIV.col-md-6 col-xs-12 --> 
			</div><!-- END: DIV.INPUT-GROUP --> 
			<div class="form-group">
			<label class="col-md-3 col-xs-12 control-label" for="image_src">Προεπισκόπηση Εικόνας Προφίλ</label>
			<div class="col-md-6 col-xs-12">
			<div class="input-group">
			<img src="<?php echo $image_src; ?>" width="100px" height="100px" />
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
        