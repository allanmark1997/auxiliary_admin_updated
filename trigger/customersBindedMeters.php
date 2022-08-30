
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="../plugins/datatables-autofill/css/autoFill.bootstrap4.css">
<link rel="stylesheet" href="../sweetAlert/dist/sweetalert2.min.css">
<script src="../sweetAlert/dist/sweetalert2.min.js"> </script>

          <div class="card-body">
             
            
<form id="myForm" action="meterDetails.php" method="GET">
<input type="hidden" name="myid" id="hiddentext" value="">
</form>
          <div class="col-12 table-responsive">
            <table class="table table-striped" id="example2">
              <thead>
                <tr align="center">    
                  <th><b>ID No.</b></th>
                  <th><b>Serial No.</b></th>
                  <th><b>Meter Type</b></th>
                  <th><b>Binded to</b></th>
                  <th><b>Status</b></th>
                  <th><b>Action</b></th>
                </tr>
              </thead>
                
                <tbody>
                <?php 
                      include("conn.php");
                      $customerSelectedID = $_SESSION['customerID'];
                      $sql="SELECT * FROM meter INNER JOIN customer ON meter.cus_id = customer.cus_id WHERE meter.cus_id = '$customerSelectedID'";
                      $query = mysqli_query($conn,$sql);
                     
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                     ?>

                <tr align="left">
                  <td><?php 
                      echo $row['meter_id'];
                  ?></td>
                  <td data-toggle="popover" class="btnPop">
                    <strong style="color: #33d176;">
                      <?php 
                        echo $row['meter_serialNo'];
                      ?>
                    </strong>
                  </td>
                  <td align="center">
                      <?php
                        if ($row['meter_type'] == 0) {
                          echo "<span class='badge badge-success'>Private Household</span>";
                        }elseif ($row['meter_type'] == 1) {
                          echo "<span class='badge badge-success'>Employee Household</span>";
                        }
                        else{
                          echo "<span class='badge badge-warning'>Something went wrong!</span>";
                        }
                      ?>
                  </td>
                  <td align="center">
                      <?php 
                        $fullname = $row['cus_fname']." ".$row['cus_mname']." ".$row['cus_lname'];
                        
                        if ($row['cus_fname'] == "Not") {
                          echo "<span class='badge badge-danger'>Not Binded</span>";
                        }
                        else{
                        echo $fullname;
                        }
                       ?>
                  </td>
                  <td align="center">
                      <?php
                        if ($row['meter_status'] == 0) {
                          echo "<span class='badge badge-danger'>Deactivated</span>";
                        }elseif ($row['meter_status'] == 1) {
                          echo "<span class='badge badge-success'>Active</span>";
                        }
                        else{
                          echo "<span class='badge badge-warning'>Something went wrong!</span>";
                        }
                      ?>
                  </td>
                  <td align="center">
                      <button class='btn btn-success btn-rounded' ondblclick="btnMeterDetails()">Double click to see Details</button>
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
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

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
  $(document).ready(function() {

    var table = $('#example2').DataTable();
    var hids =  document.getElementById("hiddentext").value
     
    $('#example2 tbody').on('click', 'tr', function () {
      
        var data = table.row( this ).data();
         document.getElementById("hiddentext").value=data[0];

         var val = document.getElementById("hiddentext").value;
    
    });


});
</script>

<script type="text/javascript">
  function btnMeterDetails(){
    document.getElementById("myForm").submit();
  }
</script>
