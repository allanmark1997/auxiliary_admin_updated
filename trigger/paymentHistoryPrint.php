<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
<p><h1>CMU Auxiliary Payment History Report</h1></p>
<div class="col-12 table-responsive">
            <table class="table table-striped" id="example2">
              <thead>
                <tr align="center">    
                  <th>Payment ID</th>
                  <th>Customer Name</th>
                  <th>Reading ID</th>
                  <th>Meter Serial</th>
                  <th>Total Payment</th>
                  <th>Payment Type</th>
                  <th>Payment Details</th>
                  <th>Date Paid</th>
                  <th>Employee Handled</th>

                </tr>
              </thead>
                
                <tbody>
<?php 
$queryDate = $_GET['querydate'];
	include_once "conn.php";
                        $sql="SELECT * FROM payment INNER JOIN meterreading ON meterreading.reading_id = payment.reading_id INNER JOIN meter ON meter.meter_id = meterreading.meter_id INNER JOIN customer ON customer.cus_id = meter.cus_id INNER JOIN employee ON employee.emp_id = payment.emp_id";
                      $query = mysqli_query($conn,$sql);
                      $totalMeterRead = 0;
                     
                      $pdate = $queryDate;
                      $pdateArray = preg_split("/-/", $pdate);
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                         $dateString = $row['datePaid'];
                          $stringArray = preg_split("/-/", $dateString);
                      if ($stringArray[0] == $pdateArray[0] and $stringArray[1] == $pdateArray[1]){
 ?>

                <tr align="left">
                  <td><?php 
                      echo $row['p_id'];
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
                        echo $row['reading_id'];
                      ?>
                  </td>
                  <td align="center">
                      <?php
                        echo $row['meter_serialNo'];
                      ?>
                  </td>
                  <td align="center">
                      <?php 
                        echo $row['amountPaid'];
                       ?>
                  </td>
                  <td align="center">
                      <?php
                          echo $row['paymentType']; 
                       ?>
                  </td>
                  <td align="center">
                      <?php
                        echo $row['payrollNo'];
                         
                      ?>
                  </td>
                  <td align="center">
                    <?php 
                      echo $row['datePaid'];
                     ?>
                  </td>
                  <td align="center">
                    <?php 
                      echo $row['emp_fname']." ".$row['emp_mname']." ".$row['emp_lname'];
                     ?>
                  </td>
                </tr>
 <?php 

                      }

                      }
                      $closeconnection=mysqli_close($conn);
	
 ?>
                  </tbody>
            </table>
          </div>

          </div>

          
 <script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>