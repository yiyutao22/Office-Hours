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
	
// include configuration file
include '../config/config.php'; 
?>


<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Upload Course Information</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/bf37eaf948.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" href="../style/css/nav.css">
	<link rel="stylesheet" href="../style/css/calendar.css">
	<link rel="stylesheet" href="../style/css/form.css">

 <style>
 	html,body
	{
    width: 100%;
    height: 100%;
    margin: 0px;
    padding: 0px;
    overflow-x: hidden; 
	}
 	body{color: black;}
 	ul{list-style-type:none;}
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
    .contact-links{float:right;}
    #sidebar ul li.active > a {color: rgba(255, 255, 255, 0.8);}
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
    height: 20px;}
</style>
<style>
.weekday_lst{
  		margin: 20px 0 20px 0;
	}
.ta_generate{font-size: 15px;}
@media (max-width: 1120px) {
.navbar{width:800px;}
.feature-content{margin-top:-27px; margin-left:-52px;}
}
@media (max-width: 825px) {
.navbar{width:650px; }
}
@media (max-width: 700px) {
.navbar{width:380px; }
.feature-content{margin:50px 120px 0 -90px;}
.feature-content legend{font-size:20px;}
.feature-content input[type="submit"]{width:90px; font-size:15px; text-align:left; padding: 12px 19px 12px 19px;}
}
</style>
  </head>
  <body>
		
	<div class="wrapper">
	    <!-- side navigation menu starts here -->
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
	            <a href="#" class="dropdown-toggle" id="courseMenu"><i class="fas fa-book-medical"></i>Course</a>
	            <ul class="collapse" id="homeSubmenu">
                <?php
                  while($row = mysqli_fetch_array($course)) {$course_lst[] = $row['name'];}
                  foreach ($course_lst as $key => $value){
                    echo "<form action='../display_OHSchedule/final_schedule.php' method='POST'>\n";
                      echo "<li><input type='hidden' name='course_lst' value='$value'>\n";
                    echo "<a href='' onclick='document.forms[$key].submit();return false;'>$value</a> </li>";
                    echo "</form>";
                     
                  };
                ?>
                </ul>
                <script>
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
    	
    	      <li>
            	<a href="https://cgi.luddy.indiana.edu/~team63/Dashboard/Dashboard.php" ><i class="fas fa-bullhorn"></i>Dashboard</a>
              </li>
	          <li>
            	<a href="https://cgi.luddy.indiana.edu/~team63/profile/profile.php" ><i class="fas fa-user-circle"></i>Profile</a>
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
	          <li>
	          <?php 
	          if (in_array('instructor', $all_role)){
              echo "<a href='https://cgi.luddy.indiana.edu/~team63/upload_information/upload_information.php' style='color:#f8b739;'><i class='fas fa-upload'></i>Upload Information</a>";
              echo "<li><a href='https://cgi.luddy.indiana.edu/~team63/Visualization/Visualization.php'><i class='fas fa-chart-line'></i>Visualization</a></li>";  
              }
              ?>
              </li>
	          
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
	        
			<form action="../IU_Login/logout.php">
       		<a href="https://idp.login.iu.edu/idp/profile/cas/logout"><button class="btn" id="logout" type="submit">Log out</button></a>
        	<a href="mailto:IUcapstoneTeam63@gmail.com" class="contact-links"><button class="btn" id="contact" type="button">Contact</button></a>
        	</form>
        	
        	
	        <div class="footer">
	        	<p>Copyright &copy; 2021 Team63. All Right Reserved</p>
	        </div>
	
	      </div>
    	</nav>
    	<!-- side navigation menu ends here -->
    	<script>
          function menuFunction() {
            var x = document.getElementById("sidebar");
            if (x.style.display === "none") {
              x.style.display = "block";
            }else {
              x.style.display = "none";
            }
          }
          </script>
       
       
    <!-- Page Content  --> 
      <div id="content">
      	<!-- top header -->
        <nav class="navbar" style="margin-top: -27px;">
          <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn" onclick="menuFunction()">
              <i class="fa fa-bars"></i>
              <span>Menu</span>
            </button> 
            <img class="logo" src="../images/IULogo.png" alt="iu logo">
            <p class="title">Office Hours +</p>  
          </div>
          <p class="quote">"An investment in knowledge pays the best interest."</p>  
        </nav>  
	

