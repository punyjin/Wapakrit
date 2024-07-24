<?php 
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
        <a class="nav-link" href="?page=kazenonekostaffmanager">
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
        <a class="nav-link" href="?page=kazenonekostaffmanager">
        <i class="fas fa-fw fa-home"></i>
        <span>จัดการพนักงาน</span></a>
    </li><?php 
    } ?>
    <li class="nav-item">
        <a class="nav-link" href="?page=kazenekostaffreport">
        <i class="fas fa-fw fa-home"></i>
        <span>รายงานผล</span></a>
    </li>
    <?php if ($dbarr['access_level'] >= "5") 
     {?>
    <li class="nav-item">
        <a class="nav-link" href="?page=kazenonekostaffdatabase">
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
        <a class="nav-link" href="?page=kazenonekostaffuserdata">
          <i class="fas fa-user"></i>
       <span>ข้อมูลผู้ใช้งาน</span></a>
    </li>         
    <li class="nav-item">
        <a class="nav-link" href="?page=kazenonekostaffnotify">
            <i class="fas fa-bell"></i>
            <span>การแจ้งเตือน</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="?page=kazenonekostaffbehavior">
            <i class="fas fa-bell"></i>
            <span">รายงานการปฎิบัติงาน</span></a>
    </li>
    <div class="sidebar-heading">
        <u><font color="red" size="2">เอกสารสำคัญ</font></u>
    </div>
    <li class="nav-item">
        <a class="nav-link" href="?page=kazenonekostaffuserlist">
            <i class="fas fa-chart-area"></i>
            <span>รายชื่อ</span></a>
    </li>    
    <li class="nav-item">
        <a class="nav-link" href="?page=kazenonekostaffreportworkcheck">
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
            <h1 class="h3 mb-0 text-gray-800">สรุปยอดการทำงาน ประจำวันที่ 24  ก.ค. 2567</h1>
        </div>
            <form class="user" action="action=report" method="POST">
        <div class="row form-group">
            <div class="col col-md-3">
			    <label for="cc-exp" class="control-label mb-1">เลือกหมวดหมู่</label>
                    <select class="form-control" id="level" name="level" required="">
                        <option value="0"> -เลือกหมวดหมู่- </option>       
                        <option value="1">Data Analysis</option>
                    </select>
                </div>
                <div class="col col-md-3">
                    <label for="cc-exp" class="control-label mb-1">เลือกประเภท</label>
                        <select class="form-control" id="stu_room" name="stu_room" required="">
                            <option value="0"> -เลือกประเภท- </option>
                            <option value="1"> Weapon </option>    
                            <option value="2"> Character </option>  
                            <option value="3"> Items </option>  
                        </select>
                    </div>           
                <div class="col col-md-3">
                    <label for="cc-exp" class="control-label mb-1">ใส่จำนวน</label>
                    <input type="number" id="count_number" name="count_number" placeholder="ใส่จำนวน" class="form-control" value="">
                </div>
            <div class="col col-md-3"><br>
                <button type="submit" class="btn btn-primary btn-user "><i class="fa fa-search"></i> ค้นหา</button>
            </div>
        </div>
</form>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-md-12"> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    $(document).ready(function () {

        //var last7Days = new Date(); 
        //last7Days.setDate(last7Days.getDate()+2);
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            //daysOfWeekDisabled: [0, 6],
            //startDate: last7Days,
            ignoreReadonly: true,
            todayBtn: true,
            language: 'th',             //Set เป็นปี พ.ศ.
        });  //กำหนดเป็นวันปัจุบัน
        $(".chosen-select").chosen();
    });	
</script></div></div></div></body></html>