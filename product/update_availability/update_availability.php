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
include '../config/config.php';
//include 'config/config.php';
$class = $_SESSION['course'];
$course_id = mysqli_fetch_array(mysqli_query($con,"select course_id from course where name='$class'"))[0];
$role = mysqli_fetch_array(mysqli_query($con,"select role from role_detail join course on course.course_id = role_detail.course_id where name = '$class'"));
$role = $role['role'];
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Update Availability</title>
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

<!-- sidebar styles -->	
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

<!-- availability timeslots table styles -->
  <style>

.container {
  position: relative;
  max-width: 1000px;
  transform: translate(0%, 0%);
}

table {
  margin: 0 auto;
  width: 800px;
  border-collapse: collapse;
  overflow: hidden; 
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  border-radius: 15px;
}

th,
td {
  font-size: 15px;
  padding: 20px;
  background-color: rgba(255, 255, 255, 0.2);
  color: #7a040e;
}
th {
  text-align: left;
}

thead th {
  background-color: rgba(66, 90, 89, 1);
  color: white;
  font-size: 20px;
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
#profile_btn{
	position: relative;
	display: inline-block;
	padding: 9px 19px 9px 19px;
	color: #FFF;
	margin: 0 auto;
	background: rgba(26, 188, 156, .9);
	font-size: 14px;
	text-align: center;
	width: 250px;
	border: 1px solid #16a085;
	border-width: 1px 1px 3px;
	font-weight: 700;
	margin-top: 20px;
	}
#profile_btn:hover
	{
	background: #109177;
	}
#role{
	margin-top:-30px;
	margin-bottom: 20px;
	margin-left: -9px;
	font-size: 17px;}
.message{
 font-size:24px; 
 margin-top: 50px;}
.message{
	position: relative;
	margin: 0 auto;
	margin-top: 70px;
	margin-bottom: 80px;
	max-width: 880px;
	background-color: rgba(255,255,255, 0.75);
	padding: 20px 18px;
	padding-bottom: 0;
	border-radius: 16px;
    box-shadow:	0 0.125rem 0.5rem rgba(0, 0, 0, .3), 0 0.0625rem 0.125rem rgba(0, 0, 0, .2);
}
.message::before {
	content: '';
	position: absolute;
	width: 0;
	height: 0;
	bottom: 100%;
	left: 50px;
	border: 20px solid transparent;
	border-top: none;
	border-bottom-color: rgba(255,255,255, 0.9);
	filter: drop-shadow(0 -0.0625rem 0.0625rem rgba(0, 0, 0, .1));
}

@media (max-width: 1120px) {
.container{margin-top:50px;}
.message{transform:scale(0.8);margin:150px 0 0 -40px;}
}
@media (max-width: 850px) {
.container{margin-top:50px;}
}
@media (max-width: 700px) {
.container p{font-size:13px !important; width:220px;}
.message{margin:150px -115px 0 -20px;}
.message p {text-align:left;width:200px;}
#profile_btn{width:190px;font-size:13px;}
#content {padding-right:0 !important;}
}

</style>
</head>

<body>

	<div class="wrapper">
