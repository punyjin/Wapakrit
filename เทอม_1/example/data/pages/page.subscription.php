<?php 
   if(!isset($_SESSION['login_true']))
   {		
   	Header("Location: /index.php?fail=login");
   }
   
   ?>
<div class="col-lg-8 order-md-1">
   <div class="card mb-3">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-btc"></i>&nbsp;ร้านค้าสถานะพรีเมี่ยม
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <div class="container my-3">
            <hr/>            
               <div class="row">
                  <div class="col-4" style="  padding: 5px;">
                     <div class="card" style="padding: 10px; background: rgba(0,0,0,0.4); ">
						<input type="hidden" name="action" value="buycafe">
                        <img class="card-img-top" src="<?=$uri;?>/assets/image/pccafe/1.jpg" style="width:100%">
                        <div class="card-body" style="background: Black;">
                           <p class="card-title"><center>สถานะ Subscription : GOLD<b></b></p>
                           <p class="card-text">
                           <h5 style="color:#00ff08">
						   <b>ราคา: <?=$web['sub_gold'];?>.00 Coin</b>
                           </h5>
						   </center>
                           </p>
						   <a class="btn btn-primary btn-block mb-3" onclick="pccafe(1);"><i class="fa fa-shopping-cart hvr-icon"></i> เเลกรับเลย</a>
                        </div>
                     </div>
                  </div>
				  <div class="col-4" style="  padding: 5px;">
                     <div class="card" style="padding: 10px; background: rgba(0,0,0,0.4); ">
                        <img class="card-img-top" src="<?=$uri;?>/assets/image/pccafe/2.jpg" style="width:100%">
                        <div class="card-body" style="background: Black;">
                           <p class="card-title"><center>สถานะ Subscription : PREMIUM<b></b></p>
                           <p class="card-text">
                           <h5 style="color:#00ff08">
						   <b>ราคา: <?=$web['sub_premium'];?>.00 Coin</b>
                           </h5>
						   </center>
                           </p>
						   <a class="btn btn-primary btn-block mb-3" onclick="pccafe(2);"><i class="fa fa-shopping-cart hvr-icon"></i> เเลกรับเลย</a>
                        </div>
                     </div>
                  </div>
               </div>
         </div>
      </div>
   </div>
</div>
<?php include("usermenu/userlogin.php"); ?>