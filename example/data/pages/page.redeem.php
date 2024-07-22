<div class="col-lg-8 order-md-1">
   <div class="card mb-3">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-key"></i>&nbsp;เติมโค้ด
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <div class="container my-3">
            <form id="itemcode-form">
			<input type="hidden" name="action" value="redeemcode">
			<img src="<?=$uri;?>/assets/image/logo/Icon_Inventory.png" class="bord" align="left" style="width: 125px; margin-left:50px; border-radius: 25px;">
				<div class="col-md-6 offset-md-6" style="margin-bottom: 10px;">
					<div class="form-group">
						<div class="input-group mb-2 mr-sm-2">
   							<div class="input-group-prepend">
      						<div class="input-group-text" style="margin-top: 70px;"><i class="fa fa-key"></i></div>
    						</div>
   							<input class="form-control" id="codetext" name="codetext" type="text" placeholder="กรอกกิ๊ฟโค๊ดเพื่อรับรางวัล" style="margin-top: 70px;">
  						</div>
					</div>
					<center><a class="btn btn-success btn-block fd-success" onclick="clickRedeem()"><i class="fa fa-check hvr-icon"></i> ยืนยันโค๊ด</a></center>
				</div>
		</form>
         </div>
      </div>
   </div>
</div>
<?php include("usermenu/userlogin.php"); ?>