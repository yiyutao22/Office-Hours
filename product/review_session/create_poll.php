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
	
include '../config/config.php'; 
?>
<?php 
$class = $_SESSION['course'];
$course_id = mysqli_fetch_array(mysqli_query($con,"select course_id from course where name='$class'"))[0];// 
$role = mysqli_fetch_array(mysqli_query($con,"select role from role_detail join course on course.course_id = role_detail.course_id where name = '$class'"));
$role = $role['role'];
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Create Poll</title>
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

h1{margin:15px 0 45px 0;}
#role{
	margin-top:-30px;
	margin-bottom: 20px;
	margin-left: -9px;
	font-size: 17px;}
@media (max-width: 1120px) {
.feature-content{margin-left:-50px;}
#go_back{margin-left:-50px !important;}
}
@media (max-width: 700px) {
.feature-content{margin-left:-95px;}
#go_back{margin-left:-95px !important; margin-top:10px !important;}
.feature-content h1{font-size:22px;}
.feature-content legend{font-size:19px;}
.feature-content input[type="submit"]{width:90px; font-size:15px; text-align:left; padding: 12px 19px 12px 19px;}
}
</style>

</head>
<body>

	<div class="wrapper">
<!-- content of sidebar -->
		<nav id="sidebar" style="margin-top: 20px;">
				<div class="sidebar-content">
		  		<?php 
				if(!empty($photo_name)){
		  		echo "<img class='profile_photo' src='$url'>";}
		  		else{
		  		echo "<img class='profile_photo' src='../images/profile_photo/user1_profile_photo02.jpg'>";};
		  		?>
		  		<center><p id='role'><?php echo strtoupper($role); ?></p></center>
	        <ul class="components">
	          <li>
            	<a href="https://cgi.luddy.indiana.edu/~team63/Dashboard/Dashboard.php" class="top-link"><i class="fas fa-arrow-circle-left"></i>Back To Homepage</a>
              </li>
	          <li class="active">
	            <a href="#" class="dropdown-toggle" id="courseMenu"><i class="fas fa-book-medical"></i>Course</a>
	            <ul class="collapse" id="homeSubmenu">
                <?php
                  while($row = mysqli_fetch_array($course)) {$course_lst[] = $row['name'];}
                  foreach ($course_lst as $key => $value){
                    echo "<form action='../display_OHSchedule/final_schedule.php' method='POST'>";
                    echo "<li><input type='hidden' name='course_lst' value='$value'>\n";
                    echo "<a href='' onclick='document.forms[$key].submit();return false;'>$value</a></li>";
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
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/review_session/review_session_tchr.php' style='color:#f8b739; fonr-weight:800;'><i class='fas fa-book-reader'></i>Review Session Poll</a>";
            	  echo "</li>";
              }
              if ($role == "student"){
            	  echo "<li>";
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/review_session/review_session_st.php' style='color:#f8b739; fonr-weight:800;'><i class='fas fa-book-reader'></i>Review Session Poll</a>";
            	  echo "</li>";
              };
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
    <script src="../style/js/app.js"></script>
            <!-- calendar ends above -->
    
	        
			<form action="../IU_Login/logout.php">
       		<a href="https://idp.login.iu.edu/idp/profile/cas/logout"><button class="btn" id="logout" type="submit">Log out</button></a>
        	<a href="mailto:IUcapstoneTeam63@gmail.com" class="contact-links"><button class="btn" id="contact" type="button">Contact</button></a>
        	</form>
        	
        	
	        <div class="footer">
	        	<p>Copyright &copy; 2021 Team63. All Right Reserved</p>
	        </div>
	
	      </div>
    	</nav>
       
       
    <!-- Page Content  --> 
      <div id="content">
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
          
<a href="javascript:history.go(-1)"><button class="btn" id='go_back' type="submit" style="margin: 0 0 20px 24px;">Go Back</button></a>
<form action="#" method="post" id="update" name="update" onsubmit="return validate()">        
<div class="feature-content">

<center><h1>Create A New Review Session Poll for <?php echo $class; ?></h1></center>

