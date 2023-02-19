<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="update_availability.css">
    <script src="https://kit.fontawesome.com/03a1b60f2c.js" crossorigin="anonymous"></script>
    <title>Update Availability</title>
</head>
<body>
	<form action="generate.php" method="post">
	<div class="titlebar">
        <img class="logo"src="image/IULogo.png" alt="">
    
        <p class="iub">OFFICE HOUR SCHEDULER</p>
    </div>
    <div class="middlebar">
        <p>INFO-I495</p>
    </div>
    <hr size="2" width="100%" color="black">
<?php
	/* connect to database */
	$con = mysqli_connect("db.soic.indiana.edu","i494f20_team63","my+sql=i494f20_team63", "i494f20_team63");
	if (!$con) {
		/* if failed, show the error message */
    	die("Connection failed: " . mysqli_connect_error() . "<br>");
	}

    $dataArray = array();
    $finalized_schedule = array();

    $qry_schedule = mysqli_query("SELECT schedule_id FROM schedule;");
    $res = mysqli_fetch_array($qry_schedule);
    echo "0";
    foreach ($qry_schedule as $x => $val){
        echo "0.1";
        $dataArray[$val] = array(); /* for each schedule_id, create an empty array */
        print_r($dataArray);
        $finalized_schedule[$res['schedule_id']] = array();  /*initialize the final schedule array*/
        
        $qry = mysqli_query("SELECT ta_id FROM ta_availability WHERE schedule_id = $val;");
        $res_schedule = mysqli_fetch_array($qry);
        
        echo "1";
        foreach ($res_schedule as $y => $v){
            array_push($dataArray,$v);
            
            echo "2";
        }
    }
    print_r($dataArray);
    

    $dataArray_copy = $dataArray;
    array_multisort(array_map('count', $dataArray_copy), $dataArray_copy);
    foreach($dataArray_copy as $i => $j){
        if (count($v) < 3 && count < 8){
            array_push ($finalized_schedule[$res['schedule_id']], $v);
            $count += 1;
        }
    }
    print_r($finalized_schedule);

    foreach ($finalized_schedule as $i => $j){
        $count = 0;
        while ($count <3){
            $insertschedule = "INSERT INTO OHschedule (schedule_id, ta_id) VALUES ($i, $j[$count]);";
            $count += 1;
            echo "insert 1";
        }
    }

    echo "<center>";
    echo "<input class='sub' type='submit' value='submit' name='submit'>";
    echo "</center>";

mysqli_close($con);   
?>
	<footer class="footer">
        <hr size="2" width="100%" color="black">  
        <p>Contact us: info-i495-team63@gmail.com</p>
    </footer>
</body>
</html>