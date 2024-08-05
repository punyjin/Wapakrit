<style>
.btn-group-xs > .btn, .btn-xs {
  padding: .50rem .4rem;
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem;
}
</style>

<table id="web_history_topup" cellspacing="0" width="100%" class="table" style="margin: 0;">
   <thead>
      <tr>
         <th style="text-align:center">#</th>
         <th style="text-align:center">ไอเท็ม</th>
         <th style="text-align:center">รูป</th>
         <th style="text-align:center">ราคา</th>
         <th style="text-align:center">เวลา</th>
		 <th style="text-align:center">จำนวน</th>
      </tr>
   </thead>
   <tbody>
      <?php
         /*session_start();
         include("/connect.php");
         include("/data/database/postgres.php");
         $result = pg_query($dbconn,"select * from accounts where login='".$_SESSION['login_true']."'") or die ("กำลังเเก้ไขระบบกกรุณารอซํกครู่");
         $dbarr = pg_fetch_array($result);
         $strhistopup = "SELECT * FROM webshop_log where player_id='".$dbarr['player_id']."' order by player_id desc";
         $qrtopup = pg_query($dbconn,$strhistopup);
         $num = 1;
                          
         while ($rstopup = pg_fetch_array($qrtopup)) { 
        */ ?>
      <tr class="50">
         <td style="text-align:center"><?php echo $num; ?></td>
         <td style="text-align:center"><?php echo $rstopup['item_name'];?></td>
         <td style="text-align:center" width="5%"><img src="<?=$uri;?>/assets/image/shop/<?=$rstopup['img'];?>.png" id="image" style="width:48px; height:25px;"></td>
         <td style="text-align:center"><?php echo number_format($rstopup['price'],2);?> บาท</td>
		 <td style="text-align:center"><?php echo $rstopup['date'];?></td>
		 <td style="text-align:center"><?php echo $rstopup['day'];?> ชิ้น</td>
      </tr>
      <?php $num++; } ?>
   </tbody>
</table>