<!-- main section -->
<div class="feature-content">
<form method="post" action="#" onsubmit="return validate()">
<fieldset>
<legend><span class="number">1</span> Course Name</legend>
<!-- use dropdown list to select -->
<select name='course' required>
<option style="display:none;"></option>
<?php
$course2 = mysqli_query($con,"SELECT name from course JOIN enrollment_details ON enrollment_details.course_id = course.course_id WHERE user_id = '$uid' and role = 'instructor' ORDER BY name");
while($row = mysqli_fetch_array($course2)) {$course_lst2[] = $row['name'];}
foreach ($course_lst2 as $key => $value){echo '<option value="'.$value.'">'.$value.'</option>';}
?>
</select>
</fieldset>

<fieldset>
<legend><span class="number">2</span> Semester Term</legend>
<select name='semester' required>
<option style="display:none;"></option>
<?php
$semester = mysqli_query($con,"select term from semester");
while($row = mysqli_fetch_array($semester)) {$semester_lst[] = $row['term'];}
foreach ($semester_lst as $key => $value){echo '<option value="'.$value.'">'.$value.'</option>';}
?>
</select>
</fieldset>

<fieldset>
<!-- dynamiclly generate input fields by the number user type  -->
<legend><span class="number">3</span> Enter TA Information</legend>
<label style="font-size:16px; margin-top:5px;">How many TAs does this course have?</label>
<input type="text" id="ta" name="ta" style="margin-bottom:11px;">
<a href="#" class="ta_generate" onclick="addinputFields()">Generate</a>
<div id="container"></div>
</fieldset>

<fieldset>
<!-- select time range with checkbox and time picker -->
<legend><span class="number">4</span> Select Time Slots</legend>
		<div class = "weekday_lst">
        <label style="font-size:18px;"><input style="margin-right:10px;" type="checkbox" id="weekday" name="weekday[]" value="Monday">Monday</label>
        <div style="margin:10px; padding: 15px;">
        <label>Starts at:</label>
        <input type="time" id="start" name="start1" min="08:00" max="13:00" placeholder="Example:08:00">
        <label style="display:inline-block; ">Ends at:</label>
        <input type="time" id="end" name="end1" min="16:00" max="21:00" placeholder="Example:16:00">
        </div>
        </div>

        <div class = "weekday_lst">
        <label style="font-size:18px;"><input style="margin-right:10px;" type="checkbox" id="weekday" name="weekday[]" value="Tuesday">Tuesday</label>
        <div style="margin:10px; padding: 15px;">
        <label>Starts at:</label>
        <input type="time" id="start" name="start2" min="08:00" max="13:00" placeholder="Example: 08:00">
        <label style="display:inline-block;">Ends at:</label>
        <input type="time" id="end" name="end2" min="16:00" max="21:00" placeholder="Example: 16:00">
        </div>
        </div>

        <div class = "weekday_lst">
        <label style="font-size:18px;"><input style="margin-right:10px;" type="checkbox" id="weekday" name="weekday[]" value="Wednesday">Wednesday</label>
        <div style="margin:10px; padding: 15px;">
        <label>Starts at:</label>
        <input type="time" id="start" name="start3" min="08:00" max="13:00" placeholder="Example: 08:00">
        <label style="display:inline-block; ">Ends at:</label>
        <input type="time" id="end" name="end3" min="16:00" max="21:00" placeholder="Example: 16:00">
        </div>
        </div>

        <div class = "weekday_lst">
        <label style="font-size:18px;"><input style="margin-right:10px;" type="checkbox" id="weekday" name="weekday[]" value="Thursday">Thursday</label>
        <div style="margin:10px; padding: 15px;">
        <label>Starts at:</label>
        <input type="time" id="start" name="start4" min="08:00" max="13:00" placeholder="Example: 08:00">
        <label style="display:inline-block; ">Ends at:</label>
        <input type="time" id="end" name="end4" min="16:00" max="21:00" placeholder="Example: 16:00">
        </div>
        </div>

        <div class = "weekday_lst">
        <label style="font-size:18px;"><input style="margin-right:10px;" type="checkbox" id="weekday" name="weekday[]" value="Friday">Friday</label>
        <div style="margin:10px; padding: 15px;">
        <label>Starts at:</label>
        <input type="time" id="start" name="start5" min="08:00" max="13:00" placeholder="Example: 08:00">
        <label style="display:inline-block; ">Ends at:</label>
        <input type="time" id="end" name="end5" min="16:00" max="21:00" placeholder="Example: 16:00">
        </div>
        </div>
</fieldset>

