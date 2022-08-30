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
            <!--Card content -->
          <div class="card-body">
            <p class="h3 text-left mb-4"><strong><b>
              SELECT CUSTOMER ACCOUNT TO BIND
             </b></strong></p>
           <div class="row m-b-20">

            <div class="col-12 table-responsive">
            <table class="table table-striped" id="overallList">
              <thead>
                <tr align="center">    
                  
                  <th><b>Name</b></th>
                  <th><b>Customer ID.</b></th>
                  <th><b>Address</b></th>
                  <th><b>Category</b></th>
                  <th><b>Status</b></th>
                  <th><b>Action</b></th>
                </tr>
              </thead>
                
                <tbody>
                <?php 
                      include("conn.php");
                      //$selectedMeterID = $_SESSION['selectedMeterID'];

                      $sql="SELECT * FROM customer";
                      $query = mysqli_query($conn,$sql);
                     
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                       $fullname = $row['cus_lname'].", ".$row['cus_fname']." ".$row['cus_mname'];
                     ?>

                <tr align="left">
                  <td data-toggle="popover" class="btnPop">
                    <strong style="color: #33d176;">
                      <?php 
                        echo $fullname;
                      ?>
                    </strong>
                  </td>
                  <td><?php 
                      echo $row['cus_id'];
                  ?></td>
                  
                  <td align="center">
                      <?php
                        echo $row['cus_address'];
                      ?>
                  </td>
                  <td align="center">
                      <?php 
                        echo $row['cus_category'];
                       ?>
                  </td>
                
                  <td align="center">
                      <?php
                        if ( $row['cus_status'] == 0) {
                          echo "<span class='badge badge-danger'>Deactivated</span>";
                        }elseif ($row['cus_status'] == 1) {
                          echo "<span class='badge badge-success'>Active</span>";
                        }
                        else{
                          echo "<span class='badge badge-warning'>Something went wrong!</span>";
                        }
                      ?>
                  </td>
                  <td align="center">
                      <button class='btn btn-success btn-rounded' onclick="bindCustomer(value)" value="<?php echo $row['cus_id']; ?>">Bind</button>
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
          </div>

          </div>
          <!--Card -->

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
function bindCustomer(value) {
  var selectedCustomer = value;
  var meterID = "<?php echo $_SESSION['selectedMeterID']; ?>";
      $.ajax({
            url  : 'customerBindingWithMeterUpdate.php',
            method: 'POST',
            data : {selectedCustomer:selectedCustomer},
            success :  function(data){

              if (data.trim() === "ok") {
                Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'You successfully Updated a meters.',
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
</script>
</body>

</html>
