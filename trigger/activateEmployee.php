<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
?>

<?php 

    if ($_SESSION['emp_position'] == 0) {
      echo "meter reader";
    }
    elseif ($_SESSION['emp_position'] == 1) {
        $selectedId = $_POST['myid'];
        if ($_SESSION['emp_id'] == $selectedId) {
          echo "ownAccountConnotBeActivatedOrDeactivated";
        }
        else{
          include ('conn.php');
          $sqls="SELECT * FROM employee WHERE emp_id = '$selectedId' AND emp_position = 1";
          $querys = mysqli_query($conn,$sqls);
          if (mysqli_num_rows($querys) > 0) {
            echo "adminAcc";
            }
          else{
            
        $sql="UPDATE employee SET emp_status = 1 WHERE emp_id = '$selectedId'";
        $query = mysqli_query($conn,$sql);
            if ($query) {
                echo "ok";
            }
            else{
            echo "no";
            }
          }
          
        }
        
    }
    elseif ($_SESSION['emp_position'] == 2) {
      echo "staff";
    }
    else{
      echo "wrong";
    }
	 
 ?>