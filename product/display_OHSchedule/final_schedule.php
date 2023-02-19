<?php
/* use session to prevent direct access */
session_start();

 if(!isset($_SESSION['user'])){
 	/* display error message and guide user to go back to login page */
 	echo 
            "<script>
            alert('Please login first!');
            setTimeout(function(){window.location.href='https://cgi.luddy.indiana.edu/~team63/IU_Login/officehourPlus.php';},0);
            </script>";
}
?>
<?php 
/*config.php contains all the connection information*/
include '../config/config.php';
/*Get the information needed for the rest coding*/
$class = $_POST['course_lst'];
$role = mysqli_fetch_array(mysqli_query($con,"select role from role_detail join course on course.course_id = role_detail.course_id where name = '$class'"));
$course_id = mysqli_fetch_array(mysqli_query($con,"select course_id from course where name='$class'"))[0];
$role = $role['role'];
$_SESSION['course'] = $class;

?>

<!doctype html>
<html lang="en">
  <head>

    <!--Automatically display the title name of the course page-->
  	<title><?php echo $class; ?></title> 
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
    html,body
	{
    width: 100%;
    height: 100%;
    margin: 0px;
    padding: 0px;
    overflow-x: hidden; 
	}
 	    body{
        color: black;
      }
 	    .logo{
  		  max-width: 60px;
  		  margin-left: 30px;
	    }
	    #sidebar{
		  position: -webkit-sticky;
  		  position: sticky;
  		  height:1000px !important;
  		  top: 0;
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
     	  font-size:11px;}
      .contact-links{
        float:right;
      }
      #sidebar ul li.active > a {
        color: rgba(255, 255, 255, 0.8);
      }
      .quote{
		    margin: 0 auto; 
		    font-size: 17px; 
		    font-weight: bold;
		    width: 620px;
	      color: #7a040e;
	      font-family: cursive;
	    }
	    #logout{
        margin-top:30px;
      }
      #contact{
        margin-top:30px;
      }
      #sidebar i{
        padding-right: 27px;
        width: 20px;
        height: 20px;
      }
      .container {
        position: relative;
        max-width: 1200px;
        transform: translate(0%, 0%);
      }
      table {
        margin: 0 auto;
        width: 1000px;
        border-collapse: collapse;
        overflow: hidden; 
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
      }
      th,
      td {
        font-size: 15px;
        padding-top: 10px;
        background-color: rgba(255, 255, 255, 0.2);
        color: #7a040e;
      }
      ul{
        padding-left: 30px;
      }
      .table_head {
        background-color: rgba(66, 90, 89, 1);
        color: white;
        font-size: 20px;
      }
      tbody td {
        position: relative;
      }
      tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.6);
      }
      tbody th {
        font-size:15px;
      }
      tbody td {
        position: relative;
      }
      tbody td:hover:before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: -9999px;
        bottom: -9999px;
        background-color: rgba(255, 255, 255, 0.6);
        z-index: -1;
      }
      #role{
	      margin-top:-30px;
	      margin-bottom: 20px;
	      margin-left: -9px;
	      font-size: 17px;
      }
      /*Responsive Design*/
      @media (max-width: 1350px) {
        ul{list-style:none;}
      }
      @media (max-width: 1120px) {
	      .container{margin-top:10px;}
	    }
      @media (max-width: 850px) {
	      .container{margin-top:10px;}
	    }
	    @media (max-width: 700px) {
	      h1{font-size:26px;width:200px;}
	    }
    </style>
    <!--Style End-->
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
				<center><p id='role'><?php echo strtoupper($role); ?></p></center>	
	        <ul class="components" style="list-style-type:none;">
	        <li>
            	<a href="https://cgi.luddy.indiana.edu/~team63/Dashboard/Dashboard.php" class="top-link"><i class="fas fa-arrow-circle-left"></i>Back To Homepage</a>
            </li>
	          <li class="active">
	            <a href="#"  class="dropdown-toggle" id="courseMenu"><i class="fas fa-book-medical"></i>Course</a>
	            <ul class="collapse" id="homeSubmenu" style="list-style-type:none;">
                
                <?php
                  /*Show Courses in Database - php sql call*/
                  while($row = mysqli_fetch_array($course)) {$course_lst[] = $row['name'];}
                  foreach ($course_lst as $key => $value){
                    echo "<form action='../display_OHSchedule/final_schedule.php' method='POST'>\n";
                    echo "<li><input type='hidden' name='course_lst' value='$value'>\n";
                    echo "<a href='' onclick='document.forms[$key].submit();return false;'>$value</a></li>";
                    echo "</form>";
                  }
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
              <?php 
              if ($role == "ta" or $role == "instructor"){
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/update_availability/update_availability.php'><i class='fas fa-user-clock'></i>Update Availability</a>";
              }
              if ($role == "student"){
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/make_appointment/make_appointment.php'><i class='fas fa-calendar-check'></i>Make Appointment</a>";
              }
              ?>
            </li>
            <li>
              <?php 
              if ($role == "ta" or $role == "instructor"){
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/TA_shift/TA_substitute.php'><i class='fas fa-people-arrows'></i>Find Substitute</a>";
              }
              ?>
              </li>
            <li>
              <a href="http://cgi.luddy.indiana.edu/~team63/discussion_board/forum_topic.php" class="top-link"><i class="fas fa-comments"></i>Discussion Board</a>
            </li>
	        <?php 
              if ($role == "ta" or $role == "instructor"){
            	  echo "<li>";
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/review_session/review_session_tchr.php' ><i class='fas fa-book-reader'></i>Review Session Poll</a>";
            	  echo "</li>";
              }
              if ($role == "student"){
            	  echo "<li>";
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/review_session/review_session_st.php' ><i class='fas fa-book-reader'></i>Review Session Poll</a>";
            	  echo "</li>";
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
                <!-- <span>Dark Mode</span> -->
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
       	  	<a href="https://idp.login.iu.edu/idp/profile/cas/logout"><button class="btn" id="logout" type="submit">Log out</button></a>
        	  <a href="mailto:IUcapstoneTeam63@gmail.com" class="contact-links"><button class="btn" id="contact" type="button">Contact</button></a>
        	</form>
            
          <!-- Footer -->
	        <div class="footer">
	        	<p>Copyright &copy; 2021 Team63. All Right Reserved</p>
	        </div>
	
	      </div>
    	</nav>
      <!--Sidebar End-->
       
       
      <!-- Top Page Content Start  --> 
      <div id="content" class="p-4 p-md-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-top: -27px;">
          <div class="container-fluid">

            <!--Menu button to hide and show sidebar-->
            <button type="button" id="sidebarCollapse" class="btn btn-primary" onclick = "meanuFunction()">
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
          function meanuFunction(){
            var x = document.getElementById("sidebar");
            if (x.style.display === "none") {
              x.style.display = "block";
            }else {
              x.style.display = "none";
            }
          }
        </script>
      
        <div class='container'>
          <h1><?php echo $class; ?></h1>
          <?php

            /*ORDER BY schedule.schedule_id result*/
            $result = mysqli_query($con,"SELECT distinct weekday FROM finalized_OHschedule JOIN schedule ON schedule.schedule_id = finalized_OHschedule.schedule_id WHERE schedule.course_id = $course_id ORDER BY schedule.schedule_id;");	
            while($row = mysqli_fetch_array($result)) {
              $result_weekday[] = $row['weekday'];
            }

            /*ORDER BY timeslot result*/
            $result2 = mysqli_query($con, "SELECT distinct timeslot FROM finalized_OHschedule JOIN schedule ON schedule.schedule_id = finalized_OHschedule.schedule_id WHERE schedule.course_id = $course_id ORDER BY timeslot;");	
            while($row = mysqli_fetch_array($result2)) {
              $result_timeslot[] = $row['timeslot'];
            }

            /*Table Start*/
            echo "<table>";
		          echo "<thead>";
      	        echo"<tr style='height: 100px;'>";

                /*Table Header*/
	              echo "<th class='table_head' style='width: 100px;'><center>Time</center></th>";
	              foreach ($result_weekday as $key => $weekday){
	                echo "<th class='table_head'><center>$weekday</center></th>";
                }
	              echo "</tr>";
	            echo "<thead>";

            /*Table Body*/
            echo "<tbody>";
            foreach ($result_timeslot as $key => $timeslot){
              $new_timeslot = date("g:i a", strtotime($timeslot));
              echo "<tr>"; 
                echo "<th><center>$new_timeslot</center></th>";
                foreach ($result_weekday as $key => $weekday){
                  $sql2 = "SELECT finalized_OHschedule.schedule_id, CONCAT(fname,' ',lname) AS fullname FROM finalized_OHschedule 
                  JOIN schedule ON finalized_OHschedule.schedule_id = schedule.schedule_id 
                  JOIN user on finalized_OHschedule.ta_id = user.user_id
                  JOIN course ON course.course_id = schedule.course_id
                  WHERE weekday = '$weekday' and timeslot = '$timeslot' and schedule.course_id = $course_id
                  ORDER BY schedule.schedule_id;";
                  $result3 = mysqli_query($con,$sql2);
                  echo "<td data-th='$weekday'>";
                  echo "<ul>";
                  while ($result4 = mysqli_fetch_assoc($result3)){
                    $sid = (int) $result4['schedule_id'];
                    if ($sid > 0){
                      echo "<li>".$result4['fullname'] ."</li>";
                    }
                  }
                  echo "</ul>";
                  echo "</td>";
                }
		            echo "</tr>";}
		            echo "</tbody>";	
		            echo "</table>";
                /*Table End*/
            ?>
          </div>
        </div>
        <!-- Page Content End --> 
	    </div>
  </body>
</html>