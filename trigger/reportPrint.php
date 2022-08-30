<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
<p><h1>CMU Auxiliary Generate Report</h1></p>
<div class="col-12 table-responsive">
            		<table class="table table-striped" id="example2">
              			<thead>
                			<tr align="center">    
                 			 <th>ID No</th>
                  				<th>Cat</th>
                  				<th>Name</th>
                  				<th>Meter Serial</th>
                  				<th>Address</th>
                  				<th>Pres. Reading</th>
                  				<th>Total Cunsume</th>
                  				<th>Bill Amount</th>
                  				<th>Arrears</th>
                  				<th>Total Amount</th>
                  				<th>Reading Date</th>
                  				<th>Meter Reader</th>
                  				<th>Status</th>
                			</tr>
              		</thead>
<?php 
	$queryDate = $_GET['querydate'];

	include_once "conn.php";
                       $sql="SELECT * FROM meterreading INNER JOIN meter ON meter.meter_id = meterreading.meter_id INNER JOIN customer ON customer.cus_id = meter.cus_id INNER JOIN employee ON employee.emp_id = meterreading.emp_id";
                      $query = mysqli_query($conn,$sql);
                      $totalMeterRead = 0;
                     
                      $pdate = $queryDate;
                      $pdateArray = preg_split("/-/", $pdate);
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                         $dateString = $row['readingDate'];
                          $stringArray = preg_split("/-/", $dateString);
                      if ($stringArray[0] == $pdateArray[0] and $stringArray[1] == $pdateArray[1]){
                        
?>
					<tr align="left">
                  <td><?php 
                      echo $row['reading_id'];
                  ?></td>
                   <td><?php 
                      echo $row['cus_category'];
                  ?></td>
                  <td data-toggle="popover" class="btnPop">
                    <strong style="color: #33d176;">
                      <?php 
                        echo "<b>".$row['cus_lname'].", ".$row['cus_fname']." ".$row['cus_mname']."</b>";
                      ?>
                    </strong>
                  </td>
                  <td align="center">
                      <?php
                        echo $row['meter_serialNo'];
                      ?>
                  </td>
                  <td align="center">
                      <?php
                        echo $row['cus_address'];
                      ?>
                  </td>
                  <td align="center">
                      <?php 
                        echo $row['reading'];
                       ?>
                  </td>
                  <td align="center">
                      <?php
                          echo $row['cubicMeterConsume']; 
                       ?>
                  </td>
                  <td align="center">
                      <?php
                        echo $row['amount'];
                         
                      ?>
                  </td>
                  <td align="center">
                    <?php 
                      echo 0;
                     ?>
                  </td>
                  <td align="center">
                      <?php
                        echo $row['amount'];
                         
                      ?>
                  </td>
                  <td align="center">
                      <?php
                        echo $row['readingDate'];
                         
                      ?>
                  </td>
                  <td align="center">
                    <?php 
                      echo $row['emp_fname']." ".$row['emp_mname']." ".$row['emp_lname'];
                     ?>
                  </td>
                  <td align="center">
                    <?php 
                     if ($row['paid_status'] == 0) {
                          echo "<span class='badge badge-danger'>Unpaid</span>";
                        }elseif ($row['paid_status'] == 1) {
                          echo "<span class='badge badge-success'>Paid</span>";
                        }
                        else{
                          echo "<span class='badge badge-warning'>Something went wrong!</span>";
                        }
                      
                     ?>
                  </td>
                </tr>

					

<?php 

                      }

                      }
                      $closeconnection=mysqli_close($conn);
	
 ?>
 <script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>