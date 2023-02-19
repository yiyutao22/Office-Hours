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
	
	<!-- google font -->
  	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<!-- icons -->
	<script src="https://kit.fontawesome.com/bf37eaf948.js" crossorigin="anonymous"></script>
	<!-- stylesheets -->
	<link rel="stylesheet" href="../style/css/form.css">
	<link rel="stylesheet" href="../style/css/profile.css">
	
	
	<title>Register</title>
	
<style>
p{
color: #8a97a0;
margin-top: 0px;
}
.footer{
margin-top: 25px;
margin-bottom: 20px;
font-size:11px;}

a.c_generate:link, a.c_generate:visited{
text-decoration: none;
font-size: 15px;
color: #f8b739;}
  
a.c_generate:active, a.c_generate:hover{
color:#5c7484;}

</style>
</head>
<body>
<!-- page content -->
<form action="#" method="post" id="update" name="update">
<div class="feature-content">
	<center><h1>Create Profile</h1></center>
	<hr style="border: 1px dashed lightgrey;">
	
<!-- note for users -->
<fieldset>
<p>* Indicates Required Field</p>
</fieldset>

<fieldset>
<legend>Name*</legend>
<input type="text" title="Name" style="font-size:17px;" name="user_name" required>
</fieldset>

<fieldset>
<legend>Biography</legend>
<textarea name="biography" id="biography" style="font-size:17px;" cols="40" rows="7" maxlength="250" spellcheck="true" form="update"></textarea>
</fieldset>

<fieldset style='margin-bottom: 50px;'>
<legend>Are You An Instructor ?*</legend>
<input type='checkbox' id='instructor' name='instructor' value='instructor' style='transform: scale(1.5); margin-left:5px; margin-top: 15px;'>
</fieldset>

<fieldset>
<legend>Enrolled Course*</legend>
<!-- dynamically generate input fields -->
<label style="font-size:16px; margin-top:5px;">How many courses are you enrolled in?</label>
<input type="text" id="course" name="course" style="margin-bottom:15px;">
<a href="#" class="c_generate" onclick="addinputFields()">Generate</a>
<div id="container" style='margin-top:20px;'></div>
</fieldset>


<fieldset>
<legend>Social Media</legend>
		<div class="icons">
		<i class="fab fa-linkedin fa-3x" style="color:#2867B2;">
		</i><input type="text" name="linkedin" style="font-size:17px;">
		
		<i class="fab fa-facebook-square fa-3x" style="color:#4267B2;"></i>
		<input type="text" name="facebook" style="font-size:17px; ">
		
		<i class="fab fa-twitter-square fa-3x" style="color:#1DA1F2;"></i>
		<input type="text" name="twitter" style="font-size:17px; ">
		
		<i class="fab fa-github-square fa-3x" style="color:#211F1F;"></i>
		<input type="text" name="github" style="font-size:17px; ">
		</div>
</fieldset>

<input type="hidden" name="confirm" value="1" />
<center><button id="profile_btn" style="margin-top:27px; margin-bottom:37px;" type="submit">Create</button></center>

</form>
<!-- copyright info -->
<hr style="border: 1px dashed lightgrey;">
<center><p class='footer'>Copyright &copy; 2021 Team63. All Right Reserved</p> </center>
</div>

<!-- function for the input fileds generation -->
<script>
    function addinputFields(){
    var number = document.getElementById("course").value;

    for (i=0;i<number;i++){
        var input = document.createElement("input");
        input.type = "text";
        input.name = "course[]";
        input.placeholder = "Example: INFO-I495";
        input.required = true;
        container.appendChild(input);
        container.appendChild(document.createElement("br"));
    }
}
</script>

<?php

// check if submit button is clicked
if (isset($_POST['confirm'])) {
// use explode seperate first and last name in the input
$new_name = explode(" ",mysqli_real_escape_string($con,$_POST['user_name'])); 
$new_fname = $new_name[0];
$new_lname = $new_name[1];
// post all data
$new_biography = htmlentities($_POST['biography']);
$new_linkedin = mysqli_real_escape_string($con,$_POST['linkedin']);
$new_facebook = mysqli_real_escape_string($con,$_POST['facebook']);
$new_twitter = mysqli_real_escape_string($con,$_POST['twitter']);
$new_github = mysqli_real_escape_string($con,$_POST['github']);

//insert user's first and last name
mysqli_query($con, "UPDATE user SET fname = '$new_fname' WHERE user_id = '$uid'") or die("Error: " . mysqli_error($con));
mysqli_query($con, "UPDATE user SET lname = '$new_lname' WHERE user_id = '$uid'") or die("Error: " . mysqli_error($con));

//check if textarea is filled
if (!empty($new_biography)) { 
mysqli_query($con, "UPDATE user SET biography = '$new_biography' WHERE user_id = '$uid'") or die("Error: " . mysqli_error($con));}

//check if link is filled
if(!empty($new_linkedin)){
	mysqli_query($con, "INSERT INTO social_media (user_id, application, link) VALUES ('$uid','Linkedin','$new_linkedin')") or die("Error: " . mysqli_error($con));
};

//check if link is filled
if(!empty($new_facebook)){
	mysqli_query($con, "INSERT INTO social_media (user_id, application, link) VALUES ('$uid','Facebook','$new_facebook')") or die("Error: " . mysqli_error($con));
};

//check if link is filled
if(!empty($new_twitter)){
	mysqli_query($con, "INSERT INTO social_media (user_id, application, link) VALUES ('$uid','Twitter','$new_twitter')") or die("Error: " . mysqli_error($con));
};

//check if link is filled
if(!empty($new_github)){
	mysqli_query($con, "INSERT INTO social_media (user_id, application, link) VALUES ('$uid','Github','$new_github')") or die("Error: " . mysqli_error($con));
};

//check if course input field is filled
if ($_POST['course']) {
		// get all course name
        foreach ( $_POST['course'] as $key => $value ) {
        $course = mysqli_real_escape_string($con, $value);
        // check if the course already exists in the database
        $sql = "select course_id from course where name='$course'";
        $records = mysqli_query($con, $sql);
        	// if not, insert the course information
			if (mysqli_num_rows($records) == 0 ){
				mysqli_query($con, "INSERT INTO course (name) VALUES ('$course')") or die("Query Failed!");
				}
		// get the course id 
        $course_id = mysqli_fetch_assoc(mysqli_query($con, $sql))['course_id'];
        	// if user checks the instructor checkbox
        	if ($_POST['instructor']) {
        	// insert user data into database as an instructor 
        	$add = "INSERT INTO 
                	enrollment_details (course_id, user_id, role)
                	Values
                	($course_id, $uid, 'instructor')";
            mysqli_query($con, $add) or die("Error: " . mysqli_error($con));}
            // else insert user data as a student
            // *** TA role can only be assigned by instructor through the upload course information feature ***
        	else{
        	$add = "INSERT INTO 
                	enrollment_details (course_id, user_id, role)
                	Values
                	($course_id, $uid, 'student')";
            mysqli_query($con, $add) or die("Error: " . mysqli_error($con));};
	};
};

// return alert message and direct user to dashboard page
echo 
    "<script>
    alert('Your profile has been created successfully!');
    setTimeout(function(){window.location.href='../Dashboard/Dashboard.php';},0);
    </script> ";

}
?>

</body>
</html>