<?php 
    include("v1/connect.php");
    include("data/database/postgres.php"); 
    include("v1/staffapi/staffmanagerpage.php");
    
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

    <div id="wrapper" style="border-radius:50px;">
        <?php include("sidebar_staff.php");?>
            <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
    <?php include("navbar_staff.php");?>

    <!-- Content Here -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard Staff - <?php if($dbarr['player_name']==""){echo "ยังไม่ได้ลงทะเบียนในระบบ";}else{echo $dbarr['player_name'];} ?></h1>
    </div>

    <form class="user" action="?page=kazenonekostaffmanager" method="POST">
    <div class="row form-group">
        <div class="col col-md-4">
            <label for="cc-exp" class="control-label mb-1">เลือกวันที่</label>
            <input type="text" id="date_search_scan" name="date_search_scan" placeholder="วันที่" class="form-control datepicker" readonly="" value="<?php echo $dbarr['Date']?>">
        </div>
        <div class="col col-md-4"><br>
            <button type="submit" class="btn btn-primary btn-user ">เรียกดูข้อมูล</button>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-bell"></i> รายชื่อพนักงาน</h6>
                  </div>
                  <div class="card-body">
                    <form id="search-staff-form">
                        <div class="row">
                            <div class="col-md-4">
                                <label>ค้นหาพนักงานเพื่อมอบหมายงาน</label>
                                <select class="form-control chosen-select" id="subject_staff" name="subject_staff">
                                    <option value="0"> -เลือกพนักงาน- </option>
                                    <?php echo $options; ?>
                                </select>
                            </div>
                            <div class="col-md-2"><br>
                                <button type="button" class="btn btn-primary btn-user" id="btn-search-staff">ค้นหา</button> <!-- onclick="searchStaff()"-->
                            </div>
                        </div>
                    </form>
                    <br>
                    <div id="staff-details" class="row" style="border-radius:10px"></div>
                </div>
                </div>
            </div>
    </div><br>
</div>
<div class="row" id="comment_zone">
      <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-comment"></i> รายชื่อสินค้า</h6>
            </div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-12"> 
               <div class="table-responsive">
                  <table class="table table-bordered table-striped" width="100%" cellspacing="0" border="1" style="font-size:13px;">
                     <thead>
                        <tr>
                           <td style="text-align:center;width:20%;">ชื่อสินค้า</td>
                           <td style="text-align:center;width:5%;">รหัสสินค้า</td>            
                           <td style="text-align:center;width:5%;">ราคา</td>        
                           <td style="text-align:center;width:5%;">จำนวน</td>
                           <td style="text-align:center;width:10%;">รูปภาพ</td>
                           <td style="text-align:center;width:15%;">ประเภทสินค้า</td>
                           <td style="text-align:center;width:15%;">หมวดหมู่</td>
                           <td style="text-align:center;width:15%;">ประเภทข่าวสาร</td>
                           <td style="text-align:center;width:15%;">ID</td>
                        </tr>
                     </thead>
                     <tbody>
                            <?php echo $get_good_table_rows; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-file-alt"></i> รายงานการทำงาน</h6>
      </div>
         <div class="card-body">
            <div class="table-responsive" id="table_report">
               <table class="table table-bordered table-striped" style="font-size: 13px;">
                  <thead>
                    <tr>
                        <!--<td style = "text-align:center;"><strong>ชื่อผู้รับผิดชอบ/งานที่ต้องทำ</strong></td>-->
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
                  </thead>
                  <tbody>
                        <?php echo $table_rows; ?>
                  </tbody>
               </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<br>
