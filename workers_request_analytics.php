<?php
include('config.php');
?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ΚΕΠ Job Finder-Εξέλιξη Αιτήσεως</title>

      	<link rel="stylesheet" type="text/css" href="css/theme.css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

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
button {
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
ol {
    counter-reset: li; /* Initiate a counter */
    list-style: none; /* Remove default numbering */
    *list-style: decimal; /* Keep using default numbering for IE6/7 */
    font: 15px 'trebuchet MS', 'lucida sans';
    padding: 0;
    margin-bottom: 4em;
    text-shadow: 0 1px 0 rgba(255,255,255,.5);
}
.rectangle-list a{
    position: relative;
    display: block;
    padding: .4em .4em .4em .8em;
    *padding: .4em;
    margin: .5em 0 .5em 2.5em;
    background: #ddd;
    color: #444;
    text-decoration: none;
    transition: all .3s ease-out;   
}

.rectangle-list a:hover{
    background: #eee;
}   

.rectangle-list a:before{
    content: counter(li);
    counter-increment: li;
    position: absolute; 
    left: -2.5em;
    top: 50%;
    margin-top: -1em;
    background: #33414e;
    height: 2em;
    width: 2em;
    line-height: 2em;
    text-align: center;
    font-weight: bold;
	color: white;
}

.rectangle-list a:after{
    position: absolute; 
    content: '';
    border: .5em solid transparent;
    left: -1em;
    top: 50%;
    margin-top: -.5em;
    transition: all .3s ease-out;               
}

.rectangle-list a:hover:after{
    left: -.5em;
    border-left-color: #33414e;             
}

ol ol {
    margin: 0 0 0 2em; /* Add some left margin for inner lists */
}
.accordion {
  width: 100%;
  margin: 30px auto 20px;
  background: #FFF;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}

.accordion .link {
  cursor: pointer;
  display: block;
  padding: 15px 15px 15px 42px;
  color: #4D4D4D;
  font-size: 14px;
  font-weight: 700;
  border-bottom: 1px solid #CCC;
  position: relative;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.accordion li:last-child .link { border-bottom: 0; }

.accordion li i {
  position: absolute;
  top: 16px;
  left: 12px;
  font-size: 18px;
  color: #595959;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.accordion li i.fa-chevron-down {
  right: 12px;
  left: auto;
  font-size: 16px;
}

.accordion li.open .link { color: #b63b4d; }

.accordion li.open i { color: #b63b4d; }

.accordion li.open i.fa-chevron-down {
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}

/**
 * Submenu
 -----------------------------*/


.submenu {
  display: none;
  font-size: 14px;
}

.submenu li { 
border-bottom: 1px solid #4b4a5e;    
list-style: none; }

.submenu a {
  display: block;
  text-decoration: none;
  padding: 12px;
  padding-left: 42px;
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
}

.submenu a:hover {
  background: #b63b4d;
  color: #FFF;
}
</style>
</head>

<body>
<script>
$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordion'), false);
});
	</script>

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

                                        <?php

                                        //WE CHECK IF THE EVENT ID IS DEFINED
                                        if(isset($_GET['id']))
                                        {
	                                    $id = intval($_GET['id']);
	                                    //WE CHECK IF THE EVENT EXISTS
                                        $dn = mysql_query('select * from stakeholders where corp_id_request="'.$id.'"');
	                                            if(mysql_num_rows($dn)>0)
	                                            {
		                                         $dnn = mysql_fetch_array($dn);
		                                         //WE DISPLAY EVENT DATAS
                                        ?>
                                        <h3 class="panel-title"><strong>Καταγεγραμμένη Αίτηση - Υπ. αριθμ. <?php echo htmlentities($dnn['corp_id_request'], ENT_QUOTES, 'UTF-8'); ?> </h3>
                                        </div><!-- END: DIV.PANEL-HEADING -->  
								</div><!-- END: DIV.PANEL-BODY -->  
								<div class="panel-body">
                                                                                         <div class="col-lg-12 col-md-12">
									                 <div class="tc-tabs">
										             <ul class="nav nav-tabs tab-lg-button tab-color-dark background-dark white">
											         <li class="active"><a href="#p1" data-toggle="tab"><i class="fa fa-desktop bigger-130"></i> Στοιχεία Αιτήσεως</a></li>
										             </ul>
							    			            <div class="tab-content">
											                <div class="tab-pane fade in active" id="p1">
<ul id="accordion" class="accordion">
 <ol class="rectangle-list">
 <?php
//We get the IDs, usernames and emails of users
$req = mysql_query('select corp_id_request,username,unix_timestamp(time_applicant) from stakeholders where corp_id_request="'.$id.'"');
function time_elapsed_B($secs){
                                     $bit = array(
                                     ' χρόνια'        => $secs / 31556926 % 12,
                                     ' εβδομάδες'     => $secs / 604800 % 52,
                                     ' ημέρες'        => $secs / 86400 % 7,
                                     ' ώρες'          => $secs / 3600 % 24,
                                     ' λεπτα'         => $secs / 60 % 60,
                                     ' δευτερόλεπτα'  => $secs % 60
                                     );
									foreach($bit as $k => $v){
                                    if($v > 1)$ret[] = $v . $k ;
                                    if($v == 1)$ret[] = $v . $k;
                                                             }
                                    array_splice($ret, count($ret)-1, 0, 'και');
                                    $ret[] = 'πριν';
                                    return join($ret,' ');
                                    }    
                                    $nowtime = time();
while ($dnn = mysql_fetch_array($req)) {
?>
<li class="dropdown">
 <a href="#" class="link">O χρήστης <?php echo $dnn['username']; ?> εκδήλωσε ενδιαφέρον <?php echo time_elapsed_B($nowtime-$dnn["unix_timestamp(time_applicant)"]); ?> για την αίτησή προσωπικού της επιχείρησής σας.</a> 
	<ul class="submenu">
        <li><a href="new_pm.php?to=<?php echo $dnn['username']; ?>">Επικοινωνήστε μαζί με τον ενδιαφερόμενο!</a></li>
        <li><a href="users.php?id=<?php echo $dnn['username']; ?>">Προφίλ Ενδιαφερόμενου</a></li>
        </ul>
		</li>
		
	<?php
	}
?>
</div>
</ol>
</ul>
																											                                 <div class="clearfix"></div>
												            </div><!-- END: DIV.tab-pane fade in active-->
									                  </div><!-- END: DIV.tab-content-->
									              </div><!-- END: DIV.tc-tabs--> 
								              </div><!-- END: DIV.col-lg-9 col-md-9 --> 
                                              <?php
	                                             }
	                                             else
	                                             {
		                                         echo 'Δεν υπάρχει κανείς ενδιαφερόμενος μέχρι στιγμής.';
												 
												 echo '<button onclick="history.go(-1);">Επιστροφή</button>';

	                                             }
                                               }
                                               else
                                               {
	                                           echo 'Το ID της αιτήσεως αυτής δεν προσδιορίζεται.';
                                               }
                                             ?>
		                        </div><!-- END: DIV.PANEL-BODY--> 
                         </div><!-- END: DIV.panel panel-default -->
									   </div><!-- END: DIV.FORM HORIZONTAL-->
					</div><!-- END: DIV.col-md-12-->
				  </div><!-- END: DIV.ROW-->
			</div><!-- END: DIV.PAGE-CONTENT WRAP-->
	</div><!-- END: DIV.PAGE-CONTENT-->
</div><!-- END: DIV.PAGE-CONTAINER-->
<!-- jQuery if needed -->
		</body>
</html>