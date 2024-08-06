<?php 
   if(!isset($_SESSION['login_true']))
   {		
   	Header("Location: /index.php?fail=login");
   }
   
   ?>
<div class="col-lg-8 order-md-1">
   <div class="card mb-4">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-shopping-bag"></i>&nbsp;สินค้า และ บริการ จากทางร้าน
      </div>
      <div class="card-body" style="padding: 20; border-top:4px solid #306aff;position: relative;">
         <br>
         <center>
            <div class="alert alert-danger" role="alert"><i class="fas fa-award"></i> หมายเหตุ : สินค้าที่สั่งซื้อจะใช้เวลา 1 - 5 นาทีในการส่งเข้ากล่องจดหมายภายในเกม</div>
         </center>
         <br>
         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item w-25 text-center">
               <a class="nav-link active" data-toggle="pill" href="#shop-3" role="tab" aria-selected="true">Assault Rifle</a>
            </li>
            <li class="nav-item w-25 text-center">
               <a class="nav-link " data-toggle="pill" href="#shop-4" role="tab" aria-selected="true">Submachine Gun</a>
            </li>
            <li class="nav-item w-25 text-center">
               <a class="nav-link " data-toggle="pill" href="#shop-5" role="tab" aria-selected="true">Sniper Rifle</a>
            </li>
            <li class="nav-item w-25 text-center">
               <a class="nav-link " data-toggle="pill" href="#shop-6" role="tab" aria-selected="true">Heavy Weapon</a>
            </li>
            <li class="nav-item w-25 text-center">
               <a class="nav-link " data-toggle="pill" href="#shop-7" role="tab" aria-selected="true">Shotgun</a>
            </li>
            <li class="nav-item w-25 text-center">
               <a class="nav-link " data-toggle="pill" href="#shop-8" role="tab" aria-selected="true">Melee Weapon</a>
            </li>
            <li class="nav-item w-25 text-center">
               <a class="nav-link " data-toggle="pill" href="#shop-9" role="tab" aria-selected="true">Resources</a>
            </li>
            <li class="nav-item w-25 text-center">
               <a class="nav-link " data-toggle="pill" href="#shop-10" role="tab" aria-selected="true">Promotion Sale</a>
            </li>
         </ul>
         <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="shop-3" role="tabpanel" aria-labelledby="pills-home-tab">
				<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '1'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '1' order by id_shop desc");
                  while($newitemshop = pg_fetch_array($newsitem))
                  {
                  ?>
               <div class="col-4" data-aos="fade-up" style="  padding: 5px; ">
                  <div class="card" style="padding: 5px; background: rgba(0,0,0,0.6);  border-bottom: 0px">
                     <img class="card-img-top" src="<?=$uri;?>/assets/image/shop/<?=$newitemshop['image'];?>.png" style="width:100%">
                     <div class="card-body" style="border-top: 0px;">
                        <h5 class="card-title text-center"><b style="color:#ffc107;"><?=$newitemshop['item_name'];?></b></h5>
                        <p class="card-text" style="padding-left:5%">
                           <i class="fas fa-tags text-danger"></i>  จำนวน: <?=$newitemshop['day'];?> ชิ้น</br><br>
                           <i class="fas fa-dollar-sign text-success"></i> ราคา: <?=number_format($newitemshop['price'],2);?> ฿</b></i>
                        </p>
						<a class="float-right btn btn-success fd-success" style="margin-left: 5px;" onclick="buyitempoint(<?=$newitemshop['item_id'];?>)"><i class="fa fa-check"></i> ซื้อในราคา : <?=number_format($newitemshop['price'],2);?> ฿ </a>
                     </div>
                  </div>
               </div>
               <?php }
                  } else {
                              echo '<center><h1 style="color:#ffc107; margin-left: 150px; margin-top:60px;">ยังไม่มีสินค้าลงขายในตอนนี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>
			</div></div>
            <div class="tab-pane fade" id="shop-4" role="tabpanel" aria-labelledby="pills-profile-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '2'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '2' order by id_shop desc");
                  while($newitemshop = pg_fetch_array($newsitem))
                  {
                  ?>
               <div class="col-4" data-aos="fade-up" style="  padding: 5px; ">
                  <div class="card" style="padding: 10px; background: rgba(0,0,0,0.6);  border-bottom: 0px">
                     <img class="card-img-top" src="<?=$uri;?>/assets/image/shop/<?=$newitemshop['image'];?>.png" style="width:100%">
                     <div class="card-body" style="border-top: 0px;">
                        <h5 class="card-title text-center"><b style="color:#ffc107;"><?=$newitemshop['item_name'];?></b></h5>
                        <p class="card-text" style="padding-left:5%">
                           <i class="fas fa-tags text-danger"></i><br>
                           จำนวน: <?=$newitemshop['day'];?> ชิ้น
                           <br>
                           <i class="fas fa-dollar-sign text-success"></i> ราคา: <?=number_format($newitemshop['price'],2);?> ฿											<br>
                        </p>
						<a class="float-right btn btn-success fd-success" style="margin-left: 5px;" onclick="buyitempoint(<?=$newitemshop['item_id'];?>)"><i class="fa fa-check"></i> ซื้อในราคา : <?=number_format($newitemshop['price'],2);?> ฿</a>
                     </div>
                  </div>
               </div>
               <?php }
                  } else {
                              echo '<center><h1 style="color:#ffc107; margin-left: 150px; margin-top:60px;">ยังไม่มีสินค้าลงขายในตอนนี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>
			</div></div>
            <div class="tab-pane fade" id="shop-5" role="tabpanel" aria-labelledby="pills-contact-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '3'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '3' order by id_shop desc");
                  while($newitemshop = pg_fetch_array($newsitem))
                  {
                  ?>
               <div class="col-4" data-aos="fade-up" style="  padding: 5px; ">
                  <div class="card" style="padding: 10px; background: rgba(0,0,0,0.6);  border-bottom: 0px">
                     <img class="card-img-top" src="<?=$uri;?>/assets/image/shop/<?=$newitemshop['image'];?>.png" style="width:100%">
                     <div class="card-body" style="border-top: 0px;">
                        <h5 class="card-title text-center"><b style="color:#ffc107;"><?=$newitemshop['item_name'];?></b></h5>
                        <p class="card-text" style="padding-left:5%">
                           <i class="fas fa-tags text-danger"></i> จำนวน: <?=$newitemshop['day'];?> ชิ้น<br>
                          
                           <br>
                           <i class="fas fa-dollar-sign text-success"></i> ราคา: <?=number_format($newitemshop['price'],2);?> ฿<br>
                        </p>
						<a class="float-right btn btn-success fd-success" style="margin-left: 5px;" onclick="buyitempoint(<?=$newitemshop['item_id'];?>)"><i class="fa fa-check"></i> ซื้อในราคา : <?=number_format($newitemshop['price'],2);?> ฿ </a>
                     </div>
                  </div>
               </div>
               <?php }
                  } else {
                              echo '<center><h1 style="color:#ffc107; margin-left: 150px; margin-top:60px;">ยังไม่มีสินค้าลงขายในตอนนี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>
			</div></div>
            <div class="tab-pane fade" id="shop-6" role="tabpanel" aria-labelledby="pills-contact-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '4'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '4' order by id_shop desc");
                  while($newitemshop = pg_fetch_array($newsitem))
                  {
                  ?>
               <div class="col-4" data-aos="fade-up" style="  padding: 5px; ">
                  <div class="card" style="padding: 10px; background: rgba(0,0,0,0.6);  border-bottom: 0px">
                     <img class="card-img-top" src="<?=$uri;?>/assets/image/shop/<?=$newitemshop['image'];?>.png" style="width:100%">
                     <div class="card-body" style="border-top: 0px;">
                        <h5 class="card-title text-center"><b style="color:#ffc107;"><?=$newitemshop['item_name'];?></b></h5>
                        <p class="card-text" style="padding-left:5%">
                           <i class="fas fa-tags text-danger"></i><br>
                           จำนวน: <?=$newitemshop['day'];?> ชิ้น
                           <br>
                           <i class="fas fa-dollar-sign text-success"></i> ราคา: <?=number_format($newitemshop['price'],2);?> ฿<br>
                        </p>
						<a class="float-right btn btn-success fd-success" style="margin-left: 5px;" href="https://discord.gg/hmCWt8HUBe"><i class="fa fa-check"></i> ติดต่อร้านค้า : <?=number_format($newitemshop['price'],2);?>  </a>
                     </div>
                  </div>
               </div>
               <?php }
                  } else {
                              echo '<center><h1 style="color:#ffc107; margin-left: 150px; margin-top:60px;">ยังไม่มีสินค้าลงขายในตอนนี้...</h1></center> <br><br><br>';
                              }?>
			</div>
			</div>
            <div class="tab-pane fade" id="shop-7" role="tabpanel" aria-labelledby="pills-home-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '5'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '5' order by id_shop desc");
                  while($newitemshop = pg_fetch_array($newsitem))
                  {
                  ?>
               <div class="col-4" data-aos="fade-up" style="  padding: 5px; ">
                  <div class="card" style="padding: 10px; background: rgba(0,0,0,0.6);  border-bottom: 0px">
                     <img class="card-img-top" src="<?=$uri;?>/assets/image/shop/<?=$newitemshop['image'];?>.png" style="width:100%">
                     <div class="card-body" style="border-top: 0px;">
                        <h5 class="card-title text-center"><b style="color:#ffc107;"><?=$newitemshop['item_name'];?></b></h5>
                        <p class="card-text" style="padding-left:5%">
                           <i class="fas fa-tags text-danger"></i><br>
                           จำนวน: <?=$newitemshop['day'];?> ชิ้น
                           <br>
                           <i class="fas fa-dollar-sign text-success"></i> ราคา: <?=number_format($newitemshop['price'],2);?> ฿											<br>
                        </p>
						<a class="float-right btn btn-success fd-success" style="margin-left: 5px;" onclick="buyitempoint(<?=$newitemshop['item_id'];?>)"><i class="fa fa-check"></i> ซื้อในราคา : <?=number_format($newitemshop['price'],2);?> ฿ </a>
                     </div>
                  </div>
               </div>
               <?php }
                  } else {
                              echo '<center><h1 style="color:#ffc107; margin-left: 150px; margin-top:60px;">ยังไม่มีสินค้าลงขายในตอนนี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>
			</div></div>
            <div class="tab-pane fade" id="shop-8" role="tabpanel" aria-labelledby="pills-profile-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '6'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '6' order by id_shop desc");
                  while($newitemshop = pg_fetch_array($newsitem))
                  {
                  ?>
               <div class="col-4" data-aos="fade-up" style="  padding: 5px; ">
                  <div class="card" style="padding: 10px; background: rgba(0,0,0,0.6);  border-bottom: 0px">
                     <img class="card-img-top" src="<?=$uri;?>/assets/image/shop/<?=$newitemshop['image'];?>.png" style="width:100%">
                     <div class="card-body" style="border-top: 0px;">
                        <h5 class="card-title text-center"><b style="color:#ffc107;"><?=$newitemshop['item_name'];?></b></h5>
                        <p class="card-text" style="padding-left:5%">
                           <i class="fas fa-tags text-danger"></i><br>
                           จำนวน: <?=$newitemshop['day'];?> ชิ้น
                           <br>
                           <i class="fas fa-dollar-sign text-success"></i> ราคา: <?=number_format($newitemshop['price'],2);?> ฿											<br>
                        </p>
						<a class="float-right btn btn-success fd-success" style="margin-left: 5px;" onclick="buyitempoint(<?=$newitemshop['item_id'];?>)"><i class="fa fa-check"></i> ซื้อในราคา : <?=number_format($newitemshop['price'],2);?> ฿ </a>
                     </div>
                  </div>
               </div>
               <?php }
                  } else {
                              echo '<center><h1 style="color:#ffc107; margin-left: 150px; margin-top:60px;">ยังไม่มีสินค้าลงขายในตอนนี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>
			</div></div>
            <div class="tab-pane fade" id="shop-9" role="tabpanel" aria-labelledby="pills-contact-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '7'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE menu = '7' order by id_shop desc");
                  while($newitemshop = pg_fetch_array($newsitem))
                  {
                  ?>
               <div class="col-4" data-aos="fade-up" style="  padding: 5px; ">
                  <div class="card" style="padding: 10px; background: rgba(0,0,0,0.6);  border-bottom: 0px">
                     <img class="card-img-top" src="<?=$uri;?>/assets/image/shop/<?=$newitemshop['image'];?>.png" style="width:100%">
                     <div class="card-body" style="border-top: 0px;">
                        <h5 class="card-title text-center"><b style="color:#ffc107;"><?=$newitemshop['item_name'];?></b></h5>
                        <p class="card-text" style="padding-left:5%">
                           <i class="fas fa-tags text-danger"></i><br>
                           จำนวน: <?=$newitemshop['day'];?> ชิ้น
                           <br>
                           <i class="fas fa-dollar-sign text-success"></i> ราคา: <?=number_format($newitemshop['price'],2);?> ฿											<br>
                        </p>
						<a class="float-right btn btn-success fd-success" style="margin-left: 5px;" onclick="buyitempoint(<?=$newitemshop['item_id'];?>)"><i class="fa fa-check"></i> ซื้อในราคา : <?=number_format($newitemshop['price'],2);?> ฿ </a>
                     </div>
                  </div>
               </div>
               <?php }
                  } else {
                              echo '<center><h1 style="color:#ffc107; margin-left: 150px; margin-top:60px;">ยังไม่มีสินค้าลงขายในตอนนี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>    
			</div></div>
            <div class="tab-pane fade" id="shop-10" role="tabpanel" aria-labelledby="pills-contact-tab">
			<div class="row">
               <?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE news = '1'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM webshop_sell WHERE news = '1' order by id_shop desc");
                  while($newitemshop = pg_fetch_array($newsitem))
                  {
                  ?>
               <div class="col-4" data-aos="fade-up" style="  padding: 5px; ">
                  <div class="card" style="padding: 10px; background: rgba(0,0,0,0.6);  border-bottom: 0px">
                     <img class="card-img-top" src="<?=$uri;?>/assets/image/shop/<?=$newitemshop['image'];?>.png" style="width:100%">
                     <div class="card-body" style="border-top: 0px;">
                        <h5 class="card-title text-center"><b style="color:#ffc107;"><?=$newitemshop['item_name'];?></b></h5>
                        <p class="card-text" style="padding-left:5%">
                           <i class="fas fa-tags text-danger"></i><br>
                           จำนวน: <?=$newitemshop['day'];?> ชิ้น
                           <br>
                           <i class="fas fa-dollar-sign text-success"></i> ราคา: <?=number_format($newitemshop['price'],2);?> ฿											<br>
                        </p>
						<a class="float-right btn btn-success fd-success" style="margin-left: 5px;" onclick="buyitempoint(<?=$newitemshop['item_id'];?>)"><i class="fa fa-check"></i> ซื้อในราคา : <?=number_format($newitemshop['price'],2);?> ฿ </a>
                     </div>
                  </div>
               </div>
               <?php }
                  } else {
                              echo '<center><h1 style="color:#ffc107; margin-left: 150px; margin-top:60px;">ยังไม่มีสินค้าลงขายในตอนนี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>               
            </div>
			</div>
         </div>
      </div>
   </div>
   <div class="card mb-3">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-money-bill-alt"></i>&nbsp;ประวัติการสั่งซื้อสินค้า
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <script>
            fetchHistory();
         </script>
         <div align="center" id="history" name="history"></div>
      </div>
   </div>
</div>
<?php include("usermenu/userlogin.php"); ?>