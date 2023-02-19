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
$course_id = mysqli_fetch_array(mysqli_query($con,"select course_id from course where name='$class'"))[0];
$role = mysqli_fetch_array(mysqli_query($con,"select role from role_detail join course on course.course_id = role_detail.course_id where name = '$class'"));
$role = $role['role'];
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Vote</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/bf37eaf948.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../style/css/nav.css">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" href="../style/css/calendar.css">
	
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

html,
body {
  height: 100%;
}

.container {
  position: relative;
  max-width: 1000px;
  transform: translate(0%, 0%);
}

table{
        margin: 0 auto;
        margin-top:30px;
        width: 770px;
        border-collapse: collapse;
        overflow: hidden; 
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 15px;
      }
    table tr:nth-child(even){background-color: #f2f2f2;}

    table tr:hover {background-color: #ddd;}

    table th {
    padding: 5px 20px;
    text-align: left;
    font-size:20px;
    background-color: rgba(66, 90, 89, 1);
    color: white;

    }
    table td{
        font-size: 16px;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.2);
        color: #7a040e;
    }
#role{
	margin-top:-30px;
	margin-bottom: 20px;
	margin-left: -9px;
	font-size: 17px;}

#profile_btn{
	position: relative;
	display: inline-block;
	color: #FFF;
	margin: 0 auto;
	background: rgba(26, 188, 156, .9);
	font-size: 16px;
	text-align: center;
	width: 160px;
	height: 40px;
	border: 1px solid #16a085;
	border-width: 1px 1px 3px;
	font-weight: 700;
	}
#profile_btn:hover{background: #109177;}
#role{
	margin-top:-30px;
	margin-bottom: 20px;
	margin-left: -9px;
	font-size: 17px;}
h1{margin-top:50px; font-weight:600;}
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
.figure{width:370px; height:auto;}
@font-face {
    font-family: ChalkSerif;
    src: url("../style/fonts/ChalkSerif/ChalkSerif.otf") format("opentype");
}
.message2{
margin-left: 30px;
margin-top: -40px;
width: 500px;
height: 200px;
border-radius: 10px;
border: #b37746 solid 10px;
background-image: url(../images/chalkboard.jpeg);
background-size: cover;
background-repeat: no-repeat;
display: flex;
justify-content: center;
align-items: center;
color: white;
font-family: 'ChalkSerif';
font-size: 62px;
}
@media (max-width: 1120px) {
.no_open{transform:scale(0.7); margin-left:-200px;}
.container h1{margin-top:80px;}
.message{transform:scale(0.8);margin:150px 0 0 -40px;}
}
@media (max-width: 825px) {
.no_open{transform:scale(0.5); margin-left:-260px;}
.container h1{font-size:22px;}
}
@media (max-width: 700px) {
.no_open img{margin: 50px 0 0 220px;}
.container h1{font-size:20px;}
.container p{font-size:14px; width:320px;}
.message{margin:150px -115px 0 -20px;}
.message p {text-align:left;width:200px;}
.message2{position: absolute; margin: -150px 0 50px 320px; width:400px; font-size:50px !important;}
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
          

<div class='container'>
<form action="#" name='resubmit' method="post">
<?php
	// student's view
	// see if there is open poll
	$result = mysqli_query($con,"SELECT distinct title FROM review_session where course_id='$course_id' and status = 'open'");
	if (mysqli_num_rows($result) > 0) {	
		while($row = mysqli_fetch_array($result)) {
   		$result_title[] = $row['title'];
		}

		foreach ($result_title as $key => $title){
		// display poll information
		if (mysqli_num_rows(mysqli_query($con,"SELECT * FROM review_session_poll join review_session on review_session.id = review_session_poll.id where student_id = $uid and title = '$title'")) == 0){
			echo "<h1>$title</h1>";
			echo "<p style='font-size:14px;'>(Choose Up to 5 Time Slots)</p>";
			
			$description = mysqli_fetch_array(mysqli_query($con,"select description from review_session where title= '$title'"))[0];
			
			echo "<p style='font-size:16px; width: 70%; opacity:.75;'>$description</p>";
			
			$result = mysqli_query($con,"select * from review_session where title= '$title'") or die("Error: " . mysqli_error($con));
			echo "<table>";
	
			echo "<thead>";
			echo "<tr>";
			echo "<th>Weekday</th>";
			echo "<th>Timeslot</th>";
			echo "<th>Vote</th>";
			echo "</tr>";
			echo "</thead>";
	
			echo "<tbody>";
			while($row = $result->fetch_assoc()) {
				 echo "<tr><td data-th='Weekday'>".$row['weekday']."</td>";
				 $new_timeslot = date("g:i a", strtotime($row['timeslot']));
				 echo "<td data-th='Timeslot'>".$new_timeslot."</td>";
				 $id = $row['id'];
				 echo "<td data-th='Vote'><input type='checkbox' name='timeslot[]' value=$id style='transform:scale(1.3);'></td>";
				 echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "<center>";
			echo "<input id='profile_btn' type='submit' value='Submit' name='submit' style='margin-top:25px;'>";
			echo "</center>";
		} 
		else {
		// display message if user already voted for the poll
		echo "<div class='message'>";
		echo "<center><p>You have already voted to the <b>$title</b> poll ! </p></center>";
		echo "<center>";
		$key = array_search($title, $result_title); 
		echo "<input type='hidden' name='re-submit$key' value='$title'>";
		// add change vote subfeature
		echo "<input id='profile_btn' type='submit' value='Change Your Vote' name='resubmit$key' onClick='confirm_message();' style='margin-top:0; margin-bottom:20px;'>";
		echo "</center>";
		echo "</div>";
		} 
		} 
	} else {
	// display proper message when there is no open poll 
	echo "<div class='no_open' style='display: flex; margin-top:105px;'>";
	echo "<img class='figure' src='../images/figure.png' alt='figure'>";
	echo "<p class='message2'>No Opening Polls !!!</div>";
	echo "</div>";}

?>
<?php
if(isset($_POST['submit'])) {
$checkbox1 = $_POST['timeslot'];  
foreach($checkbox1 as $key=>$chk1)  {  
	$chk = mysqli_real_escape_string($con, $chk1); 
	$sql = "INSERT INTO review_session_poll(id, student_id)VALUES('$chk',$uid)";
	if (mysqli_query($con,$sql)){$good=true;}
}; 

if ($good==true){
		echo 
    	"<script>
    	alert('Thank you for participating !');
    	setTimeout(function(){window.location.href='review_session_st.php';},777);
    	</script>";}
}

// drop all votes record before insert new ones
foreach ($result_title as $key => $title){
	if(isset($_POST['resubmit'.$key])) {
		$pt = $_POST['re-submit'.$key];
		mysqli_query($con,"DELETE FROM review_session_poll 
		USING review_session,review_session_poll
		WHERE review_session.id = review_session_poll.id AND student_id = $uid and title = '$pt'") or die("Error: " . mysqli_error($con));
		echo "<script>setTimeout(function(){window.location.href='review_session_st.php';},0);</script>";
	}
}
$con->close();
?>

</form>
</div>

</div>
</div> 
<!-- limit number of timeslots one user can select -->
<script>
$('input[type=checkbox]').on('change', function (e) {
    if ($('input[type=checkbox]:checked').length > 5) {
        $(this).prop('checked', false);
    }
});

function confirm_message(){
var answer = confirm('This will delete all your previous voting records, are you sure?');
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
          
          
