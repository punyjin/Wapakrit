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