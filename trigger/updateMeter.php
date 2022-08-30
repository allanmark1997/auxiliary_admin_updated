<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>

<?php 
	$meterSerial = $_POST['meterSerialNo'];
	$meterType = $_POST['metertype'];
	$meterID = $_POST['meterID'];

	if ($_SESSION['emp_position'] == 1) {
	include ("conn.php");
	$sql = "UPDATE meter SET meter_serialNo = '$meterSerial', meter_type = '$meterType' WHERE meter_id = '$meterID'";
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "ok";
	}
	else{
		echo "no";
	}

	}
	else{
		echo "notAdmin";
	}
	
 ?>