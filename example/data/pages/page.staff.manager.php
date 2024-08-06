<?php 
include("v1/connect.php");
include("data/database/postgres.php"); 
include("v1/staffapi/staffmanagerpage.php");
include("v1/staffapi/option_data.php");

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
                           <td style="text-align:center;width:5%;">Tools</td>
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
<!-- Modal -->
<div class="modal fade" id="Modal_goods" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <form class="user" id="editForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Edit Item</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="goods_name">ชื่อสินค้า</label>
                        <input type="text" class="form-control" id="goods_name" name="goods_name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="item_id">รหัสสินค้า</label>
                        <input type="text" class="form-control" id="item_id" name="item_id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="price">ราคา</label>
                        <input type="text" class="form-control" id="price" name="price" readonly>
                    </div>
                    <div class="form-group">
                        <label for="day">จำนวน</label>
                        <input type="text" class="form-control" id="day" name="day" readonly>
                    </div>
                    <div class="form-group">
                        <label for="image">รูปภาพ</label>
                        <img src="" id="image_preview" style="width:100px;height:100px;display:block;margin-bottom:10px;">
                        <input type="text" class="form-control" id="image" name="image" readonly>
                    </div>
                    <div class="form-group">
                        <label for="select_category">ประเภทสินค้า</label>
                        <select class="form-control" id="select_type" name="select_type" disabled>
                            <?php echo $options_type; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="select_category">หมวดหมู่</label>
                        <select class="form-control" id="select_category" name="menu" disabled>
                            <?php echo $options_category; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="select_category">ประเภทข่าวสาร</label>
                        <select class="form-control" id="select_news" name="select_news" disabled>
                            <?php echo $options_news; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_comment">รหัสร้านค้า</label>
                        <input type="text" class="form-control" id="TAG_ID" name="TAG_ID" maxlength="1" readonly>
                    </div>
                    <div class="form-group">
                        <label for="user_comment">รายละเอียด</label>
                        <input type="text" class="form-control" id="user_comment" name="user_comment" readonly>
                    </div>
                    <input type="hidden" name="tag_item_goods" id="tag_item_goods">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-primary" id="editButton">แก้ไข</button>
                    <button type="submit" class="btn btn-primary" id="saveButton" style="display:none;">บันทึกข้อมูล</button>
                </div>
            </div>
        </div>
    </form>    
</div>
