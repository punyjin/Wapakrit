<!-- Navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color: rgba(0,0,0,0.8)">
        <div class="container">
            <a class="navbar-brand" style="font-family: raleway" href="?page=home"> <?=$web['header'];?></a>
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
                            <a class="nav-link <?=@$_GET['page'] == 'kazenonekostaffmanager' ? 'active' : ''?>" style="color: green;" href="?page=kazenonekostaffmanager"><i class="fa fa-fw fa-wrench"></i>&nbsp;Staff Manager</a>
                        </li>
                    <?php } ?>
                    <!-- Other menu items can be added here -->

                </ul>
            </div>
        </div>
    </nav>
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
                    case 'kazenonekostaffmanager':
                        include("data/pages/page.staff.manager.php");
                        break;
                    case 'kazenonekostaffboard':
                        include("data/pages/page.staff.board.php");
                        break;
                    case 'kazenonekostaffdatabase':
                        include("data/pages/page.staff.board.php");
                        break;
                    case 'kazenekostaffreport':
                        include("data/pages/page.staff.report.php");
                        break;
                    case 'kazenonekostaffuserdata':
                        include("data/pages/page.staff.userdata.php");
                        break;
                    case 'kazenonekostaffbehavior':
                        include("data/pages/page.staff.behavior.php");
                        break;
                    case 'kazenonekostaffnotify':
                        include("data/pages/page.staff.notify.php");
                        break;
                    case 'kazenonekostaffreportworkcheck':
                        include("data/pages/page.staff.workcheck.php");
                        break;
                    case 'kazenonekostaffuserlist':
                        include("data/pages/page.staff.userlist.php");
                        break;
                    case 'genqrcode':
                        include("data/pages/page.staff.qrcode.php");
                        break;
                    case 'subscription':
                        include("data/pages/page.subscription.php");
                        break;
                    default:
                        include("data/pages/page.home.php");
                        break;
                }
                ?>