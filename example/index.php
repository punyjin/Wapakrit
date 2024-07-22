<?php
session_start();

include("v1/connect.php");
include("data/database/postgres.php"); 

// Count total players
$cPlayer = $connec->prepare('SELECT player_id FROM accounts');
$cPlayer->execute();
$countPlayer = $cPlayer->rowCount();

// Count online players
$cPlayerOnline = $connec->prepare('SELECT player_id FROM accounts WHERE online = true');
$cPlayerOnline->execute();
$countPlayerOnline = $cPlayerOnline->rowCount();

if (isset($_SESSION['login_true'])) {
    $loginTrue = $_SESSION['login_true'];
    $result = $connec->prepare("SELECT * FROM accounts WHERE login = :login");
    $result->bindParam(':login', $loginTrue, PDO::PARAM_STR);
    $result->execute();
    $dbarr = $result->fetch(PDO::FETCH_ASSOC);
    
    if (!$dbarr) {
        die("กำลังเเก้ไขระบบกรุณารอซักครู่");
    }
} else {
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$web['title'];?></title>
    <link rel="icon" href="<?=$uri;?>/assets/images/img/icon.ico">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/v4-shims.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=$uri;?>/assets/css/style.css?t=<?=time();?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <!-- Font Awesome Scripts -->
    <script src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.3.1/js/v4-shims.js"></script>

    <!-- SweetAlert2 -->
    <script src="<?=$uri;?>/assets/js/sweetalert2.min.js"></script>

    <!-- Custom JS -->
     <script src="v1/web/web.jsmain.encrypt.js"></script>
    
    
    <style>
        body {
            font-family: 'Kanit', serif;
            font-size: 12px;
        }
        
        .shadowbox {
            background: none!important;
            border: 2px inset rgba(0,0,0,0.2)!important;
            border-radius: none;
            -webkit-box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.75);
            box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.75);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color: rgba(0,0,0,0.8)">
        <div class="container">
            <a class="navbar-brand" style="font-family: raleway" href="<?=$uri;?>/?header"><?=$web['header'];?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link <?=@$_GET['page'] == 'home' ? 'active' : ''?>" href="?page=home"><i class="fa fa-fw fa-home"></i>&nbsp;หน้าแรก</a>
                    </li>
                    <?php
                     if (isset($_SESSION['login_true'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?=@$_GET['page'] == 'product' ? 'active' : ''?>" href="?page=product"><i class="fa fa-fw fa-shopping-cart"></i>&nbsp;ร้านค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=@$_GET['page'] == 'redeem' ? 'active' : ''?>" href="?page=redeem"><i class="fa fa-fw fa-key"></i>&nbsp;Redeem Code</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=@$_GET['page'] == 'subscription' ? 'active' : ''?>" href="?page=subscription"><i class="fa fa-fw fa-key"></i>&nbsp;Subscription</a>
                    </li>
                    <?php } ?>
                    <?php if(isset($_SESSION['login_true']) && $dbarr['access_level'] >= "6") { ?>
                        <!-- For Moderator Users -->
                        <li class="nav-item">
                            <a class="nav-link <?=@$_GET['page'] == 'kazenekostaffmanager' ? 'active' : ''?>" style="color: green;" href="?page=kazenekostaffmanager"><i class="fa fa-fw fa-wrench"></i>&nbsp;Staff Manager</a>
                        </li>
                    <?php } ?>
                    <!-- Other menu items can be added here -->

                </ul>
            </div>
        </div>
    </nav>
   <br>
    <center>
         <div class="logo" style="margin-top: 0px;">
            <img src="<?=$uri;?>/assets/images/kkb/anim_logo.jpg" class="img-fluid " width="200" height="1" id="animation" >
         </div>
   </center>
   <br><br>
   <div class="container" style="margin-top:0.1rem;">
         <div class="row">
            <div class="col-sm-12" style="margin-bottom: 10px;">
               <div class="card" id="header_stat">
                  <div class="card-body" style="padding: 15px; border-bottom:4px ;position: relative; font-size:18px;">
                     <center>
                        <?php
                           if($web['status'] == "1"){
                           ?>
                        <i class="fa fa-server"></i>&nbsp;Game Server Status : <span style="color: #0F0"><i class="fa fa-circle-o-notch fa-spin"></i> ออนไลน์</span> 
                        <?php
                           }else{
                           	?>
                        <i class="fa fa-server"></i>&nbsp;Game Server Status : <span style="color: red"><i class="fa fa-circle-o-notch fa-spin"></i> ปิดปรับปรุง</span>
                        <?php
                           }
                           ?>
                     </center>
                  </div>
               </div>
            </div>
            <?php
                $page = isset($_GET['page']) ? $_GET['page'] : '';

                switch ($page) {
                    case 'home':
                        include("data/pages/page.home.php");
                        break;
                    case 'register':
                        include("data/pages/page.register.php");
                        break;
                    case 'product':
                        include("data/pages/page.shop.php");
                        break;
                    case 'redeem':
                        include("data/pages/page.redeem.php");
                        break;
                    case 'subscription':
                        include("data/pages/page.subscription.php");
                        break;
                    default:
                        include("data/pages/page.home.php");
                        break;
                }
                ?>
         </div>
      </div>
    </div>
    <!-- Footer -->
    <footer style="background-color:#2a2c2d!important">
         <div class="contx" style="padding:8px;color:#FFF; text-align:center;">
            <small style="font-size:14px;">Design & System By <a href="https://discord.gg/kazeneko" target="_blank" class="credit-footer"><?php echo $config['footer_credit']; ?></a></small>
         </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
</body>

</html>
