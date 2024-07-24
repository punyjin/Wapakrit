<?php 
        include("v1/connect.php");
        include("data/database/postgres.php"); 

        function getAccessLevel($staff_result) {
            switch ($staff_result['access_level']) {
                case "1":
                    return "Staff Community";
                case "2":
                    return "Game Master";
                case "3":
                    return "Moderator";
                case "4":
                    return "Admin";
                case "5":
                    return "Manager";
                case "6":
                    return "Developer";
                case "7":
                    return "Owner";
                default:
                    return "Unknown";
                    exit();
            }
        }
        function get_type_goods($shop_result) {
            switch ($shop_result['item_category']) {
                case "1":
                    return "Weapon";
                case "2":
                    return "Character";
                case "3":
                    return "Items";
                default:
                    return "Unknown";
                    exit();
                }
        }
        function get_type_menu($shop_result) {
            switch ($shop_result['menu']) {
                case "1":
                    return "Assault Rifle";
                case "2":
                    return "Submachine Gun";
                case "3":
                    return "Sniper Rifle";
                case "4":
                    return "Heavy Weapon";
                case "5":
                    return "Shotgun";
                case "6":
                    return "Melee Weapon";
                case "7":
                    return "Resources";
                case "8":
                    return "Promotions Sales";
                default:
                    return "Unknown";
                    exit();
                }
        }
        function get_type_news($shop_result) {
            switch ($shop_result['menu']) {
                case "1":
                    return "HOT";
                case "2":
                    return "NEWS";
                case "3":
                    return "EVENT";
                case "4":
                    return "SPECIAL STATUS";
                default:
                    return "Unknown";
                    exit();
                }
        }
        function get_id_shop($shop_result) {
            switch ($shop_result['id_shop']) {
                case "1":
                    return "#ID 1";
                case "2":
                    return "#ID 2";
                case "3":
                    return "#ID 3";
                case "4":
                    return "#ID 4";
                default:
                    return "Unknown";
                    exit();
                }
        }
        // ตรวจสอบการเข้าสู่ระบบ
        if (!isset($_SESSION['login_true'])) {
            Header("Location: /?page=KazeNeko_Manager_Editor_Administator_Topup&user=admin&access=2&isteam=true&status=denied");
            exit();
        }

        // ดึงข้อมูลผู้ใช้ที่เข้าสู่ระบบ
        $result = pg_query($dbconn, "SELECT * FROM accounts WHERE login = '" . pg_escape_string($_SESSION['login_true']) . "'") or die("กำลังแก้ไขระบบกรุณารอสักครู่");
        $dbarr = pg_fetch_assoc($result);

        // ตรวจสอบสิทธิ์การเข้าถึง
        if ($dbarr['access_level'] <= "1") {
            Header("Location: /?page=KazeNeko_Manager_Editor_Administator_Topup&user=admin&access=2&isteam=true&status=denied");
            exit();
        }
        //Table Shop Database
        $select_shop_goods = "SELECT * FROM webshop_sell";
        $shop_result_query = pg_query($dbconn, $select_shop_goods);

        // ดึงข้อมูลทั้งหมดจากตาราง staff_employees
        $select_sql_staff = "SELECT * FROM staff_employees";
        $staff_result_query = pg_query($dbconn, $select_sql_staff);
        $get_good_table_rows = '';

        if (pg_num_rows($shop_result_query) > 0) {
            pg_result_seek($shop_result_query, 0);
            while ($shop_result = pg_fetch_assoc($shop_result_query)) {
                $get_good_table_rows .= '<tr>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">' . $shop_result['item_name'] . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:5%;">' . $shop_result['item_id']. '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:5%;">' . $shop_result['price'] . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:5%;">' . $shop_result['day'] . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;"> <img src="assets/images/shop/' . $shop_result['image'] . '.png" style="width:75%">' .'</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">' . get_type_goods($shop_result) . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">' . get_type_menu($shop_result) . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">' . get_type_news($shop_result) . '</td>';
                $get_good_table_rows .= '<td style="text-align:center;width:15%;">' . get_id_shop($shop_result) . '</td>';
                $get_good_table_rows .= '</tr>';
            }
        } else {
            $table_rows = '<tr><td colspan="10" style="text-align:center;">ไม่พบข้อมูล</td></tr>';
        }

        // ตรวจสอบการดึงข้อมูลและอัปเดต last_login
        date_default_timezone_set('Asia/Bangkok');
        if ($staff_result_query && pg_num_rows($staff_result_query) > 0) {
            $user_id = $dbarr['player_id']; 
            $current_time = date("Y-m-d H:i:s");

            $update_sql = "UPDATE staff_employees SET last_login = $1 WHERE staff_id = $2";
            pg_query_params($dbconn, $update_sql, array($current_time, $user_id));
        }

        // สร้างตัวเลือกจากผลลัพธ์ของการ query
        $options = '';
        if (pg_num_rows($staff_result_query) > 0) {
            while ($row = pg_fetch_assoc($staff_result_query)) {
                $options .= '<option value="' . $row['staff_id'] . '">' . $row['staff_name'] . '</option>';
            }
        } else {
            $options = '<option value="0" disabled>ไม่พบพนักงาน</option>';
        }

        // วนลูปผ่านผลลัพธ์เพื่อสร้างแถว <td>
        $table_rows = '';
        if (pg_num_rows($staff_result_query) > 0) {
            pg_result_seek($staff_result_query, 0); // ย้ายตัวชี้ผลลัพธ์ไปที่แถวแรก
            while ($staff_result = pg_fetch_assoc($staff_result_query)) {
                $table_rows .= '<tr>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . ($staff_result['staff_id'] == "" ? "ยังไม่ได้ลงทะเบียน" : $staff_result['staff_id']) . '</td>';
                $table_rows .= '<td style="text-align:center;width:30%;">' . ($staff_result['staff_name'] == "" ? "ยังไม่ได้ลงทะเบียน" : $staff_result['staff_name']) . '</td>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . $staff_result['workid'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . getAccessLevel($staff_result) . '</td>';
                $table_rows .= '<td style="text-align:center;width:10%;">' . $staff_result['status'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . $staff_result['allwork'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . $staff_result['last_login'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:25%;">' . $staff_result['last_mac'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:15%;">' . $staff_result['register_time'] . '</td>';
                $table_rows .= '<td style="text-align:center;width:10%;">' . $staff_result['last_work'] . '</td>';
                $table_rows .= '</tr>';
            }
        } else {
            $table_rows = '<tr><td colspan="10" style="text-align:center;">ไม่พบข้อมูล</td></tr>';
        }
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
    <!-- Page Wrapper -->
    <div id="wrapper" style="border-radius:50px">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark " id="accordionSidebar">

            <!-- Sidebar - Brand 
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?page=kazenonekostaffmanager">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">KazenoNeko Staff Manage </div>
            </a>-->

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link <?=@$_GET['page'] == 'kazenonekostaffmanager' ? 'active' : ''?>" href="?page=kazenonekostaffmanager">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Staff - Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">  
            <!-- Nav Item - Charts -->
             <?php if ($dbarr['access_level'] == "6") 
             {?>
            </li><li class="nav-item">
                <a class="nav-link <?=@$_GET['page'] == 'kazenonekostaffmanager' ? 'active' : ''?>" href="?page=kazenonekostaffmanager">
                <i class="fas fa-fw fa-home"></i>
                <span>จัดการพนักงาน</span></a>
            </li><?php 
            } ?>
            <li class="nav-item">
                <a class="nav-link <?=@$_GET['page'] == 'kazenekostaffreport' ? 'active' : ''?>" href="?page=kazenekostaffreport">
                <i class="fas fa-fw fa-home"></i>
                <span>รายงานผล</span></a>
            </li>
            <?php if ($dbarr['access_level'] >= "5") 
             {?>
            <li class="nav-item">
                <a class="nav-link <?=@$_GET['page'] == 'kazenekostaffdatabase' ? 'active' : ''?>" href="?page=kazenonekostaffdatabase">
                <i class="fas fa-fw fa-home"></i>
                <span>จัดการฐานข้อมูล</span></a>
            </li>
            <?php 
            } ?>
            <!--<div class="sidebar-heading">
                <u><font color="white" size="2">สำหรับ พนักงาน</font></u>
            </div>-->
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link <?=@$_GET['page'] == 'kazenekostaffuserdata' ? 'active' : ''?>" href="?page=kazenonekostaffuserdata">
                  <i class="fas fa-user"></i>
               <span>ข้อมูลผู้ใช้งาน</span></a>
            </li>         
            <li class="nav-item">
                <a class="nav-link <?=@$_GET['page'] == 'kazenekostaffboard' ? 'active' : ''?>" href="?page=kazenonekostaffboard">
                    <i class="fas fa-bell"></i>
                    <span>การแจ้งเตือน</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=@$_GET['page'] == 'kazenekostaffbehavior' ? 'active' : ''?>" href="?page=kazenonekostaffbehavior">
                    <i class="fas fa-bell"></i>
                    <span">รายงานการปฎิบัติงาน</span></a>
            </li>
            <div class="sidebar-heading">
                <u><font color="red" size="2">เอกสารสำคัญ</font></u>
            </div>
            <li class="nav-item">
                <a class="nav-link <?=@$_GET['page'] == 'kazenonekostaffuserlist' ? 'active' : ''?>" href="?page=kazenonekostaffuserlist">
                    <i class="fas fa-chart-area"></i>
                    <span>รายชื่อ</span></a>
            </li>    
            <li class="nav-item">
                <a class="nav-link <?=@$_GET['page'] == 'kazenonekostaffreportworkcheck' ? 'active' : ''?>" href="?page=kazenonekostaffreportworkcheck">
                    <i class="fas fa-chart-area"></i>
                    <span>ตรวจสอบข้อมูล</span></a>
            </li>  
            <!-- Nav Item - Charts -->
            
			
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="?page=genqrcode">
                    <i class="fas fa-qrcode"></i>
                    <span>QR Code Generate</span></a>
            </li>         
            
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="?page=kazenonekostaffmanager?res=logcomplete#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if($dbarr['player_name']==""){echo "ยังไม่ได้ลงทะเบียนในระบบ";}else{echo $dbarr['player_name'];} ?></span>
                                <img class="img-profile rounded-circle" src="https://img.icons8.com/fluency/48/user-male-circle--v1.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="?page=staff_result">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    การประเมินผลการปฎิบัติงาน
                                </a>
                                <a class="dropdown-item" href="?page=staff_profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    ข้อมูลส่วนตัว
                                </a>
                                <a class="dropdown-item" href="?page=changepass">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    เปลี่ยนรหัสผ่าน
                                </a>
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" onclick="clickLogout();" href="?page=home">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    ออกจากระบบ
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
 
<style>
.chosen-container
{
  width:100% !Important;
  font-size:15px;
}
</style>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard <?php if($dbarr['player_name']==""){echo "ยังไม่ได้ลงทะเบียนในระบบ";}else{echo $dbarr['player_name'];} ?></h1>
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
