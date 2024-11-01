<?php 
    include("v1/connect.php");
    include("data/database/postgres.php"); 
    include("v1/staffapi/staffboardpage.php");
    
?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
<style>
    body {
            font-family: 'Kanit', serif;
            font-size: 12px;
        }
    .fixed-content {
        top: 0;
        bottom:0;
        position:sticky;
        overflow-y:scroll;
        overflow-x:hidden;
    }
</style>
    <div id="wrapper" style="border-radius:50px">
        <?php include("sidebar_staff.php");?>
            <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
    <?php include("navbar_staff.php");?>

    <!-- Content Here -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">STAFF REPORT SYSTEM</h1>
                    </div>

                    <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-terminal"></i> Work Board Management</h4>	
                    <div class="row">
                                <div class="col-xl-4 col-md-6 mb-4">
                                 <a href="javascript:void(0);" id="check_noscan" data-toggle="modal" data-target="#HomeModalnoscan" onclick="submitform2('noscan');">
                                     <div class="card bg-gradient-success text-white shadow h-100 py-2">
                                         <div class="card-body">
                                             <div class="row no-gutters align-items-center">
                                                 <div class="col mr-2">
                                                     <div class="h5 mb-0 font-weight-bold text-white">Assign Work</div>
                                                 </div>
                                                 <div class="col-auto">
                                                     
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     </a>
                                 </div>        
                                 <div class="col-xl-4 col-md-6 mb-4">
                                 <a href="javascript:void(0);" id="check_in" data-toggle="modal" data-target="#HomeModal" onclick="submitform('busy');">
                                     <div class="card bg-gradient-warning text-white shadow h-100 py-2">
                                         <div class="card-body">
                                             <div class="row no-gutters align-items-center">
                                                 <div class="col mr-2">
                                                     
                                                     <div class="h5 mb-0 font-weight-bold text-white">Temp Stop Work</div>
                                                 </div>
                                                 <div class="col-auto">
                                                     
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     </a>
                                 </div> 

                                 <div class="col-xl-4 col-md-6 mb-4">
                                 <a href="javascript:void(0);" id="check_in" data-toggle="modal" data-target="#HomeModal" onclick="submitform('sick');">
                                     <div class="card bg-gradient-danger text-white shadow h-100 py-2">
                                         <div class="card-body">
                                             <div class="row no-gutters align-items-center">
                                                 <div class="col mr-2">
                                                     <div class="h5 mb-0 font-weight-bold  text-white">Pause Work</div>
                                                 </div>
                                                 <div class="col-auto">
                                                     
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     </a>
                                 </div>
                                </div>
                                <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-terminal"></i> Staff Report System</h4>
                                 <div class="row">    
                                 <div class="col-xl-6 col-md-6 mb-4">
                                 <a href="javascript:void(0);" id="check_in" data-toggle="modal" data-target="#HomeModalerror" onclick="submitform1('checkin');">
                                     <div class="card bg-gradient-info text-white shadow h-100 py-2">
                                         <div class="card-body">
                                             <div class="row no-gutters align-items-center">
                                                 <div class="col mr-2">
                                                   
                                                     <div class="h5 mb-0 font-weight-bold text-white">Report Error System</div>
                                                 </div>
                                                 <div class="col-auto">
                                                     
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     </a>
                                 </div>   

                                 <div class="col-xl-6 col-md-6 mb-4">
                                 <a href="javascript:void(0);" id="check_in" data-toggle="modal" data-target="#HomeModalerror" onclick="submitform1('error');">
                                     <div class="card bg-gradient-secondary text-white shadow h-100 py-2">
                                         <div class="card-body">
                                             <div class="row no-gutters align-items-center">
                                                 <div class="col mr-2">
                                                   
                                                     <div class="h5 mb-0 font-weight-bold text-white">Cancel Work</div>
                                                 </div>
                                                 <div class="col-auto">
                                                     
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     </a>
                                 </div> 
     </div>


<script>
 function submitform(v){
     $('#mode').val(v);
 }

 function submitform1(v){
     $('#mode1').val(v);
 }
 function submitform2(v){
     $('#mode2').val(v);
 }
</script>


