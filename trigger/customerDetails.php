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
        <a href="../customerList.html"><strong><b><i class="w-fa fas fa-arrow-left"></i>BACK</b></strong></a>
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
          <div class="card">
            <?php 
              $selectedMeterID = $_GET['myid'];
              $_SESSION["selectedMeterID"] = $selectedMeterID;
              include('conn.php');
              $sql = "SELECT * FROM customer  WHERE cus_id = '$selectedMeterID'";
              $query = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                $_SESSION['customerID'] = $row['cus_id'];
             ?>
            <!--Card content -->
          <div class="card-body">
            <p onclick="updateCustomer()"><i class="fa fa-pencil-alt float-right"></i></p>
            <p class="h3 text-left mb-4"><strong><b>
              Customer's Details
             </b></strong></p>
            <hr>
           <div class="row m-b-20">
            <div class="col-6 col-md-6">
            <p class="h5 text-left mb-4">
              Full Name: <table><tr><td><h3 style="color: silver;"><strong><?php $cus_lname = $row['cus_lname']; echo $cus_lname; ?></strong></h3></td></tr><tr><td></td><td><strong><?php $cus_fname = $row['cus_fname']; $cus_mname = $row['cus_mname']; echo $cus_fname." ".$cus_mname; ?></strong></td></tr></table>
            </p>
            <hr>
            <p class="h5 text-left mb-4 strong-text">
              Address: </p> 
             <table><tr><td><h6 style="color: black;"><strong><?php $cus_address = $row['cus_address']; echo $cus_address; ?></strong></h6></td></tr></table>
           
            <hr>
            </div>
            <div class="col-6 col-md-6">
              <p class="h5 text-left mb-4">
                Contact No: <?php 
                                $cus_contactNo = $row['cus_contactNo'];
                                if ( $cus_contactNo == "") {
                                  echo "None";
                                }
                                else{
                                  echo $row['cus_contactNo']; 
                                }
                            ?>
                
              </p>
              <hr>
              <p class="h5 text-left mb-4">
              Customer Type: <?php $cus_category = $row['cus_category']; echo $cus_category;  ?>
            </p>
            <hr>
            <p class="h5 text-left mb-4" id="meterStatusHtml">
              Meter Status: 
              <?php
                        $cus_status = $row['cus_status'];
                        if ($cus_status == 0) {
                          echo "<span class='badge badge-danger'>Deactivated</span>";
                        }elseif ($cus_status == 1) {
                          echo "<span class='badge badge-success'>Active</span>";
                        }
                        else{
                          echo "<span class='badge badge-warning'>Something went wrong!</span>";
                        }
              ?>
            </p>
            <hr>
                <button class='btn btn-danger btn-rounded' id="btnDeactivate">Deactivate</button>
          
             <button class='btn btn-success btn-rounded' id="btnActivate">Activate</button>
             <hr>
            </div>
            
          <div class="col-12 col-md-12">
            <hr>
          <p><strong>Binded Meters</strong></p>
          </div>
          <div class="col-12 col-md-12" id="showMeterList">
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
              <p class="modal-title" style="font-size: 50px;"><b>Update Customer</b></p>
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
                              <h3> Customer Details </h3>
                              <fieldset>
                                <div class="row m-b-20">
                                <div class="col-6 col-md-4">  
                                <div>
                                  <div>
                                    <label for="firstName" class="block">First Name</label>
                                    <input id="firstName" name="firstName" type="text" class="form-control" value="<?php echo $cus_fname; ?>" autofocus="">
                                  </div>
                                </div>
                                </div>

                                <div class="col-6 col-md-4">
                                <div>
                                  <div>
                                    <label for="middleName" class="block">Middle Name</label>
                                    <input id="middleName" name="middleName" type="text" class="form-control" value="<?php echo $cus_mname; ?>" autofocus="">
                                  </div>
                                </div>
                                </div>

                                <div class="col-6 col-md-4">
                                <div>
                                  <div>
                                    <label for="lastName" class="block">Last Name</label>
                                    <input id="lastName" name="lastName" type="text" class="form-control" value="<?php echo $cus_lname; ?>" autofocus="">
                                  </div>
                                </div>
                                </div>

                                <div class="col-6 col-md-4">
                                <div>
                                  <div>
                                    <label for="lastName" class="block">Contact No.</label>
                                    <input id="contactNo" name="lastName" type="text" class="form-control"value="<?php echo $cus_contactNo; ?>" autofocus="">
                                  </div>
                                </div>
                                </div>

                                <div class="col-6 col-md-8">
                                    <label for="completeAdd" class="block">Complete Address</label>
                                    <input id="address" name="address" type="text" class="form-control" value="<?php echo $cus_address; ?>" autofocus="">

                                </div>
                                <div class="col-6 col-md-6">
                                    <label for="completeAdd" class="block">Customer Type</label>

                                   <select class="form-control form-control-primary"  name="zone2" id="cus_category">
                                    <option value="">Select Type</option>
                                  <option value="PVT-R">PVT-R</option>
                                   <option value="JO">JO</option>
                                   <option value="Plantilla">Plantilla</option>
                                   <option value="BMRDO">BMRDO</option>
                                   <option value="CASUAL">CASUAL</option>
                                   <option value="Construction">Construction</option>
                                   <option value="Projects">Projects</option>
                                   <option value="Offices">Offices</option>
                                   <option value="PVT-C">PVT-C</option>
                                   <option value="PCC">PCC</option>
                                   <option value="Plantilla-PVT-C">Plantilla-PVT-C</option>
                                   <option value="CEC-UFLS">CEC-UFLS</option>


                                    </select>
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
                  <button type="submit" class="btn btn-success btn-rounded" id="btn_updateCustomer" style="margin-left: 5px; float: right;" data-dismiss="modal">Update Customer</button>
                 <button class="btn btn-danger btn-rounded" id="cancel" style="margin-left: 5px; float: right;" data-dismiss="modal">Cancel</button>
                        </div>
              </div>

          </section>
        </div>
      </div>
    </section>
  </main>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../js/mdb.min.js"></script>

  <!--Custom scripts -->
  <script>
    // SideNav Initialization
    $(".button-collapse").sideNav();

  </script>
      <script type="text/javascript">

        $(document).ready(function(){

          $.ajax({
            type : 'POST',
            url  : 'customersBindedMeters.php',
            success :  function(data){
             $('#showMeterList').empty();
             $("#showMeterList").html(data)
           }
         });

        });
      </script>
      <script type="text/javascript">
        $(document).ready(function(e){
          $('#btn_reg').click(function(e){
           $("#modal-1").modal("show");
         });
        });

