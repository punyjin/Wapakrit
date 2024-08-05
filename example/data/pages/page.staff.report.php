<?php 
    include("v1/staffapi/staffmanagerpage.php");
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
<div id="wrapper" style="border-radius:50px">
        <?php include("sidebar_staff.php");?>
            <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
    <?php include("navbar_staff.php");?>

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