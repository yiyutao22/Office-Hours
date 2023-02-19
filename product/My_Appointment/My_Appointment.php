<?php
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



// fetch records

$result = @mysqli_query($con, "select appointment_id, course.name as course, weekday, timeslot, concat(fname,' ',lname) as TA, appointment.building_code as building,link,room
from appointment
join user on appointment.ta_id = user.user_id
join schedule on appointment.schedule_id=schedule.schedule_id
join building on building.building_code=appointment.building_code
join course on appointment.course_id=course.course_id
where student_id  = $uid order by schedule.schedule_id;") or die("Error: " . mysqli_error($con));
// student_id = $uid
// delete records
if(isset($_POST['chk_id']))
{
    $arr = $_POST['chk_id'];
    foreach ($arr as $id) {
        @mysqli_query($con,"DELETE FROM appointment WHERE appointment_id = " . $id);
    }
    $msg = "Deleted Successfully! <i class='fas fa-trash-alt'></i>";
    header("Location: My_Appointment.php?msg=$msg");
}
?>


<!doctype html>
<html lang="en">
  <head>
  	<title>My Appointment Records</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../style/css/nav.css">
    <link rel="stylesheet" href="../style/css/calendar.css">
    <script src="https://kit.fontawesome.com/03a1b60f2c.js" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="../style/css/app.css"> -->

 <style>

html,body
	{
    width: 100%;
    height: 100%;
    margin: 0px;
    padding: 0px;
    overflow-x: hidden; 
}

 	ul{list-style-type:none;}
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
	.title{
		font-size: 30px;
		font-weight: bold;
		margin: 0 auto;
		color: #7a040e;
		margin-left: 15px;
	}
	/* .footer{
		position: absolute; 
     	margin-top:40px;
         margin-bottom:10px; } */
         .footer{
		position: absolute; 
     	bottom: 20px; 
     	font-size:11px;}
	
	#sidebar{
    position: -webkit-sticky;
    position: sticky;
    height:1000px !important;
  	top: 0;
  	}
      #sidebar i{
    padding-right: 27px;
    width: 20px;
    height: 20px;}
      nav{
          /* width:840px; */
      }
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
    .contact-links{float:right;}
    #sidebar ul li.active > a {color: rgba(255, 255, 255, 0.8);}

    /* My style edittion */
    .outsidebox{
        position:relative;
      }
     
      .container {
        position: relative;
        max-width: 1000px;
        transform: translate(0%, 0%);
}

      table{
        margin: 10 auto;
        margin-top:80px;
        width: 1000px;
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
        font-size: 15px;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.2);
        color: #7a040e;
    }
      td:nth-child(1){
       text-align:center;
      }
/* alert box goes here */
    .alert-box {
        position: absolute;
        padding: 15px;
        margin-bottom: 20px;
        border: 4px solid transparent;
        border-radius: 4px;  
}


.success {
    position: absolute;
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
    display: none;
}
 /* alert box ends above */



 /* calendar adjustment starts below */
 .month-list.show {
    transform: scale(1);
    visibility: visible;
    pointer-events: visible;
    transition: all 0.2s ease-in-out;
    background-color: #f7b230;
    border-radius:15px;
}
.month-list > div {
    display: grid;
    place-items: center;
}
.month-list > div > div {
    width: 100%;
    padding: 5px 0;
    border-radius: 10px;
    text-align: center;
    cursor: pointer;
    /* color: var(--color-txt); */
    color:white;
    font-size:14px;  
}
.month-list > div > div:hover {
    background-color: rgb(66,90,89);
    color: white;
    font-weight:bold;
}
/* calendar adjustment ends above */
/* building pop up message starts below */

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}
.button {
  color: #7a040e;
  padding: 10px 25px 10px 25px;
  border: 2px solid #E5DBCF;
  border-radius: 10px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #E6B794;
  color: black;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 55%;
  position: relative;
  transition: all 5s ease-in-out;
  color: #fff;
}

.popup h2 {
  margin-top: 0;
}
.popup .close {
  position: absolute;
  top: 15px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #f8b739; 
}
.popup .link {
  max-height: 45%;
  overflow: auto;
}
/* building pop up ends above */

@media (max-width: 1120px) {
td:nth-child(7){display:none;}
}


