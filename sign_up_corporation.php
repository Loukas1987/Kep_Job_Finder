<?php
include('config.php');
error_reporting(E_ALL);
         ini_set("display_errors", 1); 
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ-Νέα Εγγραφή Επιχείρησης</title>

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
                                            <h3 class="panel-title"><strong>Εγγραφή </strong>νέας Επιχείρησης!</h3>
                                            </div><!-- END: DIV.PANEL-HEADING -->
                                        </div> <!-- END: DIV.PANEL-BODY -->  											
									    <div class="panel-body">
                                        <p>
										<!-- START FORM TO REGISTER NEW MEMBER -->  
									     <?php
                                         //WE CHECK IF THE FORM HAS BEEN SENT
                                         if(isset($_POST['corporation_name'],$_POST['corporation_afm'],$_POST['corporation_working_sector'],$_POST['corporation_doy'],$_POST['corporation_telephone'],$_POST['corporation_fax'],$_POST['corporation_email'], $_POST['corporation_username'], $_POST['corporation_password'], $_POST['corporation_passverif'], $_POST['corporation_image'] ) and $_POST['corporation_username']!='')
                                        {
	                                       if(get_magic_quotes_gpc())
	                                       {
		                                    $_POST['corporation_name'] = stripslashes($_POST['corporation_name']);
		                                    $_POST['corporation_afm'] = stripslashes($_POST['corporation_afm']);
		                                    $_POST['corporation_working_sector'] = stripslashes($_POST['corporation_working_sector']);
										    $_POST['corporation_doy'] = stripslashes($_POST['corporation_doy']);
										    $_POST['corporation_telephone'] = stripslashes($_POST['corporation_telephone']);
										    $_POST['corporation_fax'] = stripslashes($_POST['corporation_fax']);
		                                    $_POST['corporation_email'] = stripslashes($_POST['corporation_email']);											
		                                    $_POST['corporation_username'] = stripslashes($_POST['corporation_username']);
		                                    $_POST['corporation_password'] = stripslashes($_POST['corporation_password']);
		                                    $_POST['corporation_passverif'] = stripslashes($_POST['corporation_passverif']);
											}
	                                        //WE CHECK IF THE TWO PASSWORDS ARE IDENTICAL
	                                        if($_POST['corporation_password']==$_POST['corporation_passverif'])
	                                       {
		                                   //WE CHECK IF THE PASSWORD HAS 6 OR MORE CHARACTERS
		                                      if(strlen($_POST['corporation_password'])>=6)
		                                      {
			                                    //WE CHECK IF THE EMAIL FORM IS VALID
			                                    if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['corporation_email']))
			                                    { 
				                                 //WE PROTECT THE VARIABLES
				                                  $corporation_name = mysql_real_escape_string($_POST['corporation_name']);
				                                  $corporation_afm = mysql_real_escape_string($_POST['corporation_afm']);
				                                  $corporation_working_sector = mysql_real_escape_string($_POST['corporation_working_sector']);
				                                  $corporation_doy = mysql_real_escape_string($_POST['corporation_doy']);
				                                  $corporation_telephone = mysql_real_escape_string($_POST['corporation_telephone']);												  
				                                  $corporation_fax = mysql_real_escape_string($_POST['corporation_fax']);
											      $corporation_email = mysql_real_escape_string($_POST['corporation_email']);
				                                  $corporation_username = mysql_real_escape_string($_POST['corporation_username']);
				                                  $corporation_password = mysql_real_escape_string($_POST['corporation_password']);
				                                  $corporation_image = mysql_real_escape_string($_POST['corporation_image']);


				                                  //WE CHECK IF THERE IS NO OTHER USER USING THE SAME USERNAME
				                                  $dn = mysql_num_rows(mysql_query("SELECT * FROM corporations WHERE corporation_username='".$corporation_username."'"));
				                                  if($dn==0)
				                                  {
					                              //WE COUNT THE NUMBER OF USERS TO GIVE AN ID TO THIS ONE
					                              $dn2 = mysql_num_rows(mysql_query("SELECT * FROM corporations"));
					                              $id = $dn2+1;
					                              //WE SAVE THE INFORMATIONS TO THE DATABASE 
																								  
					                                  if(mysql_query('insert into corporations(corporation_name,corporation_afm,corporation_working_sector,corporation_doy,corporation_telephone, corporation_fax,corporation_email, corporation_username, corporation_password,corporation_image) values ("'.$corporation_name.'","'.$corporation_afm.'","'.$corporation_working_sector.'","'.$corporation_doy.'","'.$corporation_telephone.'","'.$corporation_fax.'","'.$corporation_email.'","'.$corporation_username.'", "'.$corporation_password.'", "'.$corporation_image.'")'))
					                                 {

						                             //WE DONT DISPLAY THE FORM
						                             $form = false;
													 mysql_query('insert into all_members(username,type) values ("'.$corporation_username.'","corporation")');
											?>
                                                 <div class="message">H επιχείρησή σας έχει καταχωρηθεί επιτυχώς. Μπορείτε πλέον να συνδεθείτε.<br />
                                                 <a href="connexion.php">Σύνδεση</a>
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
									 
                                     <form action="sign_up_corporation.php" method="post">
                                      Παρακαλούμε συμπληρώστε τα ακόλουθα στοιχεία για να συνδεθείτε:<br /><br />
                                          <div class="form-horizontal">
	                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="corporation_name">Επωνυμία Εταιρείας</label>
			                                           <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
                                                            <input type="text" name="corporation_name" class="form-control" value="<?php if(isset($_POST['corporation_name'])){echo htmlentities($_POST['corporation_name'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="afm">Αριθμός Φορολογικού Μητρώου (ΑΦΜ) </label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
                                                            <input type="text" name="corporation_afm" class="form-control" value="<?php if(isset($_POST['corporation_afm'])){echo htmlentities($_POST['corporation_afm'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
													<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="corporation_working_sector">Κλάδος Εργασίας</label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
														 <select name="corporation_working_sector" id="corporation_working_sector">
                                                      <option value='' disabled='' selected=''>
                                                                    Επιλέξτε Οικονομικό Κλάδο
                                                                         </option>
																		  <?php
             $host = 'localhost';
             $user = 'root';
             $pass = '';
           
             mysql_connect($host, $user, $pass);

             mysql_select_db('kep_new');
           
             $select=mysql_query("select Sector_Name from kladoi_ergasia ORDER BY Sector_Name ASC");
             while($row=mysql_fetch_array($select))
             {
			  ?>
             <option value="<?php  echo $row['Sector_Name']; ?>"><?php  echo $row['Sector_Name']; ?></option>
            <?php            
			}
           ?>
         </select>
			                             </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												<div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="corporation_doy">Αρμόδια Δ.Ο.Υ.</label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
	                                                  <select name="doy_name" id="doy_name">
                                                      <option value='' disabled='' selected=''>
                                                                    Επιλέξτε Δ.Ο.Υ.
                                                                         </option>
																		  <?php
             $host = 'localhost';
             $user = 'root';
             $pass = '';
           
             mysql_connect($host, $user, $pass);

             mysql_select_db('kep_new');
           
             $select=mysql_query("select doy_name from doy_ellados ORDER BY doy_name ASC");
             while($row=mysql_fetch_array($select))
             {
			  ?>
             <option value="<?php  echo $row['doy_name']; ?>"><?php  echo $row['doy_name']; ?></option>
            <?php            
			}
           ?>
         </select>
			                            			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												 <div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="corporation_telephone">Τηλέφωνο Επικοινωνίας</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="corporation_telephone" class="form-control" value="<?php if(isset($_POST['corporation_telephone'])){echo htmlentities($_POST['corporation_telephone'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP--> 
												<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="corporation_fax">Fax Επιχείρησης</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="corporation_fax" class="form-control" value="<?php if(isset($_POST['corporation_fax'])){echo htmlentities($_POST['corporation_fax'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="corporation_email">E-mail Επικοινωνίας</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="corporation_email" class="form-control" value="<?php if(isset($_POST['corporation_email'])){echo htmlentities($_POST['corporation_email'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												<div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="corporation_username">Όνομα Χρήστη</label>
												        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
															<input type="text" name="corporation_username" class="form-control" value="<?php if(isset($_POST['corporation_username'])){echo htmlentities($_POST['corporation_username'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
			                                    <label class="col-md-3 col-xs-12 control-label" for="corporation_password">Κωδικός Πρόσβασης<span class="small">(6 χαρακτήρες ελάχιστο)</span></label>
			                                        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
	                                                        <input type="password" class="form-control" name="corporation_password" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
			                                    <label class="col-md-3 col-xs-12 control-label" for="corporation_password">Κωδικός Πρόσβασης<span class="small">(επιβεβαίωση κωδικού)</span></label>
			                                        <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
                                                           <input type="password" class="form-control" name="corporation_passverif" />
														   </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="corporation_image">Trademark Επιχείρησης<span class="small"> (URL)</span></label>
			                                        <div class="col-md-6 col-xs-12">
			                                              <div class="input-group">
                                                          <input type="text" class="form-control" name="corporation_image" />
														  </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
	                                            <div class="panel-footer">
			                                    <input type="submit" value="Αποθήκευση" />
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