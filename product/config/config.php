<?php
session_start(); 
$con = mysqli_connect("db.soic.indiana.edu","i494f20_team63","my+sql=i494f20_team63", "i494f20_team63");
	if (!$con) {
		/* if failed, show the error message */
    	die("Connection failed: " . mysqli_connect_error() . "<br>");
		} 
		
$user_email = $_SESSION["user"];

$user = mysqli_fetch_array(mysqli_query($con,"SELECT user_id, fname, lname, email, biography FROM user WHERE email = '$user_email'"));
$uid = $user['user_id'];
$role_sql = "CREATE OR REPLACE VIEW role_detail AS SELECT role, course_id from enrollment_details JOIN user on user.user_id = enrollment_details.user_id WHERE user.user_id = '$uid'";
mysqli_query($con,$role_sql);
$all_roles = mysqli_query($con,"SELECT role from enrollment_details JOIN user on user.user_id = enrollment_details.user_id WHERE user.user_id = '$uid'");
while($row = mysqli_fetch_array($all_roles)) {$all_role[] = $row['role'];};
$course = mysqli_query($con,"SELECT name from course JOIN enrollment_details ON enrollment_details.course_id = course.course_id WHERE user_id = '$uid' ORDER BY name");
$linkedin = mysqli_fetch_array(mysqli_query($con,"SELECT link FROM social_media WHERE user_id = '$uid' AND application = 'Linkedin'"));
$twitter = mysqli_fetch_array(mysqli_query($con,"SELECT link FROM social_media WHERE user_id = '$uid' AND application = 'Twitter'"));
$facebook = mysqli_fetch_array(mysqli_query($con,"SELECT link FROM social_media WHERE user_id = '$uid' AND application = 'Facebook'"));
$github = mysqli_fetch_array(mysqli_query($con,"SELECT link FROM social_media WHERE user_id = '$uid' AND application = 'Github'"));
$photo_name = mysqli_fetch_array(mysqli_query($con,"SELECT file_name FROM profile_photo WHERE user_id = '$uid'"));
$url = '../images/profile_photo/'.$photo_name["file_name"];
?>