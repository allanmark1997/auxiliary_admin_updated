
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>

<?php 
	$orNo = $_POST['orNo'];
	$amount = $_POST['amount'];
	$meterreadingID = $_POST['meterreadingID'];
	$datePaid = date("Y-m-d");
	$paymentType = "Casher Payment";
	$emp_id = $_SESSION['emp_id'];

	include("conn.php");
	$sql = "INSERT INTO payment (reading_id, amountPaid, datePaid, payrollNo, paymentType, emp_id) VALUES ('$meterreadingID', '$amount', '$datePaid', '$orNo', '$paymentType', '$emp_id')";
	$query = mysqli_query($conn,$sql);

		if ($query) {
			echo "ok";
		}
		else{
			echo "no";
		}

	$sqls = "UPDATE meterreading SET paid_status = 1 WHERE reading_id = '$meterreadingID'";
	$querys = mysqli_query($conn,$sqls);
 ?>