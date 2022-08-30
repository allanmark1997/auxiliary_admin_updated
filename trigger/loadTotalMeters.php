
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
             
            
<form id="myForm" action="trigger/meterDetails.php" method="GET">
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
                      $sql="SELECT * FROM meter INNER JOIN customer ON meter.cus_id = customer.cus_id";
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



    <div class="modal fade md-modal md-effect-8 modal-8" id="modal-1" tabindex="-1" aria-hidden="true" style='z-index:10000;'>
      <div class="modal-dialog  modal-lg">
        <section class="content">
          <div class="modal-content">
            <div class="modal-header">
              <p class="modal-title" style="font-size: 50px;"><b>Register Meter</b></p>
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
                                    <input id="serialNo" name="serialNo" type="number" class="form-control" placeholder="Meter Serial Number" autofocus="">
                                  </div>
                                </div>

                                </div>
                                <div class="col-6 col-md-6">
                              
                                <div>
                                  <div>
                                    <label for="completeAdd" class="block">Meter Type</label>

                                   <select class="form-control form-control-primary"  name="zone2" id="metertype">
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
                  <button type="submit" class="btn btn-success btn-rounded" id="btn_add" style="margin-left: 5px; float: right;" data-dismiss="modal">Register Meter</button>
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
              <p class="modal-title" style="font-size: 50px;"><b>Update Rate & Customer's Minimum</b></p>
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
                              <h3> Rate & Minimum Details </h3>
                              <fieldset>
                                <div class="row m-b-21">
                                <div class="col-6 col-md-4">
                                  <?php   
                                    include("conn.php");
                                     $sql="SELECT * FROM rate";
                                       $query = mysqli_query($conn,$sql);
                       
                                    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                                   ?>
                                <div>
                                  <div>
                                    <label for="excessRate" class="block">Excess Rate</label><br>
                                    <label for="excessRate" class="block"><i class="fa fa-ruble-sign"></i><?php   echo $row['existRate']; ?></label>
                                    <input id="excessRate" name="excessRate" type="number" class="form-control" placeholder="Excess Rate" autofocus="" value="<?php   echo $row['existRate']; ?>">
                                  </div>
                                </div>

                                </div>
                                <div class="col-6 col-md-4">
                              
                                <div>
                                  <div>
                                    <label for="empMinimum" class="block">Employee Household Minimum</label><br>
                                    <label for="empMinimum" class="block"><?php   echo $row['minimumEmployee']; ?><img src='cubicLogo.png' width='13' height='13' align='center'></label>
                                    <input id="empMinimum" name="empMinimum" type="number" class="form-control" placeholder="Employee Household Minimum" autofocus="" value="<?php   echo $row['minimumEmployee']; ?>">
                                  </div>
                                </div>

                                </div>
                                <div class="col-6 col-md-4">
                              
                                <div>
                                  <div>
                                    <label for="completeAdd" class="block">Private Household Minimum</label><br>
                                    <label for="privateMinimum" class="block"><?php   echo $row['minimumPrivate']; ?><img src='cubicLogo.png' width='13' height='13' align='center'></label>
                                    <input id="privateMinimum" name="privateMinimum" type="number" class="form-control" placeholder="Private Household Minimum" autofocus="" value="<?php   echo $row['minimumPrivate']; ?>">
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
                  <button type="submit" class="btn btn-success btn-rounded" id="btn_updateNow" style="margin-left: 5px; float: right;" data-dismiss="modal">Update</button>
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
    var hids =  document.getElementById("hiddentext").value
     
    $('#example2 tbody').on('click', 'tr', function () {
      
        var data = table.row( this ).data();
         document.getElementById("hiddentext").value=data[0];

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
          $('#btn_update').click(function(e){
           $("#modal-2").modal("show");
         });
        });

</script>
<script type="text/javascript">
  $(document).ready(function(e){
    $('#btn_add').click(function(e){
      var meterSerialNo = document.getElementById('serialNo').value
      var metertype = document.getElementById('metertype').value

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
                        text: 'Please input a valid METER TYPE.',
                        showConfirmButton: true
                })
      }
      else {
        $.ajax({
            url  : 'trigger/registerNewMeter.php',
            method: 'POST',
            data : {meterSerialNo:meterSerialNo, metertype:metertype},
            success :  function(data){
              if (data.trim() === "duplication") {
                Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Duplication of SERIAL NUMBER is not allowed.',
                        showConfirmButton: true
                })
              }
              else if (data.trim() === "ok") {
                $.ajax({
                      url  : 'trigger/savePresentReadingRegistration.php',
                      method: 'POST',
                      success :  function(data2){
                        if (data2 === "saved") {
                                Swal.fire({
                                      icon: 'success',
                                      title: 'Saved!',
                                      text: 'You successfully register a meter.',
                                      showConfirmButton: true
                              })
                              // $.ajax({
                              //  type : 'POST',
                              // url  : 'trigger/loadTotalMeters.php',
                              // success :  function(data){
                              // $('#showMeterList').empty();
                              // $("#showMeterList").html(data)
                              // }
                              // });
                            location.href='meterList.html';

                        }
                        else if(data2 === "errors"){
                            Swal.fire({
                                      icon: 'error',
                                      title: 'Error!',
                                      text: 'Something went wrong!',
                                      showConfirmButton: true
                              })
                        }
                      }});
              }
              else if (data.trim()==="no") {
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
    $('#btn_updateNow').click(function(e){
      var excessRate = document.getElementById('excessRate').value
      var minimumEmployee = document.getElementById('empMinimum').value
      var minimumPrivate = document.getElementById('privateMinimum').value
      
        $.ajax({
                 method : 'POST',
                url  : 'trigger/updateRate&Minimum.php',
                data:{excessRate:excessRate, minimumEmployee:minimumEmployee, minimumPrivate:minimumPrivate},
                success :  function(data){
                  if (data.trim() === "ok") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated',
                        text: 'You successfully Updated it.',
                        showConfirmButton: true
                    })
                    $.ajax({
                 type : 'POST',
                url  : 'trigger/loadTotalMeters.php',
                success :  function(data){
                $('#showMeterList').empty();
                $("#showMeterList").html(data)
                }
                });
                  }
                  else if (data.trim() === "no") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Please do not empty any input boxes, Thank you',
                        showConfirmButton: true
                    })
                  }
                  else if (data.trim() === "notAdmin") {
                Swal.fire({
                        icon: 'error',
                        title: 'Invalid',
                        text: 'Sorry only Administrator Account can Update the rate and Minimum',
                        showConfirmButton: true
                })
              }
                    
                }
                });
        
      
       
    });
  });
</script>
<script type="text/javascript">
  function btnMeterDetails(){
    document.getElementById("myForm").submit();
  }
</script>