<fieldset>
<legend>Poll Title</legend>
<input type="text" style="font-size:17px;" name="poll_title" required>
</fieldset>

<fieldset>
<legend>Description</legend>
<textarea name="description" id="description" style="font-size:17px;" cols="40" rows="7" maxlength="250" spellcheck="true" form="update"></textarea>
</fieldset>

<fieldset>
<!-- select time range with checkbox and time picker -->
<legend>Select Time Slots</legend>
		<div class = "weekday_lst">
        <label style="font-size:18px;"><input style="margin-right:10px;" type="checkbox" id="weekday" name="weekday[]" value="Monday">Monday</label>
        <div style="margin:10px; padding: 15px;">
        <label>Starts at:</label>
        <input type="time" id="start" name="start1" min="09:00" placeholder="Example: 09:00">
        <label style="display:inline-block; ">Ends at:</label>
        <input type="time" id="end" name="end1" max="19:00" placeholder="Example: 19:00">
        </div>
        </div>

        <div class = "weekday_lst">
        <label style="font-size:18px;"><input style="margin-right:10px;" type="checkbox" id="weekday" name="weekday[]" value="Tuesday">Tuesday</label>
        <div style="margin:10px; padding: 15px;">
        <label>Starts at:</label>
        <input type="time" id="start" name="start2" min="09:00" placeholder="Example: 09:00">
        <label style="display:inline-block;">Ends at:</label>
        <input type="time" id="end" name="end2" max="19:00" placeholder="Example: 19:00">
        </div>
        </div>

        <div class = "weekday_lst">
        <label style="font-size:18px;"><input style="margin-right:10px;" type="checkbox" id="weekday" name="weekday[]" value="Wednesday">Wednesday</label>
        <div style="margin:10px; padding: 15px;">
        <label>Starts at:</label>
        <input type="time" id="start" name="start3" min="09:00" placeholder="Example: 09:00">
        <label style="display:inline-block; ">Ends at:</label>
        <input type="time" id="end" name="end3" max="19:00" placeholder="Example: 19:00">
        </div>
        </div>

        <div class = "weekday_lst">
        <label style="font-size:18px;"><input style="margin-right:10px;" type="checkbox" id="weekday" name="weekday[]" value="Thursday">Thursday</label>
        <div style="margin:10px; padding: 15px;">
        <label>Starts at:</label>
        <input type="time" id="start" name="start4" min="09:00" placeholder="Example: 09:00">
        <label style="display:inline-block; ">Ends at:</label>
        <input type="time" id="end" name="end4" max="19:00" placeholder="Example: 19:00">
        </div>
        </div>

        <div class = "weekday_lst">
        <label style="font-size:18px;"><input style="margin-right:10px;" type="checkbox" id="weekday" name="weekday[]" value="Friday">Friday</label>
        <div style="margin:10px; padding: 15px;">
        <label>Starts at:</label>
        <input type="time" id="start" name="start5" min="09:00" placeholder="Example: 09:00">
        <label style="display:inline-block; ">Ends at:</label>
        <input type="time" id="end" name="end5" max="19:00" placeholder="Example: 19:00">
        </div>
        </div>
</fieldset>


<input name="button" type="submit" value="Submit">
</div>
</form>
</div>
</div> 

<script>
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
	// Get Title
	$title = mysqli_real_escape_string($con,$_POST['poll_title']);
	$description = htmlentities($_POST['description']);
	
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
                             review_session (course_id, title, weekday, timeslot, status, description)
                             Values
                             ($course_id, '$title', '$weekday', '$timeslot', 'open', '$description')";
            if(mysqli_query($con, $add_schedule) or die("Query Failed!")){$good = true;};
            }
    }
    if ($good==true){
    	echo 
    	"<script>
    	alert('New poll has been created successfully!');
    	setTimeout(function(){window.location.href='review_session_tchr.php';},777);
    	</script> ";
    } else {
    	echo 
    	"<script>
    	alert('Something went wrong, please try again!');
    	setTimeout(function(){window.location.href='create_poll.php';},777);
    	</script>";
    };
    
    };
    
};  
    
	mysqli_close($con);   
?>
  </body>
</html>  
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
