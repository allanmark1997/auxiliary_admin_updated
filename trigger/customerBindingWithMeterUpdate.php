
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
  ?>

  <?php 
     $selectedMeterID = $_SESSION['selectedMeterID'];
     $selectedCustomer = $_POST["selectedCustomer"];
     include("conn.php");
     $sql="UPDATE meter SET cus_id = '$selectedCustomer' WHERE meter_id = '$selectedMeterID'";
     $query = mysqli_query($conn,$sql);
            if ($query == true) {
                echo "ok";
            }
            else{
            echo "no";
            }
   ?>