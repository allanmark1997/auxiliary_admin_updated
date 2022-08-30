
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
<?php 
		$selectedId = $_POST['meterID'];
 		include ('conn.php');
		$sql="UPDATE meter SET meter_status = 0 WHERE meter_id = '$selectedId'";
        $query = mysqli_query($conn,$sql);
            if ($query == true) {
                echo "ok";
            }
            else{
            echo "no";
            }
          
 ?>