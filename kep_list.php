<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ Job Finder-Συμβεβλημένα ΚΕΠ</title>
  	<link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"/>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>		
	    <script src="https://templates.juliomarquez.co/social/assets/js/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.1/jquery.slimscroll.min.js"></script>
		<script src="https://templates.juliomarquez.co/social/assets/js/sidebar.js"></script>
		
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<style type="text/css" class="init">
	
	div.dataTables_wrapper {
		margin-bottom: 3em;
	}

	</style>

</head>

<body>
<script type="text/javascript" class="init">
	jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
$(document).ready(function() {
	$('table.display').DataTable();
} );

	</script>

	<script>

$(document).ready(function() {
	$(".x-navigation-control").click(function(){
        $(this).parents(".x-navigation").toggleClass("x-navigation-open");
        
        onresize();
        
        return false;
    });

})

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
                                    <h3 class="panel-title"><strong>Όλα τα συμβεβλημένα </strong> ΚΕΠ </h3>
                                    </div>
									<div class="panel-body">
                                    <p>Στην Σελίδα αυτή έχετε την δυνατότητα να δείτε όλα τα συμβεβλημένα ΚΕΠ...</p>
									</p>
                                </div>
								<div class="panel-body">
								 <?php	
                    if(isset($_SESSION['username'])){
					$user = $_SESSION['username'];
					$check1 = mysql_query("SELECT * FROM kep WHERE kep_user='$user'");
					$check2 = mysql_query("SELECT * FROM kep");
					if(mysql_fetch_assoc($check1)>0)
					{
					?>
								  
  <table id="users_list" class="display">
    <thead>
      <tr>
        <th>ID</th>
        <th>ΔΗΜΟΥ</th>
        <th>ΝΟΜΟΥ</th>
        <th>ΔΙΕΥΘΥΝΣΗ</th>
        <th>ΤΗΛΕΦΩΝΟ ΕΠΙΚΟΙΝΩΝΙΑΣ</th>

		</tr>
    </thead>
	 <tbody>
								<?php
//We display the list of unread messages
while($dn = mysql_fetch_array($check2))
{
?>
 
 <tr class="clickable-row" data-href="profile?id=<?php echo htmlentities($dn['id'], ENT_QUOTES, 'UTF-8'); ?>">
 <td><span class="name" style="min-width: 20px; display: inline-block;">
 <?php echo htmlentities($dn['id'], ENT_QUOTES, 'UTF-8'); ?></span></td>
 <td><?php echo htmlentities($dn['Dimos'], ENT_QUOTES, 'UTF-8'); ?></td> 
 <td><span class="name" style="min-width: 160px; display: inline-block;"><?php echo htmlentities($dn['Nomos'], ENT_QUOTES, 'UTF-8'); ?></span></td>
 <td><span class=""><?php echo htmlentities($dn['Address'], ENT_QUOTES, 'UTF-8'); ?></span></td>
 <td><span class="badge"><?php echo htmlentities($dn['Telephone'], ENT_QUOTES, 'UTF-8'); ?></span><td> 
</tr>
<?php
}
?>
 </tbody>
								
								</table>
								<?php
								}
								else 
								{
								if(mysql_fetch_assoc($check2)==0)
								{
								echo "<center><b>Δεν έχετε πρόσβαση σε αυτήν την σελίδα!</b></center>";
								}
								else 
								{
							    echo "<center><b>Δεν έχετε πρόσβαση σε αυτήν την σελίδα!</b></center>";

								}
								}
								}
								else
								{ 
								 ?>
								<center><b>Δεν έχετε πρόσβαση σε αυτήν την σελίδα!</b></center>
								<?php
								}
								 ?>
								</div>
	</div></div></div>
	</body>
	
</html>

		