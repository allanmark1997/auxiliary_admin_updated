<?php 
	 session_start();
	$date = date("Y-m-d");
	$empID = $_SESSION['emp_id'];
	include("conn.php");
	$sqls = "SELECT * FROM meter ORDER BY meter_id DESC LIMIT 1";
	$querys = mysqli_query($conn, $sqls);
	$row = mysqli_fetch_array($querys,MYSQLI_ASSOC);

	$latestRegisteredMeterID = $row["meter_id"];
	$closeconnection=mysqli_close($conn);
	
	include("conn.php");
    $sql = "INSERT INTO meterreading (reading, amount, cubicMeterConsume, readingDate,meter_id, emp_id, paid_status, due_date, excessRate, minimum) 
                VALUES ('0', '0', '0', '$date', '$latestRegisteredMeterID', '$empID', '1', 'Just Registered!', 0, 0)";
    $query = mysqli_query($conn,$sql);

     if ($query) {
       
          echo "saved";
        }
      else{
      	echo "errors";
      }
 ?>