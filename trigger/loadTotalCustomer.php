
<?php 
  session_start();
      if(!isset( $_SESSION['emp_id']))
      {
        header("Location:../index.html");
      } 
       ?>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="plugins/datatables-autofill/css/autoFill.bootstrap4.css">

          <div class="card-body">
             
            <p class="h3 text-left mb-4"><strong><b>
              Customer Lists
             </b></strong>
             <button name="btn_view" id="btn_reg" type="button" class="btn btn-success btn-rounded"> <i class="fa fa-user-plus"></i> Register New Customer</button>
           </p>

<form id="myForm" action="trigger/customerDetails.php" method="GET">
<input type="hidden" name="myid" id="hiddentext" value="">
          <div class="col-12 table-responsive">
            <table class="table table-striped" id="example2">
              <thead>
                <tr align="center">    
                  <th><b>Name</b></th>
                  <th><b>ID no</b></th>
                  <th><b>Address</b></th>
                  <th><b>Category</b></th>
                  <th><b>Status</b></th>
                  <th><b>Action</b></th>
                </tr>
              </thead>
                
                <tbody>
                <?php 
                      include("conn.php");
                      $sql="SELECT * FROM customer";
                      $query = mysqli_query($conn,$sql);
                     
                      while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                     ?>

                <tr align="left">
                  
                  <td data-toggle="popover" class="btnPop">
                    <strong style="color: #33d176;">
                      <?php 
                        echo "<b>".$row['cus_lname'].", ".$row['cus_fname']." ".$row['cus_mname']."</b>";
                      ?>
                    </strong>
                  </td>
                  <td align="center">
                      <?php 
                        echo $row['cus_id'];
                       ?>
                  </td>
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
                  <td align="center"><?php
                        if ($row['cus_status'] == 0) {
                          echo "<span class='badge badge-danger'>DEACTIVATED</span>";
                        }elseif ($row['cus_status'] == 1) {
                          echo "<span class='badge badge-success'>ACTIVE</span>";
                        }
                        else{
                          echo "<span class='badge badge-warning'>Something went wrong!</span>";
                        }
                      ?>
                  </td>
                  <td align="center">
                      <button class='btn btn-primary btn-rounded' ondblclick="seeDetails()">See Details</button>
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

    <div class="modal fade md-modal md-effect-8 modal-8" id="modal-1" tabindex="-1" aria-hidden="true" style='z-index:10000;'>
      <div class="modal-dialog  modal-lg">
        <section class="content">
          <div class="modal-content">
            <div class="modal-header">
              <p class="modal-title" style="font-size: 50px;"><b>Register Customer</b></p>
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
                                    <input id="firstName" name="firstName" type="text" class="form-control" placeholder="First Name" autofocus="">
                                  </div>
                                </div>
                                </div>

                                <div class="col-6 col-md-4">
                                <div>
                                  <div>
                                    <label for="middleName" class="block">Middle Name</label>
                                    <input id="middleName" name="middleName" type="text" class="form-control" placeholder="Middle Name" autofocus="">
                                  </div>
                                </div>
                                </div>

                                <div class="col-6 col-md-4">
                                <div>
                                  <div>
                                    <label for="lastName" class="block">Last Name</label>
                                    <input id="lastName" name="lastName" type="text" class="form-control" placeholder="Last Name" autofocus="">
                                  </div>
                                </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <label for="completeAdd" class="block">Complete Address</label>
                                    <input id="address" name="address" type="text" class="form-control" placeholder="Address" autofocus="">

                                </div>
                                <div class="col-6 col-md-6">
                                    <label for="completeAdd" class="block">Employee Type</label>

                                   <select class="form-control form-control-primary"  name="zone2" id="custype">
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
                  <button type="submit" class="btn btn-success btn-rounded" id="btn_register" style="margin-left: 5px; float: right;" data-dismiss="modal">Register Meter</button>
                 <button class="btn btn-danger btn-rounded" id="cancel" style="margin-left: 5px; float: right;" data-dismiss="modal">Cancel</button>
                        </div>
              </div>

          </section>
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
   
    $('#example2 tbody').on('click', 'tr', function () {
      
        var data = table.row( this ).data();
         document.getElementById("hiddentext").value=data[1];

         var val = document.getElementById("hiddentext").value;
    
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
<script type="text/javascript">
  $(document).ready(function(e){
    $('#btn_register').click(function(e){
      var firstName = document.getElementById('firstName').value
      var middleName = document.getElementById('middleName').value
      var lastName = document.getElementById('lastName').value
      var address = document.getElementById('address').value
      var custype = document.getElementById('custype').value


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
            url  : 'trigger/registerNewCustomer.php',
            method: 'POST',
            data : {firstName:firstName, middleName:middleName, lastName:lastName, address:address, custype:custype},
            success :  function(data){
              if (data.trim() === "ok") {
                Swal.fire({
                        icon: 'success',
                        title: 'Registered',
                        text: 'You successfully added 1 customer.',
                        showConfirmButton: true
                })
                location.href='customerList.html';
              }
              else if (data.trim() === "no"){
                Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Something went wrong.',
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
  function seeDetails(){
    document.getElementById("myForm").submit();
  }
</script>