<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>

<?php 
	if ( $_SESSION['emp_position'] == 1) {
		$firstName = $_POST['firstName'];
		$middleName = $_POST['middleName'];
		$lastName = $_POST['lastName'];
		$address = $_POST['address'];
		$custype = $_POST['custype'];
		$contactNo = $_POST['contactNo'];
		$cus_id = $_POST['cusID'];

		include('conn.php');
		$sql = "UPDATE customer SET cus_fname = '$firstName', cus_mname = '$middleName', cus_lname = '$lastName', cus_address = '$address', cus_contactNo = '$contactNo', cus_category = '$custype' WHERE cus_id = '$cus_id'";
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