</style>


  </head>
  <body>

	<div class="wrapper">
		<nav id="sidebar" style="margin-top: 20px;">
				<div class="sidebar-content">
        <?php 
				if(!empty($photo_name)){
		  		echo "<img class='profile_photo' src='$url'>";}
		  		else{
		  		echo "<img class='profile_photo' src='../images/profile_photo/user1_profile_photo02.jpg'>";};
		  		?>
	        <ul class="components">
	          <li class="active">
              <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	            <a href="#" class="dropdown-toggle" id="courseMenu"><i class="fas fa-book-medical"></i>Course</a>	            
                <ul class="collapse" id="homeSubmenu">
                <?php
                  while($row = mysqli_fetch_array($course)) {$course_lst[] = $row['name'];}
                  foreach ($course_lst as $key => $value){
                    echo "<form action='../display_OHSchedule/final_schedule.php' method='POST'>\n";
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
            	<a href="https://cgi.luddy.indiana.edu/~team63/Dashboard/Dashboard.php" class="top-link"><i class="fas fa-bullhorn"></i>Dashboard</a>
              </li>
	          <li>
            	<a href="https://cgi.luddy.indiana.edu/~team63/profile/profile.php" class="top-link" ><i class="fas fa-user-circle"></i>Profile</a>
			  </li>
	          <li>
	          <?php 
	          if (in_array('student', $all_role)){
	          echo "<a href='https://cgi.luddy.indiana.edu/~team63/My_Appointment/My_Appointment.php' style='color:#f8b739; fonr-weight:800;'><i class='fas fa-calendar-alt'></i>My Appointment</a>";
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
                    
    <div class="calendar"style="border:none;">
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
        <!-- top bar ends  -->
        <!-- table goes here -->
        <div class="container" >
       
          <form action="My_Appointment.php" method="post">
            <?php if (isset($_GET['msg'])) { ?>
            <div class="alert-box success" style=""><?php echo $_GET['msg']; ?></div>
            <!-- <p class="alert alert-success" style="width:200px; padding: 5px 10px;"></p> -->
           <!-- echo $_GET['msg']; -->
            <?php } ?>
            <table class="table">
                <thead>
                    <tr>
                    <th><input id="chk_all" name="chk_all" type="checkbox"  /> SelectAll</th>
                    
                    <th>Course</th>
                    <th>Date</th>
                    <th>Weekday</th>
                    <th>TimeSlot</th>
                    <th>TA</th>
                    <th>Building</th>
                    
                    </tr>
                </thead>
                <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td data-th="SelectAll"><input name="chk_id[]" type="checkbox" class='chkbox' style="font-size:20px;"value="<?php echo $row['appointment_id']; ?>"/></td>
                    
                    <td data-th="Course"><?php echo $row['course']; ?></td>
                    <td data-th="Date"><?php
                      $myDate = date("Y/m/d");
                      $a = $row['weekday'];
                      $b = 'next'.' '.strtolower($a);
                      $next_weekday = date('m/d/Y', strtotime($b, strtotime($myDate)));
                      echo $next_weekday;
                      
                    ?></td>
                    <td data-th="Weekday"><?php echo $row['weekday']; ?></td>
                    <td data-th="Timeslot"><?php echo $row['timeslot']; ?></td>
                    <td data-th="TA"><?php echo $row['TA']; ?></td>
                    <td data-th="Building"><a class="button" href="#location"><?php echo $row['building']; ?></a></td>
                   	<div id="location" class="overlay">
                      <div class="popup">
                      <h1>Here i am</h1>
                      <a class="close" href="#">&times;</a>
                      <div class="link">
                      <p style='font-size:16px; color:black; margin-bottom:0'>Room No  :  <?php echo $row['room']; ?></p>
                      <iframe src="<?php echo $row['link']; ?>" width="500" height="350" style="border:0;" ></iframe>
                      </div>
                    </div>
					</div>
                   
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <!-- <button id="success-btn"> -->
            <input id="success-btn" name="submit" type="submit" style="background-color:#f4b42f;color:white; border-radius:5px; border: 1px solid #e2eceb;padding:5px 5px; font-size:20px;margin-top:20px; cursor:pointer;" value="Cancel selected appointment" onclick="confirm('Do you want to delet the selected appointment?')" />
            <!-- </button> -->
            </form>

            <!-- <script>
                $("#success-btn").delay(200).show(300, "puff", function() {
                    $(this).delay(116010).fadeOut(3000);  });
            </script> -->
    
    </div>
  
    </div>

    </div>
       <!-- table ends here -->           
       
	

    <script src="../style/js/app.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#chk_all').click(function(){
        if(this.checked)
            $(".chkbox").prop("checked", true);
        else
            $(".chkbox").prop("checked", false);
    });
});
$(document).ready(function(){
    $('#delete_form').submit(function(e){
        if(!confirm("Confirm Delete?")){
            e.preventDefault();
        }
    });
});

</script>

	
   
  </body>
</html>