<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>

<?php 
	$updatedExessRate = $_POST['excessRate'];
	$updatedMinimumEmployee = $_POST['minimumEmployee'];
	$updatedMinimumPrivate = $_POST['minimumPrivate'];

  if ($_SESSION['emp_position'] == 1) {
	include('conn.php');
	$sql = "UPDATE rate SET existRate = '$updatedExessRate', minimumEmployee = '$updatedMinimumEmployee', minimumPrivate = '$updatedMinimumPrivate'";
	 $query = mysqli_query($conn,$sql);
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