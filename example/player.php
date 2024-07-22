<?php
   session_start();
   include("v1/connect.php");
   include("data/database/postgres.php"); 
   
   if (isset($_SESSION['login_true'])) {
      $loginTrue = $_SESSION['login_true'];
      $result = $connec->prepare("SELECT * FROM accounts WHERE login = :login");
      $result->bindParam(':login', $loginTrue, PDO::PARAM_STR);
      $result->execute();
      $dbarr = $result->fetch(PDO::FETCH_ASSOC);
      
      if (!$dbarr) {
          die("กำลังเเก้ไขระบบกรุณารอซักครู่");
      }
  } 
   
   ?>
<div class="form-group my-3">
   <div class="input-group mb-3">
      <div class="input-group-prepend">
         <span class="input-group-text"><img src="<?=$uri;?>/assets/image/rank/<?php echo $dbarr['rank']; ?>.gif" alt="rank_icon" width="20" height="20"></span>
         <?php if($dbarr['esport'] == "0"){
            } else { ?>
         <span class="input-group-text"><img src="<?=$uri;?>/assets/image/esport/<?php echo $dbarr['esport']; ?>.png" alt="special_icon" width="20" height="20"></span>
         <?php } ?>
         <?php if($dbarr['pc_cafe'] == "0"){ 
            }else { ?>
         <span class="input-group-text"><img src="<?=$uri;?>/assets/image/pccafe/<?php echo $dbarr['pc_cafe']; ?>.jpg" alt="subscription_icon" width="42" height="16"></span>
         <?php } ?>
      </div>
      <?php
         if($dbarr['name_color'] == "0"){
         	?>
      <input type="text" class="form-control" id="account_name" readonly="" value="<?php if($dbarr['player_name']==""){echo "ยังไม่ได้สร้างตัวละคร";}else{echo $dbarr['player_name'];} ?>">
      <?php
         }else if($dbarr['name_color'] == "1"){
         	?>
      <input type="text" class="form-control" id="account_name" readonly="" style="color: #FF0000" value="<?php if($dbarr['player_name']==""){echo "ยังไม่ได้สร้างตัวละคร";}else{echo $dbarr['player_name'];} ?>">
      <?php
         }else if($dbarr['name_color'] == "2"){
         	?>
      <input type="text" class="form-control" id="account_name" readonly="" style="color: #ff7c00" value="<?php if($dbarr['player_name']==""){echo "ยังไม่ได้สร้างตัวละคร";}else{echo $dbarr['player_name'];} ?>">
      <?php
         }else if($dbarr['name_color'] == "3"){
         	?>
      <input type="text" class="form-control" id="account_name" readonly="" style="color: #ffff00" value="<?php if($dbarr['player_name']==""){echo "ยังไม่ได้สร้างตัวละคร";}else{echo $dbarr['player_name'];} ?>">
      <?php
         }else if($dbarr['name_color'] == "4"){
         	?>
      <input type="text" class="form-control" id="account_name" readonly="" style="color: #7cfc00" value="<?php if($dbarr['player_name']==""){echo "ยังไม่ได้สร้างตัวละคร";}else{echo $dbarr['player_name'];} ?>">
      <?php
         }else if($dbarr['name_color'] == "5"){
         	?>
      <input type="text" class="form-control" id="account_name" readonly="" style="color: #00ff00" value="<?php if($dbarr['player_name']==""){echo "ยังไม่ได้สร้างตัวละคร";}else{echo $dbarr['player_name'];} ?>">
      <?php
         }else if($dbarr['name_color'] == "6"){
         	?>
      <input type="text" class="form-control" id="account_name" readonly="" style="color: #32cd32" value="<?php if($dbarr['player_name']==""){echo "ยังไม่ได้สร้างตัวละคร";}else{echo $dbarr['player_name'];} ?>">
      <?php
         }else if($dbarr['name_color'] == "7"){
         	?>
      <input type="text" class="form-control" id="account_name" readonly="" style="color: #80ced6" value="<?php if($dbarr['player_name']==""){echo "ยังไม่ได้สร้างตัวละคร";}else{echo $dbarr['player_name'];} ?>">
      <?php
         }else if($dbarr['name_color'] == "8"){
         	?>
      <input type="text" class="form-control" id="account_name" readonly="" style="color: #0066FF" value="<?php if($dbarr['player_name']==""){echo "ยังไม่ได้สร้างตัวละคร";}else{echo $dbarr['player_name'];} ?>">
      <?php
         }else if($dbarr['name_color'] == "9"){
         	?>
      <input type="text" class="form-control" id="account_name" readonly="" style="color: #0000FF" value="<?php if($dbarr['player_name']==""){echo "ยังไม่ได้สร้างตัวละคร";}else{echo $dbarr['player_name'];} ?>">
      <?php
         }
         ?>
   </div>
