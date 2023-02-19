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
    /*config.php contains all the connection information*/
    include '../config/config.php';
    $class = $_SESSION['course'];
    $course_id = mysqli_fetch_array(mysqli_query($con,"select course_id from course where name='$class'"))[0];
?>
<!doctype html>
<html lang="en">
  <head>

  	<title>Visualization</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	  <link rel="preconnect" href="https://fonts.gstatic.com">
	  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src="https://kit.fontawesome.com/bf37eaf948.js" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="../style/css/nav.css">
	  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	  <link rel="stylesheet" href="../style/css/calendar.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--Style Start-->
    <style>
    html,body{
      width: 100%;
      height: 100%;
      margin: 0px;
      padding: 0px;
      overflow-x: hidden; 
	  }

 	  body{
      color: black; 
    }
    ul{
      list-style-type:none;
    }
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
     	font-size:11px;
    }
	  #sidebar{
      position: -webkit-sticky;
      position: sticky;
      height:1000px !important;
  	  top: 0;
  	  }
    #sidebar i{
      padding-right: 27px;
      width: 20px;
      height: 20px;
      }
    .quote{
		  margin: 0 auto; 
		  font-size: 17px; 
		  font-weight: bold;
		  width: 620px;
		  color: #7a040e;
		  font-family: cursive;
	  }
    .done_msg{
      text-align:center;
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
    .contact-links{
      float:right;
    }
    #sidebar ul li.active > a {
      color: rgba(255, 255, 255, 0.8);
    }
    .outsidebox{
        position:relative;
    }
    .container{
      position: relative;
      max-width: 1000px;
      max-height: 800px;
      transform: translate(0%, 0%);
    }
    .wrapper{
      height:1500px;
    }
    #buttons input{
      margin: 10px 5px;
    }
    select{
      width: 270px !important;
      height: 40px !important;
      font-size:20px;
    }
    #chart {
      width: 900px; 
      min-height: 550px;
    }
    #chart_wrap {
      margin:0 !important;
    }
    #submit{
      margin-left: 20px;
      margin-top:-5px;
    }
    .msg{
    margin-top:10px;
    margin-left:7px; 
    font-size:18px;}
    .custom-select{margin-left:5px;}
    @media (max-width: 1350px) {
      #buttons{
        display: flex;
        flex-flow: row wrap;
      }
    }
    @media (max-width: 1122px) {
      #buttons{
        display: flex;
        flex-flow: row wrap;
      }
      .container{
        margin-top:-30px;
      }
      #chart{
        transform:scale(0.8);
        margin: -60px 0 0 -85px !important; 
      }
      #chart_wrap{
        width: 300px;
      }
    } 
    @media (max-width: 825px){
      #submit{
        margin-top:-7px;
      }
      #chart{
        transform:scale(0.65);
        margin: -100px 0 0 -154px !important; 
      }
      select{
        width: 180px !important;
      }
    }  
    @media (max-width: 700px){
      #submit{
      	transform:scale(.7);
        margin:-5px 20px 0 0;
      }
      #buttons{transform:scale(.7); margin:-40px 0 0 -30px;}
      #chart{
        transform:scale(0.32);
        margin: -220px 0 0 -300px !important; 
      }
      select{
      	margin-top:45px !important;
        width: 120px !important;
        height: 25px !important;
        font-size:13px;
      }
      .msg{font-size:13px;}
      .custom-select{width:220px;}
    }   
 </style>
    <!--Style end-->

  </head>

  <body>

  <div class="wrapper">
    <!--Sidebar Start-->
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
                  /*Show Courses in Database - php sql call*/
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
                  /*Show Courses in Database - js functions*/
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
            	<a href="https://cgi.luddy.indiana.edu/~team63/Dashboard/Dashboard.php" class="top-link"><i class="fas fa-bullhorn"></i>Dashboard</a>
              </li>
	          <li>
            	<a href="https://cgi.luddy.indiana.edu/~team63/profile/profile.php" class="top-link"><i class="fas fa-user-circle"></i>Profile</a>
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
	          <?php 
	          if (in_array('instructor', $all_role)){
              echo "<li><a href='https://cgi.luddy.indiana.edu/~team63/upload_information/upload_information.php'><i class='fas fa-upload'></i>Upload Information</a></li>";
              echo "<li><a href='https://cgi.luddy.indiana.edu/~team63/Visualization/Visualization.php' style='color:#f8b739; fonr-weight:800;'><i class='fas fa-chart-line'></i>Visualization</a></li>";
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
                <div class="dark-mode-switch">
                  <div class="dark-mode-switch-ident"></div>
                </div>
              </div>
            </div>
            <div class="month-list"></div>
          </div>
          <!-- calendar ends above -->

          <script src="../style/js/app.js"></script>
          <!-- Log Out Feature -->
			    <form action="../IU_Login/logout.php">
       	  	<a href="https://idp.login.iu.edu/idp/profile/cas/logout"><button class="btn btn-primary" id="logout" type="submit">Log out</button></a>
        	  <a href="mailto:IUcapstoneTeam63@gmail.com" class="contact-links"><button class="btn btn-primary" id="contact" type="button">Contact</button></a>
        	</form>
        	
          <!-- Footer -->
	        <div class="footer">
	        	<p>Copyright &copy; 2021 Team63. All Right Reserved</p>
	        </div>
	      </div>
    	</nav>
      <!--Sidebar End-->
    
       
       
    <!-- Top Page Content Start --> 
      <div id="content">
        <nav class="navbar" style="margin-top: -27px;">
          <div class="container-fluid">

            <!--Menu button to hide and show sidebar-->
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
        /*show and hide sidebar onclick function*/
          function menuFunction() {
            var x = document.getElementById("sidebar");
            if (x.style.display === "none") {
              x.style.display = "block";
            }else {
              x.style.display = "none";
            }
          }
          </script>
    <!-- Top Page Content End --> 
      
    <!-- Page Content Start --> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <div class='container'>
    <div class="custom-select"><!-- Start of 'custom-select' div tag -->
      <form action='#' method='get'> <!-- Start of post method form -->
        <?php
          $result = @mysqli_query($con,"select course_id, name from course;") or die("Error: " . mysqli_error($con));
          while($row = mysqli_fetch_array($result)) {
            $result_course[] = $row['name'];
            $result_courseid[] = $row['course_id'];
          }

          $new = array();
          for ($x=0; $x<sizeof($result_course);$x++){
            $new[$result_courseid[$x]] = $result_course[$x];
          }
          echo"<select name='course_selection' id='course'>";
          foreach ($new as $course_id => $name){
          	$class = $_GET['course_selection'];
          	$r = ($course_id == $class) ? 'selected' : '';
            echo "<option value='$course_id'".$r.">".$name."</option>";
          }
          echo '</select>';
          echo '<input type="submit" id="submit" class="btn btn-primary" name="submit" value="Submit"/>';
        ?>
      </form> <!-- End of post method form -->
    </div> <!-- End of 'custom-select' div tag -->

  <?php
    // Pass value from get method
    if($_GET) {
      $class = $_GET['course_selection'];
      $result = @mysqli_query($con,"select name from course where course_id = $class;") or die("Error: " . mysqli_error($con));
      while($row = mysqli_fetch_array($result)) {
        $coursename = $row['name'];
      }
      echo"<p class='msg'>You have selected:<br> <b>$coursename</b></p>";
    }
    //define sql statement to get data according to the value from get method
    $sql ="select schedule.weekday as 'weekday',count(appointment.appointment_id) as 'appointment'
    from finalized_OHschedule 
    join appointment on finalized_OHschedule.schedule_id = appointment.schedule_id
    join schedule on finalized_OHschedule.schedule_id=schedule.schedule_id
    where finalized_OHschedule.course_id = $class
    group by weekday
    order by 
      CASE
        WHEN weekday = 'Sunday' THEN 1
        WHEN weekday = 'Monday' THEN 2
        WHEN weekday = 'Tuesday' THEN 3
        WHEN weekday = 'Wednesday' THEN 4
        WHEN weekday = 'Thursday' THEN 5
        WHEN weekday = 'Friday' THEN 6
        WHEN weekday = 'Saturday' THEN 7
      END ASC
    ;";
  ?>

  <script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Draw the line chart when submt button was clicked as an example.
    google.charts.setOnLoadCallback(lineChart);

    // get value from php
    var coursename =  "<?= $coursename ?>";

    // define the option for graphs to save too many duplicate lines of code
    var options = {
      title: "Student Appointments on Days of Week for " + coursename,
      width: 650,
      height: 550,
      sliceVisibilityThreshold :0,
      legend: { position: 'bottom' },
      axes: { x: { 0: {side: 'top'} }}
    };

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function lineChart() { // function to draw line chart.
      var appointment = google.visualization.arrayToDataTable([
        ['weekday', 'appointment'],
        <?php
          $result = @mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
          while($row = mysqli_fetch_array($result)){
            echo "['".$row['weekday']."',".$row['appointment']."],";
          };
        ?>
      ]);
      var chart = new google.visualization.LineChart(document.getElementById('chart'));
      chart.draw(appointment, options);
    }

    function barChart() {// function to draw bar chart.
      var appointment = google.visualization.arrayToDataTable([
        ['weekday', 'appointment'],
        <?php
          $result = @mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
          while($row = mysqli_fetch_array($result)){
            echo "['".$row['weekday']."',".$row['appointment']."],";
          };
        ?>
      ]);
      var chart = new google.visualization.BarChart(document.getElementById("chart"));
      chart.draw(appointment, options);
    }

    function pieChart() { // function to draw pie chart.
      var appointment = google.visualization.arrayToDataTable([
        ['weekday', 'appointment'],
        <?php
          $result = @mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
          while($row = mysqli_fetch_array($result)){
            echo "['".$row['weekday']."',".$row['appointment']."],";
          };
        ?>
      ]);
      var chart = new google.visualization.PieChart(document.getElementById("chart"));
      chart.draw(appointment, options);
    }

    function donutChart(){ // function to draw donut chart.
      var appointment = google.visualization.arrayToDataTable([
        ['weekday', 'appointment'],
        <?php
          $result = @mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
          while($row = mysqli_fetch_array($result)){
            echo "['".$row['weekday']."',".$row['appointment']."],";
          };
        ?>
      ]);
      var options = { // re-define the option for donut chart since it has piehole.
      title: 'Student Appointments on Days of Week',
      width: 650,
      height: 550,
      sliceVisibilityThreshold :0,
      legend: { position: 'bottom' },
      axes: { x: { 0: {side: 'top'} }},
      pieHole: 0.4
    };
      var chart = new google.visualization.PieChart(document.getElementById("chart"));
      chart.draw(appointment, options);
    }

    function scatterChart() { // function to draw line chart.
      var appointment = google.visualization.arrayToDataTable([
        ['weekday', 'appointment'],
        <?php
          $result = @mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
          while($row = mysqli_fetch_array($result)){
            echo "['".$row['weekday']."',".$row['appointment']."],";
          };
        ?>
      ]);
      var chart = new google.visualization.ScatterChart(document.getElementById("chart"));
      chart.draw(appointment, options);
    }

</script>

  <!-- display the chart option buttons --> 
  <div id = "buttons">

    <input type="button"  id="linechart" class="btn btn-primary" value="Line Chart" onclick="lineChart()"> 
    <input type="button"  id="barchart" class="btn btn-primary" value="Bar Chart" onclick="barChart()">
    <input type="button"  id="barchart" class="btn btn-primary" value="Pie Chart" onclick="pieChart()">
    <input type="button"  id="barchart" class="btn btn-primary" value="Donut Chart" onclick="donutChart()">
    <input type="button"  id="barchart" class="btn btn-primary" value="Scatter Chart" onclick="scatterChart()">

  </div>
  
<br>
    <!-- display the chart --> 
    <div id="chart_wrap">
      <div id="chart"></div>
    </div>
    </div>

    </div>
    </div>
    <!-- Page Content End --> 
  </div>
    
  </body>
</html>
