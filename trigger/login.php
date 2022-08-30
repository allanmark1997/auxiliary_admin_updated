<?php 
  session_start();
 
 if (isset($_POST['username']) && isset($_POST['password'])) {

      $user = $_POST['username'];
      $pass = $_POST['password'];
      
            include_once 'conn.php';
            $sql="SELECT * FROM employee where username = '$user' && password = '$pass'";
            $query = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
            if (mysqli_num_rows($query) > 0) {
                  if ($row['emp_status']==0) {
                        echo "disabled";
                  }
                  else{
                        $_SESSION['emp_id'] = $row['emp_id'];

                        $_SESSION['emp_fname'] = $row['emp_fname'];
                        $_SESSION['emp_mname'] = $row['emp_mname'];
                        $_SESSION['emp_lname'] = $row['emp_lname'];
                        $_SESSION['emp_password'] = $row['password'];
                        $_SESSION['emp_position'] = $row['emp_position'];
                        echo "ok";
                  }
                  
            }
            else{
                  echo "wrong";
                  }
            $closeconnection=mysqli_close($conn);
 }
 

 ?>