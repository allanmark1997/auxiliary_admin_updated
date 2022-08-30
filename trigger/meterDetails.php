<script src="../js/jquery-3.4.1.min.js"></script>

<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Central Mindanao University</title>
  <!-- Font Awesome <link rel="stylesheet" href="css/all.css"> -->
  

<!-- header logo -->
<link rel="icon" href="../cmuLogo.png" type="image/x-icon">

  
    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="../css/mdb.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="../plugins/datatables-autofill/css/autoFill.bootstrap4.css">
<link rel="stylesheet" href="../sweetAlert/dist/sweetalert2.min.css">
<script src="../sweetAlert/dist/sweetalert2.min.js"> </script>



   <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->
  <!-- Ionicons 
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
  <!-- Theme style -->

  <!-- Google Font: Source Sans Pro -->
  <style>

    .map-container{
overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;
}
.map-container iframe{
left:0;
top:0;
height:100%;
width:100%;
position:absolute;
}
</style>
  <!-- Your custom styles (optional) -->
  <style>
body{
           background: url("../background/awesome-water-background-1.jpg")no-repeat center center;
            background-size: cover;
        }
  </style>
</head>

<body class="fixed-sn white-skin">

  <!-- Main Navigation -->
  <header>

    <!-- Sidebar navigation -->
 
    <!-- Sidebar navigation -->

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">

      <!-- SideNav slide-out button -->

      <!-- Breadcrumb -->
      <div class="breadcrumb-dn mr-auto">
        <button value="Back" onclick="goBack()"><strong><b><i class="w-fa fas fa-arrow-left"></i>BACK</button>
      </div>

      <!-- Navbar links -->
      <ul class="nav navbar-nav nav-flex-icons ml-auto">
      </ul>
      <!-- Navbar links -->

    </nav>
    <!-- Navbar -->

  </header>
  <!-- Main Navigation -->

  <!-- Main layout -->
  <main>
    <section class="mt-md-10 pt-md-2 mb-5 pb-3">
    <div class="container-fluid">
      <div class="center">

        <div class="col-xl-12 col-lg-4 col-md-5 col-sm-12 mx-auto mt-lg-1" align="center">
  
          <!--Card -->
          <div class="card" id="showMeterList">
            <?php 
              $selectedMeterID = $_GET['myid'];
              $_SESSION['selectedMeterID'] = $selectedMeterID ;
              $selectedMeterID = $_SESSION['selectedMeterID'];
              include('conn.php');
              $sql = "SELECT * FROM meter INNER JOIN customer ON meter.cus_id = customer.cus_id WHERE meter_id = '$selectedMeterID'";
              $query = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
             ?>
            <!--Card content -->
          <div class="card-body">
            <p onclick="updateMeter()"><i class="fa fa-pencil-alt float-right"></i></p>
            <p class="h3 text-left mb-4"><strong><b>
              METER DETAILS
             </b></strong></p>

            <hr>
           <div class="row m-b-20">
            <div class="col-6 col-md-6">
            <p class="h5 text-left mb-4">
              Meter ID: <p id="meterID"><?php echo $row['meter_id']; ?></p>
            </p>
            <hr>
            <p class="h5 text-left mb-4 strong-text">
              Meter Serial No: </p> 
              <strong><p style="font-size: 35px;"> <?php $serialNo = $row['meter_serialNo'];  echo $serialNo; ?> </p></strong>
           
            <hr>
            </div>
            <div class="col-6 col-md-6">
              <p class="h5 text-left mb-4">
                Meter Type: 
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
              </p>
              <hr>
              <p class="h5 text-left mb-4">
              Binded to: 
              <?php 
                        $fullname = $row['cus_fname']." ".$row['cus_mname']." ".$row['cus_lname'];
                        
                        if ($row['cus_fname'] == "Not") {
                          echo "<span class='badge badge-danger'>Not Bounded</span>";
                        }
                        else{
                        echo $fullname;
                        }
               ?>
            </p>
            <hr>
            <p class="h5 text-left mb-4" id="meterStatusHtml">
              Meter Status: 
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
            </p>
            <hr>
            <div id="buttonDeactivateAndActivate">
              <?php
              $meterStatusButton = $row['meter_status'];
               ?>
                <button class='btn btn-danger btn-rounded' id="btnDeactivate">Deactivate</button>
                <button class='btn btn-success btn-rounded' id="btnActivate">Activate</button>

          </div>
             <button class='btn btn-primary btn-rounded' onclick="btnBind()">Bind Customer</button>
             <hr>
            </div>
            <div class="col-6 col-md-6">
              <p><strong>Please Select Category</strong></p>
            <select class="form-control form-control-primary"  name="zone2" id="metertype" onchange="hide(value)">
               <option value="">Overall List</option>
               <option value="1">Paid List</option>
               <option value="0">Unpaid List</option>
            </select>
            <script type="text/javascript">
              function hide(value){
                if (value === "") {
                  $("#overallList").show();
                  $("#paidList").hide();
                  $("#unpaidList").hide();
                }
                else if (value === "1") {
                  $("#paidList").show();
                  $("#unpaidList").hide();
                  $("#overallList").hide();
                }
                else if (value === "0") {
                  $("#paidList").hide();
                  $("#unpaidList").show();
                  $("#overallList").hide();
                }
              }
            </script>
          </div>
          <div class="col-12 col-md-12">
            <hr>
          <p><strong>OVERALL LIST</strong></p>
          </div>
            <div class="col-12 table-responsive">
            <table class="table table-striped" id="overallList">
              <thead>
                <tr align="center">    
                  <th><b>Reading ID.</b></th>
                  <th><b>Reading</b></th>
                  <th><b>Amount</b></th>
                  <th><b>Reading Date</b></th>
                  <th><b>Consumed</b></th>
                  <th><b>Meter Reader</b></th>
                  <th><b>Payment Status</b></th>
                  <th><b>Due Date</b></th>
                  <th><b>Action</b></th>
                </tr>
              </thead>
                
                <tbody>
                <?php 
                      include("conn.php");
                      $selectedMeterID = $_SESSION['selectedMeterID'];

                      $sql="SELECT * FROM meter INNER JOIN meterreading ON meterreading.meter_id = meter.meter_id INNER JOIN employee ON employee.emp_id = meterreading.emp_id WHERE meterreading.meter_id = '$selectedMeterID'";
                      $query = mysqli_query($conn,$sql);
                     
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                     ?>

                <tr align="left">
                  <td><?php 
                      echo $row['reading_id'];
                  ?></td>
                  <td data-toggle="popover" class="btnPop">
                    <strong style="color: #33d176;">
                      <?php 
                        echo $row['reading'];
                      ?>
                    </strong>
                  </td>
                  <td align="center"><i class="w-fa fas fa-ruble-sign"></i>
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
                        echo $row['cubicMeterConsume'];
                      ?>
                  </td>
                  <td align="center">
                      <?php
                        $fullname = $row['emp_fname']." ".$row['emp_mname']." ".$row['emp_lname'];
                        echo $fullname;
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
                  <td align="center">
                      <?php
                        echo $row['due_date'];
                      ?>
                  </td>
                  <td align="center">
                      <button class='btn btn-default btn-rounded' onclick="reprint(value)" value="<?php echo $row['reading_id']; ?>"><i class="fas fa-print"></i>Re-print of Receipt</button>
                      <?php  if ($row['paid_status'] == 0) { ?>
                      <button class='btn btn-default btn-rounded' onclick="payment(value)" value="<?php $_SESSION['reading_id'] = $row['reading_id'];$_SESSION['amount'] = $row['amount'];echo $row['reading_id']; ?>"><i class="fas fa-print"></i>Payment Confirmation</button>
                    <?php } ?>
                  </td>
                </tr>
                <?php 

                      }
                      $closeconnection=mysqli_close($conn);
                 ?>
                 </tbody>
            </table>
          </div>
           <div class="col-12 col-md-12">
            <hr>
          <p><strong>PAID LIST</strong></p>
          </div>
            <div class="col-12 table-responsive">
            <table class="table table-striped" id="paidList">
              <thead>
                <tr align="center">    
                  <th><b>Reading ID.</b></th>
                  <th><b>Reading</b></th>
                  <th><b>Amount</b></th>
                  <th><b>Reading Date</b></th>
                  <th><b>Consumed</b></th>
                  <th><b>Meter Reader</b></th>
                  <th><b>Payment Status</b></th>
                  <th><b>Due Date</b></th>
                  <th><b>Action</b></th>
                </tr>
              </thead>
                
                <tbody>
                <?php 
                      include("conn.php");
                      $selectedMeterID = $_SESSION['selectedMeterID'];

                      $sql="SELECT * FROM meter INNER JOIN meterreading ON meterreading.meter_id = meter.meter_id INNER JOIN employee ON employee.emp_id = meterreading.emp_id WHERE meterreading.meter_id = '$selectedMeterID' AND meterreading.paid_status = 1";
                      $query = mysqli_query($conn,$sql);
                     
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                     ?>

                <tr align="left">
                  <td><?php 
                      echo $row['reading_id'];
                  ?></td>
                  <td data-toggle="popover" class="btnPop">
                    <strong style="color: #33d176;">
                      <?php 
                        echo $row['reading'];
                      ?>
                    </strong>
                  </td>
                  <td align="center"><i class="w-fa fas fa-ruble-sign"></i>
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
                        echo $row['cubicMeterConsume'];
                      ?>
                  </td>
                  <td align="center">
                      <?php
                        $fullname = $row['emp_fname']." ".$row['emp_mname']." ".$row['emp_lname'];
                        echo $fullname;
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
                  <td align="center">
                      <?php
                        echo $row['due_date'];
                      ?>
                  </td>
                  <td align="center">
                       <button class='btn btn-default btn-rounded' onclick="reprint(value)" value="<?php echo $row['reading_id']; ?>"><i class="fas fa-print"></i>Re-print of Receipt</button>
                      <?php  if ($row['paid_status'] == 0) { ?>
                      <button class='btn btn-default btn-rounded' onclick="payment(value)" value="<?php $_SESSION['reading_id'] = $row['reading_id'];$_SESSION['amount'] = $row['amount'];echo $row['reading_id']; ?>"><i class="fas fa-print"></i>Payment Confirmation</button>
                    <?php } ?>
                  </td>
                </tr>
                <?php 

                      }
                      $closeconnection=mysqli_close($conn);
                 ?>
                 </tbody>
            </table>
          </div>
           <div class="col-12 col-md-12">
            <hr>
          <p><strong>UNPAID LIST</strong></p>
          </div>
          <div class="col-12 table-responsive">
            <table class="table table-striped" id="unpaidList">
              <thead>
                <tr align="center">    
                  <th><b>Reading ID.</b></th>
                  <th><b>Reading</b></th>
                  <th><b>Amount</b></th>
                  <th><b>Reading Date</b></th>
                  <th><b>Consumed</b></th>
                  <th><b>Meter Reader</b></th>
                  <th><b>Payment Status</b></th>
                  <th><b>Due Date</b></th>
                  <th><b>Action</b></th>
                </tr>
              </thead>
                
                <tbody>
                <?php 
                      include("conn.php");
                      $selectedMeterID = $_SESSION['selectedMeterID'];

                      $sql="SELECT * FROM meter INNER JOIN meterreading ON meterreading.meter_id = meter.meter_id INNER JOIN employee ON employee.emp_id = meterreading.emp_id WHERE meterreading.meter_id = '$selectedMeterID' AND meterreading.paid_status = 0";
                      $query = mysqli_query($conn,$sql);
                     
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                     ?>

                <tr align="left">
                  <td><?php 
                      echo $row['reading_id'];
                  ?></td>
                  <td data-toggle="popover" class="btnPop">
                    <strong style="color: #33d176;">
                      <?php 
                        echo $row['reading'];
                      ?>
                    </strong>
                  </td>
                  <td align="center"><i class="w-fa fas fa-ruble-sign"></i>
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
                        echo $row['cubicMeterConsume'];
                      ?>
                  </td>
                  <td align="center">
                      <?php
                        $fullname = $row['emp_fname']." ".$row['emp_mname']." ".$row['emp_lname'];
                        echo $fullname;
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
                  <td align="center">
                      <?php
                        echo $row['due_date'];
                      ?>
                  </td>
                  <td align="center">
                        <button class='btn btn-default btn-rounded' onclick="reprint(value)" value="<?php echo $row['reading_id']; ?>"><i class="fas fa-print"></i>Re-print of Receipt</button>
                      <?php  if ($row['paid_status'] == 0) { ?>
                      <button class='btn btn-default btn-rounded' onclick="payment(value)" value="<?php $_SESSION['reading_id'] = $row['reading_id'];$_SESSION['amount'] = $row['amount'];echo $row['reading_id']; ?>"><i class="fas fa-print"></i>Payment Confirmation</button>
                    <?php } ?>

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
          </div>
          <?php 
            }
           ?>
          </div>

          </div>
          <!--Card -->

        </div>
      </div>

          <div class="modal fade md-modal md-effect-8 modal-8" id="modal-1" tabindex="-1" aria-hidden="true" style='z-index:10000;'>
      <div class="modal-dialog  modal-lg">
        <section class="content">
          <div class="modal-content">
            <div class="modal-header">
              <p class="modal-title" style="font-size: 50px;"><b>Update Meter</b></p>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span></button>
              </div>
              <div class="modal-body">
                <div class="card">
                  <div class="card-block">
                    <div class="row">
                      <div class="col-md-12">
                        <div id="wizard">
                          <section>
                            <form class="wizard-form" id="example-advanced-form" id="reg_form" action="#">
                              <h3> Meter Details </h3>
                              <fieldset>
                                <div class="row m-b-20">
                                <div class="col-6 col-md-6">
                              
                                <div>
                                  <div>
                                    <label for="serialNo" class="block">Meter Serial Number</label>
                                    <input id="serialNo" name="serialNo" type="number" class="form-control" placeholder="Meter Serial Number" autofocus="" value="<?php echo $serialNo; ?>">
                                  </div>
                                </div>

                                </div>
                                <div class="col-6 col-md-6">
                              
                                <div>
                                  <div>
                                    <label for="completeAdd" class="block">Meter Type</label>

                                   <select class="form-control form-control-primary"  name="zone2s" id="metertypeUpdate">
                                    <option value="">Select Type</option>
                                  <option value="1">Government</option>
                                   <option value="0">Private</option>
                                    </select>

                                  </div>
                                </div>

                                </div>
                                </div>
                              </fieldset>




                            </form>
                          </section>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <button type="submit" class="btn btn-success btn-rounded" id="btn_add" style="margin-left: 5px; float: right;" data-dismiss="modal">Update Meter</button>
                 <button class="btn btn-danger btn-rounded" id="cancel" style="margin-left: 5px; float: right;" data-dismiss="modal">Cancel</button>
                        </div>
              </div>

          </section>
        </div>
      </div>
                <div class="modal fade md-modal md-effect-8 modal-8" id="modal-2" tabindex="-1" aria-hidden="true" style='z-index:10000;'>
      <div class="modal-dialog  modal-lg">
        <section class="content">
          <div class="modal-content">
            <div class="modal-header">
              <p class="modal-title" style="font-size: 50px;"><b>Payment Confirmation</b></p>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span></button>
              </div>
              <div class="modal-body">
                <div class="card">
                  <div class="card-block">
                    <div class="row">
                      <div class="col-md-12">
                        <div id="wizard">
                          <section>
                            <form class="wizard-form" id="example-advanced-form" id="reg_form" action="#">
                              <h3> Payment Details </h3><h2>Total Payment: <i class="fas fa-ruble-sign"></i><?php echo $_SESSION['amount']; ?></h2>
                              <fieldset>
                                <div class="row m-b-20">
                                <div class="col-6 col-md-6">
                              
                                <div>
                                  <div>
                                    <label for="orNo" class="block">OR Number</label>
                                    <input id="orNo" name="orNo" type="number" class="form-control" placeholder="O.R Number" autofocus="">
                                  </div>
                                </div>

                                </div>
                                <div class="col-6 col-md-6">
                              
                                <div>
                                  <div>
                                    <label for="amount" class="block">Total Payment</label>
                                  <input id="amount" name="amount" type="number" class="form-control" placeholder="Amount" autofocus="" value="<?php echo $_SESSION['amount']; ?>" disabled>

                                  </div>
                                </div>

                                </div>
                                </div>
                              </fieldset>




                            </form>
                          </section>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" id="selectedPaymentID" value="">
                  <button type="submit" class="btn btn-success btn-rounded" id="btnConfirmPayment" style="margin-left: 5px; float: right;" data-dismiss="modal">Confirm Payment</button>
                 <button class="btn btn-danger btn-rounded" id="cancel" style="margin-left: 5px; float: right;" data-dismiss="modal">Cancel</button>
                        </div>
              </div>

          </section>
        </div>
      </div>
      <div id="demo"></div>
    </section>
  </main>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../js/mdb.min.js"></script>

  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!--Custom scripts -->
  <script>
    // SideNav Initialization
    $(".button-collapse").sideNav();

  </script>
