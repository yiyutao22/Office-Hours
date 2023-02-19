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
$class = $_SESSION['course']; 
$course_id = mysqli_fetch_array(mysqli_query($con,"select course_id from course where name='$class'"))[0];
$role = mysqli_fetch_array(mysqli_query($con,"select role from role_detail join course on course.course_id = role_detail.course_id where name = '$class'"));
$role = $role['role'];

// fetch reco
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Look For Sub</title>
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
      .wrapper{
        height:1500px;
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
#role{
	margin-top:-30px;
	margin-bottom: 20px;
	margin-left: -9px;
	font-size: 17px;}


@media (max-width: 1120px) {
.no_open{transform:scale(0.7); margin-left:-200px;}
.container h1{margin-top:80px;}

}
@media (max-width: 825px) {
.no_open{transform:scale(0.5); margin-left:-260px;}
.container h1{font-size:22px;}
}
@media (max-width: 700px) {
.no_open img{margin: 50px 0 0 220px;}
.container h1{font-size:20px;}
.container p{font-size:14px; width:320px;}
.message2{position: absolute; margin: -150px 0 50px 320px; width:400px; font-size:45px !important;}
}

</style>


  </head>
  <body>

	<div class="wrapper">
		<nav id="sidebar" style="margin-top: 20px; height: 770px;">
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
    	
    	      <!--Other Navigation Links-->
            
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
            	  echo "<a href='https://cgi.luddy.indiana.edu/~team63/TA_shift/TA_substitute.php' style='color:#f8b739; fonr-weight:800; '><i class='fas fa-people-arrows'></i>Find Substitute</a>";
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
               
                <div class="dark-mode-switch">
                    <div class="dark-mode-switch-ident"></div>
                </div>
            </div>
        </div>
        <div class="month-list"></div>
    </div>
           
	        
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
  
        
          <form action="#" method="post" name="sub">
          <?php 
           $result = @mysqli_query($con, "select name, ta_id, timeslot, weekday, schedule.schedule_id, concat(fname,' ',lname) as TA, schedule.building_code,
           CASE WHEN weekday='Monday' THEN 1
               WHEN weekday='Tuesday' THEN 2
               WHEN weekday='Wednesday' THEN 3
               WHEN weekday='Thursday' THEN 4 
               WHEN weekday='Friday' THEN 5
           else null end as day_num
           from appointment
           join course on course.course_id = appointment.course_id
           join schedule on schedule.schedule_id = appointment.schedule_id
           join user on user.user_id = appointment.ta_id
           where emergency=1 and course.course_id = $course_id
           group by ta_id, appointment.schedule_id
           order by name,day_num,timeslot;
           ") or die("Error: " . mysqli_error($con));

           if(mysqli_num_rows($result)>0){
          ?>
            <table class="table">
                <thead>
                    <tr>
                    <th><input id="chk_all" name="chk_all" type="checkbox"  /> SelectAll</th>
                
                    <th>Course</th>
                    <th>Weekday</th>
                    <th>Timeslot</th>
                    <th>TA</th>
                    <th>Building</th>
                    
                    
                    </tr>
                </thead>
                <tbody>
                
                <?php 
               
                while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>
                <td data-th="SelectAll"><input name="chk_id[]" type="checkbox" class='chkbox' style="font-size:20px;"value="<?php echo $row['schedule_id'].' '.$row['ta_id']; ?>"/></td>
                    <td data-th="Course"><?php echo $row['name']; ?></td>
                    <td data-th="Weekday"><?php echo $row['weekday']; ?></td>
                    <td data-th="Timeslot"><?php echo $row['timeslot']; ?></td>
                    <td data-th="TA"><?php echo $row['TA']; ?></td>
                    <td data-th="Building"><?php echo $row['building_code']; ?></td>
                    
                   
                </tr>
                <?php }?>
                
                </tbody>
            </table>
            <!-- <button id="success-btn"> -->
            <input id="success-btn" name="submit" type="submit" style="background-color:#f4b42f;color:white; border-radius:5px; border: 1px solid #e2eceb;padding:5px 5px; font-size:20px;margin-top:20px;cursor: pointer;" value="Cover his/her shift" onClick='confirm_message();' />
           <?php 
           }else{
            echo "<div  class='no_open'style='display: flex; margin-top:105px;'>";
            echo "<img class='figure' src='../images/figure.png' alt='figure'>";
            echo "<p class='message2'>No Request Posted !!!</div>";
            echo "</div>";

          }
           ?>
            </form>
            
            
<?php


if(isset($_POST['chk_id']))
{
    $arr = $_POST['chk_id'];
    foreach ($arr as $key => $id){

      $content = explode(" ",mysqli_real_escape_string($con,$id)); 
      $sid = $content[0];
      $tid = $content[1];
      $sub=mysqli_query($con,"UPDATE appointment SET emergency=0 , ta_id = $uid WHERE schedule_id = $sid and ta_id = $tid");
    }
  if($sub){
    echo  "<script>
    alert('Thanks for helping your colleague!');
    setTimeout(function(){window.location.href='TA_shift.php';},0);
    </script>";
  }  
}
?>
    
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

function confirm_message(){
var answer = confirm('You will help your colleague to cover his/her shift, are you sure ?');
if(answer){
sub.submit();
}
else{
alert('Cancel the action!');
event.preventDefault();
}
}

</script>

	
   
  </body>
</html>