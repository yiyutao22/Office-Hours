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
// $uid = 56;
// $course = mysqli_query($con,"SELECT name from course JOIN enrollment_details ON enrollment_details.course_id = course.course_id WHERE user_id = '$uid' ORDER BY name");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    
    <!-- style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../style/css/nav.css">
	<script src="https://kit.fontawesome.com/bf37eaf948.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../style/css/form.css">
	<link rel="stylesheet" href="../style/css/profile.css">
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
	.icons{
	display: flex;
  	width: 470px;
  	justify-content: space-between;
  	margin-bottom: 80px;
  	margin-left: 15px;
	}
	@media (max-width: 1120px) {
	.feature-content{
	transform:scale(0.9);
	margin: -92px 60px 0 -90px;
	}
	#content{width: 65% !important;}
	.flex-container {
	flex-flow: column wrap;
	}
	.flex-container .flex-item{ width: 100%; }
	.flex-item{margin-left:70px !important;}
	}
	@media (max-width: 825px) {
	#content{width: 20% !important;}
	.feature-content{
	margin-right:-290px !important;}
	.flex-item{margin-left:60px !important;}
	.icons{flex-flow:column wrap;}
	}
	@media (max-width: 700px) {
	.flex-item:nth-of-type(1){display:none;}
	.feature-content{
	margin-right:-120px !important;
	margin-top:-50px;}
	.flex-item{margin-left:0 !important;}
	.flex-item p:first-of-type{font-size:34px !important;}
	#profile_btn{width:120px !important;}
	li{margin-left:-20px !important; font-size:13px !important;}
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
	        <ul class="components" style="list-style-type:none;">
	          <li class="active">
	            <a href="#" class="dropdown-toggle" id="courseMenu"><i class="fas fa-book-medical"></i>Course</a>
	            <ul class="collapse" id="homeSubmenu" style="list-style-type:none;">
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
            	<a href="https://cgi.luddy.indiana.edu/~team63/Dashboard/Dashboard.php" class="top-link"><i class="fas fa-bullhorn"></i>Dashboard</a>
              </li>
	          <li>
            	<a href="https://cgi.luddy.indiana.edu/~team63/profile/profile.php" class="top-link" style="color:#f8b739; fonr-weight:800;"><i class="fas fa-user-circle"></i>Profile</a>
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
              echo "<a href='https://cgi.luddy.indiana.edu/~team63/upload_information/upload_information.php'><i class='fas fa-upload'></i>Upload Information</a>";
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
<div class = "flex-container">
	<div class = "flex-item">
		<img class="profile_photo" style="margin-left: 33px; margin-top: -5px; height: 220px; width: 220px;" src="<?php echo $url; ?>" alt="profile photo">
	</div>
	<div class = "flex-item">
		<!-- display data in database -->
  		<p style="font-size:39.5px;"><?php echo $user['fname'].' '.$user['lname']; ?></p>
		<p style="font-size:17px;  margin-left:5px; margin-top:5px;"><?php echo $user['email']; ?></p>
		
		<div>
		<!-- link to profile edit page -->
		<a href="update_profile.php"><button id="profile_btn" style="margin: 70px 0 15px 3px;" type="button">Edit Profile</button></a>
		</div>
	</div>
</div>

	<hr style="border: 1px dashed lightgrey;">

<!-- second half of the profile -->
<fieldset>
<legend><span class="number">B</span>Biography</legend>
<p style="font-size:17px;"><?php echo $user['biography']; ?></p>
</fieldset>

<fieldset>
<legend><span class="number">E</span>Enrolled Course</legend>
		<ul>
		<?php
		foreach ($course_lst as $key => $value){
			$role = mysqli_fetch_array(mysqli_query($con,"select role from enrollment_details join course on course.course_id = enrollment_details.course_id where user_id = $uid and name = '$value'"))[0];
			$role = ucwords($role);
    		echo "<li style='font-size: 18px; margin-top:10px;'>" . $value . "&nbsp;&nbsp;" . $role . "</li>";
		}
		?>
		</ul>
</fieldset>

<fieldset>
<legend><span class="number">S</span>Social Media</legend>
		<div class="icons">
		<a href="<?php echo $linkedin['link']; ?>"><i class="fab fa-linkedin fa-4x" style="<?php 
		if (!empty($linkedin['link'])){echo 'color:#2867B2';} else {echo 'color:#888888';};
		?>"></i></a>
		<a href="<?php echo $facebook['link']; ?>"><i class="fab fa-facebook-square fa-4x" style="<?php 
		if (!empty($facebook['link'])){echo 'color:#4267B2';} else {echo 'color:#888888';};
		?>"></i></a>
		<a href="<?php echo $twitter['link']; ?>"><i class="fab fa-twitter-square fa-4x" style="<?php 
		if (!empty($twitter['link'])){echo 'color:#1DA1F2';} else {echo 'color:#888888';};
		?>"></i></a>
		<a href="<?php echo $github['link']; ?>"><i class="fab fa-github-square fa-4x" style="<?php 
		if (!empty($github['link'])){echo 'color:#211F1F';} else {echo 'color:#888888';};
		?>"></i></a>
		</div>
</fieldset>

</div>

</div>
</div>

</body>
</html>