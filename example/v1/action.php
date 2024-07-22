<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/v1/connect.php");
include($_SERVER['DOCUMENT_ROOT'] . "/data/database/postgres.php");

function duration($begin, $end)
{
    $remain = intval(strtotime($end) - strtotime($begin));
    $minute = floor($remain / 60);
    return $minute;
}

function encripitar($pass)
{
    $salt   = '/x!a@r-$r%an¨.&e&+f*f(f(a)';
    $output = hash_hmac('md5', $pass, $salt);
    return $output;
}

function is_str($txt)
{
    if (!preg_match("/^[a-zA-Z0-9_]+$/", $txt)) {
        return false;
    } else {
        return true;
    }
}

$result = pg_query_params($dbconn, "SELECT * FROM accounts WHERE login=$1", [@$_SESSION['login_true']]) or die("Err Can not to result");
$dbarr = pg_fetch_array($result);
date_default_timezone_set('Asia/Bangkok');
$date_now = date("Y-m-d H:i:s", time());

$data = new stdClass();

if ($_POST['action'] == 'login') {
    $user_login = addslashes(trim($_POST['username']));
    $pwd_login  = addslashes(trim($_POST['password']));
    $hashpass   = hash_hmac('md5', $pwd_login, '/x!a@r-$r%an¨.&e&+f*f(f(a)');
    
    $result = pg_query_params($dbconn, "SELECT login, password FROM accounts WHERE login=$1 AND password=$2", [$user_login, $hashpass]);
    $num    = pg_num_rows($result);
    
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $data->status = "error";
        $data->desc   = "กรุณากรอกข้อมูลให้ครบ";
    } else {
        if ($num <= 0) {
            $data->status = "error";
            $data->desc   = "ชื่อผู้ใช้หรือรหัสผิดพลาด";
        } else {
            $_SESSION['login_true'] = $_POST['username'];
            $data->status           = "success";
            $data->desc             = "เข้าสู่ระบบสำเร็จ";
            $data->reload           = "true";
        }
    }
} else if ($_POST['action'] == 'logout') {
    session_destroy();
    $data->status = "success";
    $data->desc   = "ออกจากระบบสำเร็จ";
    $data->reload = "true";
} else if ($_POST['action'] == 'changepassword') {
    $pass      = $_POST['oldpass'];
    $npassword = $_POST['newpass'];
    $rpassword = $_POST['re_newpass'];
    
    $sql     = "SELECT * FROM accounts WHERE login = $1";
    $query   = pg_query_params($dbconn, $sql, [$_SESSION['login_true']]);
    $numrows = pg_num_rows($query);
    $rows    = pg_fetch_array($query);
    
    $hashpass  = hash_hmac('md5', $pass, '/x!a@r-$r%an¨.&e&+f*f(f(a)');
    $hashnpass = hash_hmac('md5', $npassword, '/x!a@r-$r%an¨.&e&+f*f(f(a)');
    
    if (empty($pass) || empty($npassword) || empty($rpassword)) {
        $data->status = "error";
        $data->desc   = "กรุณากรอกข้อมูลให้ครบ";
    } elseif ($npassword != $rpassword) {
        $data->status = "error";
        $data->desc   = "รหัสผ่านใหม่ไม่ตรงกัน";
    } elseif ($hashpass != $rows['password']) {
        $data->status = "error";
        $data->desc   = "รหัสผ่านปัจจุบันไม่ถูกต้อง";
    } else {
        $data->status = "success";
        $data->desc   = "เปลี่ยนรหัสผ่านสำเร็จ";
        $data->reload = "true";
        pg_query_params($dbconn, "UPDATE accounts SET password=$1 WHERE login=$2", [$hashnpass, $_SESSION['login_true']]);
        session_destroy();
    }
} else if ($_POST['action'] == 'topup') {
    $tmnpassword = $_POST['tmnpassword'];
    $query = pg_query_params($dbconn, "SELECT * FROM player_id WHERE login=$1", [$dbarr["login"]]);
    $date  = date("Y-m-d");
    $time  = date("H:i:s");
    $time_active = date('H:i:s', strtotime('+5 minutes', strtotime($time)));
    $aaaeee = date('Y-m-d H:i:s', strtotime('+90 minutes', strtotime($sq)));
    $lsbm = $time_active;
    $row = pg_fetch_array($query);
    $num_row = pg_num_rows($query);
    $ccpp = "1";
    $strhistopup = $dbarr['player_name'];
    $strSQLs = $nickname;

    if (empty($tmnpassword)) {
        $data->status = "error";
        $data->desc = "กรุณากรอกคำร้องขอในช่องข้อความ";
    } else if (isset($_SESSION['last_submits']) && (time() - $_SESSION['last_submits'] < 60 * 5)) { // 5 นาที Cooldown
        $data->status = "error";
        $data->desc = "กรุณารอเวลานับถอยหลัง และ ลองใหม่อีกครั้งในอีก " . (60 * 5 - (time() - $_SESSION['last_submits'])) . " วินาที";
    } else {
        $data->status = "success";
        $data->desc   = "ส่งข้อความคำร้องเรียบร้อย";
        $data->reload = "true";
        pg_query_params($dbconn, "INSERT INTO web_history_topup (player_id, truemoney_pin, amount, tranid, process) VALUES ($1, $2, 0, $3, 0)", [$dbarr['player_id'], $tmnpassword, $isTransaction]);
        
        $webhook = "https://discord.com/api/webhooks/1067446460381155369/t3zljBGYOkaBC94V_C0iMVZAGKxfh86Hy-KbyAbir2aKsQ-QKRyT6mGog9SbW3o0NqA2";
        $message = "UID : $strhistopup \nส่งคำร้องขอ : $tmnpassword";
        $_SESSION['last_submits'] = time();
        
        $base = ['content' => $message];
        
        $options = [
            CURLOPT_URL => $webhook,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($base),
            CURLOPT_RETURNTRANSFER => true,
        ];
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        file_get_contents($webhook, false, stream_context_create($options));
    }
} else if ($_POST['action'] == 'nickname') {
    $nickname = $_POST['nickname'];
    
    if (strlen($nickname) <= 0) {
        $data->status = "error";
        $data->desc   = "กรุณากรอกข้อมูลให้ครบ";
    } else {
        $sql2      = "SELECT * FROM accounts WHERE login = $1 and player_name = $2";
        $checkname = pg_query_params($dbconn, $sql2, [$_SESSION['login_true'], $nickname]);
        $c2        = pg_fetch_array($checkname);
        if ($c2) {
            $data->status = "error";
            $data->desc   = "พบชื่อนี้แล้วในระบบ";
        } else {
            $sql    = "SELECT * FROM accounts WHERE login = $1";
            $query  = pg_query_params($dbconn, $sql, [$_SESSION['login_true']]);
            $num    = pg_num_rows($query);
            $result = pg_fetch_array($query);
            if ($result['coin'] >= $config['price_name']) {
                pg_query_params($dbconn, "UPDATE accounts SET player_name = $1 WHERE login = $2", [$nickname, $_SESSION['login_true']]);
                pg_query_params($dbconn, "UPDATE accounts SET coin = coin - $1 WHERE login = $2", [$config['price_name'], $_SESSION['login_true']]);
                $data->status = "success";
                $data->desc   = "เปลี่ยนชื่อสำเร็จ";
                $data->reload = "true";
            } else {
                $data->status = "error";
                $data->desc   = "พ้อยไม่เพียงพอ";
            }
        }
    }
} else if ($_POST['action'] == 'colorname') {
    $nickcolor = $_POST['nickcolor'];
    
    if (strlen($nickcolor) <= 0) {
        $data->status = "error";
        $data->desc   = "กรุณากรอกข้อมูลให้ครบ";
    } else {
        $sql = "SELECT * FROM accounts WHERE login = $1";
        $query  = pg_query_params($dbconn, $sql, [$_SESSION['login_true']]);
        $result = pg_fetch_array($query);
        if ($result['coin'] >= $config['price_color']) {
            pg_query_params($dbconn, "UPDATE accounts SET player_color = $1 WHERE login = $2", [$nickcolor, $_SESSION['login_true']]);
            pg_query_params($dbconn, "UPDATE accounts SET coin = coin - $1 WHERE login = $2", [$config['price_color'], $_SESSION['login_true']]);
            $data->status = "success";
            $data->desc   = "เปลี่ยนสีชื่อสำเร็จ";
            $data->reload = "true";
        } else {
            $data->status = "error";
            $data->desc   = "พ้อยไม่เพียงพอ";
        }
    }
} else if ($_POST['action'] == 'cafestatus') {
    $duration     = $_POST['status_cafe'];
    $uid          = $_POST['uid'];
    $query_select = pg_query_params($dbconn, "SELECT * FROM accounts WHERE player_id = $1", [$uid]);
    $row          = pg_fetch_array($query_select);
    
    $cafe_gold    = $config['price_cafe_gold'];
    $cafe_premium = $config['price_cafe_premium'];
    
    if ($row['coin'] >= $cafe_gold && $duration == 'GOLD') {
        pg_query_params($dbconn, "UPDATE accounts SET coin = coin - $1, end_date = end_date + interval '30 days' WHERE player_id = $2", [$cafe_gold, $uid]);
        pg_query_params($dbconn, "UPDATE accounts SET cafe = 'GOLD' WHERE player_id = $1", [$uid]);
        $data->status = "success";
        $data->desc   = "ซื้อ GOLD CAFE สำเร็จ";
        $data->reload = "true";
    } elseif ($row['coin'] >= $cafe_premium && $duration == 'PREMIUM') {
        pg_query_params($dbconn, "UPDATE accounts SET coin = coin - $1, end_date = end_date + interval '30 days' WHERE player_id = $2", [$cafe_premium, $uid]);
        pg_query_params($dbconn, "UPDATE accounts SET cafe = 'PREMIUM' WHERE player_id = $1", [$uid]);
        $data->status = "success";
        $data->desc   = "ซื้อ PREMIUM CAFE สำเร็จ";
        $data->reload = "true";
    } else {
        $data->status = "error";
        $data->desc   = "พ้อยไม่เพียงพอ";
    }
} else if ($_POST['action'] == 'esportstatus') {
    $duration    = $_POST['status_esport'];
    $uid         = $_POST['uid'];
    $query_select = pg_query_params($dbconn, "SELECT * FROM accounts WHERE player_id = $1", [$uid]);
    $row         = pg_fetch_array($query_select);
    
    $esport_gold    = $config['price_esport_gold'];
    $esport_premium = $config['price_esport_premium'];
    
    if ($row['coin'] >= $esport_gold && $duration == 'GOLD') {
        pg_query_params($dbconn, "UPDATE accounts SET coin = coin - $1, end_date = end_date + interval '30 days' WHERE player_id = $2", [$esport_gold, $uid]);
        pg_query_params($dbconn, "UPDATE accounts SET esport = 'GOLD' WHERE player_id = $1", [$uid]);
        $data->status = "success";
        $data->desc   = "ซื้อ GOLD ESPORT สำเร็จ";
        $data->reload = "true";
    } elseif ($row['coin'] >= $esport_premium && $duration == 'PREMIUM') {
        pg_query_params($dbconn, "UPDATE accounts SET coin = coin - $1, end_date = end_date + interval '30 days' WHERE player_id = $2", [$esport_premium, $uid]);
        pg_query_params($dbconn, "UPDATE accounts SET esport = 'PREMIUM' WHERE player_id = $1", [$uid]);
        $data->status = "success";
        $data->desc   = "ซื้อ PREMIUM ESPORT สำเร็จ";
        $data->reload = "true";
    } else {
        $data->status = "error";
        $data->desc   = "พ้อยไม่เพียงพอ";
    }
} else if ($_POST['action'] == 'register') {
    $username    = $_POST['username'];
    $password    = $_POST['password'];
    $re_password = $_POST['re_password'];
    $email       = $_POST['email'];
    $hashpass   = hash_hmac('md5', $pwd_login, '/x!a@r-$r%an¨.&e&+f*f(f(a)');
    
    $sql_check_username = "SELECT * FROM accounts WHERE login = $1";
    $query_check_username = pg_query_params($dbconn, $sql_check_username, [$username]);
    
    if (trim($username) == "" || trim($password) == "" || trim($re_password) == "" || trim($email) == "") {
        $data->status = "error";
        $data->desc   = "กรุณากรอกข้อมูลให้ครบ";
    } else if (!is_str($_POST['username'])) {
        $data->status = "error";
        $data->desc   = "ชื่อผู้ใช้ต้องเป็นภาษาอังกฤษและตัวเลขเท่านั้น!";
    } else if ($password != $re_password) {
        $data->status = "error";
        $data->desc   = "รหัสผ่านไม่ตรงกัน";
    } else {
        $strSQL    = "SELECT * FROM accounts WHERE login = '" . trim($username) . "' "; // Verifica  ID
        $objQuery  = pg_query($dbconn,$strSQL);
        $objResult = pg_fetch_array($objQuery);
        if ($objResult) {
            $data->status = "error";
            $data->desc   = "ชื่อผู้ใช้นี้ถูกใช้งานไปแล้ว";
        } else {
            $strSQL               = "INSERT INTO accounts (login,password,email,token,repassword) VALUES ('" . $username . "','" . encripitar($password) . "','" . $email . "','" . encripitar($username) . "','". ($re_password) ."')";
            $objQuery             = pg_query($dbconn,$strSQL);
            $_SESSION['username'] = $_POST['txtUsername'];
            $data->status         = "success";
            $data->desc           = "สมัครสมาชิกสำเร็จ";
            $data->reload         = "true";
        }
    }
} else if ($_POST['action'] == 'pointitem') {
    $item_id = $_POST['itemid'];
    $point_id = $_POST['pointid'];
    
    $sql_check_point = "SELECT * FROM points WHERE id = $1";
    $query_check_point = pg_query_params($dbconn, $sql_check_point, [$point_id]);
    $row_point = pg_fetch_array($query_check_point);
    
    $sql_check_user = "SELECT * FROM accounts WHERE login = $1";
    $query_check_user = pg_query_params($dbconn, $sql_check_user, [$_SESSION['login_true']]);
    $row_user = pg_fetch_array($query_check_user);
    
    if ($row_user['point'] >= $row_point['point']) {
        pg_query_params($dbconn, "UPDATE accounts SET point = point - $1 WHERE login = $2", [$row_point['point'], $_SESSION['login_true']]);
        pg_query_params($dbconn, "INSERT INTO web_history_point (login, item_id, point, date) VALUES ($1, $2, $3, NOW())", [$_SESSION['login_true'], $item_id, $row_point['point']]);
        $data->status = "success";
        $data->desc   = "ซื้อไอเท็มสำเร็จ";
        $data->reload = "true";
    } else {
        $data->status = "error";
        $data->desc   = "พ้อยไม่เพียงพอ";
    }
} else if ($_POST['action'] == 'sharepoint') {
    $item_id = $_POST['itemid'];
    $share_id = $_POST['shareid'];
    
    $sql_check_share = "SELECT * FROM share_points WHERE id = $1";
    $query_check_share = pg_query_params($dbconn, $sql_check_share, [$share_id]);
    $row_share = pg_fetch_array($query_check_share);
    
    $sql_check_user = "SELECT * FROM accounts WHERE login = $1";
    $query_check_user = pg_query_params($dbconn, $sql_check_user, [$_SESSION['login_true']]);
    $row_user = pg_fetch_array($query_check_user);
    
    if ($row_user['share_point'] >= $row_share['share_point']) {
        pg_query_params($dbconn, "UPDATE accounts SET share_point = share_point - $1 WHERE login = $2", [$row_share['share_point'], $_SESSION['login_true']]);
        pg_query_params($dbconn, "INSERT INTO web_history_share (login, item_id, share_point, date) VALUES ($1, $2, $3, NOW())", [$_SESSION['login_true'], $item_id, $row_share['share_point']]);
        $data->status = "success";
        $data->desc   = "ซื้อไอเท็มสำเร็จ";
        $data->reload = "true";
    } else {
        $data->status = "error";
        $data->desc   = "พ้อยไม่เพียงพอ";
    }
} else if ($_POST['action'] == 'redeem') {
    $code = $_POST['code'];
    $sql_check_code = "SELECT * FROM redeem_codes WHERE code = $1";
    $query_check_code = pg_query_params($dbconn, $sql_check_code, [$code]);
    $row_code = pg_fetch_array($query_check_code);
    
    $sql_check_user = "SELECT * FROM accounts WHERE login = $1";
    $query_check_user = pg_query_params($dbconn, $sql_check_user, [$_SESSION['login_true']]);
    $row_user = pg_fetch_array($query_check_user);
    
    if ($row_code) {
        if ($row_code['used'] == 0) {
            pg_query_params($dbconn, "UPDATE redeem_codes SET used = 1 WHERE code = $1", [$code]);
            pg_query_params($dbconn, "UPDATE accounts SET point = point + $1 WHERE login = $2", [$row_code['point'], $_SESSION['login_true']]);
            $data->status = "success";
            $data->desc   = "แลกรางวัลสำเร็จ";
            $data->reload = "true";
        } else {
            $data->status = "error";
            $data->desc   = "โค้ดนี้ถูกใช้ไปแล้ว";
        }
    } else {
        $data->status = "error";
        $data->desc   = "ไม่พบโค้ดนี้";
    }
}

echo json_encode($data);
?>
