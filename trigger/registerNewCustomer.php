
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
?>

<?php 
	$firstName = $_POST['firstName'];
	$middleName = $_POST['middleName'];
	$lastName = $_POST['lastName'];
	$address = $_POST['address'];
	$custype = $_POST['custype'];

	include("conn.php");
	$sql = "INSERT INTO customer (cus_fname, cus_mname, cus_lname, cus_address, cus_category, cus_status) VALUES ('$firstName', '$middleName', '$lastName', '$address', '$custype', 0)";
	$query = mysqli_query($conn,$sql);

		if ($query) {
			echo "ok";
		}
		else{
			echo "no";
		}
 ?>