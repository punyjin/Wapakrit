<?php 

	if(isset($_SESSION['login_true']))
	{		
		Header("Location: /index.php");
	}

?>
<div class="col-lg-8 order-md-1">
   <div class="card mb-3">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-lock"></i>&nbsp;สมัครสมาชิก
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <div class="container my-3">
            <div class="alert alert-warning" style='border-radius: 0px;background-color: rgba(244, 98, 66, 0.8);color: white;'><i class="fas fa-exclamation-triangle"></i> การุณาใช้ตัวอักษรพิมพ์เล็ก a-z 0-9 เท่านั้น</div>
            <form id="registerForm">
               <input type="hidden" name="action" value="register">
               <div class="form-group">
                  <div class="input-group mb-2 mr-sm-2">
                     <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                     </div>
                     <input class="form-control" id="username" name="username" type="text" placeholder="ชื่อสมาชิก">
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group mb-2 mr-sm-2">
                     <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                     </div>
                     <input class="form-control" id="password" name="password" type="password" placeholder="รหัสผ่าน">
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group mb-2 mr-sm-2">
                     <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                     </div>
                     <input class="form-control" id="re_password" name="re_password" type="password" placeholder="รหัสผ่านอีกครั้ง">
                  </div>
               </div>
               <div class="form-group">
                  <div class="input-group mb-2 mr-sm-2">
                     <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                     </div>
                     <input class="form-control" id="email" name="email" type="email" placeholder="อีเมล์">
                  </div>
               </div>
               <button type="submit" class="btn btn-danger btn-block fd-danger" style="margin-bottom: 5px";><i class="fa fa-user-plus hvr-icon"></i> สมัครสมาชิก</button>
            
            </form>
            <a class="btn btn-info btn-block fd-primary" href="index.php?page=home"><i class="fa fa-arrow-left hvr-icon"></i> กลับไปยังหน้าแรก</a>
         </div>
         
      </div>
   </div>
   
</div>
<?php include("usermenu/userlogin.php"); ?>