</div>
<div class="form-group my-3">
   <div class="input-group mb-3">
      <div class="input-group-prepend">
         <span class="input-group-text">EXP</span>
      </div>
      <input class="form-control"  id="current_exp" value="<?php echo $dbarr['exp']; ?>">
   </div>
</div>
<div class="form-group my-3">
   <div class="input-group mb-3">
      <div class="input-group-prepend">
         <span class="input-group-text"><i class="fa fa-fw fa-money-bill-alt"></i></span>
      </div>
      <input type="text" class="form-control" id="current_point" readonly="" value="Point : <?php echo $dbarr['gp']; ?>">
   </div>
</div>
<div class="form-group my-3">
   <div class="input-group mb-3">
      <div class="input-group-prepend">
         <span class="input-group-text"><i class="fa fa-fw fa-money-bill-alt"></i></span>
      </div>
      <input type="text" class="form-control" id="current_money" readonly="" value="Cash  : <?php echo $dbarr['money']; ?>">
   </div>
</div>
<div class="form-group my-3">
   <div class="input-group mb-3">
      <div class="input-group-prepend">
         <span class="input-group-text"><i class="fa fa-fw fa-money-bill-alt"></i></span>
      </div>
      <input type="text" class="form-control" id="current_coins" readonly="" value="Coins  : <?php echo number_format($dbarr['coin'],0); ?>">
   </div>
</div>
<div class="form-group my-3">
<div class="input-group mb-3">
   <div class="input-group-prepend">
      <span class="input-group-text"><i class="fa fa-fw fa-money-bill-alt"></i></span>
   </div>
   <input type="text" class="form-control" id="current_money_promotion" readonly="" value="ยอดเติมเงินต่อเดือน  : <?php echo $dbarr['money_promotion']; ?>">
</div>
<div class="form-group my-3">
   <div class="input-group mb-3">
      <div class="input-group-prepend">
         <span class="input-group-text"><i class="fa fa-fw fa-money-bill-alt"></i></span>
      </div>
      <input type="text" class="form-control" id="current_money_promotion_all" readonly="" value="ยอดเติมเงินรวมทั้งหมด  : <?php echo $dbarr['money_promotion_all']; ?>">
   </div>
</div>
<div class="form-group my-3">
   <div class="input-group mb-3">
      <div class="input-group-prepend">
         <span class="input-group-text"><i class="fa fa-fw fa-gamepad"></i></span>
      </div>
      <?php
         if($dbarr['online'] = "f"){
         	?>
      <input type="text" class="form-control" id="current_status_offline" readonly="" style="color: red" value="สถานะ  : ออฟไลน์">
      <?php
         }else if ($dbarr['online'] = "t"){
         	?>
      <input type="text" class="form-control" id="current_status_online" readonly="" style="color: green" value="สถานะ  : ออนไลน์">
      <?php
         }else{
         ?>
      <input type="text" class="form-control" id="current_status_unknow" readonly="" style="color: grey" value="สถานะ  : ไม่สามารถระบุได้" >
      <?php
      }
      ?>
   </div>
</div>
<?php if($dbarr['access_level'] >= "1")
{ ?>
<div class="form-group my-3">
   <div class="input-group mb-3">
      <div class="input-group-prepend">
         <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
      </div> 
<?php } ?>
      <?php if($dbarr['access_level'] == "1")
      { ?>
      <input type="text" class="form-control" id="staff_level_community" readonly=""  value="ตำแหน่ง : Staff Community">
      <?php } 
      else if($dbarr['access_level'] == "2")
      { ?>
      <input type="text" class="form-control" id="staff_level_game_master" readonly=""  value="ตำแหน่ง  : Game Master">
      <?php }
      else if($dbarr['access_level'] == "3")
      {?>
      <input type="text" class="form-control" id="staff_level_moderator" readonly=""  value="ตำแหน่ง  : Moderator">
      <?php }
      else if($dbarr['access_level'] == "4")
      { ?>
      <input type="text" class="form-control" id="staff_level_admin" readonly=""  value="ตำแหน่ง  : Admin">
      <?php }
      else if($dbarr['access_level'] == "5")
      { ?>
      <input type="text" class="form-control" id="staff_level_manager" readonly=""  value="ตำแหน่ง  : Manager">
      <?php }
      else if($dbarr['access_level'] == "6")
      { ?>
      <input type="text" class="form-control" id="staff_level_developer" readonly=""  value="ตำแหน่ง  : Developer">
      <?php }
      else if($dbarr['access_level'] >= "7")
      { ?>
      <input type="text" class="form-control" id="staff_level_to_high" readonly=""  value="ตำแหน่ง  : Owner">
      <?php }?>
   </div>
</div>