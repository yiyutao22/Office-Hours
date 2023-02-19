<?php 
  /*config.php contains all the connection information*/
  include '../config/config.php';
?>
<?php

 if(!isset($_SESSION['user'])){
 	/* display error message and guide user to go back to login page */
 	echo 
            "<script>
            alert('Please login first!');
            setTimeout(function(){window.location.href='https://cgi.luddy.indiana.edu/~team63/IU_Login/officehourPlus.php';},0);
            </script>";
}
?>


<!doctype html>
<html lang="en">
  <head>

  	<title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	  <link rel="preconnect" href="https://fonts.gstatic.com">
	  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src="https://kit.fontawesome.com/bf37eaf948.js" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="../style/css/nav.css">
	  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	  <link rel="stylesheet" href="../style/css/calendar.css">

    <!--Style Start-->
    <style>
    html,body{
    width: 100%;
    height: 100%;
    margin: 0px;
    padding: 0px;
    overflow-x: hidden; 
    }
 	  body{
      color: black; 
    }
    ul{
      list-style-type:none;
    }
 	  .logo{
  		max-width: 60px;
  		margin-left: 30px;
	  }
	  .profile_photo{
		  margin: -20px 0 35px 10px;
		  width: 200px;
		  height: 200px;
		  border-radius: 50%;
	  }
	  .title{
		  font-size: 30px;
		  font-weight: bold;
		  margin: 0 auto;
		  color: #7a040e;
		  margin-left: 15px;
	  }
    .footer{
		  position: absolute; 
     	bottom: 20px; 
     	font-size:11px;
    }
	  #sidebar{
      position: -webkit-sticky;
      position: sticky;
      height:1000px !important;
  	  top: 0;
  	}
    #sidebar i{
      padding-right: 27px;
      width: 20px;
      height: 20px;
    }
    .quote{
		  margin: 0 auto; 
		  font-size: 17px; 
		  font-weight: bold;
		  width: 620px;
		  color: #7a040e;
		  font-family: cursive;
	  }
    .done_msg{
      text-align:center;
      margin: 0 auto; 
		  font-size: 36px;
		  font-weight: bold;
		  width: 720px;
		  color: #7a040e;
		  font-family: cursive;
    }
    #logout{
      margin-top:30px;
    }
    #contact{
      margin-top:30px;
    }
    .contact-links{
      float:right;
    }
    #sidebar ul li.active > a {
      color: rgba(255, 255, 255, 0.8);
    }
    .container{
      position: relative;
      max-width: 1000px;
      transform: translate(0%, 0%);
    }
    table{
      margin: 0 auto;
      width: 920px;
      border-collapse: collapse;
      overflow: hidden; 
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
    }
    table tr:nth-child(even){
      background-color: #f2f2f2;
    }
    tr:nth-child(n + 20) { /*Limit the page to display the first 20 rows of incoming events*/
      display: none;
    }
    table tr:hover {
      background-color: #ddd;
    }
    table th {
      padding: 5px 20px;
      text-align: left;
      font-size:20px;
      background-color: rgba(66, 90, 89, 1);
      color: white;
    }
    table td{
      font-size: 15px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.2);
      color: #7a040e;
    }
    td:nth-child(1){
     text-align:center;
    }
    .tenor-gif-embed{
      background: none; 
      border: none;
      max-width:100%;
      height:auto;
    }
    /*Responsive Design*/
    @media (max-width: 1120px) {
	    .container{margin-top:50px; margin-left:-70px;}
	    .tenor-gif-embed, .done_msg{transform:scale(0.8); margin-left:-120px;}
	    .done_msg{font-size:26px;}
	    td:nth-child(5){display:none;}
	  }
    @media (max-width: 850px) {
	    .container{margin-top:50px;}
	    .done_msg{font-family:"Poppins", Arial, sans-serif; margin-left:-160px; font-size:20px;}
	  }
	  @media (max-width: 700px) {
	    .container{margin-left:-100px;}
	    .done_msg{width:300px;margin-left:-60px;}
	    .tenor-gif-embed{margin-left:-10px;}
	  }
    </style>
    <!--Style end-->
    <!--reference: https://www.sanwebe.com/2014/08/css-html-forms-designs -->
  </head>

  <body>
  <div class="wrapper">
    <!--Sidebar Start-->
		<nav id="sidebar" style="margin-top: 20px;">
				<div class="sidebar-content">
		  		<?php 
				if(!empty($photo_name)){
		  		echo "<img class='profile_photo' src='$url'>";}
		  		else{
		  		echo "<img class='profile_photo' src='../images/profile_photo/user1_profile_photo02.jpg'>";};
		  		?>
	        <ul class="components">
	          <li class="active">
              <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	            <a href="#" class="dropdown-toggle" id="courseMenu"><i class="fas fa-book-medical"></i>Course</a>	            
                <ul class="collapse" id="homeSubmenu">

                <?php
                  /*Show Courses in Database - php sql call*/
                  while($row = mysqli_fetch_array($course)) {$course_lst[] = $row['name'];}
                  foreach ($course_lst as $key => $value){
                    echo "<form action='../display_OHSchedule/final_schedule.php' method='POST'>\n";
                    echo "<li><input type='hidden' name='course_lst' value='$value'>\n";
                    echo "<a href='' onclick='document.forms[$key].submit();return false;'>$value</a></li>";
                    echo "</form>"; 
                  };
                ?>

                </ul>

                <script>
                  /*Show Courses in Database - js functions*/
                  $(document).ready(function(){
    				        $('#courseMenu').click(function(event){
        			        event.stopPropagation();
         			        $("#homeSubmenu").slideToggle();
    				        });
    				        $("#homeSubmenu").on("courseMenu", function (event) {
        			        event.stopPropagation();
    				        });
				          });

				          $(document).on("courseMenu", function () {
    				        $("#homeSubmenu").hide();
				          });
                </script>

	          </li>
            <!--Other Navigation Links-->
    	      <li>
            	<a href="https://cgi.luddy.indiana.edu/~team63/Dashboard/Dashboard.php" class="top-link" style="color:#f8b739; fonr-weight:800;"><i class="fas fa-bullhorn"></i>Dashboard</a>
              </li>
	          <li>
            	<a href="https://cgi.luddy.indiana.edu/~team63/profile/profile.php" class="top-link"><i class="fas fa-user-circle"></i>Profile</a>
			  </li>
	          <li>
	          <?php 
	          if (in_array('student', $all_role)){
	          echo "<a href='https://cgi.luddy.indiana.edu/~team63/My_Appointment/My_Appointment.php'><i class='fas fa-calendar-alt'></i>My Appointment</a>";
	          }
			  ?>
			  </li>
			  <li>
			  <?php 
	          if (in_array('ta', $all_role) or in_array('instructor', $all_role)){
	          echo "<a href='https://cgi.luddy.indiana.edu/~team63/TA_shift/TA_shift.php'><i class='fas fa-users'></i>My Shift</a>";
	          }
	          ?>
              </li>
	          <?php 
	          if (in_array('instructor', $all_role)){
              echo "<li><a href='https://cgi.luddy.indiana.edu/~team63/upload_information/upload_information.php'><i class='fas fa-upload'></i>Upload Information</a></li>";
              echo "<li><a href='https://cgi.luddy.indiana.edu/~team63/Visualization/Visualization.php'><i class='fas fa-chart-line'></i>Visualization</a></li>";
              }
              ?>
    		  </ul>

          <!-- Calendar starts below: -->
	        <div class="calendar">
            <div class="calendar-header">
              <span class="month-picker" id="month-picker">February</span>
              <div class="year-picker">
                <span class="year-change" id="prev-year">
                  <pre><</pre>
                </span>
                <span id="year">2021</span>
                <span class="year-change" id="next-year">
                  <pre>></pre>
                </span>
              </div>
            </div>
            <div class="calendar-body">
              <div class="calendar-week-day">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
              </div>
            <div class="calendar-days"></div>
            </div>

            <div class="calendar-footer">
              <div class="toggle">
                <div class="dark-mode-switch">
                  <div class="dark-mode-switch-ident"></div>
                </div>
              </div>
            </div>
            <div class="month-list"></div>
          </div>
          <!-- calendar ends above -->

          <script src="../style/js/app.js"></script>
          <!-- Log Out Feature -->
			    <form action="../IU_Login/logout.php">
       	  	<a href="https://idp.login.iu.edu/idp/profile/cas/logout"><button class="btn btn-primary" id="logout" type="submit">Log out</button></a>
        	  <a href="mailto:IUcapstoneTeam63@gmail.com" class="contact-links"><button class="btn btn-primary" id="contact" type="button">Contact</button></a>
        	</form>
        	
          <!-- Footer -->
	        <div class="footer">
	        	<p>Copyright &copy; 2021 Team63. All Right Reserved</p>
	        </div>
	      </div>
    	</nav>
      <!--Sidebar End-->
    
       
       
    <!-- Top Page Content Start --> 
      <div id="content">
        <nav class="navbar" style="margin-top: -27px;">
          <div class="container-fluid">

            <!--Menu button to hide and show sidebar-->
            <button type="button" id="sidebarCollapse" class="btn" onclick="menuFunction()">
              <i class="fa fa-bars"></i>
              <span>Menu</span>
            </button> 

            <img class="logo" src="../images/IULogo.png" alt="iu logo">
            <p class="title">Office Hours +</p>  
          </div>
          <p class="quote">"An investment in knowledge pays the best interest."</p>  
        </nav> 

        <script>
        /*show and hide sidebar onclick function*/
          function menuFunction() {
            var x = document.getElementById("sidebar");
            if (x.style.display === "none") {
              x.style.display = "block";
            }else {
              x.style.display = "none";
            }
          }
          </script>
    <!-- Top Page Content End --> 
      
    <!-- Page Content Start --> 
    <?php
      /*Get the time & date when the user access at Indianapolis timezone*/
      date_default_timezone_set("America/Indiana/Indianapolis");
      $date = date('l');
      $time = date("H:i:s",time());
      /*SQL Queries to get the incoming events that the user can join*/
      $result = @mysqli_query($con, "select schedule.schedule_id, course.course_id, ta_id, course.name as course, weekday, timeslot, concat(fname,' ',lname) as TA, building.building_code as building, link, room
      from finalized_OHschedule
      join user on finalized_OHschedule.ta_id = user.user_id
      join schedule on finalized_OHschedule.schedule_id=schedule.schedule_id
      join building on building.building_code=schedule.building_code
      join course on finalized_OHschedule.course_id=course.course_id 
      where course.course_id in (select course.course_id from course join enrollment_details on enrollment_details.course_id = course.course_id where user_id = $uid and role='student') and schedule.weekday = '$date' and schedule.timeslot > '$time'
      order by schedule.timeslot") or die("Error: " . mysqli_error($con));
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <div class='container'>
      <!--Incoming Events Table-->
      <?php 
      if (mysqli_num_rows($result) == 0){
        echo "<p class='done_msg' >No more office hour for today, enjoy your day!</p>"
      ?>
        <p></p>
        <div class="tenor-gif-embed" data-postid="17334647" data-share-method="host" data-width="30%" data-aspect-ratio="1.513677811550152">
        <center><img src="../images/pikachu.gif" alt="pikachu_dancing"></center>
        </div>
      <?php
      }else{
      ?>
      
      <table class="table table-striped table-hover">
      
        <!--Headers-->
        
        <thead>
          <tr>
            <th>Course</th>
            <th>Weekday</th>
            <th>TimeSlot</th>
            <th>TA</th>
            <th>Building</th>
            <th>Join</th>
          </tr>
        </thead>
        
        
        <tbody>
          <?php 
            while($row = mysqli_fetch_assoc($result)) { ?>
              <tbody>
                <tr>
                <?php 
                  /*Display the Imcoming Events Information as Table*/
                  $s_id = $row['schedule_id'];
                  $t_id = $row['ta_id'];
                  $num_records = mysqli_num_rows(mysqli_query($con, "select * from appointment where schedule_id='$s_id' and ta_id = '$t_id'"));
                  $st_info = $row['schedule_id'].' '.$row['ta_id'];
                  if ($num_records < 5){
                    echo "<td data-th='Course'>".$row["course"]."</td>";
                    echo "<td data-th='Weekday'>".$row["weekday"]."</td>";
                    echo "<td data-th='TimeSlot'>".$row["timeslot"]."</td>";
                    echo "<td data-th='TA'>".$row["TA"]."</td>";
                ?> 
<style>
.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}
.button {
  color: #7a040e;
  padding: 10px 25px 10px 25px;
  border: 2px solid #E5DBCF;
  border-radius: 10px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #E6B794;
  color: black;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 55%;
  position: relative;
  transition: all 5s ease-in-out;
  color: #fff;
}

.popup h2 {
  margin-top: 0;
}
.popup .close {
  position: absolute;
  top: 15px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #f8b739; 
}
.popup .link {
  max-height: 45%;
  overflow: auto;
}
@media screen and (max-width: 700px){
  .popup{
    width: 70%;
  }
}
</style>

                    <td data-th='Building'><a class="button" href="#location"><?php echo $row['building']; ?></a></td>
                   	<div id="location" class="overlay">
						<div class="popup">
						<h1>Here i am</h1>
						<a class="close" href="#">&times;</a>
						<div class="link">
						<p style='font-size:16px; color:black; margin-bottom:0'>Room No  :  <?php echo $row['room']; ?></p>
						<iframe src="<?php echo $row['link']; ?>" width="500" height="350" style="border:0;" ></iframe>
						</div>
						</div>
					</div>
                <?php 
                    echo "<td data-th='Join'><center>";
                    echo "<form action='#' method = 'post'>";
                    echo "<button height='20px' width='20px' name='join' value='$st_info'><i class='fas fa-sign-in-alt'></i></button>";
                    echo "</form>";
                  } 
                ?> 
                    </center></td>
              </tr>
            <?php }  ?>  
          <?php }  ?>    
        </tbody>
      </table>

        <?php 
          /*If Join Icon was clicked, it will make the appoitnment for the user*/
          if(isset($_POST['join'])) {
            $info = explode(" ",mysqli_real_escape_string($con,$_POST['join'])); 
			      $sid = $info[0];
			      $tid = $info[1];
            $add_appointment = "insert into appointment (course_id, schedule_id, ta_id, student_id, building_code)
						select schedule.course_id, schedule.schedule_id, ta_id, $uid, building_code from schedule
						join finalized_OHschedule on finalized_OHschedule.schedule_id = schedule.schedule_id
						where schedule.schedule_id = $sid and ta_id = $tid ";
			      if(mysqli_query($con, $add_appointment)){
			        echo 
			        "<script>alert('Appointment Confirmed!');
			        setTimeout(function(){window.location.href='Dashboard.php';},0);
			        </script>";
            };
          }
        ?>
      </div>
    </div>
    <!-- Page Content End --> 
  </div>
    
  </body>
</html>