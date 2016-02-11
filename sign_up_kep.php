<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ Job Finder - Εγγραφή ΚΕΠ στο σύστημα</title>

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
       document.getElementById("dimos").innerHTML=response; 
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
                                            <h3 class="panel-title"><strong>Εγγραφή </strong> ΚΕΠ</h3>
                                            </div><!-- END: DIV.PANEL-HEADING -->
                                        </div> <!-- END: DIV.PANEL-BODY -->  											
									    <div class="panel-body">
                                        <p>
										<!-- START FORM TO REGISTER NEW MEMBER -->  
									     <?php
                                         //WE CHECK IF THE FORM HAS BEEN SENT
                                         if(isset($_POST['kep_user'],$_POST['kep_password'],$_POST['nomos'],$_POST['dimos'],$_POST['address'], $_POST['telephone'],$_POST['email'], $_POST['fax'], $_POST['passverif'] ) and $_POST['kep_user']!='')
                                        {
	                                       if(get_magic_quotes_gpc())
	                                       {
		                                    $_POST['kep_user'] = stripslashes($_POST['kep_user']);
		                                    $_POST['kep_password'] = stripslashes($_POST['kep_password']);
								            $_POST['nomos'] = stripslashes($_POST['nomos']);
		                                    $_POST['dimos'] = stripslashes($_POST['dimos']);
										    $_POST['address'] = stripslashes($_POST['address']);
										    $_POST['telephone'] = stripslashes($_POST['telephone']);
		                                    $_POST['email'] = stripslashes($_POST['email']);
		                                    $_POST['fax'] = stripslashes($_POST['fax']);
		                                    $_POST['passverif'] = stripslashes($_POST['passverif']);
											}
	                                        //WE CHECK IF THE TWO PASSWORDS ARE IDENTICAL
	                                        if($_POST['kep_password']==$_POST['passverif'])
	                                       {
		                                   //WE CHECK IF THE PASSWORD HAS 6 OR MORE CHARACTERS
		                                      if(strlen($_POST['kep_password'])>=6)
		                                      {
			                                    //WE CHECK IF THE EMAIL FORM IS VALID
			                                    if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
			                                    { 
				                                 //WE PROTECT THE VARIABLES
				                                  $kep_user = mysql_real_escape_string($_POST['kep_user']);
				                                  $kep_password = mysql_real_escape_string($_POST['kep_password']);
												  $nomos = mysql_real_escape_string($_POST['nomos']);
				                                  $dimos = mysql_real_escape_string($_POST['dimos']);
				                                  $address = mysql_real_escape_string($_POST['address']);
				                                  $telephone = mysql_real_escape_string($_POST['telephone']);
				                                  $email = mysql_real_escape_string($_POST['email']);
				                                  $fax = mysql_real_escape_string($_POST['fax']);
				                                  $passverif = mysql_real_escape_string($_POST['passverif']);

				                                  //WE CHECK IF THERE IS NO OTHER USER USING THE SAME USERNAME
				                                  $dn = mysql_num_rows(mysql_query('select Dimos from kep where Dimos="'.$dimos.'"'));
				                                  if($dn==0)
				                                  {
					                              //WE COUNT THE NUMBER OF USERS TO GIVE AN ID TO THIS ONE
					                              $dn2 = mysql_num_rows(mysql_query('select id from kep'));
					                              $id = $dn2+1;
					                              //WE SAVE THE INFORMATIONS TO THE DATABASE 
					                                  if(mysql_query('insert into kep(id,kep_user,kep_password,Dimos,Nomos,Address,Telephone,Email,Fax,signup_date) values ('.$id.', "'.$kep_user.'","'.$kep_password.'","'.$dimos.'","'.$nomos.'","'.$address.'","'.$telephone.'","'.$email.'","'.$fax.'","'.time().'")'))
					                                 {
						                             //WE DONT DISPLAY THE FORM
						                             $form = false;
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
					                                   $message = 'Είτε το Όνομα Χρήστη δεν είναι διαθέσιμο είτε το ΚΕΠ του Δήμου αυτού έχει ήδη εγγραφεί!';
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
									 
                                     <form action="sign_up_kep.php" method="post">
                                      Παρακαλούμε συμπληρώστε τα ακόλουθα στοιχεία για να συνδεθείτε:<br /><br />
                                          <div class="form-horizontal">
	                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label" for="kep user">Όνομασία Χρήστη ΚΕΠ</label>
			                                           <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
                                                            <input type="text" name="kep_user" class="form-control" value="<?php if(isset($_POST['kep_user'])){echo htmlentities($_POST['kep_user'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                    <div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="nomos">Νομός Τοποθεσίας</label>
			                                            <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
                                                       <select name="nomos" id="nomos" onchange="fetch_select(this.value);">
                                                      <option value='' disabled='' selected=''>
                                                                    Επιλέξτε Νομό Διαμονής
                                                                         </option>
																		  <?php
             $host = 'localhost';
             $user = 'root';
             $pass = '';
           
             mysql_connect($host, $user, $pass);

             mysql_select_db('kep_new');
           
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
												<label class="col-md-3 col-xs-12 control-label" for="dimos">Δήμος Τοποθεσίας</label>
			                                            <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
                                                      <select id="dimos" name="dimos" >
                                                                    </select>
			                                                </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												 <div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="address">Διεύθυνση</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="address" class="form-control" value="<?php if(isset($_POST['address'])){echo htmlentities($_POST['address'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
												<div class="form-group">
			                                    <label class="col-md-3 col-xs-12 control-label" for="kep_password">Κωδικός Πρόσβασης<span class="small">(6 χαρακτήρες ελάχιστο)</span></label>
			                                        <div class="col-md-6 col-xs-12">
			                                                <div class="input-group">
	                                                        <input type="password" class="form-control" name="kep_password" />
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
												<label class="col-md-3 col-xs-12 control-label" for="telephone">Τηλέφωνο Επικοινωνίας</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="telephone" class="form-control" value="<?php if(isset($_POST['telephone'])){echo htmlentities($_POST['telephone'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
			                                   <div class="form-group">
												<label class="col-md-3 col-xs-12 control-label" for="fax">Fax Επικοινωνίας</label>
												    <div class="col-md-6 col-xs-12">
			                                               <div class="input-group">
			                                               <input type="text" name="fax" class="form-control" value="<?php if(isset($_POST['fax'])){echo htmlentities($_POST['fax'], ENT_QUOTES, 'UTF-8');} ?>" />
			                                               </div><!-- END: DIV.INPUT-GROUP -->
			                                            </div><!-- END: DIV.col-md-6 col-xs-12 -->
			                                    </div><!-- END: DIV.FORM-GROUP-->
											  <div class="panel-footer">
			                                    <input type="submit" value="Καταχώρηση ΚΕΠ " />
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