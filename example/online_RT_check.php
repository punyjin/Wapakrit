<?php
   session_start();		 
   include("v1/connect.php");
   
   include("data/database/mysql.php"); 
   $cPlayerOnline = $connec->prepare('SELECT player_id FROM accounts WHERE online = true');
   $cPlayerOnline->execute();
   $countPlayerOnline = $cPlayerOnline->rowCount();
   $result = pg_query("select * from accounts where login='".@$_SESSION[login_true]."'") or die ("กำลังเเก้ไขระบบกกรุณารอซํกครู่");
   $dbarr = pg_fetch_array($result);
   $strhistopup = "SELECT * FROM accounts WHERE online='true'";
   $qq = pg_query($strhistopup);
   ?>
<?php echo pg_escape_string($countPlayerOnline); ?>