
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
<?php 
		$selectedId = $_POST['selectedMeterID'];
 		include ('conn.php');
		$sql="UPDATE customer SET cus_status = 0 WHERE cus_id = '$selectedId'";
        $query = mysqli_query($conn,$sql);
            if ($query == true) {
                echo "ok";
            }
            else{
            echo "no";
            }
          
 ?>