<script>
  $(function () {
   // $("#example1").DataTable();
    $('#overallList').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script>
  $(function () {
   // $("#example1").DataTable();
    $('#paidList').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script>
  $(function () {
   // $("#example1").DataTable();
    $('#unpaidList').DataTable({
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
    $(document).ready(function(){
      $("#overallList").show();
                  $("#paidList").hide();
                  $("#unpaidList").hide();
  });
</script>
<script>
function goBack() {
    window.history.back()
}
</script>
<script>
function updateMeter() {
    $("#modal-1").modal("show");
}
</script>
<script>
function payment(value) {
    $("#modal-2").modal("show");
}
</script>
<script type="text/javascript">
  $(document).ready(function(e){
    $('#btn_add').click(function(e){
      var meterSerialNo = document.getElementById('serialNo').value
      var metertype = document.getElementById('metertypeUpdate').value
      var meterID = <?php echo $_SESSION['selectedMeterID']; ?>;

      if (meterSerialNo === "") {
        Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Please input a valid serial number.',
                        showConfirmButton: true
                })
      }
      else if (metertype === "") {
        Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Please input a valid Meter Type.',
                        showConfirmButton: true
                })
      }
      else {
        $.ajax({
            url  : 'updateMeter.php',
            method: 'POST',
            data : {meterSerialNo:meterSerialNo, metertype:metertype, meterID:meterID},
            success :  function(data){
              if (data.trim() === "ok") {
                Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'You successfully Updated a meter.',
                        showConfirmButton: true
                })
                location.href = 'meterDetails.php?myid='+meterID;
              }
              else if (data.trim() === "no") {
                Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Something went wrong, data has not been saved.',
                        showConfirmButton: true
                })
              }
              else if (data.trim() === "notAdmin") {
                Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'You connot update any meters if you are not a Administrator Account',
                        showConfirmButton: true
                })
              }
            }
          });
      }
       
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(e){
    $('#btnConfirmPayment').click(function(e){
      var orNo = document.getElementById('orNo').value
      var amount = document.getElementById('amount').value
      var meterreadingID = <?php echo $_SESSION['reading_id']; ?>;
      var meterID = <?php echo $_SESSION['selectedMeterID']; ?>;


      if (orNo === "") {
        Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Please input a valid O.R Number.',
                        showConfirmButton: true
                })
      }
      else if (amount === "") {
        Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Please input a valid Amount.',
                        showConfirmButton: true
                })
      }
      else {
        $.ajax({
            url  : 'payment.php',
            method: 'POST',
            data : {orNo:orNo, amount:amount, meterreadingID:meterreadingID},
            success :  function(data){

              if (data.trim() === "ok") {
                Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'You successfully Updated a meter.',
                        showConfirmButton: true
                })
                location.href = 'meterDetails.php?myid='+meterID;
              }
              else if (data.trim() === "no") {
                Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Something went wrong, data has not been saved.',
                        showConfirmButton: true
                })
              }
            }
          });
      }
       
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(e){

    $('#btnActivate').click(function(e){
      var meterID = <?php echo $_SESSION['selectedMeterID']; ?>;
        $.ajax({
            url  : 'activateMeter.php',
            method: 'POST',
            data : {meterID:meterID},
            success :  function(data){
               
              if (data.trim() === "ok") {
                Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'You successfully Activate a meter.',
                        showConfirmButton: true
                })
                
                $("#meterStatusHtml").html("<p class='h5 text-left mb-4' id='meterStatusHtml'>Meter Status: <span class='badge badge-success'>Active</span></p>");
                $("#btnDeactivate").show();
                $("#btnActivate").hide();
              }
              else if (data.trim() === "no") {
                Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Something went wrong, data has not been saved.',
                        showConfirmButton: true
                })
              }
            }
          });
       
    });
    $('#btnDeactivate').click(function(e){
      var meterID = <?php echo $_SESSION['selectedMeterID']; ?>;
        $.ajax({
            url  : 'deactivateMeter.php',
            method: 'POST',
            data : {meterID:meterID},
            success :  function(data){
               
              if (data.trim() === "ok") {
                Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'You successfully Deactivate a meter.',
                        showConfirmButton: true
                })

                $("#meterStatusHtml").html("<p class='h5 text-left mb-4' id='meterStatusHtml'>Meter Status: <span class='badge badge-danger'>Deactivated</span></p>");
                $("#btnDeactivate").hide();
                $("#btnActivate").show();
              }
              else if (data.trim() === "no") {
                Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Something went wrong, data has not been saved.',
                        showConfirmButton: true
                })
              }
            }
          });
       
    });
  });
</script>
<script>
function btnBind() {
     location.href='customerBinding.php';
}
</script>
<script type="text/javascript">
  function reprint(value){
    location.href = 'invoice.php?readingID='+value;
  }
</script>
</body>

</html>
