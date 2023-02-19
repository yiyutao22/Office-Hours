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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<!-- style reference -->
  	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/bf37eaf948.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../style/css/nav.css">
	<link rel="stylesheet" href="../style/css/form.css">
	<link rel="stylesheet" href="../style/css/profile.css">
	<link rel="stylesheet" href="../style/css/calendar.css">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
    <title>Update Profile</title>
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
     @media (max-width: 1120px) {
	.feature-content{
	transform:scale(0.9);
	margin: -120px 30px 0 -90px;
	}
	.flex-container {
	flex-flow: column wrap;
	}
	.flex-container .flex-item{ width: 100%; }
	}
	@media (max-width: 700px) {
	.flex-item > div:first-of-type { margin-left:20px !important; }
	.flex-item > div > label{margin-right:0px;}
	.flex-item > .profile_photo{display:none;}
	.feature-content{
	margin-right:120px !important;
	margin-top:-80px;
	margin-left:-110px;
	width:235px;}
	.flex-item{margin-left:0 !important;}
	.flex-item p:first-of-type{font-size:34px !important;}
	#profile_btn{width:120px !important;}
	li{margin-left:-20px !important; font-size:13px !important;}
	.flex-item > input:first-of-type{font-size:30px !important;}
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
          
<!-- main content -->
<div class="feature-content">
<form action="#" method="post" id="update" name="update" enctype="multipart/form-data">

<!-- use flexbox to position the first half of the user profile -->
<div class = "flex-container">
	<div class = "flex-item">
		<img class="profile_photo" style="margin-left: 43px" src="<?php echo $url; ?>" alt="profile photo">
		<!-- upload picture subfeature -->
		<div style="margin-left:96px;">
		<label class="custom-file-upload">
		<input type="file" name="file" id="file">
		<input type="hidden" name="file_upload" value="1" />
    	<i class="fas fa-file-image" style="margin-left:5px; width:20px"></i> <span style="font-size:14px; font-family: Arial; font-weight:700;">Choose File</span>
		</label>
		<button style="width: 141px; margin-left:-21px" id="profile_btn" type="submit"><i class="fa fa-cloud-upload" style="margin-right:18px; margin-left:-24px;"></i>Upload</button>
		</div>
	</div>
	<!-- Name and Email -->
	<div class = "flex-item">
  		<input type="text" title="Name" name="user_name" style="font-size:39.5px;" value="<?php echo $user['fname'].' '.$user['lname']; ?>">
		<input type="text" name="user_email" style="font-size:17px; margin-top:5px;" value="<?php echo $user['email']; ?>">
		<div>
		<!-- cancel button direct back to profile page, save change proceed the data -->
		<a href="profile.php"><button id="profile_btn" style="margin-top:47px;margin-left:3px;" type="button">Cancel Edit</button></a>
		<input type="hidden" name="confirm" value="1" />
		<button id="profile_btn" style="margin-top:47px;margin-left:3px;" type="submit">Save Change</button>
		</div>
	</div>
</div>

	<hr style="border: 1px dashed lightgrey;">

<!-- second half of the profile -->
<fieldset>
<legend><span class="number">B</span>Biography</legend>
<!-- display the current information in database-->
<textarea name="biography" id="biography" style="font-size:17px;" cols="40" rows="7" maxlength="250" spellcheck="true" form="update"><?php echo $user['biography']; ?></textarea>
</fieldset>


<fieldset>
<legend><span class="number">E</span>Enrolled Course</legend>
		<ul>
		<!-- display enrolled course in list format, data is gathered from registration page-->
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
		<i class="fab fa-linkedin fa-3x" style="color:#2867B2;"></i>
		<input type="text" name="linkedin" style="font-size:17px;" value="<?php echo $linkedin['link']; ?>">
		<i class="fab fa-facebook-square fa-3x" style="color:#4267B2;margin-top:9px;"></i>
		<input type="text" name="facebook" style="font-size:17px;" value="<?php echo $facebook['link']; ?>">
		<i class="fab fa-twitter-square fa-3x" style="color:#1DA1F2;margin-top:9px;"></i>
		<input type="text" name="twitter" style="font-size:17px;" value="<?php echo $twitter['link']; ?>">
		<i class="fab fa-github-square fa-3x" style="color:#211F1F;margin-top:9px;"></i>
		<input type="text" name="github" style="font-size:17px;" value="<?php echo $github['link']; ?>">
		</div>
</fieldset>

</form>
</div>


</div>
</div>


<?php

// check if submit button is clicked
if (isset($_POST['confirm'])) {
// use explode seperate first and last name in the input
$new_name = explode(" ",mysqli_real_escape_string($con,$_POST['user_name'])); 
$new_fname = $new_name[0];
$new_lname = $new_name[1];
// post all data
$new_email = mysqli_real_escape_string($con,$_POST['user_email']);
$new_biography = htmlentities($_POST['biography']);
$new_linkedin = mysqli_real_escape_string($con,$_POST['linkedin']);
$new_facebook = mysqli_real_escape_string($con,$_POST['facebook']);
$new_twitter = mysqli_real_escape_string($con,$_POST['twitter']);
$new_github = mysqli_real_escape_string($con,$_POST['github']);

// compare if new data is same as data in database, if not run update query
if (strcmp($new_fname, $user['fname']) !== 0) { 
mysqli_query($con, "UPDATE user SET fname = '$new_fname' WHERE user_id = '$uid'");}

if (strcmp($new_lname, $user['lname']) !== 0) { 
mysqli_query($con, "UPDATE user SET lname = '$new_lname' WHERE user_id = '$uid'");}

if (strcmp($new_biography, $user['biography']) !== 0) { 
mysqli_query($con, "UPDATE user SET biography = '$new_biography' WHERE user_id = '$uid'");}


// check if link is filled and compare
if(!empty($linkedin['link'])){
	if (strcmp($new_linkedin, $linkedin['link']) !== 0) { 
		mysqli_query($con, "UPDATE social_media SET link = '$new_linkedin' WHERE user_id = '$uid' AND application = 'Linkedin'");
	};
} else {
	if(!empty($new_linkedin)){
	mysqli_query($con, "INSERT INTO social_media (user_id, application, link) VALUES ('$uid','Linkedin','$new_linkedin')");
	};
};

if(!empty($facebook['link'])){
	if (strcmp($facebook, $facebook['link']) !== 0) { 
		mysqli_query($con, "UPDATE social_media SET link = '$new_facebook' WHERE user_id = '$uid' AND application = 'Facebook'");
	};
} else {
	if(!empty($new_facebook)){
	mysqli_query($con, "INSERT INTO social_media (user_id, application, link) VALUES ('$uid','Facebook','$new_facebook')");
	};
};

if(!empty($twitter['link'])){
	if (strcmp($twitter, $twitter['link']) !== 0) { 
		mysqli_query($con, "UPDATE social_media SET link = '$new_twitter' WHERE user_id = '$uid' AND application = 'Twitter'");
	};
} else {
	if(!empty($new_twitter)){
	mysqli_query($con, "INSERT INTO social_media (user_id, application, link) VALUES ('$uid','Twitter','$new_twitter')");
	};
};

if(!empty($github['link'])){
	if (strcmp($github, $github['link']) !== 0) { 
		mysqli_query($con, "UPDATE social_media SET link = '$new_github' WHERE user_id = '$uid' AND application = 'Github'");
	};
} else {
	if(!empty($new_github)){
	mysqli_query($con, "INSERT INTO social_media (user_id, application, link) VALUES ('$uid','Github','$new_github')");
	};
};

// return alert message and direct user to profile page
echo 
    "<script>
    alert('New Information Updated Successfully');
    setTimeout(function(){window.location.href='profile.php';},0);
    </script> ";

}

// upload photo
//reference: https://www.codexworld.com/upload-store-image-file-in-database-using-php-mysql/
$target_dir = "../images/profile_photo/";
$file_name = basename($_FILES["file"]["name"]);
$target_file = $target_dir . $file_name;
$file_type = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["file_upload"]) && !empty($_FILES["file"]["name"])){
    $allow_types = array('jpg','png','jpeg','gif');
    if(in_array($file_type, $allow_types)){
    	$result = mysqli_query($con,"SELECT * FROM profile_photo WHERE user_id = '$uid'");
    	if($result->num_rows == 0){
    		// first time upload
    		move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        	mysqli_query($con, "INSERT INTO profile_photo (user_id, file_name) VALUES ('$uid','$file_name')");
        } else {
        	move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        	mysqli_query($con, "UPDATE profile_photo SET file_name = '$file_name' WHERE user_id = '$uid'");
        	};
    };
};

?>
	
</body>
</html>