<!-- side bar content -->
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
              <?php 
              if ($role == "ta" or $role == "instructor"){
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/update_availability/update_availability.php' style='color:#f8b739; fonr-weight:800;'><i class='fas fa-user-clock'></i>Update Availability</a>";
              }
              if ($role == "student"){
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/make_appointment/make_appointment.php' style='color:#f8b739; fonr-weight:800;'><i class='fas fa-calendar-check'></i>Make Appointment</a>";
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

<!-- submit button action -->
<form action="#" method="post" name='resubmit'>     
<div class='container'>

<?php
// check if user has submitted before
if (mysqli_num_rows(mysqli_query($con,"SELECT * FROM finalized_OHschedule where ta_id = $uid and course_id = '$course_id'")) == 0){
echo "<p style='font-size:18px;'>(Choose Up to 10 Time Slots)</p>
<p style='font-size:18px;'>(Each Time Slot has 3 TAs MAX)</p>";

//select data used in table from sql
$result = mysqli_query($con,"SELECT distinct weekday FROM schedule where course_id='$course_id'");	
while($row = mysqli_fetch_array($result)) {
   $result_weekday[] = $row['weekday'];
}

$result2 = mysqli_query($con,"SELECT distinct timeslot FROM schedule where course_id = '$course_id'");	
while($row = mysqli_fetch_array($result2)) {
   $result_timeslot[] = $row['timeslot'];
}
//build table
	echo "<table>";
	
	echo "<thead>";
	echo "<tr>";
	foreach ($result_weekday as $key => $weekday){
	echo "<th><center>$weekday</center></th>";}
	echo "</tr>";
	echo "</thead>";
//put available availabilities into table	
	echo "<tbody>";
	foreach ($result_timeslot as $key => $timeslot){
	$new_timeslot = date("g:i a", strtotime($timeslot));
	echo "<tr>";
	foreach ($result_weekday as $key => $weekday){
	$sql2 = "SELECT schedule_id FROM schedule WHERE weekday = '$weekday' and timeslot = '$timeslot' and course_id='$course_id'";
	$s_id = (int)mysqli_fetch_row(mysqli_query($con, $sql2))[0];
	$num_records = mysqli_num_rows(mysqli_query($con, "select * from finalized_OHschedule where schedule_id='$s_id' and course_id='$course_id'"));
	// use if condition to adjust the style 
	$r = ($s_id <= 0) ? 'display:none' : '';
	// if the time slots are filled with 3 Tas, make checkbox disabled and display full message
	$s = ($num_records >= 3) ? 'disabled' : '';
	$m = ($num_records >= 3) ? 'FULL' : '';
	echo "<td data-th='$weekday'><input type='checkbox' id='timeslot' name='timeslot[]' value='$s_id'";
	echo "style='".$r."'";
	echo $s.">";
	if ($s_id > 0){echo $new_timeslot.' ';}
	if($num_records >= 3){echo '<b> '.$m; echo'</b>';}
	}
	echo "</td>";
	echo "</tr>";}	
	echo "</tbody>";
	echo "</table>";

echo "<center>";
echo "<input id='profile_btn' type='submit' value='submit' name='submit'>";
echo "</center>";
} 
else {
		// display message if user already has time slots assigned
		echo "<div class='message'>";
		echo "<center><p>You have already submitted your availability information! </p></center>";
		echo "<center>";
		echo "<input type='hidden' name='re-submit' value= $uid>";
		// add change submission subfeature
		echo "<input id='profile_btn' type='submit' value='Update Your Availability' name='resubmit' onClick='confirm_message();' style='margin-top:0; margin-bottom:20px;'>";
		echo "</center>";
		echo "</div>";
};
?>
<?php

if (isset($_POST['timeslot'])){
$good = false;
$checkbox1 = $_POST['timeslot'];  
foreach($checkbox1 as $key=>$chk1)  {  
	$chk = mysqli_real_escape_string($con, $chk1); 
	$sql = "INSERT INTO finalized_OHschedule(schedule_id, ta_id, course_id)VALUES('$chk','$uid', '$course_id')";
	if (mysqli_query($con,$sql))
	{
	$good = true;
	}
}; 

if ($good==true){
echo 
    	"<script>
    	alert('Update Successfully');
    	setTimeout(function(){window.location.href='update_availability.php';},777);
    	</script>";
};
};

// if user needs to update the informatiom 
if(isset($_POST['resubmit'])) {
	$pt = $_POST['re-submit'];
	mysqli_query($con,"delete from finalized_OHschedule where course_id = $course_id and ta_id = $uid") or die("Error: " . mysqli_error($con));
	echo "<script>setTimeout(function(){window.location.href='update_availability.php';},0);</script>";
}

$con->close();
?>
	</div>

</form>
    </div>	
    </div>
    
<script>
// limit the number of checkboxes user can select(number of slots one TA can sign up)
$('input[type=checkbox]').on('change', function (e) {
    if ($('input[type=checkbox]:checked').length > 10) {
        $(this).prop('checked', false);
    }
});

function confirm_message(){
var answer = confirm('This will delete all your previous records, are you sure?');
if(answer){
resubmit.submit();
}
else{
alert('Cancel the action!');
event.preventDefault();
}
}
</script>
</body>
</html>