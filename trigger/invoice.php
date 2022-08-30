
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



   <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->
  <!-- Ionicons 
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
  <!-- Theme style -->


</head>

<body class="fixed-sn white-skin">
  <!-- Main Navigation -->

  <!-- Main layout -->
  <main>
  	<section class="content">
      <div class="card">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <?php 
              		$readingID = $_GET['readingID'];
               		include("conn.php");
               		$sql = "SELECT * FROM meterreading INNER JOIN meter ON meter.meter_id = meterreading.meter_id INNER JOIN customer ON customer.cus_id = meter.cus_id INNER JOIN employee ON employee.emp_id = meterreading.emp_id WHERE reading_id = '$readingID'";
               		$query = mysqli_query($conn, $sql);
               		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
               ?>
              <div class="row">
                <div class="col-12">
                	<p>Republic of the Philippines</p>
                  <h4>
                    <i class="fas fa-globe"></i> Central Mindanao University <br> <small>Musuan, Maramag, Bukidnon</small>
                    <small class="float-right">Date: <?php echo date("M-d-Y"); ?></small>
                  </h4>
                  <hr>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <h4>
              		AUXILIARY SERVICES UNIT
              	</h4>
              <table align="center">
              		<tr align="center"><td>
              		<h3>NOTICE OF BILLING</h3>
              		</td></tr>
              		<tr><td>
              			<h3>READING DATE OF 
              				<?php 

              					echo ($row['readingDate']);

              				 ?>
              			</h3>
              		</td></tr>
              </table>
              	
              <div class="row invoice-info">
              	
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>CMU Auxiliary Office</strong><br>
                    University Town, Musuan,<br>
                    Maramag, Bukidnon<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>Name: <?php echo $row['cus_fname']." ".$row['cus_mname']." ".$row['cus_lname']; ?></strong><br>
                    Address: <?php echo $row['cus_address']; ?><br>
                    Customer Type: <?php echo $row['cus_category']; ?><br>
                   <br>
                    
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>M. Serial No: <?php echo $row['meter_serialNo']; ?></b><br>
                  <br>
                  <b>Meter Type: <?php if ($row['meter_type'] == 1) {
                  	echo "EMPLOYEE HOUSEHOLD";
                  }else{
                  	echo "PRIVATE HOUSEHOLD";  }?></b> 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <table align="center">
              	<tr><td>
              		<p>WATER METER READING INFORMATION</p>
              	</td></tr>
              </table>
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped" align="center">
                    
                    <tbody align="center">
                    <tr>
                      <td>Bill Date</td>
                      <td><?php echo ($row['readingDate']); ?></td>
                    </tr>
                    <tr>
                      <td>Due Date</td>
                      <td><?php echo ($row['due_date']); ?></td>
                    </tr>
                    <tr>
                      <td>Reading</td>
                      <td><?php echo ($row['reading']); ?></td>
                    </tr>
                    <tr>
                      <td>Consumption</td>
                      <td><?php echo ($row['cubicMeterConsume']); ?></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">

                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Bill Amount</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Water Charge:</th>
                        <td><?php echo ($row['amount']); ?></td>
                      </tr>
                      <tr>
                        <th>Garbage</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th>Others:</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th><h2><b>Total:</b></h2></th>
                        <td><h1><b><?php echo ($row['amount']); ?></b></h1></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
  window.addEventListener("load", window.print());
</script>
</body>

</html>

       