</script>
<script>
function updateCustomer() {
    $("#modal-1").modal("show");
}
</script>
<script type="text/javascript">
  $(document).ready(function(e){
    $('#btn_updateCustomer').click(function(e){
      var firstName = document.getElementById('firstName').value
      var middleName = document.getElementById('middleName').value
      var lastName = document.getElementById('lastName').value
      var address = document.getElementById('address').value
      var custype = document.getElementById('cus_category').value
      var contactNo = document.getElementById('contactNo').value

      var cusID = <?php echo $_GET['myid']; ?>;

      if (firstName === "") {
        Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Please input a valid Customer First Name.',
                        showConfirmButton: true
                })
      }
      else if (lastName === "") {
        Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Please input a valid Customer Last Name.',
                        showConfirmButton: true
                })
      }
      else if (address === "") {
        Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Please input a valid Customer Complete Address.',
                        showConfirmButton: true
                })
      }
      else if (custype === "") {
        Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Please Select Customer Type.',
                        showConfirmButton: true
                })
      }
      else {
        $.ajax({
            url  : 'customerUpdate.php',
            method: 'POST',
            data : {firstName:firstName, middleName:middleName, lastName:lastName, address:address, custype:custype, contactNo:contactNo, cusID:cusID},
            success :  function(data){
              if (data.trim() === "ok") {
                Swal.fire({
                        icon: 'success',
                        title: 'Registered',
                        text: 'You successfully updated 1 customer.',
                        showConfirmButton: true
                })
                //location.href='customerList.html';
              }
              else if (data.trim() === "no"){
                Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Something went wrong.',
                        showConfirmButton: true
                })
              }
              else if (data.trim() === "notAdmin"){
                Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Sorry, Only Admin account can update customer details.',
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
      var selectedMeterID = <?php echo $_SESSION["selectedMeterID"]; ?>;
        $.ajax({
            url  : 'activateCustomer.php',
            method: 'POST',
            data : {selectedMeterID:selectedMeterID},
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
      var selectedMeterID = <?php echo $_SESSION["selectedMeterID"]; ?>;
              $.ajax({
            url  : 'deactivateCustomer.php',
            method: 'POST',
            data : {selectedMeterID:selectedMeterID},
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
</body>

</html>
