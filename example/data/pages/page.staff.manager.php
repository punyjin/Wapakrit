<?php 
    include("v1/connect.php");
    include("data/database/postgres.php"); 
    $cPlayer = $connec->prepare('SELECT player_id FROM accounts');
    $cPlayer->execute();
    $countPlayer = $cPlayer->rowCount();
   
    $cPlayer1 = $connec->prepare('SELECT player_id FROM accounts');
    $cPlayer1->execute();
    $countPlayer1 = $cPlayer1->rowCount();
   
    $cPlayerOnline = $connec->prepare('SELECT player_id FROM accounts WHERE online = true');
    $cPlayerOnline->execute();
    $countPlayerOnline = $cPlayerOnline->rowCount();
   
	$result = pg_query($dbconn,"SELECT * FROM accounts WHERE login='".@$_SESSION['login_true']."'") or die("กำลังเเก้ไขระบบกกรุณารอซํกครู่");
	$dbarr = pg_fetch_array($result);

		if (!isset($_SESSION['login_true']) || $dbarr['access_level'] != "523704375") {
			Header("Location: /?page=KazeNeko_Manager_Editor_Administator_Topup?user=admin?access=2?isteam=true?status=denied");
			
		}
	   else if($dbarr['access_level']=="523704375")
		{
			
		}
		else{Header("Location: /?page=KazeNeko_Manager_Editor_Administator_Topup?user=admin?access=2?isteam=true?status=denied");}
?>
<div class="col-lg-8 order-md-1">
   <div class="card mb-4">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-shopping-bag"></i>&nbsp;งานที่ได้รับมอบหมาย
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <br>
         <center>
            <div class="alert alert-danger" role="alert"><i class="fas fa-award"></i> ระบบจัดการคิวงาน สำหรับ พนักงาน ทีมงานทุกท่านจะได้รับมอบหมายงาน ที่ตรงนี้ และแจ้งรายละเอียดของงานที่นี่ !</div>
         </center>
         <br>
         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item w-25 text-center">
               <a class="nav-link active" data-toggle="pill" href="#shop-3" role="tab" aria-selected="true">ฟาร์มไอเทม</a>
            </li>
            <li class="nav-item w-25 text-center">
               <a class="nav-link " data-toggle="pill" href="#shop-4" role="tab" aria-selected="true">ดูแลไอดี</a>
            </li>
         </ul>
         <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="shop-3" role="tabpanel" aria-labelledby="pills-home-tab">
				<div class="row">
					<?php
					  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '1'");
					  $newarr = pg_fetch_array($newsitem);
					  if($newarr)
					  { 
					  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '1' order by id_shop desc");
					  while($newitemshop = pg_fetch_array($newsitem))
					  {
                  ?>
						<div class="col-4" data-aos="fade-up" style="padding: 5px;">
							<div class="card" style="padding: 5px; background: rgba(0,0,0,0.6); border-bottom: 0px">
								<img class="card-img-top" src="<?=$uri;?>/assets/image/shop/<?=$newitemshop['image'];?>.png" style="width:100%">
								<div class="card-body" style="border-top: 0px;">
									<h5 class="card-title text-center"><b style="color:#ffc107;"><?=$newitemshop['item_name'];?></b></h5>
									<p class="card-text" style="padding-left:5%">
										<i class="fa fa-bookmark"></i> วันที่เริ่มงาน: <?=$newitemshop['day'];?></br><br>
										<i class="fa fa-times"></i> กำหนดส่ง: <?php if ($newarr['item_category'] == "") {echo "ไม่มีกำหนด";} else {echo $newarr['item_category'];} ?></br><br>
									</p>
									<button type="submit" name="button" class="btn btn-primary btn-block mb-3" value="<?php echo $newitemshop['id']; ?>">แก้ไขรายละเอียด</button>
									<button type="submit" name="button" class="btn btn-primary btn-block mb-3" value="<?php echo $newitemshop['id']; ?>">อัพเดทงาน</button>
								</div>
							</div>
						</div>
					
				</div>
			</div>
            <?php }}
			else 
			{
                echo '<center><h1 style="color:#ffc107; margin-top:60px;"> </h1></center> <br><br><br>';
            }
            ?>
			</div></div>
            <div class="tab-pane fade" id="shop-4" role="tabpanel" aria-labelledby="pills-profile-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '2'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '2' order by id_shop desc");
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
                  } 
                              ?>
			</div></div>
            <div class="tab-pane fade" id="shop-5" role="tabpanel" aria-labelledby="pills-contact-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '3'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '3' order by id_shop desc");
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
                              echo '<center><h1 style="color:#ffc107; margin-top:60px;">ยังไม่มีงานในหน้านี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>
			
            <div class="tab-pane fade" id="shop-6" role="tabpanel" aria-labelledby="pills-contact-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '4'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '4' order by id_shop desc");
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
                              echo '<center><h1 style="color:#ffc107; margin-top:60px;">ยังไม่มีงานในหน้านี้...</h1></center> <br><br><br>';
                              }?>
			</div>
			</div>
            <div class="tab-pane fade" id="shop-7" role="tabpanel" aria-labelledby="pills-home-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '5'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '5' order by id_shop desc");
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
                              echo '<center><h1 style="color:#ffc107; margin-top:60px;">ยังไม่มีงานในหน้านี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>
			</div></div>
            <div class="tab-pane fade" id="shop-8" role="tabpanel" aria-labelledby="pills-profile-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '6'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '6' order by id_shop desc");
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
                              echo '<center><h1 style="color:#ffc107; margin-top:60px;">ยังไม่มีงานในหน้านี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>
			</div></div>
            <div class="tab-pane fade" id="shop-9" role="tabpanel" aria-labelledby="pills-contact-tab">
			<div class="row">
				<?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '7'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE menu = '7' order by id_shop desc");
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
                              echo '<center><h1 style="color:#ffc107; margin-top:60px;">ยังไม่มีงานในหน้านี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>    
			</div></div>
            <div class="tab-pane fade" id="shop-10" role="tabpanel" aria-labelledby="pills-contact-tab">
			<div class="row">
               <?php
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE news = '1'");
                  $newarr = pg_fetch_array($newsitem);
                  if($newarr)
                  { 
                  $newsitem = pg_query($dbconn,"SELECT * FROM staff_task WHERE news = '1' order by id_shop desc");
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
                              echo '<center><h1 style="color:#ffc107; margin-top:60px;">ยังไม่มีงานในหน้านี้...</h1></center> <br><br><br>';
                              }
                              
                              ?>               
            </div>
			</div>
         </div>
      </div>
   </div>
   <div class="card mb-3">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-money-bill-alt"></i>&nbsp;ประวัติการดำเนินงาน
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <!--<script language="javascript">
            function History() {
            	var req;
            	if (window.XMLHttpRequest) req=new XMLHttpRequest(); else if (window.ActiveXObject) req=new ActiveXObject("Microsoft.XMLHTTP");	else { alert("Browser not support");return false; }
            	req.onreadystatechange=function() {	if (req.readyState==4) { document.getElementById('history').innerHTML=req.responseText;	setTimeout("History()",1000);} }
            	var querystr="we3a03213z65.php";
            	req.open("POST", querystr , true);
            	req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            	req.send(null);
            }
            History();
         </script> -->
         <div align="center" id="history" name="history"></div>
      </div>
   </div>
</div>
<?php include("pageedit/userlogin.php"); ?>