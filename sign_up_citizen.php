<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ Job Finder - Εγγραφή Νέου Χρήστη</title>

        <link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
		<script type="text/javascript">

function fetch_select(val)
{
   $.ajax({
     type: 'post',
     url: 'fetch_data.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("dimos_diamonis").innerHTML=response; 
     }
   });
}

</script>

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
a.button {
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
                                            <h3 class="panel-title"><strong>Εγγραφή </strong> νέου Μέλους!</h3>
                                            </div><!-- END: DIV.PANEL-HEADING -->
                                        </div> <!-- END: DIV.PANEL-BODY -->  											
									    <div class="panel-body">
                                        <p>
										<!-- START FORM TO REGISTER NEW MEMBER -->  
									     <?php
                                         //WE CHECK IF THE FORM HAS BEEN SENT
                                         if(isset($_POST['name'],$_POST['lastname'],$_POST['education'],$_POST['occupation'], $_POST['nomos_diamonis'],$_POST['dimos_diamonis'], $_POST['bio'],$_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'],$_POST['image_src'] ) and $_POST['username']!='')
                                        {
	                                       if(get_magic_quotes_gpc())
	                                       {
		                                    $_POST['name'] = stripslashes($_POST['name']);
		                                    $_POST['lastname'] = stripslashes($_POST['lastname']);
								            $_POST['education'] = stripslashes($_POST['education']);
		                                    $_POST['occupation'] = stripslashes($_POST['occupation']);
										    $_POST['nomos_diamonis'] = stripslashes($_POST['nomos_diamonis']);
										    $_POST['dimos_diamonis'] = stripslashes($_POST['dimos_diamonis']);
		                                    $_POST['bio'] = stripslashes($_POST['bio']);
		                                    $_POST['username'] = stripslashes($_POST['username']);
		                                    $_POST['password'] = stripslashes($_POST['password']);
		                                    $_POST['passverif'] = stripslashes($_POST['passverif']);
		                                    $_POST['email'] = stripslashes($_POST['email']);
		                                    $_POST['image_src'] = stripslashes($_POST['image_src']);
											}
	                                        //WE CHECK IF THE TWO PASSWORDS ARE IDENTICAL
	                                        if($_POST['password']==$_POST['passverif'])
	                                       {
		                                   //WE CHECK IF THE PASSWORD HAS 6 OR MORE CHARACTERS
		                                      if(strlen($_POST['password'])>=6)
		                                      {
			                                    //WE CHECK IF THE EMAIL FORM IS VALID
			                                    if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
			                                    { 
				                                 //WE PROTECT THE VARIABLES
				                                  $name = mysql_real_escape_string($_POST['name']);
				                                  $lastname = mysql_real_escape_string($_POST['lastname']);
												  $education = mysql_real_escape_string($_POST['education']);
				                                  $occupation = mysql_real_escape_string($_POST['occupation']);
				                                  $nomos_diamonis = mysql_real_escape_string($_POST['nomos_diamonis']);
				                                  $dimos_diamonis = mysql_real_escape_string($_POST['dimos_diamonis']);
				                                  $bio = mysql_real_escape_string($_POST['bio']);
				                                  $username = mysql_real_escape_string($_POST['username']);
				                                  $password = mysql_real_escape_string($_POST['password']);
				                                  $email = mysql_real_escape_string($_POST['email']);
			                                      $image_src = mysql_real_escape_string($_POST['image_src']);

				                                  //WE CHECK IF THERE IS NO OTHER USER USING THE SAME USERNAME
				                                  $dn = mysql_num_rows(mysql_query('select id from users where username="'.$username.'"'));
				                                  if($dn==0)
				                                  {
					                              //WE COUNT THE NUMBER OF USERS TO GIVE AN ID TO THIS ONE
					                              $dn2 = mysql_num_rows(mysql_query('select id from users'));
					                              $id = $dn2+1;
					                              //WE SAVE THE INFORMATIONS TO THE DATABASE 
					                                  if(mysql_query('insert into users(id,name,lastname,education,occupation,dimos,nomos,bio,username,password,email,signup_date,image_src) values ('.$id.', "'.$name.'","'.$lastname.'","'.$education.'","'.$occupation.'","'.$dimos_diamonis.'","'.$nomos_diamonis.'","'.$bio.'","'.$username.'", "'.$password.'", "'.$email.'", "'.time().'","'.$image_src.'")'))
					                                 {
						                             //WE DONT DISPLAY THE FORM
						                             $form = false;
													 mysql_query('insert into all_members(username,type) values ("'.$username.'","user")');

											?>
                                                 <div class="message">Έχετε εγγραφεί επιτυχώς. Μπορείτε πλέον να συνδεθείτε.<br />
												 <a href="connexion.php" class="button">Σύνδεση</a>

												 </div><!-- END: DIV.MESSAGE -->
                                            <?php
					                        }
					                                 else
					                                 {
						                              //OTHERWISE,WE SAY THAT AN ERROR OCCURED
						                              $form = true;
						                              $message = 'Ένα σφάλμα συνέβη κατά την εγγραφή σας';
					                                 }
				                                  }
				                                else
				                                        {
					                                    //OTHERWISE, SEEMS THAT USERNAME IS NOT AVAILABLE
					                                    $form = true;
					                                   $message = 'Το Όνομα Χρήστη το οποίο θέλετε να χρησιμοποιήσετε δεν είναι διαθέσιμο, παρακαλώ επιλέξτε διαφορετικό.';
				                                       }
			                                    }
			                                    else
			                                    {
				                                 //OTHERWISE, WE SAY THAT THE EMAIL IS NOT VALID
				                                $form = true;
				                                $message = 'Το email που έχετε εισάγει δεν είναι έγκυρο.';
			                                    }
		                                    }
		                                    else
		                                   {
			                                //OTHERWISE, WE SAY THAT THE PASSWORD IS TOO SHORT
			                                $form = true;
			                                $message = 'Ο κωδικός πρόσβασης πρέπει να αποτελείται τουλάχιστον από 6 χαρακτήρες.';
		                                   }
	                                    }
	                                    else
	                                    {
		                                //OTHERWISE, WE SAY THAT THA PASSWORDS ARE NOT IDENTICAL
		                                 $form = true;
		                                 $message = 'O κωδικός πρόσβασης και ο κωδικός επιβεβαίωσης διαφέρουν. Προσπαθήστε πάλι';
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
									 
                                     <form action="sign_up_citizen.php" method="post">
                                      Παρακαλούμε συμπληρώστε τα ακόλουθα στοιχεία για να συνδεθείτε:<br /><br />
                                          <div class="form-horizontal">
	                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="name">Όνομα</label>
			                                           <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
                                                            <input type="text" name="name" class="form-control" value="<?php if(isset($_POST['name'])){echo htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="lastname">Επώνυμο</label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
                                                            <input type="text" name="lastname" class="form-control" value="<?php if(isset($_POST['lastname'])){echo htmlentities($_POST['lastname'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="education">Εκπαίδευση</label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
															<select name="education">
															<option value="Απολυτήριο Δημοτικού">Απολυτήριο Δημοτικού</option>
                                                            <option value="Απολυτήριο Λυκείου">Απολυτήριο Λυκείου</option>
                                                            <option value="Φοιτητής">Φοιτητής</option>
                                                            <option value="Πτυχιούχος ΠΕ">Πτυχιούχος ΠΕ</option>
															<option value="Πτυχιούχος ΤΕ">Πτυχιούχος ΤΕ</option>
                                                             <option value="Κάτοχος Μεταπτυχιακού">Κάτοχος Μεταπτυχιακού</option>                                                             
															 <option value="Κάτοχος Διδακτορικού">Κάτοχος Διδακτορικού</option>
                                                             </select>
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												
												<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="occupation">Επαγγελματική Κατάσταση</label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
															<select name="occupation">
                                                            <option value="Άνεργος">Άνεργος</option>
                                                            <option value="Μισθωτός">Μισθωτός</option>
                                                            <option value="Ελεύθερος Επαγγελματίας">Ελεύθερος Επαγγελματίας</option>
                                                             <option value="Συνταξιούχος">Συνταξιούχος</option>
                                                             </select>
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="nomos_diamonis">Νομός Διαμονής</label>
			                                            <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
                                                       <select name="nomos_diamonis" id="nomos_diamonis" onchange="fetch_select(this.value);">
                                                      <option value='' disabled='' selected=''>
                                                                    Επιλέξτε Νομό Διαμονής
                                                                         </option>
																		  <?php
             $host = 'localhost';
             $user = 'root';
             $pass = '';
           
             $con = mysql_connect($host, $user, $pass);
              mysql_select_db("kep_new", $con) or die(mysql_error());
			 mysql_query("SET NAMES 'utf8'", $con);
           
             $select=mysql_query("select nomos from dimoi_ellados group by nomos ORDER BY nomos ASC");
             while($row=mysql_fetch_array($select))
             {
			  ?>
             <option value="<?php  echo $row['nomos']; ?>"><?php  echo $row['nomos']; ?></option>
            <?php            
			}
           ?>
         </select>
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="dimos_diamonis">Δήμος Διαμονής</label>
			                                            <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
                                                      <select id="dimos_diamonis" name="dimos_diamonis" >
                                                                    </select>
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="bio">Βιογραφικό Χρήστη</label>
			                                            <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
															<textarea name="bio" rows="5" cols="40"></textarea>
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="username">Όνομα Χρήστη</label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
															<input type="text" name="username" class="form-control" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
			                                    <label class="col-md-3 col-xs-12 control-label" for="password">Κωδικός Πρόσβασης<span class="small">(6 χαρακτήρες ελάχιστο)</span></label>
			                                        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
	                                                        <input type="password" class="form-control" name="password" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
			                                    <label class="col-md-3 col-xs-12 control-label" for="password">Κωδικός Πρόσβασης<span class="small">(επιβεβαίωση κωδικού)</span></label>
			                                        <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
                                                           <input type="password" class="form-control" name="passverif" />
														   </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="email">E-mail</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="email" class="form-control" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="image_src">Εικόνα Προφίλ<span class="small"> (URL)</span></label>
			                                        <div class="col-md-6 col-xs-12">
			                                              <div class="input-group">
                                                          <input type="text" class="form-control" name="image_src" />
														  </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
	                                            <div class="panel-footer">
			                                    <input type="submit" value="Αίτηση Κλειδαρίθμου" />
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