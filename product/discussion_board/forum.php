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
// include 'config/config.php';
// $uid=101;
$class = $_SESSION['course'];
$course_id = mysqli_fetch_array(mysqli_query($con,"select course_id from course where name='$class'"))[0];
$role = mysqli_fetch_array(mysqli_query($con,"select role from role_detail join course on course.course_id = role_detail.course_id where name = '$class'"));
$role = $role['role'];
?>

<?php
if (isset($_GET['reply'])) {
    $topic=$_GET['reply'];
    $topic_id = mysqli_fetch_array(mysqli_query($con,"select topic_id from forum_topic where topic_name='$topic'"))[0];   
    // $_SESSION['topic'] = $topic_id;
}
?>
<?php
if (isset($_GET['submit'])){
		$good = false;
		$topic_id=$_GET['hidden'];
		$message=mysqli_real_escape_string($con,$_GET['message']);
		$date=date('Y-m-d H:i:s');
		$sql="INSERT INTO forum(user_id, course_id, message, date, topic_id ) VALUES('$uid','$course_id','$message','$date', '$topic_id')";
		if ($con->query($sql)){$good=true;};
}  
if ($good==true){echo 
    	"<script>
    	alert('New reply message posted successfully!');
    	</script> ";} 
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Reply to Topic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta http-equiv="refresh" content="60;forum.php" /> -->

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
</style>

<!-- discussion board style -->
<style>
.post{
  position: relative;
  padding: 15px 15px 20px 80px;
  margin-bottom: 50px;
  border: 1px solid #ebeff1;
  border-bottom: none;
  box-shadow: 0 2px 1px rgba(0, 0, 0, 0.15);
  }
.post_author{
  margin-top: 5px;
  margin-bottom: 5px;
  font-size: 18px;
  font-weight: 700 ;
  }
.post_time{
  margin-top: 0;
  font-size: 12px;
  font-weight: 400;
  color: #89989c;
  }
.portrait{
  float:left; 
  margin-right: 18px; 
  border-radius: 50px !important;
  height:80px ;
  }
@media (max-width: 1120px) {
#go_back{margin-left:-60px !important; margin-top:10px !important;}
.feature-content input[type="submit"]{width:130px; font-size:15px; text-align:left; padding: 12px 19px 12px 19px;}
.feature-content{margin-left:-60px !important;}
}
@media (max-width: 825px) {
.feature-content input[type="submit"]{width:130px; font-size:15px; text-align:left; padding: 12px 19px 12px 19px;}
}
@media (max-width: 700px) {
hr,.post_author,.post_time,.image,.post_body{margin-left:-55px;width:110px;}
#go_back{margin-left:-92px !important; margin-top:10px !important;}
.feature-content{margin-left:-92px !important; width:200px;}
.feature-content input[type="submit"]{width:130px; font-size:15px; text-align:left; padding: 12px 19px 12px 19px;}
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
            	<a href="http://cgi.luddy.indiana.edu/~team63/discussion_board/forum_topic.php" class="top-link" style='color:#f8b739;'><i class="fas fa-comments"></i>Discussion Board</a>
			  </li>
			  <?php 
              if ($role == "ta" or $role == "instructor"){
            	  echo "<li>";
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/review_session/review_session_tchr.php'><i class='fas fa-book-reader'></i>Review Session Poll</a>";
            	  echo "</li>";
              }
              if ($role == "student"){
            	  echo "<li>";
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/review_session/review_session_st.php'><i class='fas fa-book-reader'></i>Review Session Poll</a>";
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
          
<a href="forum_topic.php"><button class="btn" id="go_back" type="submit" style="margin: 0 0 20px 24px;">Go Back</button></a>

<!-- main board -->

<div class="feature-content">

<?php
echo "<div class = 'post'>";
$sql = "SELECT * FROM forum JOIN user ON user.user_id = forum.user_id where topic_id = $topic_id";
$result = $con->query($sql); 
$i = 0;

while($row = $result->fetch_assoc()) {
  echo "<form id='view" .$i. "'action='../profile/show_profile.php' method='GET'>";
  $user_id = $row['user_id'];
  $portrait = mysqli_fetch_array(mysqli_query($con,"SELECT file_name FROM profile_photo WHERE user_id = '$user_id'"));
  $portrait_url = '../images/profile_photo/'.$portrait["file_name"];
  echo "<div class = 'image'>";
  echo "<input type='hidden' name='user_name' value='$user_id' />";
  echo "<a href='#' onclick='submitdata($i)'>";
  echo "<img src='$portrait_url' alt='forum portrait' class='portrait'>";
  echo "</a>";
  echo "</div>"; 
  echo "<div class = 'post_author'>";
  echo $row['fname'].' '.$row['lname'];
  echo "</div>";
  echo "<div class = 'post_time'>";
  echo $row['date'];
  echo "</div>";
  echo "<div class = 'post_body'>";
  echo $row['message'].'<br />';
  echo "</div>";
  echo "<div style='margin-bottom:30px; width:75%;'>";
  echo '<hr>';
  echo "</div>";
  echo "</form>";
  $i+=1;
}
echo "</div>";
?>

 <script>
	function submitdata(parameter){
	var real_id = 'view' + parameter;
	document.getElementById(real_id).submit();
	}
</script>

<form method="get" action="#">
<fieldset>
<legend>Message</legend>
<input type='hidden' name='hidden' id='hidden' value='<?php echo $topic_id; ?>' />
<textarea name="message" id="message" style="font-size:17px;" cols="40" rows="7" maxlength="250" spellcheck="true"></textarea>
</fieldset>
  
  <input type="submit" name="submit" id="submit" value="Post Message" />
	

</form>
</div>
</div>
</div> 

</body>
</html>