<div class="modal fade" id="HomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <form class="user" action="?page=save_data" method="POST">
         
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"></h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <div class="modal-body">

                         <div class="form-group">
                             <input type="text" class="form-control form-control-user" id="user_check" placeholder="กรุณากรอกชื่อผู้ใช้งานหรือเบอร์โทรศัพท์" name="user_check" value="<?php $dbarr['staff_id']?>" readonly="">
                         <input type="hidden" name="mode_check" id="mode">
                         </div>
                          <div class="form-group">
                              <input type="text" class="form-control form-control-user" id="user_comment" placeholder="หมายเหตุหรือเหตุผล" name="user_comment">
                         </div>

         </div>
         <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">ปิด</button>
             <button type="submit" class="btn btn-primary" href="login.html">บันทึกข้อมูล</button>
         </div>
     </div>
 </div>
     </form>	
</div>

<div class="modal fade" id="HomeModalerror" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <form class="user" action="?page=save_data" method="POST">
         
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"></h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <div class="modal-body">

                         <div class="form-group">
                             <input type="text" class="form-control" id="user_check" placeholder="กรุณากรอกชื่อผู้ใช้งานหรือเบอร์โทรศัพท์" name="user_check" value="<?php $dbarr['staff_id']?>" readonly="">
                         <input type="hidden" name="mode_check" id="mode1">
                         </div>
                          <div class="form-group">
                              <input type="text" class="form-control" id="user_comment" placeholder="หมายเหตุหรือเหตุผล" name="user_comment">
                         </div>
                         <div class="form-group">
                                <select name="classroom" class="form-control chosen-select" style="display: none;">
                                    <option value="0"> Select Name </option>
                                    <?php echo $option ?>
                                </select>
                                <div class="chosen-container chosen-container-single" style="width: 0px;" title="">
                                    <a class="chosen-single" tabindex="-1"><span>เลือกชื่อ</span>
                                    <div><b></b>
                                </div>
                            </a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                         </div>
                         <div class="form-group">
                                     <select name="level" class="form-control">
                                      <option value="0"> Select Tier </option>
                            </select>
                         </div>
                         <div class="form-group">
                                     <select name="room" class="form-control">
                                      <option value="0"> Select Type </option>
                            </select>
                         </div>

         </div>
         <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">ปิด</button>
             <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
         </div>
     </div>
 </div>
     </form>	
</div>

<div class="modal fade" id="HomeModalnoscan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <form class="user" action="?page=save_data" method="POST">
         
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"></h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <div class="modal-body">
                          <div class="form-group">
                            <input type="radio" name="noscan_type" value="start"> Start Work
                            <input type="radio" name="noscan_type" value="end"> Successfully End Work
                         </div>                   
                         <div class="form-group">
                             <input type="text" class="form-control" id="user_check" placeholder="กรุณากรอกชื่อผู้ใช้งานหรือเบอร์โทรศัพท์" name="user_check" value="<?php $dbarr['staff_id']?>" readonly="">
                         <input type="hidden" name="mode_check" id="mode2">
                         </div>
                         
                          <div class="form-group">
                              <input type="text" class="form-control" id="user_comment" placeholder="หมายเหตุหรือเหตุผล" name="user_comment" required="">
                         </div>
                         
                        

         </div>
         <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">ปิด</button>
             <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
         </div>
     </div>
 </div>
     </form>	
</div>
                
