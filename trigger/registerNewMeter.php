
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
<?php 
	$meterSerialNo = $_POST['meterSerialNo'];
	$metertype = $_POST['metertype'];

	include("conn.php");
	$sqls = "SELECT * FROM meter WHERE meter_serialNo = '$meterSerialNo'";
	$querys = mysqli_query($conn, $sqls);
	 if (mysqli_num_rows($querys) > 0) {
	 	echo "duplication";
	 }
	 else{
	 	$sql = "INSERT INTO meter (meter_serialNo, meter_type, cus_id, meter_status, meter_area) VALUES ('$meterSerialNo', '$metertype', 836, 0, 0)";
		$query = mysqli_query($conn,$sql);

		if ($query) {
			echo "ok";
		}
		else{
			echo "no";
		}
	 }

	
 ?>