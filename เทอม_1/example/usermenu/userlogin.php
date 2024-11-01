<div class="col-lg-4 order-md-2">
   <?php if(!isset($_SESSION['login_true'])) { ?>   
   <div class="card mb-3">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-sign-in-alt"></i>&nbsp;เข้าสู่ระบบ	
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <div class="container">
            <div class="container my-3">
               <div class="card-content">
                  <div class="row">
                     <div class="col-2">
                        <img src="<?=$uri;?>/assets/image/img/login.svg" alt="login_icon" style="width: 37px; height: 37px;">
                     </div>
                     <div class="col">
                        <b style="color: red;">Login</b>
                        <div>Manage account</div>
                     </div>
                  </div>
                  <br>
                  <div class="alert alert-warning" style='border-radius: 0px;background-color: rgba(244, 98, 66, 0.8);color: white;'>
                     <i class="fas fa-exclamation-triangle"></i> กรุณากรอกชื่อไอดีเป็นตัวเล็กทั้งหมด!
                  </div>
                  <form id="login-form">
                     <input type="hidden" name="action" value="login">
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
                           <input class="form-control" id="password" name="password" type="password" placeholder="รหัสผ่านบัญชี">
                        </div>
                     </div>
                  </form>
                  <a class="btn btn-success btn-block fd-success" onclick="clickLogin()"><i class="fa fa-sign-in hvr-icon"></i> เข้าสู่ระบบ</a>
                  <a class="btn btn-danger btn-block fd-danger" href="index.php?page=register"><i class="fa fa-user-plus hvr-icon"></i> สมัครสมาชิก</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="card mb-3">
      <div id="header" class="card-header"><i class="fas fa-info-circle"></i> Rate Topup</div>
      <div class="card-body" style="border-top:4px solid #306aff;position: relative;">
         <h4 class="mt-0"><?=$web['header'];?> <small></small></h4>
         <div class="input-group mb-3">
            <div class="input-group-prepend">
               <div class="input-group-text"><i class="fas fa-star text-warning"></i>&nbsp;Point</div>
            </div>
            <input type="text" class="form-control" readonly value="x <?=number_format($web['rate_exp'],0) ?> %">
         </div>
         <div class="input-group">
            <div class="input-group-prepend">
               <div class="input-group-text"><i class="fas fa-star text-warning"></i>&nbsp;Coins</div>
            </div>
            <input type="text" class="form-control" readonly value="x <?=number_format($web['rate_point'],0) ?> %">
         </div>
         <br>
      </div>
   </div>
   <br><br>
   <?php } else { ?>
   <div class="card mb-3">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-address-card"></i>&nbsp;ข้อมูลสมาชิก	
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <div class="container">
            <script language="javascript">
               fetchPlayer();
            </script> 
            <div align="center" id="player" name="player"></div>
            <a  href="?page=table_infomation_data_sync_player_genshin_impact" class="btn btn-primary btn-block"><i class="fa fa-fw fa-table"></i>&nbsp;ตารางงาน</a>
            <button data-aos="fade-up" class="btn btn-danger btn-block fd-danger aos-init aos-animate" onclick="clickLogout();"><i class="fa fa-sign-out hvr-icon"></i> ออกจากระบบ</button>
               <br>
         </div>
      </div>
   </div>
   <?php if(isset($_SESSION['login_true']) && $dbarr['access_level'] >= "3") { ?>
      <!-- For Staff users -->
   <div class="card mb-3">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-chart-bar"></i>&nbsp;เมนูพนักงาน	
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <div class="container">
            <div class="form-group my-3">
               <div class="input-group mb-3">
                  <button onclick="window.location = '?page=staffmanager_page_get_user'" class="form-control btn btn-outline-success btn-buy btn-block"><i class="fa fa-fw fa-key"></i> รายชื่อผู้ใช้งาน</button>
               </div>
               <div class="input-group mb-3">
                  <button onclick="window.location = '?page=staffmanager_page_moderator'" class="form-control btn btn-outline-success btn-buy btn-block"><i class="fa fa-fw fa-key"></i> จัดการผู้ดูแล</button>
               </div>
               <div class="input-group mb-3">
                  <button onclick="window.location = '?page=staffmanager_page_edit_shop'" class="form-control btn btn-outline-success btn-buy btn-block"><i class="fa fa-fw fa-key"></i> จัดการร้านค้า</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
</div>
<?php } ?>