<div class="row">            
<div class="col-lg-12 mb-4">
<div class="card shadow mb-4">
    <form action="board.php" method="POST">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Report Your Work</h6>
    </div>
    <div class="card-body">
    <div class="row">
        <div class="col-sm-12">
        

                                <div class="row form-group">
								
                                                <div class="col col-md-3">
                                                    													<label for="cc-exp" class="control-label mb-1">เลือกเดือน</label>
                                                    
                                                    <select name="month" class="form-control chosen-select" style="display: none;">
                                                                                                        <option value="1">มกราคม</option>
                                                                                                        <option value="2">กุมภาพันธ์</option>
                                                                                                        <option value="3">มีนาคม</option>
                                                                                                        <option value="4">เมษายน</option>
                                                                                                        <option value="5">พฤษภาคม</option>
                                                                                                        <option value="6">มิถุนายน</option>
                                                                                                        <option value="7" selected="">กรกฎาคม</option>
                                                                                                        <option value="8">สิงหาคม</option>
                                                                                                        <option value="9">กันยายน </option>
                                                                                                        <option value="10">ตุลาคม</option>
                                                                                                        <option value="11">พฤศจิกายน</option>
                                                                                                        <option value="12">ธันวาคม</option>
                                                                                                        </select><div class="chosen-container chosen-container-single" style="width: 378px;" title=""><a class="chosen-single" tabindex="-1"><span>กรกฎาคม</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                                                    
                                                </div>

                                                <div class="col col-md-3">
                                                  
													<label for="cc-exp" class="control-label mb-1">เลือกปี</label>
                                                    
                                                    <select name="year" class="form-control chosen-select" style="display: none;">
                                                    
                                                    <option value="2022">2565</option>
                                                    <option value="2023">2566</option>
                                                    <option value="2024" selected="">2567</option>
                                                    <option value="2025">2568</option>
                                                    </select><div class="chosen-container chosen-container-single" style="width: 378px;" title=""><a class="chosen-single" tabindex="-1"><span>2567</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                                                    
                                                </div>
                                            
                                            <div class="col col-md-3">
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-user ">
                                            เรียกดูข้อมูล
                                        </button>
                                            </div>
                                            </div>
		 
        
        <div id="printTable">
            <div><h6 class="m-0 font-weight-bold text-primary">Report Work </h6> </div>
       <div class="table-responsive">                                                 
        <table class="table table-bordered" style="font-size:10px;width:100%;" border="1" cellspacing="0">
		 <tbody>
        <tr>
		 <td style="text-align:center;width:15%;">วันที่</td>
         <td style="text-align:center;"><strong>Day 1</strong></td>
        <tr>
		 <td style="text-align:center;width:15%;">Report In</td>
         <td style="text-align:center;">01:04</td>
        </tr>
        <tr>
		 <td style="text-align:center;width:15%;">Report Out</td>
         <td style="text-align:center;">17:47</td>
        </tr>
       </tbody></table>
       </div>
       </div>
        </div>

      
    </div>
   

    </div></form>

</div>

<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Staff Board</h6>
    </div>
    <div class="card-body">
	 <form class="user" action="home.php#xxx" method="POST">
                                <div class="row form-group">
											
											<div class="col col-md-3">
												<label for="cc-exp" class="control-label mb-1">Select Type</label>
                                                        <select name="class_id" class="form-control chosen-select" style="display: none;">
                                                            <option value="0"> Select Type </option>
                                                        </select>
                                                        <div class="chosen-container chosen-container-single" style="width: 378px;" title="">
                                                            <a class="chosen-single" tabindex="-1">
                                                                <span>Select Admin</span>
                                                                <div>
                                                                    <b>
                                                                    </b>
                                                                </div>
                                                            </a>
                                                            <div class="chosen-drop">
                                                                <div class="chosen-search">
                                                                    <input type="text" autocomplete="off">
                                                                </div>
                                                                <ul class="chosen-results">

                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div>
                                              <div class="col col-md-3">
													<label for="cc-exp" class="control-label mb-1">เลือกวันที่</label>
                                                        <input type="text" id="date_search" name="date_search" placeholder="วันที่" class="form-control datepicker" readonly="" value="<?php echo $dbarr['date']?>">
                                              </div>
                                            
                                            <div class="col col-md-2">
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-user ">เรียกดูข้อมูล</button>
                                            </div>
                                        </div>
		</form> 
	    
    <div class="table-responsive" id="xxx">
        <table class="table table-bordered table-striped" style="font-size: 13px;">
        <thead>
            <tr>
                <td style="text-align:center;width:10%;"><strong>UID</strong></strong></td>
                <td style="text-align:center;width:30%;"><strong>Player Name</strong></td>
                <td style="text-align:center;width:10%;"><strong>Work ID</strong></td>
                <td style="text-align:center;width:10%;"><strong>Staff Level</strong></td>
                <td style="text-align:center;width:10%;"><strong>Status</strong></td>
                <td style="text-align:center;width:10%;"><strong>All Work</strong></td>
                <td style="text-align:center;width:20%;"><strong>Dashboard Login</strong></td>
                <td style="text-align:center;width:20%;"><strong>MAC</strong></td>
                <td style="text-align:center;width:10%;"><strong>Lastest Login</strong></td>
                <td style="text-align:center;width:10%;"><strong>Register Time</strong></td>
            </tr>
            <tbody>
                <td colspan="10" style="text-align:center;">ไม่พบข้อมูล</td>
            </tbody>
    </thead>
    </table>
    </div>
    </div>
</div>

<!-- Approach -->

</div>
                    
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © 2024 KazenoNeko Studio All Rights Reserved.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" style="display: none;">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>