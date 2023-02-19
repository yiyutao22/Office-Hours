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

// post user name data
$uid = $_GET['user_name'];
$con = mysqli_connect("db.soic.indiana.edu","i494f20_team63","my+sql=i494f20_team63", "i494f20_team63");
	if (!$con) {
		/* if failed, show the error message */
    	die("Connection failed: " . mysqli_connect_error() . "<br>");
		} 

// use username to select all needed data
$user = mysqli_fetch_array(mysqli_query($con,"SELECT user_id, fname, lname, email, biography FROM user WHERE user_id = $uid"));
$course = mysqli_query($con,"SELECT name from course JOIN enrollment_details ON enrollment_details.course_id = course.course_id WHERE user_id = '$uid' ORDER BY name");
while($row = mysqli_fetch_array($course)) {$course_lst[] = $row['name'];}
$linkedin = mysqli_fetch_array(mysqli_query($con,"SELECT link FROM social_media WHERE user_id = '$uid' AND application = 'Linkedin'"));
$twitter = mysqli_fetch_array(mysqli_query($con,"SELECT link FROM social_media WHERE user_id = '$uid' AND application = 'Twitter'"));
$facebook = mysqli_fetch_array(mysqli_query($con,"SELECT link FROM social_media WHERE user_id = '$uid' AND application = 'Facebook'"));
$github = mysqli_fetch_array(mysqli_query($con,"SELECT link FROM social_media WHERE user_id = '$uid' AND application = 'Github'"));
$photo_name = mysqli_fetch_array(mysqli_query($con,"SELECT file_name FROM profile_photo WHERE user_id = '$uid'"));
$url = '../images/profile_photo/'.$photo_name["file_name"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <meta http-equiv="refresh" content="60;show_profile.php" /> -->
    <!-- add user's name to title -->
    <title><?php echo $user['fname'].' '.$user['lname']; ?>'s Profile</title>
    
    <!-- style -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../style/css/nav.css">
	<script src="https://kit.fontawesome.com/bf37eaf948.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../style/css/form.css">
	<link rel="stylesheet" href="../style/css/profile.css">

     <style>
 	body{color: black;}
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
	.icons{
	display: flex;
  	width: 470px;
  	justify-content: space-between;
  	margin-bottom: 80px;
  	margin-left: 15px;
	}
	p{margin-left:23px;}
	@media (max-width: 700px) {
	.flex-container {flex-flow: column wrap;}
	.flex-container .flex-item{ width: 100%; }
	.flex-item:nth-of-type(1){margin-left:-20px !important; margin-bottom:-40px;}
	.flex-item:nth-of-type(2){margin-bottom:30px;}
	.icons{flex-flow:column wrap; width:50%;}
	.flex-item p{margin-left:23px !important;}
	}
	</style>
	
</head>
<body>
    
<div class="wrapper">
       
    <!-- Page Content  --> 
      <div id="content"> 

<!-- main section -->
<a href="javascript:history.go(-1)"><button class="btn" type="submit" style="margin: 0 0 20px 24px;">Go Back</button></a>
<div class="feature-content">
<!-- profile -->
<div class = "flex-container">
	<div class = "flex-item">
		<img class="profile_photo" style="margin-left: 33px; margin-top: -5px; height: 220px; width: 220px;" src="<?php echo $url; ?>" alt="profile photo">
	</div>
	<div class = "flex-item">
  		<p style="font-size:39.5px;"><?php echo $user['fname'].' '.$user['lname']; ?></p>
		<p style="font-size:17px;  margin-left:5px; margin-top:15px;"><?php echo $user['email']; ?></p>
		
	</div>
</div>

	<hr style="border: 1px dashed lightgrey; margin-top:-45px;">


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