<input name="button" type="submit" value="Submit">
</form>
</div>
</div>
</div>

<!-- function for input fileds generation -->
<script>
    function addinputFields(){
    var number = document.getElementById("ta").value;

    for (i=0;i<number;i++){
        var input = document.createElement("input");
        input.type = "text";
        input.name = "ta[]";
        input.placeholder = "Example: xxx@iu.edu"
        container.appendChild(input);
        container.appendChild(document.createElement("br"));
    }
}

// for some browsers that time picker not working, add validation to text input 
function validate() {
    var time = document.getElementById("start").value;
    var time2 = document.getElementById("end").value;
    if (!time.match(/^[0-9]{2}:[0-9]{2}$/) || !time2.match(/^[0-9]{2}:[0-9]{2}$/)) {
        alert("Invalide time: data should be in HH:MM format!");
        event.preventDefault();
    }
}
</script>

<?php
	if(isset($_POST['button'])){
	$good = false;
    /* get course and semester information */
    if (!empty($_POST['course'])){
    $course_name = mysqli_real_escape_string($con,$_POST['course']);
    $get_cid = "SELECT course_id FROM course WHERE name = '$course_name'";
    };
        
    if (!empty($_POST['semester'])){
    $semester_term = mysqli_real_escape_string($con,$_POST['semester']);
    $get_sid = "SELECT semester_id FROM semester WHERE term = '$semester_term'";
    };
        

    /* Assign TA role to students */
    $course_id = mysqli_fetch_row(mysqli_query($con, $get_cid))[0];
    $semester_id = mysqli_fetch_row(mysqli_query($con, $get_sid))[0];
    
    
    if ($_POST['ta']) {
        foreach ( $_POST['ta'] as $key => $value ) {
        $ta = mysqli_real_escape_string($con, $value);
        $assign_role = "UPDATE enrollment_details JOIN user ON user.user_id = enrollment_details.user_id
                        SET role = 'ta' 
                        WHERE email = '$ta' AND course_id = '$course_id' AND semester_id = '$semester_id'";
        mysqli_query($con, $assign_role) or die("Query Failed!");
        }
    };
    

    /* Create timeslot array */
    /* source:https://www.codexworld.com/create-time-range-array-php/ */
    function create_time_range($start, $end, $interval = '1 hour', $format = '24') {
        $startTime = strtotime($start); 
        $endTime = strtotime($end);
        $returnTimeFormat = ($format == '24')?'G:i:s':'G:i:s';
    
        $current = time(); 
        $addTime = strtotime('+'.$interval, $current); 
        $diff = $addTime - $current;
    
        $times = array(); 
        while ($startTime < $endTime) { 
            $times[] = date($returnTimeFormat, $startTime); 
            $startTime += $diff; 
        } 
        $times[] = date($returnTimeFormat, $startTime); 
        return $times; 
    };
    
    /* Insert everything into schedule table */
    $weekday_list = array("Monday"=>1,"Tuesday"=>2,"Wednesday"=>3,"Thursday"=>4,"Friday"=>5);
       
    if (!empty($_POST['weekday'])){  
    foreach ($_POST['weekday'] as $key => $value) { 
        $weekday = mysqli_real_escape_string($con, $value); 
        $i = $weekday_list[$weekday];
        $start = mysqli_real_escape_string($con,$_POST['start' . $i]);
        $start = date("G:i:s", strtotime($start));
        $end = mysqli_real_escape_string($con,$_POST['end' . $i]); 
        $end = date("G:i:s", strtotime($end)); 
        $times = create_time_range($start, $end, '1 hour');
        foreach ($times as $key => $value) {
            $timeslot = mysqli_real_escape_string($con, $value);
            $add_schedule = "INSERT INTO 
                             schedule (course_id, semester_id, weekday, timeslot)
                             Values
                             ('$course_id', '$semester_id', '$weekday', '$timeslot')";
            if(mysqli_query($con, $add_schedule) or die("Query Failed!")){$good = true;};
            }
    }
    };
    
    if ($good==true){
    	echo 
    	"<script>
    	alert('Course Information Uploaded Successfully');
    	setTimeout(function(){window.location.href='upload_information.php';},777);
    	</script>";
    } else {
    	echo 
    	"<script>
    	alert('Something went wrong, please try again!');
    	setTimeout(function(){window.location.href='upload_information.php';},777);
    	</script>";
    };
    
};    
	mysqli_close($con);   
?>
  </body>
</html>