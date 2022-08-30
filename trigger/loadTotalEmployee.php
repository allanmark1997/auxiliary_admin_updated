
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
              Employee Lists
             </b></strong></p>
<form id="myForm" action="trigger/deactivateEmployee.php" method="GET">
<input type="hidden" name="myid" id="hiddentext" value="">
</form>
          <div class="col-12 table-responsive">
            <table class="table table-striped" id="example2">
              <thead>
                <tr align="center">    
                  <th><b>ID No.</b></th>
                  <th><b>Name</b></th>
                  <th><b>Position</b></th>
                  <th><b>Username</b></th>
                  <th><b>Date Created</b></th>
                  <th><b>Status</b></th>
                  <th><b>Action</b></th>
                </tr>
              </thead>
                
                <tbody>
                <?php 
                      include("conn.php");
                      $sql="SELECT * FROM employee";
                      $query = mysqli_query($conn,$sql);
                     
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                     ?>

                <tr align="left">
                  <td><?php 
                      echo $row['emp_id'];
                  ?></td>
                  <td data-toggle="popover" class="btnPop">
                    <strong style="color: #33d176;">
                      <?php 
                        echo "<b>".$row['emp_lname'].", ".$row['emp_fname']." ".$row['emp_mname']."</b>";
                      ?>
                    </strong>
                  </td>
                  <td align="center">
                      <?php
                        if ($row['emp_position'] == 0) {
                          echo "<span class='badge badge-success'>Meter Reader</span>";
                        }elseif ($row['emp_position'] == 1) {
                          echo "<span class='badge badge-success'>Administrator</span>";
                        }
                        elseif($row['emp_position'] == 2){
                          echo "<span class='badge badge-success'>Staff</span>";
                        }
                      ?>
                  </td>
                  <td align="center">
                      <?php 
                        echo $row['username'];
                       ?>
                  </td>
                  <td align="center">
                      <?php
                          echo $row['emp_dateCreated']; 
                       ?>
                  </td>
                  <td align="center">
                      <?php
                        if ($row['emp_status'] == 0) {
                          echo "<span class='badge badge-danger'>Deactivated</span>";
                        }elseif ($row['emp_status'] == 1) {
                          echo "<span class='badge badge-success'>Active</span>";
                        }
                        else{
                          echo "<span class='badge badge-warning'>Something went wrong!</span>";
                        }
                      ?>
                  </td>
                  <td align="center">
                    <?php
                        if ($row['emp_status'] == 1) {
                    ?>
                      <button class='btn btn-danger btn-rounded' ondblclick="btnDeactivate()">Double Click to Deactivate</button>

                    <?php
                        }elseif ($row['emp_status'] == 0) {
                    ?>
                      <button class='btn btn-success btn-rounded' ondblclick="btnActivate()">Double Click to Activate</button>
                    <?php
                        }
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
  $(document).ready(function() {

    var table = $('#example2').DataTable();
    //var hids =  document.getElementById("hiddentext").value
     
    $('#example2 tbody').on('click', 'tr', function () {
      
    var data = table.row( this ).data();
    document.getElementById("hiddentext").value = data[0];

    var val = document.getElementById("hiddentext").value;


    $('.mybtn').not(this).popover('hide');

    });
    
});
  
</script>
<script>
function btnActivate()
{
  var myid=$("#hiddentext").val();
       //document.getElementById("myForm").submit();
        $.ajax({
            url  : 'trigger/activateEmployee.php',
            method: 'POST',
            data : {myid:myid},
            success :  function(datas){
                if (datas.trim() === "meter reader") {
                  Swal.fire({
                        icon: 'warning',
                        title: 'Invalid',
                        text: 'Meter reader connot Activate any acccount.',
                        showConfirmButton: true
                      })
                }
                else if (datas.trim() === "ownAccountConnotBeActivatedOrDeactivated") {
                  Swal.fire({
                        icon: 'warning',
                        title: 'Invalid',
                        text: 'You connot deactivate or activate your account.',
                        showConfirmButton: true
                      })
                }
                else if (datas.trim() === "adminAcc") {
                  Swal.fire({
                        icon: 'warning',
                        title: 'Invalid',
                        text: 'You connot deactivate or activate any Administrator account',
                        showConfirmButton: true
                      })
                }
                else if (datas.trim() === "ok") {
                  Swal.fire({
                        icon: 'success',
                        title: 'Activated',
                        text: 'Success you activated an account.',
                        showConfirmButton: true
                      })
                      $.ajax({
                      type : 'POST',
                      url  : 'trigger/loadTotalEmployee.php',
                      success :  function(data){
                      $('#showEmployeeList').empty();
                      $("#showEmployeeList").html(data)
                      }
                      });
                }
                else if (datas.trim() === "no") {
                  Swal.fire({
                        icon: 'warning',
                        title: 'Invalid',
                        text: 'Something went wrong',
                        showConfirmButton: true
                      })
                }
                else if (datas.trim() === "staff") {
                  Swal.fire({
                        icon: 'warning',
                        title: 'Invalid',
                        text: 'Staff connot activate any account, only Administrator',
                        showConfirmButton: true
                      })
                }
                else if (datas.trim() === "wrong") {
                  Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Somthing went wrong',
                        showConfirmButton: true
                      })
                }
              }
         });      
}
</script>
<script>
function btnDeactivate()
    {
       var myid=$("#hiddentext").val();
       //document.getElementById("myForm").submit();
        $.ajax({
            url  : 'trigger/deactivateEmployee.php',
            method: 'POST',
            data : {myid:myid},
            success :  function(datas){
                  if (datas.trim() === "meter reader") {
                  Swal.fire({
                        icon: 'warning',
                        title: 'Invalid',
                        text: 'Meter reader connot Activate any acccount.',
                        showConfirmButton: true
                      })
                }
                else if (datas.trim() === "ownAccountConnotBeActivatedOrDeactivated") {
                  Swal.fire({
                        icon: 'warning',
                        title: 'Invalid',
                        text: 'You connot deactivate or activate your account.',
                        showConfirmButton: true
                      })
                }
                else if (datas.trim() === "adminAcc") {
                  Swal.fire({
                        icon: 'warning',
                        title: 'Invalid',
                        text: 'You connot deactivate or activate any Administrator account',
                        showConfirmButton: true
                      })
                }
                else if (datas.trim() === "ok") {
                  Swal.fire({
                        icon: 'success',
                        title: 'Deactivated',
                        text: 'Success you deactivate an account.',
                        showConfirmButton: true
                      })
                      $.ajax({
                      type : 'POST',
                      url  : 'trigger/loadTotalEmployee.php',
                      success :  function(data){
                      $('#showEmployeeList').empty();
                      $("#showEmployeeList").html(data)
                      }
                      });
                }
                else if (datas.trim() === "no") {
                  Swal.fire({
                        icon: 'warning',
                        title: 'Invalid',
                        text: 'Something went wrong',
                        showConfirmButton: true
                      })
                }
                else if (datas.trim() === "staff") {
                  Swal.fire({
                        icon: 'warning',
                        title: 'Invalid',
                        text: 'Staff connot activate any account, only Administrator',
                        showConfirmButton: true
                      })
                }
                else if (datas.trim() === "wrong") {
                  Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Somthing went wrong',
                        showConfirmButton: true
                      })
                }
              }
         });
    }
</script>
