
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="plugins/datatables-autofill/css/autoFill.bootstrap4.css">

<link rel="stylesheet" href="sweetAlert/dist/sweetalert2.min.css">
<script src="sweetAlert/dist/sweetalert2.min.js"> </script>
          <div class="card-body">
             
            <p class="h3 text-center mb-4" id="sample"><strong><b>
             Payment History List
             </b></strong></p>
             <label>Please Input Date</label>
             <input type="text" name="" placeholder="Ex. 2020-01" id="queryDate">
             <button onclick="report()">Generate Report</button>
<form id="myForm" action="trigger/deactivateEmployee.php" method="GET">
<input type="hidden" name="myid" id="hiddentext" value="">
</form>
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
                  <th>Employee Handle</th>

                </tr>
              </thead>
                
                <tbody>
                <?php 
                      include("conn.php");
                      $sql="SELECT * FROM payment INNER JOIN meterreading ON meterreading.reading_id = payment.reading_id INNER JOIN meter ON meter.meter_id = meterreading.meter_id INNER JOIN customer ON customer.cus_id = meter.cus_id INNER JOIN employee ON employee.emp_id = payment.emp_id";
                      $query = mysqli_query($conn,$sql);
                     
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
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
                      $closeconnection=mysqli_close($conn);
                 ?>
                 </tbody>
            </table>
          </div>

          </div>

  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
  $(function () {
   // $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script type="text/javascript">
  function report(){
    var queryDate = document.getElementById('queryDate').value
    if (queryDate === "") {
      Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Please input a valid Date as your query.',
                        showConfirmButton: true
                })
    }
      else{
         location.href = "trigger/paymentHistoryPrint.php?querydate="+queryDate;
      }
   
  }
</script>

