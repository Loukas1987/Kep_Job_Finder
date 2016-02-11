 <div class="page-sidebar" style="position:fixed">
                <!-- START LT_SIDEBAR -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                    <a href="index.php">ΚΕΠ Job Finder</a>
                    <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                    <div class="profile">
                        <div class="profile-image">
					    <!-- CONDITION FOR PROFILE IMAGE BY REGISTERED-UNREGISTERED USER -->
                              <?php if(!isset($_SESSION['username']))
							  {
							  echo "<img src='upload/default.png' title='Άγνωστος Χρήστης' alt='Άγνωστος Χρήστης'>";
							  } 
							  ?>
							  <?php if(isset($_SESSION['username']))
							  {
							  $user = $_SESSION['username'];
							  $check = mysql_query("SELECT * FROM users WHERE username='$user'");
				           	  $check1 = mysql_query("SELECT * FROM corporations WHERE corporation_username='$user'");
                                        while ($row = mysql_fetch_assoc($check))
							            {
										echo '<img src="'.$row['image_src'].'" title="Άγνωστος Χρήστης" alt="Άγνωστος Χρήστης">';
										
										}
                                        while ($row = mysql_fetch_array($check1))
							            {
                                        echo '<img src="'.$row['corporation_image'].'"/>';
										}
						      } 
							  ?>
                        <!-- END:CONDITION FOR PROFILE IMAGE BY REGISTERED-UNREGISTERED USER -->                                
					    </div><!-- END: DIV.PROFILE-IMAGE -->  
                        <div class="profile-data">
                             <div class="profile-data-name">
					         <!-- CONDITION FOR DISPLAY NAME IF REGISTERED USER -->
					           <?php if(isset($_SESSION['username']))
					           {
					           echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');
							   } 
							   ?>
					         <!-- END:CONDITION FOR DISPLAY NAME IF REGISTERED USER -->
		                     </div><!-- END: DIV.PROFILE-DATA-NAME -->  
                             <div class="profile-data-title">
					         <!-- CONDITION FOR DISPLAY NAME IF UNREGISTERED USER -->
					           <?php if(!isset($_SESSION['username']))
                               {
							   ?>
						       Επισκέπτης / Άγνωστος Χρήστης 
							   <?php
                               }
                               ?> 
                             <!-- END:CONDITION FOR DISPLAY NAME IF UNREGISTERED USER -->	
					         <!-- CONDITION FOR DISPLAY OCCUPATION IF REGISTERED USER -->
                              <?php if(isset($_SESSION['username']))
							  {
							  $user = $_SESSION['username'];
							  $check = mysql_query("SELECT email FROM users WHERE username='$user'");
							  $check1 = mysql_query("SELECT * FROM corporations WHERE corporation_username='$user'");
                              while ($row = mysql_fetch_assoc($check))
							  {
							  echo $row['email'];
						      } 
							  while ($row = mysql_fetch_assoc($check1))
							  {
							  echo "Α.Φ.Μ.:".$row['corporation_afm'];
						      } 
							  }
							  ?>
					         <!-- END:CONDITION FOR DISPLAY OCCUPATION IF REGISTERED USER -->
                   
                             </div><!-- END: DIV.PROFILE-DATA-TITLE -->  
                        </div><!-- END: DIV.PROFILE-DATA -->            
                    </div> <!-- END: DIV.PROFILE -->                                                                         
                    </li>
					<!-- START SIDEBAR_MENU_BUTTONS -->
		            <li>
                    <a href="index.php"><span class="fa fa-home"></span> <span class="xn-text">Αρχική Σελίδα</span></a>                        
                    </li>
                    <!-- SIDEBAR_MENU_BUTTONS ONLY FOR REGISTERED USERS-->
					<?php if(isset($_SESSION['username']))
					{
				    $user = $_SESSION['username'];
					$users_feed = mysql_query("SELECT * FROM users WHERE username='$user'");
					$corporations_feed = mysql_query("SELECT corporation_id FROM corporations WHERE corporation_username='$user'");
		            $kep_feed = mysql_query("SELECT * FROM kep WHERE kep_user='$user'");

					$check12 = mysql_fetch_array($check1);
					$google= $check12['corporation_id'];
					$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
					$req3 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, all_members.id as userid, all_members.username from pm as m1, pm as m2,all_members where ((m1.user1="'.$google.'" and m1.user1read="no" and all_members.id=m1.user2) or (m1.user2="'.$google.'" and m1.user2read="no" and all_members.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
                    $req2 = mysql_query("SELECT corporation_name,corporation_afm,corporation_image,unix_timestamp(time_req) FROM notifications WHERE seen=0 AND username='$user'");

					
					if(mysql_num_rows($users_feed) == 1){
					?>
                    <li><a href="citizen_edit_infos.php"><span class="fa fa-pencil"></span> <span class="xn-text">Επεξεργασία Προσωπικών Δεδομένων</span></a></li>
					<?php
					}
                    else if (mysql_num_rows($corporations_feed) == 1){
					?>
                    <li><a href="corporation_edit_infos.php"><span class="fa fa-pencil"></span> <span class="xn-text">Επεξεργασία Προσωπικών Δεδομένων</span></a></li>
					<li><a href="workers_request.php"><span class="fa fa-users"></span> <span class="xn-text">Αίτηση Προσωπικού</span></a></li>					
					<li><a href="workers_request_state.php"><span class="fa fa-spinner"></span> <span class="xn-text">Εξέλιξη αιτήσεων</span></a></li>										
					<?php
                    }
					else if (mysql_num_rows($kep_feed) == 1){
					?>
               <li><a href="map_of_corporations.php"><span class="fa fa-map-marker"></span> <span class="xn-text">Χαρτογράφηση όλων των Επιχειρήσεων</span></a></li>
               <li><a href="map_of_users.php"><span class="fa fa-map-marker"></span> <span class="xn-text">Χαρτογράφηση όλων των Χρηστών</span></a></li>
               <li class="xn-title"><center><span class="fa fa-cog"></span> Ρυθμίσεις</center></li>
               <li><a href="kep_edit_infos.php"><span class="fa fa-check-square-o"></span> <span class="xn-text">Επεξεργασία Δεδομένων</span></a></li>
         <?php 
      		 }
			}
					else
					{
					?>
                    <li><a href="contact.php"><span class="fa fa-phone-square"></span> <span class="xn-text">Επικοινωνία</span></a></li>
					<?php
					}
                    ?>                
                </ul>
              <!-- END X-NAVIGATION -->
    </div><!-- END: DIV.PAGE-SIDEBAR --> 