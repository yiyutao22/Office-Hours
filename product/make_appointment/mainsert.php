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
$class = $_SESSION['course'];
$course_id = mysqli_fetch_array(mysqli_query($con,"select course_id from course where name='$class'"))[0];
?>

<!-- submit action -->
<?php
if(isset($_POST['submit']))  
{  
$course_start=mysqli_fetch_array(mysqli_query($con,"select schedule_id from schedule where course_id='$course_id'"))[0];
$course_end=mysqli_query($con,"select schedule_id from schedule where course_id=$course_id");
while($row = mysqli_fetch_array($course_end)) {
   $cend[] = $row['schedule_id'];
}
$course_end=end($cend);
$ta_list = array();
for ($x = $course_start; $x <= $course_end; $x++)
{
    $ta_list[$x] = $x;
};
 
foreach ($_POST['timeslot'] as $key => $value) { 
	$time = mysqli_real_escape_string($con, $value);
	$building = mysqli_fetch_array(mysqli_query ($con, "select building_code from schedule where schedule_id = '$time' and course_id='$course_id'"))[0];
	$i = $ta_list[$time];
	$ta = mysqli_real_escape_string($con,$_POST['ta_name' . $i]);  
	$add_appointment = "INSERT INTO 
                        appointment (course_id, schedule_id, building_code, ta_id, student_id, check_in, emergency)
                        Values
                        ('$course_id', '$time', '$building', '$ta', '$uid', 'false', 'false')";
	mysqli_query($con, $add_appointment) or die("Query Failed!");
	
}
//after submit go back to the make_appointment page automatically
	echo 
    	"<script>
    	alert('Appointment Confirmed');
    	setTimeout(function(){window.location.href='https://cgi.luddy.indiana.edu/~team63/My_Appointment/My_Appointment.php';},777);
    	</script>";

};


    
?>
