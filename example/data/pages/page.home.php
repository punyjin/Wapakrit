<?php
$cPlayer = $connec->prepare('SELECT player_id FROM accounts');
$cPlayer->execute();
//$countPlayer = $cPlayer->rowCount();

$cPlayer1 = $connec->prepare('SELECT player_id FROM accounts');
//$cPlayer1->execute();
//$countPlayer1 = $cPlayer1->rowCount();

error_reporting(~E_NOTICE);
$user_login = addslashes(trim($_POST['user_login']));
$pwd_login = addslashes(trim($_POST['pwd_login']));
$hashpass = hash_hmac('md5', $pwd_login, $config['md5_salt']);

function GenerateRandomString($length = 8) 
{
   return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),3,$length);
}
$Random = GenerateRandomString(8);
?>

<div class="col-lg-8 order-md-1">
   <div class="card mb-4">
      <div class="card-header" id="header">
         <i class="fa fa-fw fa-box"></i>&nbsp;กิจกรรม และ โปรโมชั่น
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <div class="card-content" style="padding: 0px;">
            <div id="newscarousel" class="carousel slide carousel-fade" data-ride="carousel" style="height: 400px !important">
               <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0"class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
               </ol>
               <div class="carousel-inner">
                  <div class="carousel-item active"><img src="<?=$uri;?>/assets/images/xorbit/ABOUT.png" class="d-block w-100" style="height: 400px !important"></div>
                  <div class="carousel-item "><img src="<?=$uri;?>/assets/images/xorbit/GAMEINDEVELOPMENT.png" class="d-block w-100" style="height: 400px !important"></div>
                  <div class="carousel-item "><img src="<?=$uri;?>/assets/images/xorbit/PIXELFIGHTER.png" class="d-block w-100" style="height: 400px !important"></div>
                  <div class="carousel-item "><img src="<?=$uri;?>/assets/images/xorbit/PIXELFIGHTER_INFORM.png" class="d-block w-100" style="height: 400px !important"></div>
               </div>
               <a class="carousel-control-prev" href="#newscarousel" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#newscarousel" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
               </a>
               <script>
                  $('#newscarousel').carousel({
                   	interval: 2000
                  })
               </script>
            </div>
         </div>
      </div>
   </div>
   <div class="card mb-3">
      <div class="card-header" id="header">
         <b><i class="fa fa-fw fa-newspaper-o"></i>&nbsp;Event & Promotion</b> กิจกรรม และ โปรโมชั่น ใหม่
      </div>
      <div class="card-body" style="padding: 0px; border-top:4px solid #306aff;position: relative;">
         <table class="table" style="width: 100%;">
			<?php 
				$strSQL6 = "SELECT * FROM announce order by id desc limit 5 ";
				$objQuery2  = pg_query($dbconn,$strSQL6) or die("Error Query [".$strSQL6."]");
				while($result_aannounce = pg_fetch_array($objQuery2))
				{ ?>
               <tr>
                  <td style="width: 100%;">
                     <label class="badge badge-success" style="font-size: 13px;">โปรโมชั่น</label>
                     <a id="newsevent" href="?page=<?=$result_aannounce['url'];?>"  style="font-size: 15px; color: white;">
						<?=$result_aannounce['detail'];?>
                     </a>
                  </td>
                  <td class="text-right" style="color: pink;">
                     *
                  </td>
               </tr>
				<?php } ?>
         </table>
      </div>
   </div>
</div>

<?php include("usermenu/userlogin.php"); ?>